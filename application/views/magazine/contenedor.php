<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contenedor</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    
    .normal{
	    
	    display: block;
	    }
	    
	    .smart{
	    display: none;
	    }
    
    a {	
		font-family: helvetica;
    	font-size: 20px;
    	}
    
    @media screen and (max-device-width: 750px){
	    .container {
		    margin-left: auto;
		    margin-right: auto;
		    padding-left: 0;
		    padding-right: 0;
		}
	    
	    
	    .panel-body {
		    padding: 0;
		}
	
	a {	
		font-family: helvetica;
    	font-size: 18px;
    	}
    	
    	.normal{
	    display: block;
	    }
	    
	    .smart{
	    display: none;
	    }
	}
	
	  @media screen and (max-device-width: 360px){
	    .normal{
	    display: none !important;
	    }
	    
	    .smart{
	    display: block !important;
	    }
	    
	    a {	
		font-family: helvetica;
    	font-size: 16px;
    	text-align: center;
    	}
	    
	    .nav > li > a {
		    display: block;
		    padding: 5px 5px;
		    position: relative;
		    text-align: center;
		}
    </style>
    
  </head>

  <body>  
    <div class="container">
		<div class="panel-group normal" id="accordion">
		  <div class="panel panel-default">
		    <div class="panel-heading">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
		          Marcador En Vivo
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in">
		      <div class="panel-body">
		        <object data="http://new.futbolecuador.com/scoreboards/matches_today_magazine/ExMpLKey123" width="100%" height="630">
		
				</object>
		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading" data-parent="#accordion" href="#collapseTwo">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
		          Tabla de Posiciones
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse">
		      <div class="panel-body">
		        <object data="http://new.futbolecuador.com/histories/leaderboard_magazine/49" width="100%" height="650">
		
				</object>
		      </div>
		    </div>
		  </div>  
		</div>
	<div class="smart">
      <ul class="nav nav-tabs" role="tablist">
		  <li class="active"><a href="#home" role="tab" data-toggle="tab">Marcador En Vivo</a></li>
		  <li><a href="#profile" role="tab" data-toggle="tab">Tabla de Posiciones</a></li>		  
		</ul>
				
		<div class="tab-content">
		  <div class="tab-pane active" id="home">
		  		<object data="http://new.futbolecuador.com/scoreboards/matches_today_magazine/ExMpLKey123" width="100%" height="630"></object>
		  </div>
		  <div class="tab-pane" id="profile">
		  	<object data="http://new.futbolecuador.com/histories/leaderboard_magazine/49" width="100%" height="650"></object>
		  </div>
		  
		</div>
      </div>

      

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo base_url()?>js/bootstrap.min.js"></script>

  </body>
</html>
