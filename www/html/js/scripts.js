
//
// begin select all/none checkboxes functionality
//
$("#select_all").change(function(){  //"select all" change
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change
$('.checkbox').change(function(){
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){
        $("#select_all").prop('checked', true);
    }
});
// end select all/none checkboxes functionality




// Save all changes button functionality
$(".save_all_changes").click(function() {
	
	// grab the student_id off the button name field
	student_id = $(this).attr('id');
	
	//alert('student_id: '+student_id);
	
	// update the value of the hidden field with the selected student_id
	$("#current_student_id").val(student_id);
	
	// submit the big form
	$("#edit_form" ).submit();
	
});

// confirm delete button
$("#delete_comments").click(function() {
	
	if (confirm("Are you sure you want to delete all saved comments?")) {
		$("#delete_action" ).val('1');
		
		// submit the big form
		$("#edit_form" ).submit();
	}
	else {
		return false;
	}
});


// confirm delete button
$("#delete_students").click(function() {
	
	if (confirm("Are you sure you want to delete all students/tasks/grades/templates attached to this report?")) {
		
		window.location.href = '/reports/delete_report_data.php';
	}
	else {
		return false;
	}
});


// generic buttons can be used to send the user to a new page
// by passing the new page url within the title attribute
$(".generic_button").click(function() {
	
	var new_url = $(this).prop('title');
	//alert("new_url: "+new_url);
	window.location.href = new_url;
});


// copies and pastes generated template into respective textarea
$(".copy_generated").click(function() {
	
	// grab the student_id off the button name field which was pressed
	student_id = $(this).attr('name');
	//student_id = $(this).attr('id');
	
	// get the text from within the <div>
	generated_content = $("#generated_"+student_id).html();
	
	//alert('student_id: '+student_id+" generated_content: "+generated_content);
	
	// update the value of the textarea with the generated text
	$("#comment_"+student_id).val(generated_content);
	
	return false;
	
});


// allows the user to override a particular task grade for a student
// it changes the value of a hidden field for this students' grade
$(".custom_grade").change(function() {
	
	var hidden_field = $(this).attr('title');
	var select_field_value = $(this).val();
	
	//alert('hidden_field: '+hidden_field);
	
	$("#"+hidden_field).val(select_field_value);
	
	return false;
	
});