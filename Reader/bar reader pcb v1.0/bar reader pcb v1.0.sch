EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title ""
Date ""
Rev ""
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L symbols_esp32_devkit_v1_doit:ESP32_DevKit_V1_DOIT U3
U 1 1 605C0A90
P 4450 3750
F 0 "U3" H 4450 5550 50  0000 C CNN
F 1 "ESP32_DevKit_V1_DOIT" H 4450 5450 50  0000 C CNN
F 2 "esp32_devkit_v1_doit:esp32_devkit_v1_doit" H 4000 5100 50  0001 C CNN
F 3 "https://aliexpress.com/item/32864722159.html" H 4000 5100 50  0001 C CNN
	1    4450 3750
	1    0    0    -1  
$EndComp
$Comp
L Battery_Management:1S_BMS_5v-in U1
U 1 1 605C6191
P 1500 1450
F 0 "U1" H 1475 2065 50  0000 C CNN
F 1 "1S_BMS_5v-in" H 1475 1974 50  0000 C CNN
F 2 "Symbol:1S_BMS_5v-in" H 1500 1450 50  0001 C CNN
F 3 "" H 1500 1450 50  0001 C CNN
	1    1500 1450
	1    0    0    -1  
$EndComp
$Comp
L Switch:SW_Push SW2
U 1 1 605C6BE3
P 10750 2900
F 0 "SW2" H 10750 3185 50  0000 C CNN
F 1 "SW_Push" H 10750 3094 50  0000 C CNN
F 2 "" H 10750 3100 50  0001 C CNN
F 3 "~" H 10750 3100 50  0001 C CNN
	1    10750 2900
	1    0    0    -1  
$EndComp
$Comp
L Switch:SW_Push SW3
U 1 1 605C7696
P 10750 3350
F 0 "SW3" H 10750 3635 50  0000 C CNN
F 1 "SW_Push" H 10750 3544 50  0000 C CNN
F 2 "" H 10750 3550 50  0001 C CNN
F 3 "~" H 10750 3550 50  0001 C CNN
	1    10750 3350
	1    0    0    -1  
$EndComp
$Comp
L Switch:SW_Push SW4
U 1 1 605C7DDF
P 10750 3850
F 0 "SW4" H 10750 4135 50  0000 C CNN
F 1 "SW_Push" H 10750 4044 50  0000 C CNN
F 2 "" H 10750 4050 50  0001 C CNN
F 3 "~" H 10750 4050 50  0001 C CNN
	1    10750 3850
	1    0    0    -1  
$EndComp
$Comp
L pspice:R R3
U 1 1 605C8590
P 7200 1250
F 0 "R3" V 6995 1250 50  0000 C CNN
F 1 "47K" V 7086 1250 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" H 7200 1250 50  0001 C CNN
F 3 "~" H 7200 1250 50  0001 C CNN
	1    7200 1250
	0    1    1    0   
$EndComp
$Comp
L pspice:R R1
U 1 1 605C8B8E
P 6550 1250
F 0 "R1" V 6345 1250 50  0000 C CNN
F 1 "17K" V 6436 1250 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" H 6550 1250 50  0001 C CNN
F 3 "~" H 6550 1250 50  0001 C CNN
	1    6550 1250
	0    1    1    0   
$EndComp
$Comp
L pspice:R R6
U 1 1 605CC197
P 8550 1400
F 0 "R6" V 8345 1400 50  0000 C CNN
F 1 "48" V 8436 1400 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" H 8550 1400 50  0001 C CNN
F 3 "~" H 8550 1400 50  0001 C CNN
	1    8550 1400
	0    -1   1    0   
$EndComp
$Comp
L pspice:R R5
U 1 1 605CBD14
P 8550 1100
F 0 "R5" V 8345 1100 50  0000 C CNN
F 1 "48" V 8436 1100 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" H 8550 1100 50  0001 C CNN
F 3 "~" H 8550 1100 50  0001 C CNN
	1    8550 1100
	0    -1   1    0   
$EndComp
$Comp
L pspice:R R4
U 1 1 605C8E30
P 8550 800
F 0 "R4" V 8345 800 50  0000 C CNN
F 1 "48" V 8436 800 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" H 8550 800 50  0001 C CNN
F 3 "~" H 8550 800 50  0001 C CNN
	1    8550 800 
	0    -1   1    0   
