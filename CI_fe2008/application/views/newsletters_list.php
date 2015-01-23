<div id=admin>	
	<h1><?php echo $title.$heading;?></h1>
	<h3><i><?='Bolet&iacute;n -> '.$query2[0]->date?></i></h3>
	<br><br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('newsletters','Bolet&iacute;n')?></li>
    </ul>
    </div>
    <br>
	<div>
		
		<?=form_open('newsletters/preview/'.$this->uri->segment(3))?>
		<center>Noticia:<input type="text" id="autocomplete" name="autocomplete" size=80/>
		<input type="button" value="Reset" onclick="document.forms[0].autocomplete.value='';">
		<?php $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

		echo anchor_popup('newsletters/preview/'.$this->uri->segment(3), 'Vista Previa', $atts);?></center>
		<div id="autocomplete_choices" class="autocomplete"></div>
	</div>
	<br>
	<div id="lista">	
	</div>
	<center>
	<table>
	<tr><td><input type="submit" name="submit" value="Enviar Bolet&iacute;n" /></td>
	<?php echo "</form>"?>
	</table>
	</center>
	<script type="text/javascript">
	new Ajax.Autocompleter("autocomplete", "autocomplete_choices", "<?=base_url()?>newsletters/get_news/",{afterUpdateElement : getSelectionId}); 
	function getSelectionId(text, li) {
	    newsletters_stories_insert("<?=base_url()?>newsletters/newsletters_stories_insert","<?=base_url()?>newsletters/list_view",<?=$this->uri->segment(3)?>,li.id);
	}
	newsletters_stories_view("<?=base_url()?>newsletters/list_view",<?=$this->uri->segment(3)?>);
	</script>
</div>