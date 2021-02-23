<?php

/*
* Handles the report templates
* eg adding in the students' name and marks etc into the template
*/
class template
{

	
	/*
	* Loads the template from DB and replaces [keywords] with student details
	* returns a string with the new template paragraphs
	*/
	public function invoke_template($report_id, $student) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (!is_array($student)) {
			trigger_error('ERROR - $student must be an array containing all the students\' details from db.', E_USER_ERROR);
		}
		
		// pull out student id from passed params
		$student_id = $student['student_id'];
		
		//debug($student,'student');
		$overall_grade = $student['overall_grade'];
		
		// get templates which can be used for this report, and the students grade
		// first check to see if this student has been assigned a template manually
		// if found, use it
		$student_template = template::get_student_template($report_id, $student_id, $overall_grade);
		//dbug($student_template,'$student_template','black');
		
		// add the template content in
		$new_content = $student_template;
		
		
		// simplify student variables
		$firstname = $student['student_firstname'];
		$gender = $student['student_gender'];
		
		// replace all instances of [Name] with the students' real name
		$new_content = str_replace('[Name]', $firstname, $new_content);
		
		
		// add in the custom characteristics and improvements for this student
		//debug($student,'student','purple');
		
		// for use later with word class
		word::set_student_id($student_id);
		
		//dbug($new_content,'$new_content','purple');
		
		//dbug($student_id,'student_id','black');
		
		$traits = student::get_student_traits_named($student_id);
		//dbug($traits,'$traits');
		foreach ($traits as $trait => $student_trait) {
			
			// add 'and ' if more than one characteristic or improvement selected for this student
			if ($trait == 'characteristic2' and !empty($student_trait)) {
				$student_trait = ' and '.$student_trait;
			}
			else if ($trait == 'improvement2' and !empty($student_trait)) {
				$student_trait = ' and to '.$student_trait;		// improvement2 handled slightly different
			}
			
			//dbug($student_trait,'$student_trait');

			// make a string like [characteristic1] to search and replace on
			$needle = '['.$trait.']';
			//echo $trait_string;
			
			
			// For characteristics, do we have to replace the preceding 'a' word in the sentence with 'an'?
			// eg Ricky is a attentive student...
			// should become:
			// Ricky is an attentive student...
			//dbug($trait,'trait');
			
			if ($trait == 'characteristic1') {
				
				// word::fix_vowels($needle, $replacement, $haystack);
				$new_content = word::fix_vowels($needle, $student_trait, $new_content);
			}
			
			$new_content = str_replace($needle, $student_trait, $new_content);
			
			//dbug($new_content,'new_content','black');
			//exit;
			//dbug($student,'student');
			
		}
	
		// ADD GRADES
		// replace [overall_grade] and [overall_grade_alternative] with real words
		$new_content = self::replace_grade('[overall_grade]', $student['overall_grade'], $new_content);
		$new_content = self::replace_grade('[overall_grade_alternative]', $student['overall_grade'], $new_content, true);
		
		//dbug($new_content,'$new_content');
		
		// add the students' individual task grades into the template
		// eg replace [task1_grade] with 'sound'
		$needle = '';
		
		//dbug($student_id,'student_id','black');
		//dbug($student['grades'], '$student[grades]', 'purple');
		
		// start with task1_grade
		$task_number = 1;
		foreach ($student['grades'] as $grade) {
			
			// build our search needle
			$needle = '[task'.$task_number.'_grade]';
			$needle_alternative = '[task'.$task_number.'_grade_alternative]';
			$grade = $grade['grade'];
			
			// this method also REPLACES (adds) the new adjective into the string. Can be confusing!
			$grade_adjective = grade::get_adjective($grade, false);
			
			//dbug($grade,'$grade','black');
			//dbug($grade_adjective,'$grade_adjective','black');
			$student_id = word::get_student_id();
			
			
			//dbug($new_content,'$new_content3');
			
			
			//dbug($new_content,'$new_content4');
			
			/////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////
			// THE LINE BELOW IS PROBLEMATIC AND MAKES FUNNY SENTENCES
			// THE LINE BELOW IS PROBLEMATIC AND MAKES FUNNY SENTENCES
			// THE LINE BELOW IS PROBLEMATIC AND MAKES FUNNY SENTENCES
			// eg: In Semester One, Nikhita worked <consistently> in class to achievan [task1_grade]
			//dbug($new_content,'$new_content','pink');
			
			// insert the student grade into the content string
			$new_content = self::replace_grade($needle, $grade, $new_content);
			$new_content = self::replace_grade($needle_alternative, $grade, $new_content, true);
			
			
			$task_number++;
		}
		
		
		// finally, any words marked with <> (eg <word>) should be replaced
		// with alternative words from words table
		$new_content = word::replace_alternative_words($new_content);
		