$EndComp
$Comp
L Device:LED D3
U 1 1 605C2C96
P 10700 1500
F 0 "D3" H 10693 1716 50  0000 C CNN
F 1 "LED" H 10693 1625 50  0000 C CNN
F 2 "" H 10700 1500 50  0001 C CNN
F 3 "~" H 10700 1500 50  0001 C CNN
	1    10700 1500
	-1   0    0    -1  
$EndComp
$Comp
L Device:LED D2
U 1 1 605C232C
P 10700 1100
F 0 "D2" H 10693 1316 50  0000 C CNN
F 1 "LED" H 10693 1225 50  0000 C CNN
F 2 "" H 10700 1100 50  0001 C CNN
F 3 "~" H 10700 1100 50  0001 C CNN
	1    10700 1100
	-1   0    0    -1  
$EndComp
$Comp
L Device:LED D1
U 1 1 605C1D68
P 10700 750
F 0 "D1" H 10693 966 50  0000 C CNN
F 1 "LED" H 10693 875 50  0000 C CNN
F 2 "" H 10700 750 50  0001 C CNN
F 3 "~" H 10700 750 50  0001 C CNN
	1    10700 750 
	-1   0    0    -1  
$EndComp
Wire Wire Line
	10850 750  11100 750 
Wire Wire Line
	10850 1100 11100 1100
Wire Wire Line
	10850 1500 11100 1500
Wire Wire Line
	6800 1250 6950 1250
$Comp
L power:GND #PWR0104
U 1 1 605D09B7
P 7550 1300
F 0 "#PWR0104" H 7550 1050 50  0001 C CNN
F 1 "GND" H 7555 1127 50  0000 C CNN
F 2 "" H 7550 1300 50  0001 C CNN
F 3 "" H 7550 1300 50  0001 C CNN
	1    7550 1300
	1    0    0    -1  
$EndComp
Wire Wire Line
	7450 1250 7550 1250
Wire Wire Line
	7550 1250 7550 1300
$Comp
L Switch:SW_DPST_x2 SW1
U 1 1 605D6814
P 950 5600
F 0 "SW1" H 950 5835 50  0000 C CNN
F 1 "SW_DPST_x2" H 950 5744 50  0000 C CNN
F 2 "" H 950 5600 50  0001 C CNN
F 3 "~" H 950 5600 50  0001 C CNN
	1    950  5600
	1    0    0    -1  
$EndComp
Wire Wire Line
	10950 3850 11050 3850
Wire Wire Line
	11050 3850 11050 3950
Wire Wire Line
	10950 3350 11050 3350
Wire Wire Line
	10950 2900 11050 2900
$Comp
L power:GND #PWR0108
U 1 1 605DB1E3
P 4350 5150
F 0 "#PWR0108" H 4350 4900 50  0001 C CNN
F 1 "GND" H 4355 4977 50  0000 C CNN
F 2 "" H 4350 5150 50  0001 C CNN
F 3 "" H 4350 5150 50  0001 C CNN
	1    4350 5150
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR0109
U 1 1 605DB946
P 4450 5150
F 0 "#PWR0109" H 4450 4900 50  0001 C CNN
F 1 "GND" H 4455 4977 50  0000 C CNN
F 2 "" H 4450 5150 50  0001 C CNN
F 3 "" H 4450 5150 50  0001 C CNN
	1    4450 5150
	1    0    0    -1  
$EndComp
$Comp
L power:+5V #PWR0110
U 1 1 605DC414
P 4350 2350
F 0 "#PWR0110" H 4350 2200 50  0001 C CNN
F 1 "+5V" H 4365 2523 50  0000 C CNN
F 2 "" H 4350 2350 50  0001 C CNN
F 3 "" H 4350 2350 50  0001 C CNN
	1    4350 2350
	1    0    0    -1  
$EndComp
$Comp
L power:+3.3V #PWR0111
U 1 1 605DD15B
P 4550 2350
F 0 "#PWR0111" H 4550 2200 50  0001 C CNN
F 1 "+3.3V" H 4565 2523 50  0000 C CNN
F 2 "" H 4550 2350 50  0001 C CNN
F 3 "" H 4550 2350 50  0001 C CNN
	1    4550 2350
	1    0    0    -1  
