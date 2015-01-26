<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images/insert','Agregar Imagenes')?></li>
    </ul>
    <br>
	</div>
	<table class='listing' border=1>
	<tr>
    <?php 
    for($i=65;$i<91;$i++){
    	if($this->uri->segment(3)!=chr($i))
    		echo "<th align='center'>".anchor('images/index/'.chr($i),chr($i))."</th>";
    	else
    		echo "<th style='font-size: 22px;' align='center'><strong>".chr($i)."</strong></th>";
    }
    ?>
    </tr>
    </table>
	<?=$table;?>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>