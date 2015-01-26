<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Recortar Imagen</title>

<script type="text/javascript" src="<?=$path ?>js/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="<?=$path ?>js/scriptaculous/src/scriptaculous.js"></script>
<script type="text/javascript" src="<?=$path ?>js/cropper.js"></script>
<script type="text/javascript" charset="utf-8">
		
		// setup the callback function
		function onEndCrop( coords, dimensions ) {
			$( 'x1' ).value = coords.x1;
			$( 'y1' ).value = coords.y1;
			$( 'x2' ).value = coords.x2;
			$( 'y2' ).value = coords.y2;
			$( 'width' ).value = dimensions.width;
			$( 'height' ).value = dimensions.height;
		}
		
		// basic example
		Event.observe( 
			window, 
			'load', 
			function() { 
				new Cropper.Img( 
					'testImage',
					{
						ratioDim: { x: 160, y: 160 },
						displayOnInit: true,
						onEndCrop: onEndCrop 
					}
				) 
			}
		); 		
		
		
		if( typeof(dump) != 'function' ) {
			Debug.init(true, '/');
			
			function dump( msg ) {
				Debug.raise( msg );
			};
		} else dump( '---------------------------------------\n' );
		
</script>
<link rel="stylesheet" type="text/css" href="<?=$path ?>css/debug.css"
	media="all" />
<style type="text/css">
label {
	clear: left;
	margin-left: 50px;
	float: left;
	width: 5em;
}

html,body {
	margin: 0;
}

#testWrap {
	margin: 20px 20px 20px 20px;
	/* Just while testing, to make sure we return the correct positions for the image & not the window */
}
</style>

</head>
<body>

<div id="testWrap"><?=img(array('src'=>$thumb,'border'=>'0','id'=>'testImage','width'=>$tam[0],'height'=>$tam[1],'alt'=>$name))?>
</div>
<div style='text-align: center;'>
<?php
echo form_open('images/crop');
echo form_hidden('id',$id)."\n";
echo form_input(array('type' => 'hidden','value' => 0,'id'=>'x1','name'=>'x1'))."\n";
echo form_input(array('type' => 'hidden','value' => 0,'id'=>'y1','name'=>'y1'))."\n";
echo form_input(array('type' => 'hidden','value' => 0,'id'=>'x2','name'=>'x2'))."\n";
echo form_input(array('type' => 'hidden','value' => 0,'id'=>'y2','name'=>'y2'))."\n";
echo form_input(array('type' => 'hidden','value' => 0,'id'=>'width','name'=>'width'))."\n";
echo form_input(array('type' => 'hidden','value' => 0,'id'=>'height','name'=>'height'))."\n";
echo form_submit('submit', 'Recortar')."\n";
echo form_close();
?>
</div>
</body>
</html>