$EndComp
Wire Wire Line
	4450 2350 4550 2350
$Comp
L power:+BATT #PWR0112
U 1 1 605DDFE6
P 1850 1350
F 0 "#PWR0112" H 1850 1200 50  0001 C CNN
F 1 "+BATT" V 1865 1478 50  0000 L CNN
F 2 "" H 1850 1350 50  0001 C CNN
F 3 "" H 1850 1350 50  0001 C CNN
	1    1850 1350
	0    1    1    0   
$EndComp
$Comp
L power:+BATT #PWR0113
U 1 1 605DE8E9
P 1100 2700
F 0 "#PWR0113" H 1100 2550 50  0001 C CNN
F 1 "+BATT" V 1115 2827 50  0000 L CNN
F 2 "" H 1100 2700 50  0001 C CNN
F 3 "" H 1100 2700 50  0001 C CNN
	1    1100 2700
	0    -1   -1   0   
$EndComp
$Comp
L power:-BATT #PWR0114
U 1 1 605DF2CB
P 1850 1550
F 0 "#PWR0114" H 1850 1400 50  0001 C CNN
F 1 "-BATT" V 1865 1678 50  0000 L CNN
F 2 "" H 1850 1550 50  0001 C CNN
F 3 "" H 1850 1550 50  0001 C CNN
	1    1850 1550
	0    1    1    0   
$EndComp
$Comp
L power:-BATT #PWR0115
U 1 1 605DF9E5
P 1100 3000
F 0 "#PWR0115" H 1100 2850 50  0001 C CNN
F 1 "-BATT" V 1115 3127 50  0000 L CNN
F 2 "" H 1100 3000 50  0001 C CNN
F 3 "" H 1100 3000 50  0001 C CNN
	1    1100 3000
	0    -1   -1   0   
$EndComp
Text GLabel 1850 1150 2    50   Input ~ 0
Out+
Text GLabel 750  4300 0    50   Input ~ 0
Out+
Text GLabel 5050 3750 2    50   Input ~ 0
SCK
Text GLabel 5050 3850 2    50   Input ~ 0
MISO
Text GLabel 5050 3350 2    50   Input ~ 0
RST
Text GLabel 5050 4150 2    50   Input ~ 0
MOSI
Text GLabel 5750 4850 0    50   Input ~ 0
SCK
Text GLabel 5750 5050 0    50   Input ~ 0
MISO
Text GLabel 5750 4950 0    50   Input ~ 0
MOSI
Text GLabel 5750 5350 0    50   Input ~ 0
RST
$Comp
L power:GND #PWR0116
U 1 1 605ED8DE
P 5750 5250
F 0 "#PWR0116" H 5750 5000 50  0001 C CNN
F 1 "GND" V 5755 5122 50  0000 R CNN
F 2 "" H 5750 5250 50  0001 C CNN
F 3 "" H 5750 5250 50  0001 C CNN
	1    5750 5250
	0    1    1    0   
$EndComp
$Comp
L power:+3.3V #PWR0117
U 1 1 605EE10B
P 5750 5450
F 0 "#PWR0117" H 5750 5300 50  0001 C CNN
F 1 "+3.3V" V 5765 5578 50  0000 L CNN
F 2 "" H 5750 5450 50  0001 C CNN
F 3 "" H 5750 5450 50  0001 C CNN
	1    5750 5450
	0    -1   -1   0   
$EndComp
Text GLabel 5050 4050 2    50   Input ~ 0
SCL
Text GLabel 5050 3950 2    50   Input ~ 0
SDA
Text GLabel 6100 2350 0    50   Input ~ 0
SCL
Text GLabel 6100 2250 0    50   Input ~ 0
SDA
Text GLabel 5750 4750 0    50   Input ~ 0
SS
Text GLabel 5050 3650 2    50   Input ~ 0
SS
$Comp
L power:+5V #PWR0118
U 1 1 605F032B
P 6100 2150
F 0 "#PWR0118" H 6100 2000 50  0001 C CNN
F 1 "+5V" V 6115 2278 50  0000 L CNN
F 2 "" H 6100 2150 50  0001 C CNN
F 3 "" H 6100 2150 50  0001 C CNN
	1    6100 2150
	0    -1   -1   0   
