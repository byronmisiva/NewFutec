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
<style>
@font-face {
    font-family: 'HelveticaNeue';
    src: url('http://www.futbolecuador.com/assets/fonts/HelveticaNeue.eot');
    src: url('http://www.futbolecuador.com/assets/fonts/HelveticaNeue.eot?#iefix') format('embedded-opentype'),
    url('http://www.futbolecuador.com/assets/fonts/HelveticaNeue.woff') format('woff'),
    url('http://www.futbolecuador.com/assets/fonts/HelveticaNeue.ttf') format('truetype'),
    url('http://www.futbolecuador.com/assets/fonts/HelveticaNeue.svg#HelveticaNeue') format('svg');
    font-weight: normal;
    font-style: normal;
}
</style>
 <div id="pbl-coke'"'>
	<div id="Stage" class="EDGE-492515342"></div>
</div>


<div class='contenedor-expandible'>
	<iframe class='contenedor-video' width='800' height='600' src='http://www.futbolecuador.com/unionlayer/	noticia-expandible/coca/expandido/index.html'></iframe>		
	<div class='btn-cerrar-expandible'>Cerrar</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
	$(".btn-cerrar-expandible").click(function () {
		$(".pbl_unionajax").hide();
        $(".pbl_unionajax").html("");
    });
});
</script>