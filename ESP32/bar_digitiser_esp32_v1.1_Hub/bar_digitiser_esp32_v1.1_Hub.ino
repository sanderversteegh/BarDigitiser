#include <ArduinoJson.h>
#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>        // Include the Wi-Fi library
#include <HTTPClient.h>
#include <LiquidCrystal_I2C.h>
#include <SimpleTimer.h>
#include <WiFiManager.h>          //https://github.com/tzapu/WiFiManager WiFi Configuration Magic
#include <analogWrite.h>

#include <melody_player.h>
#include <melody_factory.h>

// set the LCD number of columns and rows
int lcdColumns = 16;
int lcdRows = 2;



// set LCD address, number of columns and rows
// if you don't know your display address, run an I2C scanner sketch
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);

const char* ssid3     = "";         // The SSID (name) of the Wi-Fi network you want to connect to
const char* password3 = "";     // The password of the Wi-Fi network

const char* ssid2     = "";         // The SSID (name) of the Wi-Fi network you want to connect to
const char* password2 = "";     // The password of the Wi-Fi network

const char* ssid     = "";         // The SSID (name) of the Wi-Fi network you want to connect to
const char* password = "";     // The password of the Wi-Fi network

const char *host = "";
const char* API_user = "";
const char* API_password = "";


#define RST_PIN         14          // Configurable, see typical pin layout above
#define SS_PIN          17         // Configurable, see typical pin layout above

#define SCK_PIN         18
#define MISO_PIN        19
#define MOSI_PIN        23

#define Beer_B          34
#define Soft_B          35
#define Balance_B       32

#define Beer_led        26
#define Soft_led        25
#define Balance_led     33
#define Power_led       13

#define buzzer          12

#define Battery_PIN     36

#define battMaxV        4.2
#define battminV        2.5

#define highBrightness 255
#define lowBrightness 5


MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance

bool newRead = 0;
byte counter = 0;
bool wipeBypas = 0;

byte option_select = 0;
byte brightness = 10;

const char *c_name = "";
const char *c_balance = "";

String card_name = "";
String card_balance = "";

float batteryVoltage = 0;
long rssi = 0;

MelodyPlayer player(buzzer, LOW);

SimpleTimer wipeTimer (2000);
SimpleTimer batteryTimer (2000);
SimpleTimer blinkTimer (500);
SimpleTimer energySaveTimer (120000);



bool blinkBit = 0;
bool setupMode = 0;


//----------------------- Setup wifi manager --------

void configModeCallback(WiFiManager *myWiFiManager) {
  Serial.println("Entered config mode");
  Serial.println(WiFi.softAPIP());

  Serial.println(myWiFiManager->getConfigPortalSSID());

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Config SSD:");
  lcd.setCursor(0, 1);
  lcd.print(myWiFiManager->getConfigPortalSSID());
}

//----------------------- Connects to wifi --------
void wifi_connect() {
  bool res;

  WiFiManager wifiManager;

  int i = 0;
  Serial.print("Connecting wifi");
  //Serial.print(ssid); Serial.println(" ...");

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Connect to wifi");

  //first parameter is name of access point, second is the password
  wifiManager.setAPCallback(configModeCallback);
  wifiManager.setWiFiAutoReconnect(true);

  // When the Beer and balance button are prest and the soft not on startup, reset wifi settings.
  if (setupMode == 1) {
    Serial.println("//-------------------------------//");
    Serial.println("Wifi reset");
    //res = wifiManager.startConfigPortal("BarScanner-Setup");
    wifiManager.resetSettings();

    setupMode = 0;
  }
  res = wifiManager.autoConnect("BarScanner-Setup");

  if (!res) {
    //Conection failet
    lcd.setCursor(0, 0);
    lcd.print("Connection fail");
    delay(1000);
    lcd.setCursor(0, 1);
    lcd.print("Ressetting");
    delay (1500);
    ESP.restart();
    delay(5000);
  }
  else {

    Serial.println('\n');
    Serial.println("Connection established!");
    Serial.print("IP address:\t");
    Serial.println(WiFi.localIP());         // Send the IP address of the ESP8266 to the computer
    Serial.println(wifiManager.getLastConxResult());

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Connected       ");
    lcd.setCursor(0, 1);
    lcd.print(WiFi.localIP());
    delay(1000);
    lcd.clear();

    delay(1000);       // Optional delay. Some board do need more time after init to be ready, see Readme
  }
}


