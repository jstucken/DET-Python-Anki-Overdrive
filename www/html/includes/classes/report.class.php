<?php
/*
* Handles general report related stuff
* eg deleting students etc
*/
class report
{
	
	/*
	* Clears out all students/tasks/grades/templates from a specified report
	*/
	public function delete_report_data($report_id) {
		
		$report_id = db::makeDBSafe($report_id);
		
		if (empty($report_id)) {
			trigger_error('Error - $report_id cannot be empty!', E_USER_ERROR);
		}
		
		// delete any existing tasks for this report to make way for fresh import
		$delete_sql = "DELETE FROM tasks WHERE report_id='$report_id'";
		$delete_result = db::doQuery($delete_sql);

		// delete any existing students for this report to make way for fresh import
		$delete_sql = "DELETE FROM students WHERE report_id='$report_id'";
		$delete_result = db::doQuery($delete_sql);
		
		// delete any existing student grades for this report to make way for fresh import
		$delete_sql = "DELETE FROM grades WHERE report_id='$report_id'";
		$delete_result = db::doQuery($delete_sql);
		
		// delete any existing student grades for this report to make way for fresh import
		$delete_sql = "DELETE FROM templates WHERE report_id='$report_id'";
		$delete_result = db::doQuery($delete_sql);
	}
	
	
	/*
	* Creates a new task for a particular report
	* Returns the task_id of the newly created task
	*/
	public function create_task($report_id, $task_name) {
		
		$report_id = db::makeDBSafe($report_id);
		if (empty($report_id)) {
			trigger_error('Error - $report_id cannot be empty!', E_USER_ERROR);
		}
		
		$task_name = db::makeDBSafe($task_name);
		if (empty($task_name)) {
			trigger_error('Error - $task_name cannot be empty!', E_USER_ERROR);
		}

		$insert_sql = "INSERT INTO tasks (report_id, name) VALUES ('$report_id', '$task_name')";
		//dbug($insert_sql,'$insert_sql');

		$insert_result = db::doQuery($insert_sql);
		if (!$insert_result) {
			trigger_error('Error - could not insert new record into tasks table, $insert_sql: '.$insert_sql, E_USER_ERROR);
		}
		
		// return the new task id
		$last_id = db::getLastID();
		return $last_id;
	}
	
	
	/*
	* Creates a new student for a particular report
	* Returns the student_id of the newly created student
	*/
	public function create_student($report_id, $lastname, $firstname, $gender) {
		
		$report_id = db::makeDBSafe($report_id);
		$lastname = db::makeDBSafe($lastname);
		$firstname = db::makeDBSafe($firstname);
		$gender = db::makeDBSafe($gender);
		
		if (empty($report_id)) {
			trigger_error('Error - $report_id cannot be empty!', E_USER_ERROR);
		}
		if (empty($lastname)) {
			trigger_error('Error - $lastname cannot be empty!', E_USER_ERROR);
		}
		if (empty($firstname)) {
			trigger_error('Error - $firstname cannot be empty!', E_USER_ERROR);
		}
		if (empty($gender)) {
			trigger_error('Error - $gender cannot be empty!', E_USER_ERROR);
		}

		// insert new student into db
		$insert_sql = "INSERT INTO students (report_id, lastname, firstname, gender) VALUES ('$report_id', '$lastname', '$firstname', '$gender')";
		//dbug($insert_sql,'$insert_sql');

		$insert_result = db::doQuery($insert_sql);
		if (!$insert_result) {
			trigger_error('Error - could not insert new record into students table, $insert_sql: '.$insert_sql, E_USER_ERROR);
		}
		$student_id = db::getLastID();
		
		return $student_id;
	}
	
	
	
	/*
	* Adds a report grade for a particular student and task
	*/
	public function create_grade($report_id, $student_id, $task_id, $grade) {
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		$task_id = db::makeDBSafe($task_id);
		$grade = db::makeDBSafe($grade);
		
		if (empty($report_id)) {
			trigger_error('Error - $report_id cannot be empty!', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('Error - $student_id cannot be empty!', E_USER_ERROR);
		}
		if (empty($task_id)) {
			trigger_error('Error - $task_id cannot be empty!', E_USER_ERROR);
		}
		if (empty($grade)) {
			trigger_error('Error - $grade cannot be empty!', E_USER_ERROR);
		}

		// insert into db
		$insert_sql = "INSERT INTO grades (report_id, student_id, task_id, grade) VALUES ('$report_id', '$student_id', '$task_id', '$grade')";
		//dbug($insert_sql,'$insert_sql');

		$insert_result = db::doQuery($insert_sql);
		if (!$insert_result) {
			trigger_error('Error - could not insert new record into grades table, $insert_sql: '.$insert_sql, E_USER_ERROR);
		}
	}
	
	
	
	
}