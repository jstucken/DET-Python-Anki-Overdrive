<?php

/**
* Jono's CRON class
* Handles start, stop and errors in CRON jobs
*/
class cron
{
	private $db_table;			// holds what database table we are working with
	private $script;			// holds what script is running by cron
	private $cron_id;			// saves what cron_id we will be working with
	private $last_cron_id;		// most recent cron_id before new cron was started
	private $time_started;		// saves when the current cron was started
	private $cron_frequency;	// holds interval between cron jobs eg '2 minutes'. Set by script calling this class.
	
	
	/*
	* constructor method
	* record what script is using this cron class
	* @param string $db_table - db table to work with eg securities_historicals_crons
	* @param string $script - The name of the script executing the cron job eg: /tools/get_historicals.php
	*/
	public function __construct($db_table, $script) {
		
		
		if (empty($db_table)) {
			trigger_error('ERROR - $db_table cannot be blank.', E_USER_ERROR);
		}
		
		if (empty($script)) {
			trigger_error('Error - $script not set', E_USER_ERROR);
		}
		
		
		$this->db_table = $db_table;
		$this->script = $script;
	}
	
	
	
	/*
	* Starts a new CRON job, recording start time in relevant db table
	*/
	public function start() {
		
		// cron field in db will be set to:
		// 0 if running from browser
		// 1 if running from CLI or CRON job
		
		$insert_sql = "INSERT INTO $this->db_table (script,shell) VALUES ('$this->script', ".SHELL.")";	// live code
		//$insert_sql = "INSERT INTO $this->db_table (script, complete) VALUES ('$this->script',1)";		// for testing only!
		
		$insert_result = db::doQuery($insert_sql);
		if (!$insert_result) {
			trigger_error('Error - could not insert new record into '.$this->db_table.', $insert_sql: '.$insert_sql, E_USER_ERROR);
		}
		$cron_id = db::getLastID();

		self::setCronID($cron_id);
		
		// Find out and record start time of current Cron
		$time_started_sql = "SELECT time_started FROM $this->db_table WHERE id = '$cron_id'";
		$time_started_result = db::getRow($time_started_sql);
		
		if (empty($time_started_result)) {
			trigger_error('Error - could not select cron start time. $time_started_sql: '.$time_started_sql, E_USER_ERROR);
		}
		
		$this->time_started = $time_started_result['time_started'];
		
	}
	
	
	/*
	* Tells class what cron_id in the db we should be working with
	*/
	public function setCronID($cron_id) {
		
		$this->cron_id = $cron_id;
	}
	
	
	/*
	* Returns the current cron_id
	*/
	public function getCronID() {
		return $this->cron_id;
	}
	
	
	/*
	* Returns the time which the current cron started
	*/
	public function getTimeStarted() {
	
		return $this->time_started;
	}
	
	
	/*
	* Checks that all crons are complete for the current script
	* Returns true if all ok
	* Returns false if a cron is still running
	*/
	public function areCronsComplete() {
		
		$cron_check_sql = "SELECT * FROM ".$this->db_table." WHERE script = '$this->script' AND complete != 1 ORDER BY id ASC";
		
		//dbug($cron_check_sql,'cron_check_sql');
		
		$cron_check_result = db::getRow($cron_check_sql);
		//dbug($cron_check_result,'$cron_check_result');
		if (empty($cron_check_result)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	/*
	* Purges (deletes) any stuckn CRON jobs for this script
	* which have been stuck since $date_time_past eg stuck for 3 hours or more
	* @param string $interval_time - max hours can run for as incomplete eg '3 hours'
	* @returns int $num_rows - The number of rows deleted by this method
	*/
	public function deleteIncompleteCrons($interval_time) {
		
		if (empty($interval_time)) {
			trigger_error('Error - $interval_time not set', E_USER_ERROR);
		}
		
		$date_time_past = db::getDateInPast($interval_time);
		
		$delete_sql = "
		DELETE FROM $this->db_table
		WHERE complete = 0
		AND script = '$this->script'
		AND time_started < '$date_time_past'
		";
		
		//dbug($delete_sql,'$delete_sql');
		
		$delete_result = db::doQuery($delete_sql);
		
		$num_rows = db::getAffectedRows();
		//dbug($num_rows,'$num_rows');
		return $num_rows;
	}
	
	
	/*
	* Gets the cron id of the last run cron job which did NOT finish
	* returns int id
	*/
	public function getLastIncompleteCronId() {
		
		$cron_check_sql = "SELECT id FROM $this->db_table WHERE script = '$this->script' AND complete != 1 ORDER BY id ASC";
		$cron_check_result = db::getRow($cron_check_sql);
		
		return $cron_check_result['id'];
	}
	
	
	/*
	* Gets the time_started field of the most recently run cron
	* returns datetime time_started
	*/
	public function getLastIncompleteCronTimeStarted() {
		
		$cron_check_sql = "SELECT time_started FROM $this->db_table WHERE script = '$this->script' ORDER BY id ASC";
		$cron_check_result = db::getRow($cron_check_sql);
		
		return $cron_check_result['time_started'];
	}
	
	
	/*
	* See how many CRONS have already run today for this script
	* Returns a count
	*/
	public function getTodaysCrons() {
		
		$cron_check_sql = "
		SELECT id, script, complete, last_security_id, date(time_started) AS date_started
		FROM $this->db_table
		WHERE script = '$this->script'
		HAVING date_started = CURDATE()";
		
		//dbug($cron_check_sql,'$cron_check_sql','purple');
		$cron_check_results = db::getRows($cron_check_sql);

		//dbug($cron_check_results,'cron_check_results','purple');
		
		return count($cron_check_results);
	}
	
	
	/*
	* Updates the security_ids field with a list of ids downloaded
	* Note this does not guarantee that all these securities completed successfully
	* @param str $msg
	*/
	public function setSecurityIdsField($security_ids_msg) {
		
		if (empty($security_ids_msg)) {
			trigger_error('Error - $security_ids_msg not set', E_USER_ERROR);
		}
		
		$update_sql = "UPDATE $this->db_table SET security_ids = '".db::makeDBSafe($security_ids_msg)."' WHERE id = '$this->cron_id' LIMIT 1";
		
		//dbug($update_sql,'$update_sql');
		
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error('Error - could not update '.$this->db_table.' table. $update_sql: '.$update_sql, E_USER_ERROR);
		}
	}
	
	
	/*
	* Updates the symbols field with a list of symbols
	* Note this does not guarantee that all these securities completed successfully
	* @param str $msg
	*/
	public function setSymbolsField($symbols_msg) {
		
		if (empty($symbols_msg)) {
			trigger_error('Error - $symbols_msg not set', E_USER_ERROR);
		}
		
		$update_sql = "UPDATE $this->db_table SET symbols = '".db::makeDBSafe($symbols_msg)."' WHERE id = '$this->cron_id' LIMIT 1";
		
		//dbug($update_sql,'$update_sql');
		
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error('Error - could not update '.$this->db_table.' table. $update_sql: '.$update_sql, E_USER_ERROR);
		}
	}
	
	
	/*
	* Updates the last_security_id field with the final security id we will process in this batch
	* Note this does not guarantee that all these securities completed successfully
	* This is useful for debugging and error checking if the CRON stuffs up
	* @param int security_id
	*/
	public function setLastSecurityId($security_id) {
		
		if (empty($security_id)) {
			trigger_error('Error - we require a security_id', E_USER_ERROR);
		}
		
		$update_sql = "UPDATE $this->db_table SET last_security_id = '$security_id' WHERE id = '$this->cron_id' LIMIT 1";
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error('Error - could not update '.$this->db_table.' table. $update_sql: '.$update_sql, E_USER_ERROR);
		}
	}
	
	
	/*
	* Saves an error message for this cron in the database
	*/
	public function setError($error_msg) {
		
		$update_sql = "UPDATE $this->db_table SET error = '1', error_msg = '".db::makeDBSafe($error_msg)."' WHERE id = '$this->cron_id' LIMIT 1";
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error('Error - could not update '.$this->db_table.' table. $update_sql: '.$update_sql, E_USER_ERROR);
		}
	}
	
	
	/*
	* Finishes a cron by marking it complete and updating db with a timestamp
	*/
	public function setComplete() {
		
		$update_sql = "UPDATE $this->db_table SET complete = '1', time_complete = NOW() WHERE id = '$this->cron_id' LIMIT 1";
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error('Error - could not update '.$this->db_table.'. $update_sql: '.$update_sql, E_USER_ERROR);
		}
	}
	
	
	/*
	* This method is used before calling getNextCronTime()
	* @param string $cron_frequency interval between cron jobs eg '2 minutes'
	*/
	public function setCronFrequency($cron_frequency) {
		$this->cron_frequency = $cron_frequency;
	}
	
	/*
	* Calculates the time when this CRON job should next run
	* @returns string with date/time eg '2019-01-18 18:16:22'
	*/
	public function getNextCronTime() {
		
		if (empty($this->cron_frequency)) {
			trigger_error('Error - $this->cron_frequency not set. Make sure to run method setCronFrequency() before calling this method', E_USER_ERROR);
		}
		
		// determine when this page started execution
		$start_time = $_SERVER["REQUEST_TIME"];

		// calculate next cron run time
		$next_cron_time = date('Y-m-d H:i:s', strtotime('+'.$this->cron_frequency, $start_time));
		
		return $next_cron_time;
	}
	
}
?>