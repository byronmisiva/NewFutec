<!--<style>
.contenedor-expandibl{
	margin: 25px auto;
	position: relative;
	width: 800px;
	height: 600px;
}

.btn-cerrar-expandible{
	position: absolute;
	right: 45px;
	top: 25px;	
}

</style>-->

<iframe class="contenedor-video" width="800" height="600" src="http://www.futbolecuador.com/unionlayer/noticia-expandible/coca/expandido/index.html"></iframe>	

<!--<div class="contenedor-expandible">
	
	<div class="btn-cerrar-expandible">Cerrar</div>
</div>-->
<script type="text/javascript">
$(document).ready(function () {
	$(".btn-cerrar-expandible").click(function () {
		$(".pbl_unionajax").hide();
        $(".pbl_unionajax").html("");
    });
});
</script>