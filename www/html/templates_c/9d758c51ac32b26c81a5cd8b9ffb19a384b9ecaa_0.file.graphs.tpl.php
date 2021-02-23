<?php
/* Smarty version 3.1.30-dev/47, created on 2021-02-24 06:56:41
  from "/var/www/html/templates/graphs/graphs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/47',
  'unifunc' => 'content_60355df9ce4202_80029429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d758c51ac32b26c81a5cd8b9ffb19a384b9ecaa' => 
    array (
      0 => '/var/www/html/templates/graphs/graphs.tpl',
      1 => 1614110203,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60355df9ce4202_80029429 (Smarty_Internal_Template $_smarty_tpl) {
?>


    <!--Load the AJAX API-->
    <?php echo '<script'; ?>
 type="text/javascript" src="https://www.gstatic.com/charts/loader.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
	google.charts.load('current', {'packages':['gauge']});

      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChart2);
     
    function drawChart() {
      var jsonData = $.ajax({
          url: "get_data.php",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {title: 'DB records based on Player Names', width: 400, height: 240});
	  
	  
	  
    }

	function drawChart2() {

        var data2 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80],
          ['CPU', 55],
          ['Network', 68]
        ]);

        var options2 = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart2 = new google.visualization.Gauge(document.getElementById('chart_div2'));

        chart2.draw(data2, options2);

        setInterval(function() {
          data2.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart2.draw(data2, options2);
        }, 13000);
        setInterval(function() {
          data2.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart2.draw(data2, options2);
        }, 5000);
        setInterval(function() {
          data2.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart2.draw(data2, options2);
        }, 26000);
      }


    <?php echo '</script'; ?>
>




    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>GRAPHS AND STATISTICS</h1>
                    <hr class="star-primary">
					<br />
					<br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
								
					Work in progress -coming soon!
					
					
					<br />
					<br />
					<!--Div that will hold the pie chart-->
					<div id="chart_div"></div>
					<br />
					<br />
					<br />
					<div id="chart_div2"></div>
					
					<!--
					<table width="90%" class="general">
					
						<tr>
							<th>id</th>
							<th>date_time</th>
							<th>MAC Address</th>
							<th>player_name</th>
							<th>speed</th>
							<th>location</th>
							<th>car_type</th>
						</tr>
						</tr>
					</table>
					-->
					
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
        </div>
    </section>
	
	
	<?php }
}