$EndComp
$Comp
L Display_Character:2x16_LCD_I2C U5
U 1 1 605F5A50
P 7800 2200
F 0 "U5" H 8628 2246 50  0000 L CNN
F 1 "2x16_LCD_I2C" H 8628 2155 50  0000 L CNN
F 2 "" H 7700 2300 50  0001 C CNN
F 3 "" H 7700 2300 50  0001 C CNN
	1    7800 2200
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR0119
U 1 1 605F7530
P 6100 2050
F 0 "#PWR0119" H 6100 1800 50  0001 C CNN
F 1 "GND" V 6105 1922 50  0000 R CNN
F 2 "" H 6100 2050 50  0001 C CNN
F 3 "" H 6100 2050 50  0001 C CNN
	1    6100 2050
	0    1    1    0   
$EndComp
Text GLabel 5050 4850 2    50   Input ~ 0
IO35
Text GLabel 5050 4750 2    50   Input ~ 0
IO34
Text GLabel 5050 4650 2    50   Input ~ 0
IO33
Text GLabel 5050 4550 2    50   Input ~ 0
IO32
Text GLabel 5050 4250 2    50   Input ~ 0
IO25
Text GLabel 5050 4350 2    50   Input ~ 0
IO26
Text GLabel 5050 4450 2    50   Input ~ 0
IO27
$Comp
L Device:Buzzer BZ1
U 1 1 605F9CFE
P 7400 3500
F 0 "BZ1" H 7552 3529 50  0000 L CNN
F 1 "Buzzer" H 7552 3438 50  0000 L CNN
F 2 "Buzzer_Beeper:Buzzer_12x9.5RM7.6" V 7375 3600 50  0001 C CNN
F 3 "~" V 7375 3600 50  0001 C CNN
	1    7400 3500
	1    0    0    -1  
$EndComp
Text GLabel 5050 3150 2    50   Input ~ 0
IO12
Text GLabel 6500 3950 0    50   Input ~ 0
IO12
Text GLabel 8300 1100 0    50   Input ~ 0
IO25
Text GLabel 8300 800  0    50   Input ~ 0
IO26
Text GLabel 6850 1250 3    50   Input ~ 0
IO27
Text GLabel 9400 3200 0    50   Input ~ 0
IO32
Text GLabel 8300 1400 0    50   Input ~ 0
IO33
Text GLabel 9400 3400 0    50   Input ~ 0
IO34
Text GLabel 9400 3300 0    50   Input ~ 0
IO35
$Comp
L Transistor_BJT:PN2222A Q1
U 1 1 605FB008
P 7200 3950
F 0 "Q1" H 7390 3996 50  0000 L CNN
F 1 "PN2222A" H 7390 3905 50  0000 L CNN
F 2 "Package_TO_SOT_THT:TO-92_Inline" H 7400 3875 50  0001 L CIN
F 3 "http://www.fairchildsemi.com/ds/PN/PN2222A.pdf" H 7200 3950 50  0001 L CNN
	1    7200 3950
	1    0    0    -1  
$EndComp
$Comp
L pspice:R R2
U 1 1 605FD8E5
P 6750 3950
F 0 "R2" V 6545 3950 50  0000 C CNN
F 1 "220" V 6636 3950 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" H 6750 3950 50  0001 C CNN
F 3 "~" H 6750 3950 50  0001 C CNN
	1    6750 3950
	0    -1   1    0   
$EndComp
Wire Wire Line
	7300 3600 7300 3750
$Comp
L power:+5V #PWR0120
U 1 1 605FF325
P 7300 3400
F 0 "#PWR0120" H 7300 3250 50  0001 C CNN
F 1 "+5V" V 7315 3528 50  0000 L CNN
F 2 "" H 7300 3400 50  0001 C CNN
F 3 "" H 7300 3400 50  0001 C CNN
	1    7300 3400
	0    -1   -1   0   
