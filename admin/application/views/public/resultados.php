<div id='modulo'>
	<table class='titulo_credife_lt' cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<th>Calendario</th>
		</tr>
	</table>
	<div id='ultimos'>
		<script type="text/javascript">
			ajax_update('ultimos','<?=base_url();?>championships/list_played_matches/<?=$champ?>','<?=base_url();?>');
        </script>
    </div>
</div>