<?php
/* Smarty version 3.1.30-dev/47, created on 2021-02-20 14:49:33
  from "/var/www/html/templates/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/47',
  'unifunc' => 'content_603086cd2a4b96_31502046',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f5e8735dc257dd026d547179a71cc30a02d75e7' => 
    array (
      0 => '/var/www/html/templates/login.tpl',
      1 => 1572861032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603086cd2a4b96_31502046 (Smarty_Internal_Template $_smarty_tpl) {
?>

<header>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			
				<form action="login.php" method="POST" class="form-signin">
					<h2 class="form-signin-heading">Please sign in</h2>
					<br>
					
					<label for="email" class="sr-only">Email address</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus maxlength="100">
					
					
					<label for="password" class="sr-only">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required maxlength="20">
					
					
					<div class="checkbox">
					  <label>
						<input type="checkbox" value="remember-me"> Remember me
					  </label>
					</div>
					
					<button class="btn btn-lg btn-primary btn-block text-center" type="submit">Sign in</button>
				  </form>
			</div>
		</div>
	</div>
</header>
<?php }
}
