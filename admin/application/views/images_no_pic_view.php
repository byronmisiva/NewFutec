<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<br><br>
	<?=$table;?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>