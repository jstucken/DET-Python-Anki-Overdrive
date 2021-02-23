

<form method="POST" action="templates.php">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>EDIT TEMPLATES</h1>
                    <h1>FOR REPORT ID {$report_id}</h1>
                    <hr class="star-primary">
					<br />
					<br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
				
					<br />
					<br />
					<a href="/reports/templates.php" class="button_link"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Import Templates from existing report(TODO)</a>
					<br />
					<br />
					
					<textarea style="width: 800px; height: 400px; border: 1px dashed red">
					TODO:
					When the above button is clicked, create a temp table and copy template data into it eg:
					
					CREATE table temporary_table AS SELECT * FROM original_table WHERE Event_ID="155";

					UPDATE temporary_table SET Event_ID="120";

					UPDATE temporary_table SET ID=NULL

					INSERT INTO original_table SELECT * FROM temporary_table;

					DROP TABLE temporary_table
					
					
					
					FROM:
					https://stackoverflow.com/questions/2783150/mysql-how-to-copy-rows-but-change-a-few-fields
					
					</textarea>
						
						
						
					
					<br />
					<br />
					
					<strong>An example compiled template, combining the fields below:</strong>
					<br>
					<br>
					<textarea class="template_textarea" style="width: 1000px;">[Name] is a [characteristic1][characteristic2] student who has achieved outstanding results in Industrial Technology Timber this semester. In class, [Name] <willingly> works to the best of [his] ability to <complete> set tasks and [he] <participates> <thoughtfully> in classroom <conversations> when <prompted>. [He] has achieved [task1_grade_alternative] results in [his] classwork tasks, <demonstrating> a <deep> <understanding> of the course content. [He] completed the majority of the assigned online learning activities. [Name] has demonstrated safe and effective use of hand tools and woodworking machinery to <successfully> <construct> [his] Minor Timber Project <project> to an [task2_grade_alternative] standard. To improve, [Name] is <encouraged> to [improvement1][improvement2]. [He] is to be commended for <achieving> these <outstanding> results.</textarea>
					
					<br />
					<h3 class="intro">Intro Template</h3>
					
					<table width="90%" class="general">
						<tr>
							<th>A</th>
							<th>B</th>
							<th>C</th>
							<th>D</th>
							<th>E</th>
						</tr>
						<tr>
							<td><textarea name="intro[A]" id="intro[A]" class="template_textarea" placeholder="eg [Name] is a [characteristic1][characteristic2] student who has achieved outstanding results in Industrial Technology Timber this semester.">{$intro.A}</textarea></td>
							
							<td><textarea name="intro[B]" id="intro[B]" class="template_textarea" placeholder="eg [Name] is a [characteristic1][characteristic2] student who is commended for making pleasing progress in Industrial Technology Timber this semester.">{$intro.B}</textarea></td>
							
							<td><textarea name="intro[C]" id="intro[C]" class="template_textarea" placeholder="eg [Name] is a [characteristic1][characteristic2] student who has achieved sound results in Industrial Technology Timber this semester.">{$intro.C}</textarea></td>
							
							<td><textarea name="intro[D]" id="intro[D]" class="template_textarea" placeholder="eg [Name] is a [characteristic1][characteristic2] student who has achieved basic results in Industrial Technology Timber this semester.">{$intro.D}</textarea></td>
							
							<td><textarea name="intro[E]" id="intro[E]" class="template_textarea" placeholder="[Name] is a [characteristic1][characteristic2] student who has achieved limited results in Industrial Technology Timber this semester.">{$intro.E}</textarea></td>
						</tr>
					</table>
					
					{foreach from=$tasks key=i item=task}	
						<br />
						<br />
						<h3 class="task{$task.task_number}">{$task.name} (Task {$task.task_number})</h3>
						
						{assign var='task_id' value=$task.id}
						
						task_id: {$task_id}
						
						<table width="90%" class="general">
							<tr>
								<th width="20%">A</th>
								<th width="20%">B</th>
								<th width="20%">C</th>
								<th width="20%">D</th>
								<th width="20%">E</th>
							</tr>
							<tr>
								<td><textarea name="task_templates[{$task.id}][A]" class="template_textarea" placeholder="eg In class, [Name] <willingly> works to the best of [his] ability to <complete> set tasks and [he] <participates> <thoughtfully> in classroom <conversations> when <prompted>.">{$task_templates.$task_id.A}</textarea></td>
								
								<td><textarea name="task_templates[{$task.id}][B]" class="template_textarea" placeholder="eg In class, [Name] works <independently> to <complete> set tasks and [he] <participates> <thoughtfully> in classroom <conversations> when <prompted>.">{$task_templates.$task_id.B}</textarea></td>
								
								<td><textarea name="task_templates[{$task.id}][C]" class="template_textarea" placeholder="eg In class, [Name] can work satisfactorily when [he] puts [his] mind to it, however, [he] allows [himself] to become distracted <occasionally>.">{$task_templates.$task_id.C}</textarea></td>
								
								<td><textarea name="task_templates[{$task.id}][D]" class="template_textarea" placeholder="eg In class, [Name] <often> allows [himself] to become distracted which has negatively impacted on his <results>.">{$task_templates.$task_id.D}</textarea></td>
								
								<td><textarea name="task_templates[{$task.id}][E]" class="template_textarea" placeholder="eg In class, [Name] regularly allows [himself] to become distracted and unfortunately [he] has not achieved the course outcomes.">{$task_templates.$task_id.E}</textarea></td>
							</tr>
						</table>
					{/foreach}
					<br />
					<br />
					<h3 class="outro">Outro Template</h3>
					
					<table width="90%" class="general">
						<tr>
							<th>A</th>
							<th>B</th>
							<th>C</th>
							<th>D</th>
							<th>E</th>
						</tr>
						<tr>
							<td><textarea name="outro[A]" id="outro[A]" class="template_textarea" placeholder="eg To improve, [Name] is <encouraged> to [improvement1][improvement2]. [He] is to be commended for <achieving> these <outstanding> results.">{$outro.A}</textarea></td>
							
							<td><textarea name="outro[B]" id="outro[B]" class="template_textarea" placeholder="eg To <improve> [his] results, [Name] is <encouraged> to [improvement1][improvement2].">{$outro.B}</textarea></td>
							
							<td><textarea name="outro[C]" id="outro[C]" class="template_textarea" placeholder="eg To <improve> [his] results, [Name] is <encouraged> to [improvement1][improvement2].">{$outro.C}</textarea></td>
							
							<td><textarea name="outro[D]" id="outro[D]" class="template_textarea" placeholder="eg To <improve> [his] results, [Name] is <encouraged> to [improvement1][improvement2].">{$outro.D}</textarea></td>
							
							<td><textarea name="outro[E]" id="outro[E]" class="template_textarea" placeholder="eg To <improve> [his] results, [Name] is <encouraged> to [improvement1][improvement2].">{$outro.E}</textarea></td>
						</tr>
					</table>
					<br>
					<br>
					<input type="button" value="Cancel" class="generic_button" title="/reports/edit.php?report_id={$report_id}">
					&nbsp;
					&nbsp;
					<input type="submit" value="Save">
					
					
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
	
	