
	<?php 
	$aux=true;
	$html="";
	if($banner->code==''){
		if($banner->file!=''){
			$html.='<script type="text/javascript">'."\n";
			$html.="AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','".$banner->width."','height','".$banner->height."','src','".base_url().substr($banner->file, 0, -4)."','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','".base_url().substr($banner->file, 0, -4)."' );\n";
    		//echo "AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','324','height','132','src','http://localhost/CI_fe2008/imagenes/template/public/swf/bannervallas','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','http://localhost/CI_fe2008/imagenes/template/public/swf/bannervallas' ); //end AC code\n";
			
			$html.='</script>'."\n";
		}
		else{
			if($banner->link!="")
				$html.=anchor('http://'.$banner->link, img(array('src'=>$banner->image,'border'=>'0','width'=>$banner->width,'alt'=>'')), array('title' => 'Da click aqui !!!','target'=>'_blank'));
			else
				$html.=img(array('src'=>$banner->image,'border'=>'0','width'=>$banner->width));	
		}
	}
	else{
		if(substr_count($banner->code, '<div')>0){
			$html.=$banner->code;
			$aux=false;
		}
			
		else{
			$html.='<div id="'.$banner->name.'" style="width: '.$banner->width.'px; height: '.$banner->height.'px;">';
			$html.='<script type="text/javascript">'."\n";
			$html.=htmlspecialchars_decode($banner->code);
			$html.='</script>'."\n";
			$html.='</div>';
		}
	}
	if($aux)
		$html="<div id='banner' align='center' style='width: 512px; margin-top: 5px;  margin-bottom: 3px;'>\n<div>\n".$html."</div>\n</div>";
	
	echo $html;
	?>

