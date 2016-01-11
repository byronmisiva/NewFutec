<div id="boton" style="width: 800px; height: 600px; cursor: pointer; background-image: url(http://www.futbolecuador.com/futbolecuador_html5/chevrolet/enero/FUTBOLECUADOR-LANZAMIENTO-800X600-RICHMEDIA-SPARKLIFE-EC.jpg);">
    <div id="content" style="padding-top: 80px; height: 450px"></div>
    <a href="http://www.chevrolet.com.ec/spark-hb-auto-hatchback/contacto.html" target="_blank" ><div id="conoce" style="height: 64px; "></div></a>
</div>

<script src="http://www.youtube.com/player_api"></script>
<script>
    document.getElementById('boton').onclick=function(){
        var div = document.createElement('div');
        div.id = 'player';
        document.getElementById('content').appendChild(div);
        playVideo();
    }
    // create youtube player
    var player;
    function playVideo () {
        player = new YT.Player('player', {
            height: '450',
            width: '800',
            videoId: 'MGDBBwU1Oj0',
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
    function onYouTubePlayerAPIReady() {
    }
    // autoplay video
    function onPlayerReady(event) {
        event.target.playVideo();
    }
    // when video ends
    function onPlayerStateChange(event) {
        if(event.data === 0) {
            document.getElementById('content').innerHTML = "";
        }
    }
</script>