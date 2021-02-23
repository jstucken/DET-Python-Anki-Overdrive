<form method="POST" action="/reports/import.php" enctype="multipart/form-data">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
		
		{* if user has uploaded a file, allow them to map fields *}
		{if $file_uploaded}
		
			<div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Map Data Fields</h1>
                    <hr class="star-primary">
					<br />
					<br />
				</div>
            </div>
			
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="text-center">
						<br />
						<br />
						<strong>Map your uploaded columns to their correct corresponding Report Mate equivalent fields.</strong>
						<br />
						<br />
						<ol>
							<li>Ensure you select all the fields you require.</li>
							<li>You can leave tasks blank (don't select anything) so that they do not get imported</li>
						</ol>
						<br />
						<br />
						
						<table width="40%" class="import">
							<tr>
								{foreach from=$smarty.session.import.first_row_headings key=i item=row}	
									<th class="import_field_headings">{$row}</th>
								{/foreach}
							</tr>
							<tr>
								{foreach from=$smarty.session.import.first_row_headings key=a item=row}	
									<th class="import_map_to">
										<div class="import_text">Map to:</div>
										<select name="user_fields[{$a}]" class="import">
											<option value=""></option>
										{foreach from=$select_fields_html key=i item=option}
											<option value="{$option}" class="{$option}">{$select_fields.$i}</option>
										{/foreach}
										</select>
									</th>
								{/foreach}
							</tr>
							{foreach from=$smarty.session.import.example_data key=i item=row}	
								<tr>
								{foreach from=$row key=b item=cell}
									<td class="import_map_to_data">{$cell}</td>
								{/foreach}
								</tr>
							{/foreach}
						</table>
						
					</div>
				</div>
			</div>
			
			<div class="row">
                <div class="col-lg-12 text-center">
					<br />
					<input type="button" value="Cancel" class="generic_button" title="/reports">
					&nbsp;
					&nbsp;
					<input type="submit" value="Import">
					
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
			
		
		{else}
			{* else, this is the first screen they will see allowing them to upload a file *}
			
			<div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Import Data into report</h1>
                    <hr class="star-primary">
					<br />
					<br />
				</div>
            </div>
			
            <div class="row">
				<div class="col-lg-12 text-center">
					<div class="text-center">
						<strong>Instructions:</strong>
						<br />
						<br />
						This page allows you to upload a CSV file (Excel Spreadsheet) containing all students, tasks and masks for this report.
						<br />
						<br />
						<a href="report_import_template.csv">Click here</a> to download a sample CSV import template you can modify and use, to see what data/fields need to go where.
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-lg-12 text-center">
				
					<br />
					<br />
					<table width="90%" class="general">
						<tr>
							<th>Upload CSV File</th>
						</tr>
						<tr>
							<td>
								<input type="file" name="user_file" id="user_file">
							</td>
						</tr>
					</table>
					
					<br />
					<br />
					<input type="button" value="Cancel" class="generic_button" title="/reports">
					&nbsp;
					&nbsp;
					<input type="submit" value="Upload">
					
					
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
			{/if}
        </div>
    </section>

</form>
	
	