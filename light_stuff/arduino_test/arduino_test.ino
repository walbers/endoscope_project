#include <SPI.h>

//const int slaveSelectPin = 10;
int keystroke = 0;
//int value = 0;
String thing;
//int CS = 0;

void setup() {

  // set the slaveSelectPin as output:

//  pinMode(slaveSelectPin, OUTPUT);
  
  // initialize SPI:

//  SPI.begin();
  pinMode(LED_BUILTIN, OUTPUT);

  Serial.begin(9600);
}

void loop() {

  if (Serial.available()>0){
    thing = Serial.readString();
    keystroke = thing.toInt();
    if (keystroke == 1) {
      digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
      delay(1000);
    }
    if (keystroke == 2) {
      digitalWrite(LED_BUILTIN, LOW);   // turn the LED on (HIGH is the voltage level)
      delay(1000);
    }
  }
  
//
//  Serial.print("I received: ");
//  Serial.println(keystroke);

//  if (keystroke == 0){
//    value = 0;
//  }
//  else {
//    value = 117 + keystroke;
//  }
  // go through the six channels of the digital pot:

//  for (int channel = 0; channel < 1; channel++) {
//
//    digitalPotWrite(channel, value);
//
//  }

  delay(10);

}

//void digitalPotWrite(int address, int value) {
//
//  // take the SS pin low to select the chip:
//
//  digitalWrite(slaveSelectPin, LOW);
//
//  delay(100);
//
//  //  send in the address and value via SPI:
//
//  SPI.transfer(address);
//
//  SPI.transfer(value);
//  digitalWrite(CS, LOW);
//
//  delay(100);
//
//  // take the SS pin high to de-select the chip:
//
//  digitalWrite(slaveSelectPin, HIGH);
//}
