<?php
/* Smarty version 3.1.30-dev/47, created on 2021-02-24 06:16:14
  from "/var/www/html/templates/add.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/47',
  'unifunc' => 'content_6035547e15b1b4_59008269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61e1cef5389092b17903d77b7a2f1859af9fea5c' => 
    array (
      0 => '/var/www/html/templates/add.tpl',
      1 => 1613816809,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6035547e15b1b4_59008269 (Smarty_Internal_Template $_smarty_tpl) {
?>


<form method="POST" action="add.php">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>MANUALLY ADD TEST DATA</h1>
                    <hr class="star-primary">
					<br />
					<br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
				
					<br />
					<br />
					<table width="50%" class="general">
						<tr>
							<th>Field</th>
							<th>Value</th>
						</tr>
						<tr>
							<td>School ID</td>
							<td><input type="text" name="school_id" placeholder="eg 8521" maxlength="20" style="width: 150px"></td>
						</tr>
						<tr>
							<td>Car MAC Address</td>
							<td>
								<select name="mac">
									<option value="DE:FD:79:49:7B:8E">DE:FD:79:49:7B:8E</option>
									<option value="CF:F4:51:BD:54:A0">CF:F4:51:BD:54:A0</option>
									<option value="FB:60:5B:2C:9A:A2">FB:60:5B:2C:9A:A2</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Player Name</td>
							<td><input type="text" name="player_name" placeholder="eg Jono" maxlength="20" style="width: 150px"></td>
						</tr>
						<tr>
							<td>Speed</td>
							<td><input type="text" name="speed" placeholder="eg 300" maxlength="20" style="width: 150px"></td>
						</tr>
						<tr>
							<td>Location</td>
							<td><input type="text" name="location" placeholder="eg 1" maxlength="20" style="width: 150px"></td>
						</tr>
						<tr>
							<td>Car Type</td>
							<td>
								<select name="car_type">
									<option value="Ice Charger">Ice Charger</option>
									<option value="Nuke">Nuke</option>
									<option value="MXT">MXT</option>
									<option value="Supertruck">Supertruck</option>
								</select>
							</td>
						</tr>
						
					</table>
					
					<br />
					<br />
					<input type="button" value="Cancel" class="generic_button" title="/">
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
	
	<?php }
}
