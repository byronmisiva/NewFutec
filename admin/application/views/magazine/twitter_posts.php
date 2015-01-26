<!-- <?=date('l jS \of F Y h:i:s A');?> -->
<?php 
foreach($twitts as $tweet){
?>	
<div id='tweet'>
	<div id='thumb' style='display:inline-block; margin:5px; vertical-align:top;'><img src='<?=$tweet['thumb']?>' /></div>
	<div style="width: 200px; display:inline-block; margin-top:5px; vertical-align:top;">
		<div id='username' style='color:#002d47;font-size:12px;font-family:Helvetica;font-weight:bold;'><?=$tweet['username']?></div>
		<div id='text' style='color:#002d47;font-size:10px;font-family:Helvetica;'><?=$tweet['text']?></div>
	</div>
	<div id='created' style='position:absolute; top:5px; right:5px;font-family:Helvetica;color:#002d47;font-size:10px;font-weight:bold;'><?=$tweet['minutes']?></div>
</div>

<?php 
}
?>