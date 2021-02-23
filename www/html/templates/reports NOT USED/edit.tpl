
<form method="POST" action="edit.php" id="edit_form">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                   <h1>{$students.0.report_name}</h1>
                    <hr class="star-primary">
					<br />
					<br />
					<h3>{$students|count} students</h3>
					<br>
					<br>
					
					<a href="#" class="button_link" id="delete_students"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete all students/tasks/grades/templates</a>
					
					<a href="#" class="button_link" id="delete_comments"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete all saved comments</a>
					
					<a href="/reports/templates.php" class="button_link"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Edit Report Templates</a>
					<br>
					<br>
					<br>
					<br>

                </div>
            </div>

            <div class="row">
				
                <div class="col-lg-12 text-center">
				
					<!-- hidden field which handles saving of individual students' details -->
					<input type="hidden" name="current_student_id" id="current_student_id" value="">
					<input type="hidden" name="delete_action" id="delete_action" value="">
					
					{foreach from=$students key=i item=student}	
						
						<a name="student_{$student.student_id}"></a> 
						<table width="90%" class="general" style="border: 1px solid red">
							<tr>
								<th colspan="12" style="font-weight: bold; font-size: 18px">{$i+1} - {$student.student_lastname}, {$student.student_firstname}</h2></span>
							</tr>
							<tr>
								<th>student_id</th>
								<th>Gender</th>
								<th class="task0">Task 0 - </th>
								<th class="task1">Task 1 - </th>
								<th class="task2">Task 2 -</th>
								<th class="task3">Task 3 - </th>
							{* only display tasks 4-7 if data is present for them *}
							{if $student.grades.4.task_name}
								<th class="task4">Task 4 - </th>
							{/if}
							{if $student.grades.5.task_name}
								<th class="task5">Task 5 - </th>
							{/if}
							{if $student.grades.6.task_name}
								<th class="task6">Task 6 - </th>
							{/if}
							{if $student.grades.7.task_name}
								<th class="task7">Task 7 - </th>
							{/if}
								<th>OVERALL POINTS AVG</th>
								<th class="blue">OVERALL GRADE</th>
							</tr>
							<tr>
								<td>{$student.student_id}</td>
								<td>{$student.student_gender}</td>
								<td class="task0">
									{$student.grades.0.task_name}
									<br />
									<br />
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.0.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.0.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.0.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.0.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.0.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.0.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.0.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.0.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
								<td class="task1">
									{$student.grades.1.task_name}
									<br />
									<br />
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.1.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.1.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.1.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.1.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.1.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.1.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.1.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.1.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
								<td class="task2">
									{$student.grades.2.task_name}
									<br />
									<br />
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.2.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.2.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.2.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.2.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.2.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.2.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.2.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.2.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
								<td class="task3">
									{$student.grades.3.task_name}
									<br />
									<br />
									
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.3.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.3.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.3.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.3.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.3.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.3.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.3.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.3.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
							{* only display tasks 4-7 if data is present for them *}
							{if $student.grades.4.task_name}
								<td class="task4">
									{$student.grades.4.task_name}
									<br />
									<br />
									
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.4.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.4.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.4.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.4.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.4.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.4.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.4.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.4.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
							{/if}
							{if $student.grades.5.task_name}
								<td class="task5">
									{$student.grades.5.task_name}
									<br />
									<br />
									
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.5.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.5.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.5.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.5.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.5.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.5.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.5.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.5.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
							{/if}
							{if $student.grades.6.task_name}
								<td class="task6">
									{$student.grades.6.task_name}
									<br />
									<br />
									
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.6.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.6.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.6.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.6.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.6.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.6.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.6.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.6.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
							{/if}
							{if $student.grades.7.task_name}
								<td class="task7">
									{$student.grades.7.task_name}
									<br />
									<br />
									
									<input type="hidden" name="custom_grades[{$student.student_id}][{$student.grades.7.task_id}]" id="custom_grades_{$student.student_id}_{$student.grades.7.task_id}">
									
									<select title="custom_grades_{$student.student_id}_{$student.grades.7.task_id}" class="custom_grade">
										<option value="A"{if $student.grades.7.grade == 'A'} selected{/if}>A</option>
										<option value="B"{if $student.grades.7.grade == 'B'} selected{/if}>B</option>
										<option value="C"{if $student.grades.7.grade == 'C'} selected{/if}>C</option>
										<option value="D"{if $student.grades.7.grade == 'D'} selected{/if}>D</option>
										<option value="E"{if $student.grades.7.grade == 'E'} selected{/if}>E</option>
									</select>
								</td>
							{/if}
							
								<td>
									<strong>{$student.overall_points_avg|number_format:2}</strong>
								</td>
								<td class="blue" style="font-size: 14px;">
									<span >OVERALL GRADE</span>
									<br />
									<br />
									<strong>{$student.overall_grade}</strong>
								</td>
							</tr>
							
							<tr>
								<td colspan="12">
									<table class="traits">
										<tr>
											<td>
												<strong>Characteristic 1:</strong>
												<!-- db value: {$student.traits.characteristic1} -->
												<select name="students_traits[{$student.student_id}][characteristic1]" id="students_traits[{$student.student_id}][characteristic1]" class="traits{if !$student.traits.characteristic1} denied{else} accepted{/if}">
													<option value=""></option>
													{foreach from=$default_characteristics key=t item=characteristic}	
														<option value="{$characteristic.id}"{if $student.traits.characteristic1 == $characteristic.id} selected{/if}>{$characteristic.name}</option>
													{/foreach}
												</select>
											</td>
											<td>
												<strong>Characteristic 2:</strong>
												<!-- db value: {$student.traits.characteristic2} -->
												<select name="students_traits[{$student.student_id}][characteristic2]" id="students_traits[{$student.student_id}][characteristic2]" class="traits{if $student.traits.characteristic2} accepted{/if}">
													<option value=""></option>
													{foreach from=$default_characteristics key=t item=characteristic}	
														<option value="{$characteristic.id}"{if $student.traits.characteristic2 == $characteristic.id} selected{/if}>{$characteristic.name}</option>
													{/foreach}
												</select>
											</td>
											<td>
												<strong>Improvement1:</strong>
												<!-- db value: {$student.traits.improvement1} -->
												<select name="students_traits[{$student.student_id}][improvement1]" id="students_traits[{$student.student_id}][improvement1]" class="traits{if !$student.traits.improvement1} denied{else} accepted{/if}" style="width: 450px">
													<option value=""></option>
													{foreach from=$default_improvements key=t item=improvement}	
														<option value="{$improvement.id}"{if $student.traits.improvement1 == $improvement.id} selected{/if}>{$improvement.name}</option>
													{/foreach}
												</select>
											</td>
											
											<td>
												<strong>Improvement2:</strong>
												<!-- db value: {$student.traits.improvement2}-->
												<select name="students_traits[{$student.student_id}][improvement2]" id="students_traits[{$student.student_id}][improvement2]" class="traits{if $student.traits.improvement2} accepted{/if}" style="width: 450px; overflow: scroll">
													<option value=""></option>
													{foreach from=$default_improvements key=t item=improvement}	
														<option value="{$improvement.id}"{if $student.traits.improvement2 == $improvement.id} selected{/if}>{$improvement.name}</option>
													{/foreach}
												</select>
											</td>
										</tr>
										<tr style="display: none;">
											<td colspan="4">
												<strong>Generated Template Comment:</strong>
												<br>
												<div id="generated_{$student.student_id}" class="template_box">{$student.student_template}</div>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<strong>Generated Template Comment:</strong>
												<br>
												<div id="coloured_generated_{$student.student_id}" class="template_box">{$student.student_template_coloured}</div>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<strong>Saved Comment:</strong>
												<br>
												<textarea name="comment[{$student.student_id}]" id="comment_{$student.student_id}" class="comments_box{if $student.traits.characteristic1 and $student.traits.improvement1} accepted{else} denied{/if}">{if $student.student_comment}{$student.student_comment}{/if}</textarea>
											</td>
										</td>
									</table>
									
									
									
								</td>
							</tr>
							<tr>
								<td colspan="12" style="height: 5px; background-color: #DDD;">&nbsp;</td>
							</tr>
						</table>
						<br />
						
						<!--<input type="button" value="Copy generated comment" style="margin-right: 20px" name="{$student.student_id}" id="generated_{$student.student_id}" class="copy_generated">-->
						
						<a href="#" class="button_link copy_generated" name="{$student.student_id}" id="generated_{$student.student_id}"><span class="glyphicon glyphicon-paste"></span>&nbsp;&nbsp;Copy generated comment</a>
						
						<!--<input type="button" value="Save all changes" name="Save all changes" id="{$student.student_id}" class="save_all_changes">-->
						
						<a href="#student_{$student.student_id}" class="button_link save_all_changes" id="{$student.student_id}"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Save all changes</a>
						<br />
						<br />
					{/foreach}
					
						<br />
						<br />
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
        </div>
    </section>
	
	
</form>
	