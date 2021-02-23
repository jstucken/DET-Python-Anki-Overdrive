


    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>VIEW DATA</h1>
                    <hr class="star-primary">
					<br />
					<br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
								
					<a href="/add.php" class="button_link"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Manually add test data</a>
					
					<br />
					<br />
					<strong>Showing the most recent 100 rows below, in descending order:</strong>
					<br />
					<br />
					<table width="90%" class="general">
					
						<tr>
							<th>id</th>
							<th>Date Time (inc. milliseconds)</th>
							<th>MAC Address</th>
							<th>player_name</th>
							<th>speed</th>
							<th>location</th>
							<th>car_type</th>
						</tr>
					{foreach from=$results key=i item=row}	
						<tr>
							<td>{$row.id}</td>
							<td>{$row.date_time_micro}</td>
							<td>{$row.mac}</td>
							<td>{$row.player_name}</td>
							<td>{$row.speed}</td>
							<td>{$row.location}</td>
							<td>{$row.car_type}</td>
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
	
	
	