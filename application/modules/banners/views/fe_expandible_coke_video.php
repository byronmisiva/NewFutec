<style>
.contenedor-video{
	position:absolute;
	top:0;
	left: 0;
	width: 100%;
	height: 100%;
}

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

</style>

<div class="contenedor-expandible">
	<iframe class="contenedor-video" width="800" height="600" src="http://www.futbolecuador.com/unionlayer/noticia-expandible/coca/expandido/index.html"></iframe>	
	<div class="btn-cerrar-expandible">Cerrar</div>
</div>

<script type="text/javascript">
	

</script>

<script type="text/javascript">
/*evento click*/
$(document).ready(function () {
	$(".btn-cerrar-expandible").click(function () {
		$(".pbl_unionajax").hide();
        $(".pbl_unionajax").html("");
    });

    $(".js--click-lateral").click(function () {
           window.parent.unionlayerSony();
    });
});
</script>
