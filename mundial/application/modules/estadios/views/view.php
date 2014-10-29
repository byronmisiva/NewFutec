<nav class="navbar navbar-default navbar-bottom">
	<div class="container text-center">
		<?php echo $links;?>
	</div>
</nav>
<?php if( count($estadio->imagenes) > 0 ){?>
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php $i=0?>
			<?php foreach ( $estadio->imagenes as $imagen ){?>	
				<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i?>" class="<?php echo ( $i ==0 ) ? 'active' : '';?>"></li>
			<?php $i++?>
			<?php }?>		
		</ol>
	
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<?php $i=0?>
			<?php foreach ( $estadio->imagenes as $imagen ){?>		
			<div class="item text-center <?php echo ( $i ==0 ) ? 'active' : '';?>" style="width: 100%; height: 400px;">
				<img src="<?php echo base_url($imagen->original)?>" alt="<?php echo $imagen->descripcion;?>" width="100%" height="400px">
				<div class="carousel-caption">
					<?php echo $imagen->descripcion;?>
				</div>
			</div>
			<?php $i++?>
			<?php }?>
		</div>
	
		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic"
			data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span>
		</a> <a class="right carousel-control" href="#carousel-example-generic"
			data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div>
<?php }?>
<h1>
	<?php echo $estadio->nombre;?>
</h1>
<p>
	Ciudad: <?php echo $estadio->ciudad;?>
</p>
<p>
	Capacidad: <?php echo $estadio->capacidad;?>
</p>
<p>
	Club: <?php echo $estadio->club;?>
</p>
<p>
	Programa: <?php echo $estadio->programa;?>
</p>
<nav class="navbar navbar-default navbar-bottom">
	<div class="container text-center">
		<?php echo $links;?>
	</div>
</nav>