$EndComp
$Comp
L power:GND #PWR0121
U 1 1 605FFAF9
P 7300 4150
F 0 "#PWR0121" H 7300 3900 50  0001 C CNN
F 1 "GND" H 7305 3977 50  0000 C CNN
F 2 "" H 7300 4150 50  0001 C CNN
F 3 "" H 7300 4150 50  0001 C CNN
	1    7300 4150
	1    0    0    -1  
$EndComp
$Comp
L Converter_DCDC:MT3608_DC-DC_Boost_5-28V_2A U2
U 1 1 60602565
P 1950 4400
F 0 "U2" H 1950 4765 50  0000 C CNN
F 1 "MT3608_DC-DC_Boost_5-28V_2A" H 1950 4674 50  0000 C CNN
F 2 "Converter_DCDC:MT3068_DC-DC_max28V_2A" H 1950 4400 50  0001 C CNN
F 3 "" H 1950 4400 50  0001 C CNN
	1    1950 4400
	-1   0    0    -1  
$EndComp
Wire Wire Line
	1350 4300 1250 4300
$Comp
L power:+5V #PWR0122
U 1 1 60606863
P 2550 4300
F 0 "#PWR0122" H 2550 4150 50  0001 C CNN
F 1 "+5V" V 2565 4428 50  0000 L CNN
F 2 "" H 2550 4300 50  0001 C CNN
F 3 "" H 2550 4300 50  0001 C CNN
	1    2550 4300
	0    1    1    0   
$EndComp
$Comp
L power:GND #PWR0123
U 1 1 60607D1A
P 1250 4500
F 0 "#PWR0123" H 1250 4250 50  0001 C CNN
F 1 "GND" H 1255 4327 50  0000 C CNN
F 2 "" H 1250 4500 50  0001 C CNN
F 3 "" H 1250 4500 50  0001 C CNN
	1    1250 4500
	1    0    0    -1  
$EndComp
Text GLabel 950  3850 0    50   Input ~ 0
OutSwitcht
Wire Wire Line
	950  3850 1250 3850
Wire Wire Line
	1250 3850 1250 4300
Connection ~ 1250 4300
Text GLabel 6300 1250 0    50   Input ~ 0
OutSwitcht
Wire Wire Line
	1350 4450 1250 4450
Wire Wire Line
	1250 4450 1250 4500
$Comp
L power:GND #PWR0124
U 1 1 6060B281
P 2650 4500
F 0 "#PWR0124" H 2650 4250 50  0001 C CNN
F 1 "GND" H 2655 4327 50  0000 C CNN
F 2 "" H 2650 4500 50  0001 C CNN
F 3 "" H 2650 4500 50  0001 C CNN
	1    2650 4500
	1    0    0    -1  
$EndComp
Wire Wire Line
	2550 4450 2650 4450
Wire Wire Line
	2650 4450 2650 4500
$Comp
L Connector:Conn_01x04_Female J7
U 1 1 606165B5
P 9900 1050
F 0 "J7" H 9792 1335 50  0000 C CNN
F 1 "Conn_01x04_Female" H 9792 1244 50  0000 C CNN
F 2 "" H 9900 1050 50  0001 C CNN
F 3 "~" H 9900 1050 50  0001 C CNN
	1    9900 1050
	-1   0    0    -1  
$EndComp
Wire Wire Line
	8800 800  8800 950 
Wire Wire Line
	8800 950  9150 950 
Wire Wire Line
	9150 1050 8800 1050
Wire Wire Line
	8800 1050 8800 1100
Wire Wire Line
	9150 1150 8800 1150
Wire Wire Line
	8800 1150 8800 1400
$Comp
L power:GND #PWR0101
U 1 1 60629814
P 9150 1250
F 0 "#PWR0101" H 9150 1000 50  0001 C CNN
F 1 "GND" H 9155 1077 50  0000 C CNN
F 2 "" H 9150 1250 50  0001 C CNN
F 3 "" H 9150 1250 50  0001 C CNN
	1    9150 1250
	1    0    0    -1  
$EndComp
Wire Wire Line
	11100 750  11100 1100
Connection ~ 11100 1100
Wire Wire Line
	11100 1100 11100 1500