//-----------------------Buzzer --------

void melodyfun(String play) {

  String notesStart[] = { "C4", "G3", "G3", "A3", "G3"};
  // Load and play a correct melody
  Melody start = MelodyFactory.load("start", 250, notesStart, 5);

  String notesClosed[] = { "B3" };
  // Load and play a correct melody
  Melody scan = MelodyFactory.load("scan", 175, notesClosed, 1);

  String notesOpent[] = { "C8", "SILENCE", "C8", };
  // Load and play a correct melody
  Melody opent = MelodyFactory.load("opent", 150, notesOpent, 3);

  String notesUnknown[] = { "C8", "C8", "C8" };
  // Load and play a correct melody
  Melody error = MelodyFactory.load("error", 175, notesUnknown, 3);

  if (play == "start") {
    player.play(start);
    digitalWrite(buzzer, LOW);
  }
  else if (play == "scan") {
    player.play(scan);
    digitalWrite(buzzer, LOW);
  }
  else if (play == "opent") {
    player.play(opent);
    digitalWrite(buzzer, LOW);
  }
  else if (play == "error") {
    player.play(error);
    digitalWrite(buzzer, LOW);
  }
  return;
}


void setup() {

  Serial.begin(9600);   // Initialize serial communications with the PC
  //while (!Serial);    // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)

  //Setup button pins
  pinMode(Beer_B, INPUT_PULLUP);
  pinMode(Soft_B, INPUT_PULLUP);
  pinMode(Balance_B, INPUT_PULLUP);

  pinMode(Beer_led, OUTPUT);
  pinMode(Soft_led, OUTPUT);
  pinMode(Balance_led, OUTPUT);

  pinMode(Battery_PIN, INPUT);
  pinMode(buzzer, OUTPUT);

  digitalWrite(buzzer, LOW);


  if ((digitalRead(Beer_B) == LOW) && (digitalRead(Soft_B) == HIGH) && (digitalRead(Balance_B) == LOW)) {
    setupMode = 1;
  }

  // initialize LCD
  lcd.init();
  // turn on LCD backlight
  lcd.backlight();
  lcd.print("Hello, welkom!");
  delay(1000);
  lcd.clear();

  // setup SPI and reader
  SPI.begin(SCK_PIN, MISO_PIN, MOSI_PIN, SS_PIN);      // Init SPI bus
  mfrc522.PCD_Init();   // Init MFRC522
  delay(10);       // Optional delay. Some board do need more time after init to be ready, see Readme

  //setup wifi
  wifi_connect();

  mfrc522.PCD_DumpVersionToSerial();  // Show details of PCD - MFRC522 Card Reader details
  Serial.println(F("Done with start-up"));
  
  melodyfun("start");
  energySaveTimer.reset();
}

//----------------------- confert incomming data to variables --------

void energySaving(){
  if (energySaveTimer.isReady()){
    brightness = lowBrightness;
    lcd.noBacklight();
  }
  else
  {
     brightness = highBrightness;
     lcd.backlight();
  }
}


//----------------------- confert incomming data to variables --------
void confert_json(String json) {
  StaticJsonDocument<200> doc;
  DeserializationError error = deserializeJson(doc, json);
  // Test if parsing succeeds.
  if (error) {
    Serial.print(F("deserializeJson() failed: "));
    Serial.println(error.f_str());
    return;
  }
  c_name = doc["card_name"];
  c_balance = doc["card_balance"];
  card_name = c_name;
  card_balance = String(c_balance);
  Serial.print("card_name: " + card_name);
  Serial.print("card_balance: " + card_balance);
}


