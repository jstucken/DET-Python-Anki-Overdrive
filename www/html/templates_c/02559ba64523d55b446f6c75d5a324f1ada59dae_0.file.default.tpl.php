<?php
/* Smarty version 3.1.30-dev/47, created on 2021-02-24 06:56:41
  from "/var/www/html/templates/default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/47',
  'unifunc' => 'content_60355df9c677d8_03112562',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02559ba64523d55b446f6c75d5a324f1ada59dae' => 
    array (
      0 => '/var/www/html/templates/default.tpl',
      1 => 1614108631,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60355df9c677d8_03112562 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/img/favicon.png?132" type="image/png">
	
	<title><?php echo @constant('SITE_TITLE');?>
</title>
	
	
	<!-- Bootstrap Core CSS -->
	<link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	

	<!-- Theme CSS -->
	<link href="/css/freelancer.min.css" rel="stylesheet">
	
	<!-- OUR CSS -->
	<link rel="stylesheet" href="/css/styles.css">

	<!-- Custom Fonts -->
	<link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
	<![endif]-->

	

<?php echo '<script'; ?>
 type="text/javascript">

// page javascript goes here
<?php echo $_smarty_tpl->tpl_vars['inline_scripts']->value;?>

<?php echo '</script'; ?>
>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
<![endif]-->


</head>

<body id="page-top" class="index">
    
	 <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll" style="margin-top: 8px; color: white;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
               <span style="margin: 0; padding: 0"><a href="/index.php"><img src="/img/logo_icon_small.png" style="padding-right: 3px; margin-top: -3px" /></a>&nbsp;&nbsp;DET-Python-Anki-Overdrive</span>
			   
			   
			   <!--<a class="navbar-brand" href="#page-top">Start Bootstrap</a>-->
			   <!--<a class="navbar-brand" href="#page-top">Start Bootstrap</a>-->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					<?php if ($_SESSION['user']) {?>
						<li class="page-scroll">
							<a href="/logout.php">Logout</a>
						</li>
					<?php } else { ?>
						<!--
						<li class="page-scroll">
							<a href="/login.php">Login</a>
						</li>
						-->
						
						<li class="page-scroll">
							<a href="/index.php">Home</a>
						</li>
						
						<li class="page-scroll">
							<a href="/view.php">View Data</a>
						</li>
						
						<li class="page-scroll">
							<a href="/add.php">Add Data</a>
						</li>
						
						<li class="page-scroll">
							<a href="/graphs/graphs.php">Graphs and Stats</a>
						</li>
					<?php }?>
                    
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	
	
	<!-- show error or alert msg's -->
	<?php if ($_smarty_tpl->tpl_vars['error_msg']->value) {?>
		<div class="container">
			<div class="row">
				
				
				<?php echo $_smarty_tpl->tpl_vars['error_msg']->value;?>

			</div>
		</div>
	<?php }?>
		
		
	<!-- get page specific smarty template -->
	<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	
	
	<!-- Footer -->
    <footer class="text-center">
	
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
					<!--
                        <h3>Location</h3>
                        <p>3481 Melrose Place
                            <br>Beverly Hills, CA 90210</p>
					-->
                    </div>
					
					
                    <div class="footer-col col-md-4">
					<!--
                        <h3>About Freelancer</h3>
                        <p>Freelance is a free to use, open source Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                    -->
					</div>
                </div>
            </div>
        </div>
		
		
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        &copy; DET-Python-Anki-Overdrive 2021
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
	
	
	<!-- jQuery -->
    <?php echo '<script'; ?>
 src="/vendor/jquery/jquery.min.js"><?php echo '</script'; ?>
>

    <!-- Bootstrap Core JavaScript -->
    <?php echo '<script'; ?>
 src="/vendor/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>

    <!-- Plugin JavaScript -->
    <?php echo '<script'; ?>
 src="/vendor/jquery-easing/1.3/jquery.easing.min.js"><?php echo '</script'; ?>
>

    <!-- Contact Form JavaScript -->
    <?php echo '<script'; ?>
 src="/js/jqBootstrapValidation.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/contact_me.js"><?php echo '</script'; ?>
>

    <!-- Theme JavaScript -->
    <?php echo '<script'; ?>
 src="/js/freelancer.min.js"><?php echo '</script'; ?>
>
	
	<?php echo '<script'; ?>
 src="/js/scripts.js"><?php echo '</script'; ?>
>
	
	<!-- load any page specific JS here -->
	<?php echo $_smarty_tpl->tpl_vars['external_js']->value;?>

	

</body>	
	
</html><?php }
}
