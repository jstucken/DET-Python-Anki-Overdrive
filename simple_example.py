#
# This script allows the user to control an Anki car using Python
# To control multiple cars at once, open a separate Command Line Interface (CLI) window for each car
# and call this script with the appropriate car mac address.
#
# Author: jstucken
#
   
SCRIPT_TITLE="Simple Example"

import time
from lib import overdrive               # the script which contains variables, functions and classes
from lib.overdrive import Overdrive     # the overdrive class itself
from lib import keyboard                # keyboard control class

# Setup our car
car = Overdrive()  # init overdrive object

# set the car speed now
# usage: car.changeSpeed(speed, accel)
car.changeSpeed(300, 600)
time.sleep(10)   # run for 10 seconds

# stop the car
car.stopCar()

quit()