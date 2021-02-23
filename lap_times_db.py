#
# This script allows the user to control an Anki car using Python
# To control multiple cars at once, open a seperate Command Line Window for each car
# and call this script with the approriate car mac address.

# This script attempts to save lap times into local mysql db running on the pi
# Author: jstucken
# Created: 23-2-2021
#
   
SCRIPT_TITLE="Lap timer saving to Mysql"
API_ENDPOINT = "http://127.0.0.1/python_save.php"

import time
from lib import overdrive               # the script which contains variables, functions and classes
from lib.overdrive import Overdrive     # the overdrive class itself
from lib import keyboard                # keyboard control class
import requests							# for POSTING data to db


# Setup our car
car = Overdrive()  # init overdrive object
#car.disableLocationData()

# get car mac and player name from our class object
car_mac = car.car_mac
player_name = car.player_name

# count number of laps completed
lap_count = 0

# start the car off
# usage: car.changeSpeed(speed, accel)
car.changeSpeed(700, 800)

last_lap_time = 0
last_lap_count = -1

# race 3 laps and time each one
while lap_count !=3:

	time.sleep(0.1)
	lap_count = car.getLapCount()

	# count laps done
	if last_lap_count != lap_count:
		last_lap_count = lap_count
		print()
		print("lap_count: "+str(lap_count))

	# get lap time
	prev_lap_time = car.getLapTime()

	if last_lap_time != prev_lap_time:
		print()
		print("prev_lap_time: "+str(prev_lap_time))
		print()
		print("*****")

	last_lap_time = prev_lap_time
	
	#last_lap_time = int(last_lap_time)
	
	location = car.getLocation()
	print("location:")
	print(location)
	
	speed = car.getSpeed()

	# data to be sent to api 
	# data to be sent to api 
	data = {'school_id':'8521', 
			'mac':car_mac,
			'player_name':player_name,
			'speed':speed,
			'location':location,
			'car_type':'MXT'}
			
	# sending post request and saving response as response object 
	r = requests.post(url = API_ENDPOINT, data = data) 

	# extracting response text  
	return_text = r.text 
	print("Response from PHP script: %s"%return_text)


# stop the car
car.stopCarFast()
print("Stopping as car has done the required number of laps")

quit()