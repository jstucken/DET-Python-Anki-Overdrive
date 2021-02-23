<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/img/favicon.png?132" type="image/png">
	
	<title>{$smarty.const.SITE_TITLE}</title>
	
	
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
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	

<script type="text/javascript">

// page javascript goes here
{$inline_scripts}
</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
					{if $smarty.session.user}
						<li class="page-scroll">
							<a href="/logout.php">Logout</a>
						</li>
					{else}
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
							<a href="/graphs.php">Graphs and Stats</a>
						</li>
					{/if}
                    
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	
	
	<!-- show error or alert msg's -->
	{if $error_msg}
		<div class="container">
			<div class="row">
				{* NOTE: error_msg contains its own div *}
				
				{$error_msg}
			</div>
		</div>
	{/if}
		
		
	<!-- get page specific smarty template -->
	{include file="$template"}
	
	
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
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/js/freelancer.min.js"></script>
	
	<script src="/js/scripts.js"></script>
	
	<!-- load any page specific JS here -->
	{$external_js}
	

</body>	
	
</html>