Connection ~ 11100 1500
$Comp
L Connector:Conn_01x04_Male J5
U 1 1 6062D5CB
P 9350 1050
F 0 "J5" H 9450 1300 50  0000 R CNN
F 1 "Conn_01x04_Male" H 9750 1400 50  0000 R CNN
F 2 "Connector_JST:JST_XH_B4B-XH-A_1x04_P2.50mm_Vertical" H 9350 1050 50  0001 C CNN
F 3 "~" H 9350 1050 50  0001 C CNN
	1    9350 1050
	-1   0    0    -1  
$EndComp
Wire Wire Line
	10550 750  10550 950 
Wire Wire Line
	10550 950  10100 950 
Wire Wire Line
	10100 1050 10550 1050
Wire Wire Line
	10550 1050 10550 1100
Wire Wire Line
	10100 1150 10550 1150
Wire Wire Line
	10550 1150 10550 1500
Wire Wire Line
	10100 1250 10450 1250
Wire Wire Line
	10450 1250 10450 1700
Wire Wire Line
	10450 1700 11100 1700
Wire Wire Line
	11100 1500 11100 1700
$Comp
L Connector:Conn_01x04_Male J6
U 1 1 606504AA
P 9600 3300
F 0 "J6" H 9700 3550 50  0000 R CNN
F 1 "Conn_01x04_Male" H 10000 3650 50  0000 R CNN
F 2 "Connector_JST:JST_XH_B4B-XH-A_1x04_P2.50mm_Vertical" H 9600 3300 50  0001 C CNN
F 3 "~" H 9600 3300 50  0001 C CNN
	1    9600 3300
	-1   0    0    -1  
$EndComp
$Comp
L power:GND #PWR0102
U 1 1 60651234
P 9400 3500
F 0 "#PWR0102" H 9400 3250 50  0001 C CNN
F 1 "GND" H 9405 3327 50  0000 C CNN
F 2 "" H 9400 3500 50  0001 C CNN
F 3 "" H 9400 3500 50  0001 C CNN
	1    9400 3500
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x04_Female J8
U 1 1 60652D7D
P 10050 3300
F 0 "J8" H 9942 3585 50  0000 C CNN
F 1 "Conn_01x04_Female" H 9942 3494 50  0000 C CNN
F 2 "" H 10050 3300 50  0001 C CNN
F 3 "~" H 10050 3300 50  0001 C CNN
	1    10050 3300
	-1   0    0    -1  
$EndComp
Wire Wire Line
	10250 3200 10250 2900
Wire Wire Line
	10250 2900 10550 2900
Wire Wire Line
	10550 3350 10550 3300
Wire Wire Line
	10550 3300 10250 3300
Wire Wire Line
	10250 3400 10550 3400
Wire Wire Line
	10550 3400 10550 3850
Wire Wire Line
	11050 2900 11050 3350
Connection ~ 11050 3350
Wire Wire Line
	11050 3350 11050 3850
Connection ~ 11050 3850
Wire Wire Line
	11050 3950 10250 3950
Wire Wire Line
	10250 3950 10250 3500
$Comp
L Connector:Conn_01x04_Male J3
U 1 1 6065DB8E
P 6300 2150
F 0 "J3" H 6400 2400 50  0000 R CNN
F 1 "Conn_01x04_Male" H 6700 2500 50  0000 R CNN
F 2 "Connector_JST:JST_XH_B4B-XH-A_1x04_P2.50mm_Vertical" H 6300 2150 50  0001 C CNN
F 3 "~" H 6300 2150 50  0001 C CNN
	1    6300 2150
	-1   0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x04_Female J4
U 1 1 6065EE8D
P 6750 2150
F 0 "J4" H 6642 2435 50  0000 C CNN
F 1 "Conn_01x04_Female" H 6642 2344 50  0000 C CNN
F 2 "" H 6750 2150 50  0001 C CNN
F 3 "~" H 6750 2150 50  0001 C CNN
	1    6750 2150
	-1   0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x02_Female J2
U 1 1 60661729
P 900 5000
F 0 "J2" V 838 4812 50  0000 R CNN
F 1 "Conn_01x02_Female" V 747 4812 50  0000 R CNN
F 2 "" H 900 5000 50  0001 C CNN
F 3 "~" H 900 5000 50  0001 C CNN
	1    900  5000
	0    -1   -1   0   