//-----------------------Http codes handeling
void http_code(int http_code) {

  if (http_code == 405) {
    Serial.print("Error 405: Kaart onbekend");
    lcd.clear();
    lcd.print("Error!!");
    lcd.setCursor(0, 1);
    lcd.print("Kaart onbekend");
    melodyfun("error");
  } else if (http_code == 101) {
    Serial.print("Error 101: Kaart uigeschakeld");
    lcd.clear();
    lcd.print("Error!!");
    lcd.setCursor(0, 1);
    lcd.print("Kaart disabled");
    melodyfun("error");
  } else if (http_code == 102) {
    Serial.print("Error 102: geen saldo");
    lcd.clear();
    lcd.print("Error!!");
    lcd.setCursor(0, 1);
    lcd.print("Geen saldo :-(");
    melodyfun("error");
  } else {
    Serial.print("Error " + String(http_code));
    lcd.clear();
    lcd.print("Error " + String(http_code));
    melodyfun("error");
  }
}

//----------------------- Get balance function --------
void get_balance(String UID) {
  Serial.println("Get balance");
  String API_prefix = "wp-json/bar/v1/get_balance/?UID=";
  String link = host + API_prefix + UID;

  //std::unique_ptr<BearSSL::WiFiClientSecure>client(new BearSSL::WiFiClientSecure);
  //client->setInsecure();
  HTTPClient https;


  if (https.begin(link)) {  // HTTPS
    https.setAuthorization(API_user, API_password); // Will set _base64Authorization to base64encode(user+ ':' + pass)
    Serial.println("[HTTPS] GET...");
    int httpCode = https.GET();

    // httpCode will be negative on error
    if (httpCode > 0) {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTPS] GET... code: %d\n", httpCode);
      // file found at server?
      if (httpCode == HTTP_CODE_OK) {
        String payload = https.getString();
        Serial.println(String("[HTTPS] Received payload: ") + payload);
        confert_json(payload);
        Serial.println(card_name);
        lcd.clear();
        lcd.print("Card:" + card_name);
        lcd.setCursor(0, 1);
        lcd.print("Saldo:" + card_balance);
        lcd.setCursor(14, 1);
        lcd.print("BC");
      }
      else {
        http_code(httpCode);
      }
    } else {
      Serial.printf("[HTTPS] GET... failed, error: %s\n\r", https.errorToString(httpCode).c_str());
      lcd.clear();
      lcd.print("Timeout");
      lcd.setCursor(0, 1);
      lcd.print("Probeer nogmaal");
      melodyfun("error");
    }

    https.end();
  } else {
    Serial.printf("[HTTPS] Unable to connect\n\r");
    lcd.clear();
    lcd.print("Error");
    lcd.setCursor(0, 1);
    lcd.print("Unable to connect");
    melodyfun("error");
  }

  option_select = 0;

  analogWrite(Beer_led, brightness);
  analogWrite(Soft_led, 0);
  analogWrite(Balance_led, 0);

  return;
}



//----------------------- BUY function --------
void buy(String UID) {
  Serial.println("Buy a product");
  String API_prefix = "wp-json/bar/v1/buy/?UID=";
  String link = host + API_prefix + UID;
  String product = "";

  if (option_select == 0) {
    product = "beer";
  }
  else if (option_select == 1) {
    product = "softdrink";
  }

  //std::unique_ptr<BearSSL::WiFiClientSecure>client(new BearSSL::WiFiClientSecure);
  //client->setInsecure();
  HTTPClient https;


  if (https.begin(link)) {  // HTTPS
    https.setAuthorization(API_user, API_password); // Will set _base64Authorization to base64encode(user+ ':' + pass)
    Serial.println("[HTTPS] POST...");
    int httpCode = https.POST("{\"product\":\"" + product + "\"}");

    // httpCode will be negative on error
    if (httpCode > 0) {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTPS] GET... code: %d\n", httpCode);
      // file found at server?
      if (httpCode == HTTP_CODE_OK) {
        String payload = https.getString();
        Serial.println(String("[HTTPS] Received payload: ") + payload);
        confert_json(payload);
        lcd.clear();
        lcd.print("Aankoop geslaagd!");
        lcd.setCursor(0, 1);
        lcd.print("Saldo: " + card_balance);
        lcd.setCursor(14, 1);
        lcd.print("BC");
      }
      else {
        http_code(httpCode);
      }
    } else {
      Serial.printf("[HTTPS] GET... failed, error: %s\n\r", https.errorToString(httpCode).c_str());
      lcd.clear();
      lcd.print("Timeout");
      lcd.setCursor(0, 1);
      lcd.print("Probeer nogmaal");
      melodyfun("error");
    }

    https.end();
  } else {
    Serial.printf("[HTTPS] Unable to connect\n\r");
    lcd.clear();
    lcd.print("Error");
    lcd.setCursor(0, 1);
    lcd.print("Unable to connect");
    melodyfun("error");
  }

  return;
}

