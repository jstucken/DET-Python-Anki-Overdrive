

<form method="POST" action="create.php">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>ADD NEW REPORT</h1>
                    <hr class="star-primary">
					<br />
					<br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
				
					<br />
					<br />
					<table width="90%" class="general">
						<tr>
							<th>Year Group</th>
							<th>Semester</th>
							<th>Class</th>
						</tr>
						<tr>
							<td>
								<select name="year_group">
									<option value="7">Year 7</option>
									<option value="8">Year 8</option>
									<option value="9">Year 9</option>
									<option value="10">Year 10</option>
									<option value="11">Year 11</option>
									<option value="12">Year 12</option>
								</select>
							<td>
								<select name="semester">
									<option value="1">Semester 1</option>
									<option value="2">Semester 2</option>
								</select>
							</td>
							<td><input type="text" name="class" placeholder="eg 10ITT" maxlength="20" style="width: 150px"></td>
							
						</tr>
					</table>
					
					<br />
					<br />
					<input type="button" value="Cancel" class="generic_button" title="/reports">
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
	
	