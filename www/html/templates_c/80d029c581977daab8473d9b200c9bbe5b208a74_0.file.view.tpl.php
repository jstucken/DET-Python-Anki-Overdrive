<?php
/* Smarty version 3.1.30-dev/47, created on 2021-02-23 22:07:29
  from "/var/www/html/templates/view.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/47',
  'unifunc' => 'content_6034e1f152f916_78070159',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80d029c581977daab8473d9b200c9bbe5b208a74' => 
    array (
      0 => '/var/www/html/templates/view.tpl',
      1 => 1613903402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6034e1f152f916_78070159 (Smarty_Internal_Template $_smarty_tpl) {
?>



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
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['results']->value, 'row', false, 'i');
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved = $_smarty_tpl->tpl_vars['row'];
?>	
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['date_time_micro'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['mac'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['player_name'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['speed'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['location'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['row']->value['car_type'];?>
</td>
					<?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
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
	
	
	<?php }
}
