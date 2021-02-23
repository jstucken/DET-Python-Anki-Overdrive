<?php


/**
* Handles students, their traits and comments
* eg updating and deleting trait selections
* eg2 saving a comment for a particular student
*/
class student
{
	private $test;			// holds what script is running by cron
	
	/*
	* Gets all the default traits
	*/
	public function get_traits($category) {
		
		if (empty($category)) {
			trigger_error('ERROR - $category must be set', E_USER_ERROR);
		}
		
		$traits_sql = "SELECT id, name FROM traits WHERE category='$category' ORDER BY name ASC";
		//dbug($traits_sql,'traits_sql');
		
		$traits = db::getRows($traits_sql);
		//dbug($traits,'traits');
		return $traits;
	}
	

	
	/*
	* Gets the saved traits (ids) for a specified student
	*/
	public function get_student_traits($student_id) {
		
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id not set', E_USER_ERROR);
		}
		
		// get all saved traits for this student
		$select_sql = "SELECT characteristic1, characteristic2, improvement1, improvement2 FROM students_traits WHERE student_id = '$student_id'";
		$select_result = db::getRow($select_sql);
		
		//dbug($select_result,'select_result');
		
		return $select_result;
		
	}
	
	
	/*
	* Gets the saved traits (ids) for a specified student
	* returns an array with their names
	* eg:
		Array
		(
			[characteristic1] => considerate
			[characteristic2] => friendly
			[improvement1] => actively contribute to class discussions
			[improvement2] => put aside costly distractions
		)
	*/
	public function get_student_traits_named($student_id) {
		
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id not set', E_USER_ERROR);
		}
		
		$student_traits_ids = self::get_student_traits($student_id);
		//dbug($student_traits_ids,'$student_traits_ids','purple');
		
		// we have ids, now get the proper names of these traits
		$named_traits = array();
		
		foreach ($student_traits_ids as $key => $trait_id) {
				
				$select_sql = "SELECT name FROM traits WHERE id = '$trait_id'";
				$select_result = db::getRow($select_sql);
				
				//dbug($select_result,'$select_result');
				$named_traits[$key] = $select_result['name'];
			
		}
		
		//dbug($named_traits,'named_traits');
		return $named_traits;
		
	}
	
	
	
	/*
	* Creates a trait in the students_traits table
	* $column is the column in the db table to update, eg trait_id1
	*/
	public function set_student_trait($column, $student_id, $value) {
		
		if (empty($column)) {
			trigger_error('ERROR - $column not set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id not set', E_USER_ERROR);
		}
		
		$column = db::makeDBSafe($column);
		$student_id = db::makeDBSafe($student_id);
		$value = db::makeDBSafe($value);
		
		// check if student has a trait record already
		$select_sql = "SELECT * FROM students_traits WHERE student_id = '$student_id'";
		$select_result = db::getRow($select_sql);
		
		// create a new row for this student
		if (empty($select_result)) {
			// insert new trait
			$insert_sql = "INSERT INTO students_traits (student_id, $column) VALUES ('$student_id', '$value')";
			//dbug($insert_sql,'insert_sql');

			$insert_result = db::doQuery($insert_sql);
			if (!$insert_result) {
				trigger_error('Error - could not insert new record into students_traits table, $insert_sql: '.$insert_sql, E_USER_ERROR);
			}
		}
		else {
			
			// update existing row
			$update_sql = "UPDATE students_traits SET $column='$value' WHERE student_id='$student_id' LIMIT 1";
			
			//dbug($update_sql,'$update_sql');

			$update_result = db::doQuery($update_sql);
			if (!$update_result) {
				trigger_error('Error - could not update students_traits table. $update_sql: '.$update_sql, E_USER_ERROR);
			}
		}
	}
	
	
	
	/*
	* Saves a students' comment to the students_comments table
	*/
	public function set_student_comment($report_id, $student_id, $comment) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id not set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id not set', E_USER_ERROR);
		}
		
		
		$student_id = db::makeDBSafe($student_id);
		$comment = db::makeDBSafe($comment);
		
		// check if student has a comment record already
		$select_sql = "SELECT * FROM students_comments WHERE report_id='$report_id' AND student_id='$student_id'";
		$select_result = db::getRow($select_sql);
		
		//dbug($select_result,'select_result');
		
		// create a new row for this student
		if (empty($select_result)) {
			// insert new trait
			$insert_sql = "INSERT INTO students_comments (report_id, student_id, comment) VALUES ('$report_id','$student_id','$comment')";
			//dbug($insert_sql,'insert_sql');

			$insert_result = db::doQuery($insert_sql);
			if (!$insert_result) {
				trigger_error('Error - could not insert new record into students_comments table, $insert_sql: '.$insert_sql.' sql_error: '.db::getError(), E_USER_ERROR);
			}
		}
		else {
			
			// update existing row
			$update_sql = "UPDATE students_comments SET comment='$comment' WHERE report_id='$report_id' AND student_id='$student_id' LIMIT 1";
			
			//dbug($update_sql,'$update_sql');

			$update_result = db::doQuery($update_sql);
			if (!$update_result) {
				trigger_error('Error - could not update students_comments table. $update_sql: '.$update_sql, E_USER_ERROR);
			}
		}
		return true;
	}
	
	
	/*
	* Deletes all saved comments in the students_comments table
	*/
	public function delete_all_comments($report_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id not set', E_USER_ERROR);
		}
		
		// delete all comments for all students, for this report
		$delete_sql = "DELETE FROM students_comments WHERE report_id='$report_id'";
		
		$delete_result = db::doQuery($delete_sql);
		$num_rows = db::getAffectedRows();
		
		return $num_rows;
	}
	
}