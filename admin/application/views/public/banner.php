<div id='banner' align='center' style='background-color: #EDE9E3; padding: 1px;'>
<div style='text-align: center;' > 
	<?php 
	if($banner->code==''){
		if($banner->file!=''){
			echo '<script type="text/javascript">'."\n";
			echo "AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','".$banner->width."','height','".$banner->height."','src','".base_url().substr($banner->file, 0, -4)."','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','".base_url().substr($banner->file, 0, -4)."' );\n";
    		//echo "AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','324','height','132','src','http://localhost/CI_fe2008/imagenes/template/public/swf/bannervallas','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','http://localhost/CI_fe2008/imagenes/template/public/swf/bannervallas' ); //end AC code\n";
			
			echo '</script>'."\n";
		}
		else{
			if($banner->link!="")
				echo anchor('http://'.$banner->link, img(array('src'=>$banner->image,'border'=>'0','width'=>$banner->width)), array('title' => 'Da click aqui !!!','target'=>'_blank'));
			else
				echo img(array('src'=>$banner->image,'border'=>'0','width'=>$banner->width));
			
			
		}
		
			
	}
	else
		echo '<div id="'.$banner->name.'" style="position:relative; width: '.$banner->width.'px; height: '.$banner->height.'px; overflow:hidden;">';
		echo '<script type="text/javascript">'."\n";
		echo htmlspecialchars_decode($banner->code);
		echo '</script>'."\n";
		echo '</div>'
	?>
</div>
</div>
