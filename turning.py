#
# This script allows the user to control an Anki car using Python
# To control multiple cars at once, open a seperate Command Line Window for each car
# and call this script with the approriate car mac address.
#
# Author: jstucken
#

SCRIPT_TITLE="Turning and U-Turn example"

import time
from lib import overdrive               # the script which contains variables, functions and classes
from lib.overdrive import Overdrive     # the overdrive class itself
from lib import keyboard                # keyboard control class


# Setup our car
car = Overdrive()  # init overdrive object


# Start infinite loop
while True:

    # set the car speed now
    print("\n Moving car \n")
    car.changeSpeed(300, 1000)
    time.sleep(2)

    print("\n TURNING LEFT... \n")
    car.turnLeft()
    time.sleep(1)

    print("\n TURNING LEFT... \n")
    car.turnLeft()
    time.sleep(1)

    print("\n TURNING LEFT... \n")
    car.turnLeft()
    time.sleep(1)

    print("\n TURNING LEFT... \n")
    car.turnLeft()
    time.sleep(1)

    print("\n TURNING LEFT... \n")
    car.turnLeft()
    time.sleep(1)

    print("\n TURNING RIGHT... \n")
    car.turnRight()
    time.sleep(1)

    print("\n TURNING RIGHT... \n")
    car.turnRight()
    time.sleep(1)

    print("\n TURNING RIGHT... \n")
    car.turnRight()
    time.sleep(1)

    print("\n TURNING RIGHT... \n")
    car.turnRight()
    time.sleep(1)

    print("\n TURNING RIGHT... \n")
    car.turnRight()
    time.sleep(1)
    
    print("\n MAKING U-TURN... \n")
    car.doUturn()
    time.sleep(1)





quit()


# stop again
car.brakeLightsOn()
print("\n BRAKES!!! \n")
car.stopCar()
time.sleep(3)   # script will usually end on this

quit()