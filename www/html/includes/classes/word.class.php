<?php


/**
* Handles fetching alternate words etc to make the reports a bit more realistic and random
* eg converting a 'outstanding' to 'excellent'
*/
class word
{
	
	/*
	* replaces any words marked with pointy arrows eg <word>
	* with alternative words/phrases from words table
	*@param string $haystack template string
	*@return string New string with alternative words added
	*/
	public function replace_alternative_words($haystack) {
		
		// extract the words from between the pointy arrows
		$words_array = array();		// good matches will be saved into here
		//dbug($haystack,'$haystack');
		
		// explode string into parts based on the left pointy bracket first
		$matches_left = explode('<', $haystack);
		
		//dbug($matches_left,'$matches_left');
		
		// throw away the first row in the result which is typically trash
		unset($matches_left[0]);

		// loop thru the results
		// now strip out crap using the right closing bracket >
		foreach ($matches_left as $item) {
			
			$match_right = explode('>',$item);
			
			// ignore blank results, though there really shouldnt be any, but just in case
			if (!empty($match_right[0])) {
				$words_array[] = $match_right[0];
			}
		}
		
		//dbug($words_array,'$words_array');
		// replace the applicable words/phrases
		$num_replacements = 0;
		foreach ($words_array as $word) {
			
			$needle = "<$word>";
			$replacement = word::get_alternative($word);
			
			//dbug($needle,'$needle');
			
			// get location of first instance of <needle>, so we don't replace all the needles at once
			// eg replace first instance of <results> with grades, rather than setting ALL instances
			// of <results> in the string to grades, which is super repetitive and defeats the purpose of this functionality
			//debug($haystack,'haystack','purple');
			
			$needle_pos = strpos($haystack, $needle);
			//dbug($needle_pos,'$needle_pos');
			
			// count how many characters in the needle we will need to replace
			$needle_length = strlen($needle);
			//dbug($needle_length,'$needle_length');
			
			//$haystack = str_replace($needle, $replacement, $haystack);
			$haystack = substr_replace($haystack, $replacement, $needle_pos, $needle_length);
			
			// dbug($needle,'$needle');
			// dbug($replacement,'$replacement');
			// debug($haystack,'haystack','black');
			
			$num_replacements++;
			
			/*
			if ($num_replacements >=2 ) {
				exit;
			}
			*/
		}
		
		
		return $haystack;
	}
	
	
	
	/*
	* Saves the current students' student_id into the session for use with word class
	*/
	public function set_student_id($student_id) {
		
		if (empty($student_id)) {
			trigger_error('ERROR - $student_id must be set', E_USER_ERROR);
		}
		$_SESSION['student']['student_id'] = $student_id;
	}
	
	
	/*
	* Retrieves the current students' student_id from the session for use with word class
	*/
	public function get_student_id() {
		
		return $_SESSION['student']['student_id'];
	}	
	
	/*
	* set the last used replacement value for this word, from session
	* so we make sure not to use this twice in a row
	*/
	public function set_previous_word($original_word, $new_word) {
		
		$student_id = self::get_student_id();
		$_SESSION['word'][$student_id]['prev_words'][$original_word] = $new_word;
		
	}
	
	
	/*
	* get the last used replacement value for this word, from session
	* so we make sure not to use this twice in a row
	*/
	public function get_previous_word($word) {
		
		$student_id = self::get_student_id();
		$prev_word = $_SESSION['word'][$student_id]['prev_words'][$word];
		$prev_word = db::makeDBSafe($prev_word);
		
		return $prev_word;
	}
	
	
	
	/*
	* gets an alternative word
	* eg converts 'outstanding' to 'excellent'
	*
	* NOTE: this method KEEPS the original word as part of the random selection pool
	* returns a string with alternative word
	*/
	public function get_alternative($original_word) {
		
		if (empty($original_word)) {
			trigger_error('ERROR - $original_word must be set', E_USER_ERROR);
			exit;
		}
		
		$student_id = self::get_student_id();
		$original_word = db::makeDBSafe($original_word);
		$prev_word = self::get_previous_word($original_word);
		
		// dbug($original_word,'$original_word');
		// dbug($prev_word,'$prev_word');
		
		
		if (empty($prev_word)) {
			$sql = "SELECT alternative FROM words WHERE original = '$original_word'";
		}
		else {
			$sql = "SELECT alternative FROM words WHERE original = '$original_word' AND alternative != '$prev_word'";
		}
		$result = db::getRows($sql);
		//dbug($result,'$result');
		
		
		// add original word eg sound into the random choice array
		// but only if it wasn't used on the last iteration
		// if we can't find any alternative words in db, we'll do this step too
		// as otherwise we wont have any word to use
		if (($prev_word != $original_word) OR empty($result)) {
			
			$result[]['alternative'] = $original_word;		// add original word in
			//echo "Added original word ($original_word) into the alternative words array";
		}
				
				
		// get a random word from the results
		$rand = rand(0, (count($result) -1));
		
		// pull a word out of our randomised array of words, and use it
		$new_word = $result[$rand]['alternative'];
		//dbug($new_word,'$new_word');
		
		// update session to prevent future repetition of this word
		self::set_previous_word($original_word, $new_word);
		//echo 'check session updated';
		
		
		//dbug($_SESSION['word'][$student_id]['prev_words'], "SESSION");
		
		return $new_word;
	}


	/*
	* Method to fix the prefixed vowels in sentences, and inserts a new word directly after
	* eg a attentive student...
	* becomes:
	* an attentive student...
	*
	* Accepts a string as input ($haystack)
	* and returns the fixed string ($haystack)
	*/
	public function fix_vowels($needle, $replacement, $haystack) {
		
		 // dbug($needle,'needle');
		 // dbug($replacement,'replacement');
		 // dbug($haystack,'haystack');
		
		$pos = strpos($haystack, $needle);
		
		//dbug($new_content,'$new_content');
		//dbug($pos,'$pos');
		// letters which nominate for this process will be vowels
		$vowels = array('a','e','i','o','u');
		
		// get first character of the characteristic to see if it applies
		$first_char = $replacement[0];
		
		//dbug($first_char,'first_char');
		
		if (in_array($first_char, $vowels)) {
			
			// preceding word should be back two spaces
			$prefix_pos = $pos-2;
			//dbug($prefix_pos,'$prefix_pos');
			
			//dbug($needle,'$needle','green');
			
			$prefix = $haystack[$prefix_pos];
			
			// mark the position with a temp placeholder symbol, so we can swap it out
			// ie: _
			
			// hack fix
			if ($replacement == 'outstanding') {
				$haystack[$prefix_pos+1] = '^';
				$haystack = str_replace('^', ' ', $haystack);		// replace the vowel
			}
			else {
				$haystack[$prefix_pos] = '^';
				$haystack = str_replace('^', 'an', $haystack);		// replace the vowel
			}
			
		}
		
		//dbug($haystack,'$haystack','black');
		
		if ($replacement == 'elementary') {
			//echo "got one";
			//exit;
		}
		if ($needle == '[task1_grade_alternative]') {
			// echo "got one2";
			// debug($needle,'$needle', 'black');
			// debug($replacement,'$replacement', 'black');
			// debug($haystack,'$haystack', 'black');
		}	
		
			
		return $haystack;
		
	}
	
}