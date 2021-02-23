<?php

/*
* Handles importing of user data
* eg adding students' names, tasks and grades for a report
*/
class import {
	
	public $error_array = array(); 	// holds problematic row keys and an error description


	/*
	* handles errors with user data
	*/
	public function addError($row_key, $error_msg) {
		
		// if this is an additional error for this row, add nice formatting
		if (!empty($this->error_array[$row_key])) {
			$this->error_array[$row_key] .= ', ';
		}
		$this->error_array[$row_key] .= $error_msg;
	}
	
	
	/*
	* Checks if any errors with certain row of data
	* returns true if error or false if no error
	*/
	public function isRowError($row_key) {
		
		if (empty($this->error_array[$row_key])) {
			return false;
		}
		else {
			return true;
		}
	}
	
	
	/*
	* Returns a count of how many errors there are
	*/
	public function getNumErrors() {
		
		return count($this->error_array);
	}
	
	
	/*
	* Returns a formatted error message detailing all the problematic rows	
	* adds a <br> for each row
	*/
	public function getErrorMessage() {
		
		$error_msg = '';
		
		// loop through problematic rows and report their errors
		foreach ($this->error_array as $row_key => $row_error_msg) {
			
			// try match MS Excel's row key
			$excel_row_key = $row_key +1;
			
			if (!empty($error_msg)) {
				$error_msg .= '<br>';
			}
			
			$error_msg .= "Row $excel_row_key: $row_error_msg";
		}
		
		//dbug($this->error_array,'error_array');
		//dbug($error_msg,'$error_msg','blue');
		return $error_msg;
		
	}
	
}
?>		