import serial
import time
PORT = "/dev/ttyUSB0"
BAUD_RATE = 9600
PARITY = serial.PARITY_NONE
STOPBITS = serial.STOPBITS_ONE
BYTESIZE = serial.EIGHTBITS
TIMEOUT = 3

def initialize_serial():
    ser = serial.Serial(port=PORT, baudrate=BAUD_RATE, timeout=TIMEOUT)
    return ser


def send_string(string):
    try:
        ser = initialize_serial()
        if not ser.isOpen():
            ser.open()
        print("Sending %s" % string)
        ser.write(string.encode("utf-8"))
        print('sent')
    except Exception as e:
        print(e)
        return False
    return True


send_string("2")