$EndComp
$Comp
L Connector:Conn_01x02_Male J1
U 1 1 60662589
P 900 4700
F 0 "J1" V 900 4850 50  0000 R CNN
F 1 "Conn_01x02_Male" V 800 5000 50  0000 R CNN
F 2 "Connector_JST:JST_XH_B2B-XH-A_1x02_P2.50mm_Vertical" H 900 4700 50  0001 C CNN
F 3 "~" H 900 4700 50  0001 C CNN
	1    900  4700
	0    -1   -1   0   
$EndComp
Wire Wire Line
	750  4300 900  4300
Wire Wire Line
	900  4300 900  4500
Wire Wire Line
	1000 4500 1000 4300
Wire Wire Line
	1000 4300 1250 4300
Wire Wire Line
	900  5200 600  5200
Wire Wire Line
	600  5200 600  5600
Wire Wire Line
	600  5600 750  5600
Wire Wire Line
	1000 5200 1350 5200
Wire Wire Line
	1350 5200 1350 5600
Wire Wire Line
	1350 5600 1150 5600
$Comp
L Connector:Conn_01x08_Male J9
U 1 1 60675B6E
P 5950 5050
F 0 "J9" H 5922 5024 50  0000 R CNN
F 1 "Conn_01x08_Male" H 5922 4933 50  0000 R CNN
F 2 "Connector_JST:JST_XH_B8B-XH-A_1x08_P2.50mm_Vertical" H 5950 5050 50  0001 C CNN
F 3 "~" H 5950 5050 50  0001 C CNN
	1    5950 5050
	-1   0    0    -1  
$EndComp
$Comp
L RF_RFID:RC522_RFID_module U4
U 1 1 605D4D0E
P 8000 5100
F 0 "U4" H 8628 5146 50  0000 L CNN
F 1 "RC522_RFID_module" H 8628 5055 50  0000 L CNN
F 2 "" H 7700 5200 50  0001 C CNN
F 3 "" H 7700 5200 50  0001 C CNN
	1    8000 5100
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x08_Female J10
U 1 1 60674946
P 7050 5050
F 0 "J10" H 6942 5535 50  0000 C CNN
F 1 "Conn_01x08_Female" H 6942 5444 50  0000 C CNN
F 2 "" H 7050 5050 50  0001 C CNN
F 3 "~" H 7050 5050 50  0001 C CNN
	1    7050 5050
	-1   0    0    -1  
$EndComp
$Comp
L Device:Battery_Cell_2x BT1
U 1 1 606A6EED
P 2050 2900
F 0 "BT1" H 2168 2996 50  0000 L CNN
F 1 "Battery_Cell_2x" H 2168 2905 50  0000 L CNN
F 2 "Battery:BatteryHolder_Keystone_1042_2x18650" V 2050 2960 50  0001 C CNN
F 3 "~" V 2050 2960 50  0001 C CNN
	1    2050 2900
	1    0    0    -1  
$EndComp
Wire Wire Line
	1100 2700 1800 2700
Wire Wire Line
	1100 3000 1800 3000
Wire Wire Line
	1800 2700 2050 2700
Connection ~ 1800 2700
Wire Wire Line
	1800 3000 2050 3000
Connection ~ 1800 3000
$Comp
L Device:C C1
U 1 1 606164E9
P 3450 1600
F 0 "C1" H 3565 1646 50  0000 L CNN
F 1 "0,1uf" H 3565 1555 50  0000 L CNN
F 2 "Capacitor_THT:C_Disc_D5.1mm_W3.2mm_P5.00mm" H 3488 1450 50  0001 C CNN
F 3 "~" H 3450 1600 50  0001 C CNN
	1    3450 1600
	1    0    0    -1  
