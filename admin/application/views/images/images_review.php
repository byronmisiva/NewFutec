<div style="position: relative; width: 840px; top: 0px; left: 0px;">
	<div style="position: relative; width: 840px; top: 0px; left: 0px; text-align: center;">
		<?=$this->pagination->create_links();?>
	</div>	
	<div style="position: relative; width: 840px; top: 0px; left: 0px;">
		<?foreach ( $images as $key => $image ){?>
			<div style="float: left; width: 100px; margin-bottom: 10px; min-height: 150px; padding: 20px;">
				<div style="float: left; width: 100px; height: 100px;">
					<img style="width: 100%; height: 100%;" alt="<?=$image->name?>" src="<?=base_url().$image->thumb300?>">
				</div>
				<div style="float: left; width: 100px; text-align: center; font-size: 11px; margin-top: 10px; cursor: pointer;">
					<?=$image->name?>
				</div>
				<div style="float: left; width: 100px; text-align: center; font-size: 16px; margin-top: 5px; cursor: pointer;" onclick="execute_ajax( 'content', '<?=base_url()?>images/delete_images_files/<?=$ini_row?>', '<?=$image->id?>', '<?=base_url()?>' )" >
					BORRAR
				</div>
			</div>
		<?}?>		
	</div>
</div>