<?php

/**
* Jono's Webpage scraper class
* Finds stuff between two tags
*/
class jonoScraper
{
	private $url;			// url to scrape
	
	
	/*
	* constructor method
	*/
	public function __construct($url) {
		
		if (empty($url)) {
			trigger_error('ERROR - $url cannot be blank.', E_USER_ERROR);
		}
		$this->url = $url;
	}
	
	
	/*
	* grabs some html between two designated html tags in a webpage
	* @param str $start - contains the starting html to search for
	* @param str $end - contains the ending html to search for
	* @returns str $item - contains the gold we want in between the search parts.
	*/
	public function getBetween($start, $end) {
		
		//dbug($start,'$start');
		//dbug($end,'$end');
		
		// get whole webpage
		$html = file_get_contents($this->url);
		
		// split using search string
		$parts = explode($start, $html);
		
		// what we want will be in position 1 of array
		$parts2 = $parts[1];
		
		// what we now want will be in position 0 of array
		$parts3 = explode($end, $parts2);
		
		// the gold we really want
		$item = $parts3[0];
		
		return $item;
				
	}
	
}
?>