$EndComp
$Comp
L power:+3.3V #PWR0103
U 1 1 60617277
P 3450 1450
F 0 "#PWR0103" H 3450 1300 50  0001 C CNN
F 1 "+3.3V" H 3465 1623 50  0000 C CNN
F 2 "" H 3450 1450 50  0001 C CNN
F 3 "" H 3450 1450 50  0001 C CNN
	1    3450 1450
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR0105
U 1 1 60617891
P 3450 1750
F 0 "#PWR0105" H 3450 1500 50  0001 C CNN
F 1 "GND" H 3455 1577 50  0000 C CNN
F 2 "" H 3450 1750 50  0001 C CNN
F 3 "" H 3450 1750 50  0001 C CNN
	1    3450 1750
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR0106
U 1 1 605D03EA
P 1850 1750
F 0 "#PWR0106" H 1850 1500 50  0001 C CNN
F 1 "GND" H 1855 1577 50  0000 C CNN
F 2 "" H 1850 1750 50  0001 C CNN
F 3 "" H 1850 1750 50  0001 C CNN
	1    1850 1750
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J14
U 1 1 605D6F5D
P 5250 2650
F 0 "J14" H 5278 2676 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 2650 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 2650 50  0001 C CNN
F 3 "~" H 5250 2650 50  0001 C CNN
	1    5250 2650
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J15
U 1 1 605D74EB
P 5250 2750
F 0 "J15" H 5278 2776 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 2750 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 2750 50  0001 C CNN
F 3 "~" H 5250 2750 50  0001 C CNN
	1    5250 2750
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J16
U 1 1 605D7785
P 5250 2850
F 0 "J16" H 5278 2876 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 2850 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 2850 50  0001 C CNN
F 3 "~" H 5250 2850 50  0001 C CNN
	1    5250 2850
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J17
U 1 1 605D7AEB
P 5250 2950
F 0 "J17" H 5278 2976 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 2950 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 2950 50  0001 C CNN
F 3 "~" H 5250 2950 50  0001 C CNN
	1    5250 2950
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J18
U 1 1 605D7E3B
P 5250 3050
F 0 "J18" H 5278 3076 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 3050 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 3050 50  0001 C CNN
F 3 "~" H 5250 3050 50  0001 C CNN
	1    5250 3050
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J19
U 1 1 605D7FE5
P 5250 3250
F 0 "J19" H 5278 3276 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 3250 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 3250 50  0001 C CNN
F 3 "~" H 5250 3250 50  0001 C CNN
	1    5250 3250
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J20
U 1 1 605D8399
P 5250 3450
F 0 "J20" H 5278 3476 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 3450 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 3450 50  0001 C CNN
F 3 "~" H 5250 3450 50  0001 C CNN
	1    5250 3450
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J21
U 1 1 605D85F4
P 5250 3550
F 0 "J21" H 5278 3576 50  0000 L CNN
F 1 "Conn_01x01_Female" H 5500 3550 50  0000 L CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 5250 3550 50  0001 C CNN
F 3 "~" H 5250 3550 50  0001 C CNN
	1    5250 3550
	1    0    0    -1  
$EndComp
$Comp
L Connector:Conn_01x01_Female J13
U 1 1 605D8959
P 3650 2850
F 0 "J13" H 3542 2625 50  0000 C CNN
F 1 "Conn_01x01_Female" H 4050 2850 50  0000 C CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 3650 2850 50  0001 C CNN
F 3 "~" H 3650 2850 50  0001 C CNN
	1    3650 2850
	-1   0    0    1   
$EndComp
$Comp
L Connector:Conn_01x01_Female J12
U 1 1 605D92B0
P 3650 2750
F 0 "J12" H 3542 2525 50  0000 C CNN
F 1 "Conn_01x01_Female" H 4050 2750 50  0000 C CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 3650 2750 50  0001 C CNN
F 3 "~" H 3650 2750 50  0001 C CNN
	1    3650 2750
	-1   0    0    1   
$EndComp
$Comp
L Connector:Conn_01x01_Female J11
U 1 1 605D94E5
P 3650 2550
F 0 "J11" H 3542 2325 50  0000 C CNN
F 1 "Conn_01x01_Female" H 4050 2550 50  0000 C CNN
F 2 "Connector_Wire:SolderWirePad_1x01_Drill0.8mm" H 3650 2550 50  0001 C CNN
F 3 "~" H 3650 2550 50  0001 C CNN
	1    3650 2550
	-1   0    0    1   
$EndComp
$EndSCHEMATC
