<?php


/**
* Handles students' grades and related tasks
* eg converting a 'C' to 'sound'
*/
class grade
{
	/*
	* converts a 'grade' like A, to a string like 'outstanding'
	* converts an A to outstanding
	* converts a B to high
	* converts a C to sound
	* converts a D to basic
	* converts a E to limited
	* returns a string
	*/
	public function get_adjective($grade, $randomise=false) {
		
		if (empty($grade)) {
			trigger_error('ERROR - $grade must be set', E_USER_ERROR);
		}
		
		$word = 'ERROR';	// default case, should never occur if used right!
		
		if ($grade == 'A') {
			$word = 'outstanding';
		}
		else if ($grade == 'B') {
			$word = 'high';
		}
		else if ($grade == 'C') {
			$word = 'sound';
		}
		else if ($grade == 'D') {
			$word = 'basic';
		}
		else if ($grade == 'E') {
			$word = 'limited';
		}
		
		// are we randomising the word?
		if ($randomise) {
			
			$original_word = $word;
			$word = word::get_alternative($original_word);	// get new word
		}
		
		return $word;
	}

	
	/*
	* Saves a grade for a particular student/task
	* Usually grades are imported from an excel spreadsheet
	* But user can still override them on /reports/edit.php
	* $grade must be either A B C D E
	*/
	public function setStudentGrade($report_id, $student_id, $task_id, $grade) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		if (empty($task_id)) {
			trigger_error('ERROR - $task_id must be set', E_USER_ERROR);
		}
	
		$accepted_grades = array('A','B','C','D','E');
		if (!in_array($grade, $accepted_grades)) {
			trigger_error('ERROR - $grade must be either A B C D E', E_USER_ERROR);
		}
		
		$student_id = db::makeDBSafe($student_id);
		$task_id = db::makeDBSafe($task_id);
		$grade = db::makeDBSafe($grade);
		
		$update_sql = "UPDATE grades SET grade='$grade' WHERE report_id='$report_id' AND student_id='$student_id' AND task_id='$task_id' LIMIT 1";
		
		$update_result = db::doQuery($update_sql);
		if (!$update_result) {
			trigger_error("Error - could not update grades table for student_id: $student_id and task_id: $task_id, update_sql: $update_sql", E_USER_ERROR);
		}
		
	}
	
}