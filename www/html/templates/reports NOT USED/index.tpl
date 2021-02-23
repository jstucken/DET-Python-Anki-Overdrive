


    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>VIEW REPORTS</h1>
                    <hr class="star-primary">
					<br />
					<br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
								
					<a href="/reports/create.php" class="button_link"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Create new report</a>
					
					<br />
					<br />
					
					<table width="90%" class="general">
						<tr>
							<th>id</th>
							<th>Year</th>
							<th>Year Group</th>
							<th>Class</th>
							<th>Report name</th>
							<th>Students</th>
							<th>Tasks</th>
							<th>Templates</th>
							<th>Created</th>
							<th>&nbsp;</th>
						</tr>
					{foreach from=$results key=i item=row}	
						<tr>
							<td>{$row.id}</td>
							<td>{$row.year}</td>
							<td>{$row.year_group}</td>
							<td>{$row.class}</td>
							<td>{$row.name}</td>
							<td>{$row.num_students}</td>
							<td>{$row.num_tasks}</td>
							<td>{$row.num_templates}</td>
							<td>{$row.created}</td>
							<td>
							{* Only allow user to edit if report contains students and tasks *}
								{if $row.num_students == 0 OR $row.num_tasks == 0}
									<a href="/reports/import.php?report_id={$row.id}">Import students and grades</a>
								{else}
									<a href="/reports/edit.php?report_id={$row.id}">View/Edit Report</a>
								{/if}
							</td>
					{/foreach}
						</tr>
					</table>
					
					
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
        </div>
    </section>
	
	
	