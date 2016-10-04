<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://appss.misiva.com.ec/noticia/css/coke/css/bootstrap.css">
  <script src="https://appss.misiva.com.ec/noticia/css/coke/js/jquery.min.js"></script>
  <style>
  .separador{
  height: 35px;
  border-bottom:1px solid #666;
  }
  </style>	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1> Lista de noticias</h1>
			</div>
		</div>
		<?php
		$con=1;
		foreach ($lista as $row){?>
		<div class="row">
		
			<div class="col-lg-12 separador">
				<div class="col-lg-1">
					<?php echo $con?>
				</div>
				<div class="col-lg-5"> <?php echo $row->title?></div>
				<div class="col-lg-6">
				  <?php $link = base_url() . 'site/noticia/'.$this->contenido->_urlFriendly($row->subtitle).'/'.$row->id ?>
				  <a href="<?php echo $link?>" target="_blank" ><?php echo $link?></a>
				</div>				
			</div>
		
		</div>
		<?php 
			$con = $con+1;
			}?>	  
			</div>  
  <script src="https://appss.misiva.com.ec/noticia/css/coke/js/bootstrap.min.js"></script>
</body></html>