void battery_measurement() {
  if (batteryTimer.isReady()) {
    int ADC_value = analogRead(Battery_PIN);
    Serial.print("ADC VALUE = ");
    Serial.println(ADC_value);

    batteryVoltage = (ADC_value - 247);
    batteryVoltage = (batteryVoltage / 1140);
    batteryVoltage = (batteryVoltage + 1);
    Serial.print("Voltage= ");
    Serial.println (batteryVoltage);

    rssi = WiFi.RSSI();
    Serial.print("RSSI:");
    Serial.println(rssi);


    batteryTimer.reset();
  }
}

void signalStrength(int xpos, int ypos)
{
  //read the voltage and convert it to volt
  //Serial.print("curvolt= ");
  //Serial.println(curvolt);
  // check if voltge is bigger than 4.2 volt so this is a power source
  if (rssi == 0) {
    byte signallevel[8] = {
      B10001,
      B01010,
      B00100,
      B01010,
      B10001,
      B00000,
      B00000,
      B00001,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }

  else if (rssi > -30)
  {
    byte signallevel[8] = {
      B11111,
      B11111,
      B01111,
      B01111,
      B00111,
      B00111,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else if (rssi > -50)
  {
    byte signallevel[8] = {
      B00000,
      B11111,
      B01111,
      B01111,
      B00111,
      B00111,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else if (rssi > -60)
  {
    byte signallevel[8] = {
      B00000,
      B00000,
      B01111,
      B01111,
      B00111,
      B00111,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else if (rssi > -67)
  {
    byte signallevel[8] = {
      B00000,
      B00000,
      B00000,
      B01111,
      B00111,
      B00111,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else if (rssi > -70)
  {
    byte signallevel[8] = {
      B00000,
      B00000,
      B00000,
      B00000,
      B00111,
      B00111,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else if (rssi > -80)
  {
    byte signallevel[8] = {
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00111,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else if (rssi > -90)
  {
    byte signallevel[8] = {
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00011,
      B00011,
    };
    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
  else
  {
    byte signallevel[8] = {
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00011,
    };

    lcd.createChar(1 , signallevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(1));
  }
}


void batterylevel(int xpos, int ypos)
{
  battery_measurement();
  //read the voltage and convert it to volt
  double curvolt = double(batteryVoltage);
  //Serial.print("curvolt= ");
  //Serial.println(curvolt);
  // check if voltge is bigger than 4.2 volt so this is a power source
  if (curvolt > 4.2)
  {
    byte batlevel[8] = {
      B01110,
      B11111,
      B10101,
      B10001,
      B11011,
      B11011,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else if (curvolt > 4.0)
  {
    byte batlevel[8] = {
      B01110,
      B11111,
      B11111,
      B11111,
      B11111,
      B11111,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else if (curvolt > 3.8)
  {
    byte batlevel[8] = {
      B01110,
      B10001,
      B11111,
      B11111,
      B11111,
      B11111,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else if (curvolt > 3.6)
  {
    byte batlevel[8] = {
      B01110,
      B10001,
      B10001,
      B11111,
      B11111,
      B11111,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else if (curvolt > 3.4)
  {
    byte batlevel[8] = {
      B01110,
      B10001,
      B10001,
      B10001,
      B11111,
      B11111,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else if (curvolt > 3.2)
  {
    byte batlevel[8] = {
      B01110,
      B10001,
      B10001,
      B10001,
      B10001,
      B11111,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else if (curvolt > 3.0)
  {
    byte batlevel[8] = {
      B01110,
      B10001,
      B10001,
      B10001,
      B10001,
      B10001,
      B11111,
      B11111,
    };
    lcd.createChar(0 , batlevel);
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));
  }
  else
  {
    byte batlevelON[8] = {
      B01110,
      B10001,
      B10001,
      B10001,
      B10001,
      B10001,
      B10001,
      B11111,
    };
    byte batlevelOFF[8] = {
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
      B00000,
    };

    if (blinkBit == 0) {
      lcd.createChar(0 , batlevelON);
    }
    else {
      lcd.createChar(0 , batlevelOFF);
    }
    lcd.setCursor(xpos, ypos);
    lcd.write(byte(0));

    if (blinkTimer.isReady()) {
      if (blinkBit == 0) {
        blinkBit = 1;
      }
      else {
        blinkBit = 0;
      }
      blinkTimer.reset();
    }
  }
}

void button_check() {
  if (digitalRead(Beer_B) == LOW) {
    option_select = 0;
    analogWrite(Beer_led, highBrightness);
    analogWrite(Soft_led, 0);
    analogWrite(Balance_led, 0);
    energySaveTimer.reset();
  }
  if (digitalRead(Soft_B) == LOW) {
    option_select = 1;
    analogWrite(Beer_led, 0);
    analogWrite(Soft_led, highBrightness);
    analogWrite(Balance_led, 0);
    energySaveTimer.reset();
  }
  if (digitalRead(Balance_B) == LOW) {
    option_select = 2;

    analogWrite(Beer_led, 0);
    analogWrite(Soft_led, 0);
    analogWrite(Balance_led, highBrightness);
    energySaveTimer.reset();
  }

  if (wipeTimer.isReady() || (wipeBypas == 1)){
    wipeBypas = 0;
    lcd.setCursor(0, 0);
    lcd.print("Scan kaart     ");

    if (option_select == 0) {
      lcd.setCursor(0, 1);
      lcd.print("Bier           ");

      analogWrite(Beer_led, brightness);
      analogWrite(Soft_led, 0);
      analogWrite(Balance_led, 0);
    }
    else if (option_select == 1) {
      lcd.setCursor(0, 1);
      lcd.print("Fris           ");

      analogWrite(Beer_led, 0);
      analogWrite(Soft_led, brightness);
      analogWrite(Balance_led, 0);
    }
    else if (option_select == 2) {
      lcd.setCursor(0, 1);
      lcd.print("Bekijk saldo   ");

      analogWrite(Beer_led, 0);
      analogWrite(Soft_led, 0);
      analogWrite(Balance_led, brightness);
    }

    batterylevel(15, 1);
    signalStrength(15, 0);

  }
  return;
}


//--------------------Loop -------------
void loop() {
  button_check();
  energySaving();

  if (WiFi.status() != WL_CONNECTED) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("No wifi");
    lcd.setCursor(0, 1);
    lcd.print("Reconecting");
    while (WiFi.status() != WL_CONNECTED) {
      WiFi.reconnect();

      batterylevel(15, 1);
      signalStrength(15, 0);
      delay (5000);
    }
  }


  // Reset the loop if no new card present on the sensor/reader. This saves the entire process when idle.
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  String content = "";
  byte letter;
  for ( byte i = 0; i < mfrc522.uid.size; i++ ) {
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
    Serial.println("----- UID conversie----");
    Serial.println(content);

  }

  if (content != "") {
    energySaveTimer.reset();
    wipeBypas = 1;
    button_check();
    energySaving();
    
    
    content.toUpperCase();
    Serial.println();
    Serial.println("UID tag :'" + content + "'");
    lcd.clear();
    lcd.print("uid:" + content);
    lcd.setCursor(0, 1);
    lcd.print("verwerken....");
    melodyfun("scan");
    if (option_select == 0 || option_select == 1) {
      buy(content);
    }
    else if (option_select == 2) {
      get_balance(content);
    }
    wipeTimer.reset();
  }
}
