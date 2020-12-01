#include <SPI.h>

const int slaveSelectPin = 10;
int keystroke = 0;
int value = 0;
String thing;
int CS = 0;

void setup() {

  // set the slaveSelectPin as output:

  pinMode(slaveSelectPin, OUTPUT);
  
  // initialize SPI:

  SPI.begin();
  Serial.begin(9600);
}

void loop() {

  if (Serial.available()>0){
    thing = Serial.readString();
    keystroke = thing.toInt();

    Serial.print("I received: ");
    Serial.println(keystroke);
    Serial.println(keystroke, DEC);

    if (keystroke == 0){
      value = 0;
    }
    else {
    value = 117 + keystroke;
    }

  }
  
  // go through the six channels of the digital pot:

  for (int channel = 0; channel < 1; channel++) {

    digitalPotWrite(channel, value);

  }

  delay(10);

}

void digitalPotWrite(int address, int value) {

  // take the SS pin low to select the chip:

  digitalWrite(slaveSelectPin, LOW);

  delay(100);

  //  send in the address and value via SPI:

  SPI.transfer(address);

  SPI.transfer(value);
  digitalWrite(CS, LOW);

  delay(100);

  // take the SS pin high to de-select the chip:

  digitalWrite(slaveSelectPin, HIGH);
}
