<!-- Tabla de Posiciones Acumulada -->
<div id='modulo' style='background-color:white;'>
	<table class='titulo_credife_ct' cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th><div style='width:170px;margin-left:300px;color:#3f473a;text-align:left;'><?=$title?></div></th>
		</tr>
	</table>
	<div id="tabla_acumulada">
		<script type="text/javascript">
			ajax_update('tabla_acumulada','<?=base_url();?>championships/leaderboard_cumulative/<?=$championship?>','<?=base_url();?>');
        </script>
	</div> 
	<br>
</div>