		// add proper gender text into the template, replacing [he] with he/she etc
		$new_content = self::replace_gender($gender, $new_content);
		
		/////////////////////// TODO ///////////////////////
		/////////////////////// TODO ///////////////////////
		// make another template, and only use this line for A and B grade students:
		//In class, Andreo works consistently to complete his classwork. 
		// also use random choice of templates
		
		return $new_content;
	}
	
	
	/*
	* Adds the students' gender into a string, using $gender from db
	* eg replaces [his] with his or her
	* and replaces [His] with His or Her
	* and replaces [he] with he or she
	* and replaces [He] with He or She
	*
	* Accepts a string containing F or M
	* Returns an amended string
	*/
	public function replace_gender($gender, $string) {
		
		if ($gender != 'M' and $gender != 'F') {
			trigger_error('ERROR - $gender must be either M or F', E_USER_ERROR);
		}
		if (empty($string)) {
			trigger_error('ERROR - $string not set', E_USER_ERROR);
		}
		
		
		// add in his/her
		$his = 'his';
		if ($gender == 'F') {
			$his = 'her';
		}
		
		$string = str_replace('[his]', $his, $string);
		
		// title case equivalent of above
		$His = 'His';
		if ($gender == 'F') {
			$His = 'Her';
		}
		$string = str_replace('[His]', $His, $string);
		
		// do he and she
		$he = 'he';
		if ($gender == 'F') {
			$he = 'she';
		}
		$string = str_replace('[he]', $he, $string);
		
		// do He and She
		$He = 'He';
		if ($gender == 'F') {
			$He = 'She';
		}
		//echo "Gender: $gender <br>";
		//echo "He: $He <br>";
		$string = str_replace('[He]', $He, $string);
		
		// do himself and herself
		$himself = 'himself';
		if ($gender == 'F') {
			$himself = 'herself';
		}
		//echo "himself: $himself <hr>";
		
		$string = str_replace('[himself]', $himself, $string);
		
		
		return $string;
	}


	/*
	* Adds the students' grade into a string
	* eg replaces [task1_grade] with high
	* eg replaces [task1_grade_alternative] with pleasing (or another word from words table)
	*
	* @param string $overall_grade eg B
	* @param string The string to replace on
	* @param bool $randomise - set to true to get alternate words from db
	* Returns an amended string
	*/
	public function replace_grade($needle, $replacement, $string, $randomise=false) {
		
		
		// dbug($needle,'needle','purple');
		// dbug($replacement,'replacement','purple');
		// dbug($string,'string','purple');
		// dbug($randomise,'randomise','purple');
		
		if (empty($needle)) {
			trigger_error('ERROR - $needle not set', E_USER_ERROR);
		}
		$accepted = array('A','B','C','D','E');
		if (!in_array($replacement, $accepted)) {
			trigger_error('ERROR - $needle must be either A, B, C, D or E', E_USER_ERROR);
		}
		if (empty($string)) {
			trigger_error('ERROR - $string not set', E_USER_ERROR);
		}
		
		
		// convert A,B,C etc into outstanding, high, sound etc
		$adjective = grade::get_adjective($replacement, $randomise);
		
		//dbug($adjective,'adjective');
		
		// add into the string proper
		
		
		
		// BUGGY! DISABLED!
		//$string = word::fix_vowels($needle, $adjective, $string);
		
		$old_string = $string;
		$string = str_replace($needle, $adjective, $string);
		
		if ($adjective == 'elementary') {
			// echo "BOOM";
			// dbug($old_string,'$string','black');
			// dbug($needle,'$string');
			// dbug($adjective,'$adjective');
			// dbug($string,'$string');
			// dbug($string,'$string','green');
		}
		
		
		
		return $string;
	}
	
	
	
	/*
	* Gets all the default templates available for the report
	* Edit 2/11/2020: I'm not sure if this method gets used anymore?
	* overall_grades column no longer exists in the DB table
	*/
	public function get_available_templates($report_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		
		
		$report_id = db::makeDBSafe($report_id);
		
		$templates_sql = "SELECT id, name, overall_grades, content FROM templates WHERE report_id='$report_id' ORDER BY overall_grades ASC";
		//dbug($traits_sql,'traits_sql');
		
		$templates = db::getRows($templates_sql);
		//dbug($templates,'templates');
		
		return $templates;
	}
	
	
	
	/*
	* Gets all templates for all students for specified report
	* Returns an array with student_id as the key
	* also saves the data into the session
	*/
	public function get_students_templates($report_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		
		$report_id = db::makeDBSafe($report_id);
		
		$templates_sql = "SELECT id, student_id, template_id FROM students_templates WHERE report_id='$report_id' ORDER BY id ASC";
		//dbug($traits_sql,'traits_sql');
		
		$templates = db::getRows($templates_sql);
		//dbug($templates,'templates');
		
		// final array
		// we need to put results into an array with the $student_id as the key
		$students_templates = array();
		
		foreach ($templates as $template) {
			
			$student_id = $template['student_id'];
			$template_id = $template['template_id'];
			
			$students_templates[$student_id] = $template_id;
		}
		
		//dbug($students_templates,'students_templates','green');
		
		
		// save above data to session
		$_SESSION['students_templates'] = $students_templates;
		//dbug($_SESSION,'_SESSION');

		return $students_templates;
		
	}
	
	
	
	/*
	* Saves a chosen template for a particular student
	*/
	public function set_student_template($report_id, $student_id, $template_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		$template_id = db::makeDBSafe($template_id);
		
		// delete any selected template for this student
		$delete_sql = "DELETE FROM students_templates WHERE report_id='$report_id' AND student_id='$student_id'";
		$delete_result = db::doQuery($delete_sql);
		$num_rows = db::getAffectedRows();
		
		// only create a record if template_id provided (chosen by user)
		if ($template_id != '') {
			// save the selected template for this student
			$insert_sql = "INSERT INTO students_templates  VALUES ('$report_id','$student_id','$template_id')";
			//dbug($insert_sql,'insert_sql');

			$insert_result = db::doQuery($insert_sql);
			if (!$insert_result) {
				trigger_error('Error - could not insert new record into students_templates table, $insert_sql: '.$insert_sql, E_USER_ERROR);
			}
		}
		
		//dbug($traits_sql,'traits_sql');
		
	}
	
	
	/*
	* Gets any template which has been manually assigned to a student, from session
	* Retrieves from DB, not session
	* returns string $template_content containing the actuall template content
	*/
	public function get_student_template($report_id, $student_id, $overall_grade) {
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		$overall_grade = db::makeDBSafe($overall_grade);
		
		// this string will hold the template content for all tasks incluuding the intro/outro
		$task_templates = '';
		
		// get the intro and outro template content
		$intro = self::getIntroTemplate($report_id, $student_id, $overall_grade);
		$outro = self::getOutroTemplate($report_id, $student_id, $overall_grade);
		
		$task_templates = $intro;
		
		//dbug($intro,'$intro');
		//dbug($outro,'$outro');
		
		// get all the students' tasks for this report
		$tasks = self::getStudentGrades($report_id, $student_id);
		
		//dbug($tasks,'$tasks');
		
		// for each task, get the associated template snippet content, based on the grade
		// the student has received for the task
		foreach ($tasks as $key => $task) {
			
			$task_id = $task['task_id'];
			
			$task_template = self::getTaskTemplate($report_id, $student_id, $task_id);
			
			// place a space between each task template block of text
			// add colour coded tags to template for readability
			$task_templates .= 'BEGINTASK'.$key;
			$task_templates .= ' ';
			$task_templates .= $task_template;
			$task_templates .= 'ENDTASK'.$key;
		}
		//dbug($task_templates,'$task_templates');
		
		// finally, append the outro template text onto the end of the string
		$task_templates .= ' '.$outro;
		
		return $task_templates;

	}
	
	
	/*
	* gets all the tasks for a specified report
	*/
	public function getReportTasks($report_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
	
		$report_id = db::makeDBSafe($report_id);
		$tasks_sql = "SELECT * FROM tasks WHERE report_id = '$report_id' ORDER BY id ASC";
		
		//dbug($tasks_sql,'tasks_sql');
		
		$tasks = db::getRows($tasks_sql);
		
		// add in the task number eg task 1
		// this is not a DB column so we have to add it in
		foreach ($tasks as $key => $task) {
			$tasks[$key]['task_number'] = $key;
		}
		//dbug($tasks,'$tasks');
		
		return $tasks;
		
	}
	
	
	/*
	* Gets all the intro template grades for a given report
	* returns an associated array with 5 rows (A - E)
	*/
	public function getIntroTemplates($report_id) {
		
		$report_id = db::makeDBSafe($report_id);
		
		
		$select_sql = "SELECT * FROM templates WHERE report_id='$report_id' and intro='1' ORDER BY id ASC";
		$select_results = db::getRows($select_sql);
		
		$intro_templates = array();
		
		foreach ($select_results as $key => $result) {
			
			$grade = $result['grade'];
			$intro_templates[$grade] = $result['content'];
		}
		//dbug($intro_templates,'$intro_templates');
		
		return $intro_templates;
	}
	
	
	/*
	* Gets the intro template content for a given student
	* It's chosen based upon their overall grade
	* returns a string with the content
	*/
	public function getIntroTemplate($report_id, $student_id, $overall_grade) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		if (empty($overall_grade)) {
			trigger_error('ERROR - $overall_grade must be set', E_USER_ERROR);
		}
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		$overall_grade = db::makeDBSafe($overall_grade);
		
		// get an intro template for this student, based on their overall grade
		$template_sql = "
		SELECT
			grade,
			content
		FROM templates
		WHERE report_id = '$report_id'
		AND intro = '1'
		AND grade='$overall_grade'";
		
		//dbug($template_sql,'template_sql');
		$template_result = db::getRow($template_sql);
		$intro = $template_result['content'];

		return $intro;
	}
	
	
	/*
	* Gets all the intro template grades for a given report
	* returns an associated array with 5 rows (A - E)
	*/
	public function getTaskTemplates($report_id) {
		
		$report_id = db::makeDBSafe($report_id);
		
		$select_sql = "SELECT * FROM templates WHERE report_id='$report_id' AND intro='0' AND outro='0' ORDER BY id ASC";
		$select_results = db::getRows($select_sql);
		
		//dbug($select_results,'$select_results');
		
		// numerically key the array grouping by $task_id
		$tasks = array();
		
		foreach ($select_results as $task) {
		
			$task_id = $task['task_id'];
			
			if ($task['grade'] == 'A') {
				$tasks[$task_id]['A'] = $task['content'];
			}
			else if ($task['grade'] == 'B') {
				$tasks[$task_id]['B'] = $task['content'];
			}
			else if ($task['grade'] == 'C') {
				$tasks[$task_id]['C'] = $task['content'];
			}
			else if ($task['grade'] == 'D') {
				$tasks[$task_id]['D'] = $task['content'];
			}
			else if ($task['grade'] == 'E') {
				$tasks[$task_id]['E'] = $task['content'];
			}
		}
		
		return $tasks;
	}
	
	
	/*
	* Gets a template content for a given task and student
	* It's chosen based upon students' grade received for the task
	* returns a string with the task template content
	*/
	public function getTaskTemplate($report_id, $student_id, $task_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		if (empty($task_id)) {
			trigger_error('ERROR - $task_id must be set', E_USER_ERROR);
		}
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		$task_id = db::makeDBSafe($task_id);
		
		// get an intro template for this student, based on their overall grade
		$template_sql = "
		SELECT
			g.task_id,
			g.student_id,
			g.grade,
			t.content
        FROM grades g
		LEFT JOIN templates t ON (t.task_id = g.task_id)
        WHERE g.report_id = '$report_id'
        AND g.task_id = '$task_id'
        AND g.student_id = '$student_id'
		AND t.grade = g.grade";
		
		//dbug($template_sql,'template_sql');
		
		$template_result = db::getRow($template_sql);
		$template_content = $template_result['content'];
		
		return $template_content;
		
	}
	
	
	
	
	/*
	* Gets all the outro template grades for a given report
	* returns an associated array with 5 rows (A - E)
	*/
	public function getOutroTemplates($report_id) {
		
		$report_id = db::makeDBSafe($report_id);
		
		$select_sql = "SELECT * FROM templates WHERE report_id='$report_id' and outro='1' ORDER BY id ASC";
		$select_results = db::getRows($select_sql);
		
		$outro_templates = array();
		
		foreach ($select_results as $key => $result) {
			
			$grade = $result['grade'];
			$outro_templates[$grade] = $result['content'];
		}
		//dbug($outro_templates,'$outro_templates');
		
		return $outro_templates;
	}
	
	
	/*
	* Gets the outro template content for a given student
	* It's chosen based upon their overall grade
	* returns a string with the content
	*/
	public function getOutroTemplate($report_id, $student_id, $overall_grade) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		if (empty($overall_grade)) {
			trigger_error('ERROR - $overall_grade must be set', E_USER_ERROR);
		}
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		$overall_grade = db::makeDBSafe($overall_grade);
		
		// get an intro template for this student, based on their overall grade
		$template_sql = "
		SELECT
			grade,
			content
		FROM templates
		WHERE report_id = '$report_id'
		AND outro = '1'
		AND grade='$overall_grade'";
		
		//dbug($template_sql,'template_sql');
		$template_result = db::getRow($template_sql);
		$outro = $template_result['content'];

		return $outro;
	}
	
	
	
	/*
	* Gets all the tasks assigned to a report/student
	* and the students' grades for each task
	* Returns an array with a row for each task
	*/
	public function getStudentGrades($report_id, $student_id) {
		
		if (empty($report_id)) {
			trigger_error('ERROR - $report_id must be set', E_USER_ERROR);
		}
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		
		$report_id = db::makeDBSafe($report_id);
		$student_id = db::makeDBSafe($student_id);
		
		// get tasks and their corresponding grades for this student
		$tasks_sql = "
		SELECT
			t.id AS task_id,
			t.name AS task_name,
			g.grade AS grade
		FROM tasks t
		LEFT JOIN grades g ON (g.task_id = t.id)
		LEFT JOIN reports r ON (r.id = '$report_id')
		WHERE g.student_id = '$student_id'
		ORDER BY t.id ASC
		";
		
		//dbug($tasks_sql,'$tasks_sql');
		$tasks = db::getRows($tasks_sql);
		
		return $tasks;
	}


	/*
	* removes the BEGINTASK1 and ENDTASK1 etc tags from the template text
	*/
	public function removeColorTags($template_text) {
		

		$template_text = str_replace('BEGINTASK0', '', $template_text);
		$template_text = str_replace('ENDTASK0', '', $template_text);
		
		$template_text = str_replace('BEGINTASK1', '', $template_text);
		$template_text = str_replace('ENDTASK1', '', $template_text);
		
		$template_text = str_replace('BEGINTASK2', '', $template_text);
		$template_text = str_replace('ENDTASK2', '', $template_text);
		
		$template_text = str_replace('BEGINTASK3', '', $template_text);
		$template_text = str_replace('ENDTASK3', '', $template_text);
		
		$template_text = str_replace('BEGINTASK4', '', $template_text);
		$template_text = str_replace('ENDTASK4', '', $template_text);
		
		$template_text = str_replace('BEGINTASK5', '', $template_text);
		$template_text = str_replace('ENDTASK5', '', $template_text);
		
		$template_text = str_replace('BEGINTASK6', '', $template_text);
		$template_text = str_replace('ENDTASK6', '', $template_text);
		
		$template_text = str_replace('BEGINTASK7', '', $template_text);
		$template_text = str_replace('ENDTASK7', '', $template_text);

		
		return $template_text;
	}	
	
	
	/*
	* adds <span class="task1"> tags to the the BEGINTASK1 and ENDTASK1 etc tags from the template text
	* Useful to create a colour coded version of the student tasks for readability
	*/
	public function addColorTags($template_text) {
		
		$template_text = str_replace('BEGINTASK0', '<span class="task0">', $template_text);
		$template_text = str_replace('ENDTASK0', '</span>', $template_text);

		$template_text = str_replace('BEGINTASK1', '<span class="task1">', $template_text);
		$template_text = str_replace('ENDTASK1', '</span>', $template_text);
		
		$template_text = str_replace('BEGINTASK2', '<span class="task2">', $template_text);
		$template_text = str_replace('ENDTASK2', '</span>', $template_text);
		
		$template_text = str_replace('BEGINTASK3', '<span class="task3">', $template_text);
		$template_text = str_replace('ENDTASK3', '</span>', $template_text);
		
		$template_text = str_replace('BEGINTASK4', '<span class="task4">', $template_text);
		$template_text = str_replace('ENDTASK4', '</span>', $template_text);
		
		$template_text = str_replace('BEGINTASK5', '<span class="task5">', $template_text);
		$template_text = str_replace('ENDTASK5', '</span>', $template_text);
		
		$template_text = str_replace('BEGINTASK6', '<span class="task6">', $template_text);
		$template_text = str_replace('ENDTASK6', '</span>', $template_text);
		
		$template_text = str_replace('BEGINTASK7', '<span class="task7">', $template_text);
		$template_text = str_replace('ENDTASK7', '</span>', $template_text);
		
		return $template_text;
	}
	
}
?>