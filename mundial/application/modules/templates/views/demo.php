<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

<title><?php echo $pageTitle?></title>

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url('assets/css/bootstrap.min.css')?>"
	rel="stylesheet">


<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->


</head>

<body>

	<div id="navigation-nav" class="hidden-xs">
		<div id="navbar-menu" class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">					
					<a class="navbar-brand" href="<?php echo base_url()?>">
						DEMO
					</a>
				</div>				
				<ul id="navbar" class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url('site/equipos')?>">EQUIPOS</a></li>
					<li><a href="<?php echo base_url('site/estadios')?>">ESTADIOS</a></li>
					<li><a href="<?php echo base_url('site/historias')?>">HISTORIAS</a></li>
				</ul>
				
			</div>
		</div>
	</div>

	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<?php echo $body?>			
		</div>	
	</div>
	<!-- /container -->


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
</body>
</html>
