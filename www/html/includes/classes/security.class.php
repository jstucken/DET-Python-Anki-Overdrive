<?php

/**
* Jono's security
* Handles stuff related
*/
class cron
{
	private $db_table;			// holds what database table we are working with
	private $script;			// holds what script is running by cron
	private $cron_id;			// saves what cron_id we will be working with
	private $time_started;		// saves when the current cron was started
	
	
	/*
	* constructor method
	* record what script is using this cron class
	*/
	public function __construct($db_table) {
		
		if (empty($db_table)) {
			trigger_error('ERROR - $db_table cannot be blank.', E_USER_ERROR);
		}
		
		$this->script = $_SERVER['PHP_SELF'];
		$this->db_table = $db_table;
	}
	
	
	/*
	* Starts a new CRON job, recording start time in relevant db table
	*/
	public function start() {
		
		$insert_sql = "INSERT INTO $this->db_table (script) VALUES ('$this->script')";
		
		$insert_result = db::doQuery($insert_sql);
		if (!$insert_result) {
			trigger_error('Error - could not insert new record into '.$this->db_table.', $insert_sql: '.$insert_sql, E_USER_ERROR);
		}
		$cron_id = db::getLastID();
		$this->setCronID($cron_id);
		
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
		
		$cron_check_sql = "SELECT * FROM securities_historicals_crons WHERE script = '$this->script' AND complete != 1 AND id != '$this->cron_id' ORDER BY id ASC";
		$cron_check_result = db::getRow($cron_check_sql);
		
		if (empty($cron_check_result)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/*
	* See how many CRONS have already run today for this script
	* Returns a count
	*/
	public function getTodaysCrons() {
		
		$cron_check_sql = "
		SELECT id, script, complete, last_security_id, date(time_started) AS date_started
		FROM securities_historicals_crons
		WHERE script = '$this->script'
		HAVING date_started = CURDATE()";
		
		//dbug($cron_check_sql,'$cron_check_sql','purple');
		$cron_check_results = db::getRows($cron_check_sql);

		//dbug($cron_check_results,'cron_check_results','purple');
		
		return count($cron_check_results);
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
	* Saves an error message for a particular Security
	* Useful to serve as a warning that there's an ongoing problem importing data
	* for a particular security
	* @param int $security_id
	* @param string $error_msg
	*/
	public function setSecurityError($security_id, $error_msg) {
		
		if (empty($security_id)) {
			trigger_error('Error - $security_id cannot be empty.', E_USER_ERROR);
		}
		
		// append a timestamp to the error message to aid debugging
		$error_msg = db::getHumanReadableDate().' - '.$error_msg;
		
		// increment import_error. This will help identify recurring bad securities
		$update_sql = "UPDATE securities SET import_error = import_error + 1, import_error_msg = CONCAT(import_error_msg, '".db::makeDBSafe($error_msg)."\n') WHERE id = '$security_id' LIMIT 1";
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error('Error - could not update securities table. $update_sql: '.$update_sql, E_USER_ERROR);
		}
	}
	
}
?>