<?php
/* Smarty version 3.1.30-dev/47, created on 2021-02-24 06:17:00
  from "/var/www/html/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/47',
  'unifunc' => 'content_603554ac169db2_93874605',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8339e4591a4132edf23ef9a583dda3d69912170' => 
    array (
      0 => '/var/www/html/templates/index.tpl',
      1 => 1614076710,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603554ac169db2_93874605 (Smarty_Internal_Template $_smarty_tpl) {
?>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-primary">
					<img src="/img/anki_photo.png" width="20%" title="Anki Cars Photo" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>This web application was created to help fellow teachers code Anki Overdrive cars using Python.
					<br />
					<br />
					<strong>Author:</strong> jonathan.stucken2@det.nsw.edu.au
					<br />
					<strong>Last Modified:</strong> 20/02/2021
					<br />
					<strong>Github link:</strong> <a href="https://github.com/jstucken/DET-Python-Anki-Overdrive">https://github.com/jstucken/DET-Python-Anki-Overdrive</a>
					<br />
					<br />
					<span style="font-size: 18px">This page is being served by apache2 running on Raspberian Pi OS</span>
					<br />
					</p>
					<br />
					<p>
					<h4>Some links which may interest you:</h4>

					<ul>
						<li><a href="view.php">view.php</a> - shows all local database entries</li>
						<li><a href="add.php">add.php</a> - allows you to manually add a test entry to DB</li>
						<li><a href="/phpmyadmin">PhpMyAdmin</a> - to administer the local database</li>
						<li><a href="phpinfo.php">phpinfo.php</a> - PHP info page for debugging PHP installation </li>
					</ul>
					</p>
				
					
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
