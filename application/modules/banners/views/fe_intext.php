<!-- FE_NEW_LATERAL_1 -->
<div id='intext' class="col-md-12 margen0">
    <div id="content" class="child0"></div>
</div>
<script src="http://www.youtube.com/player_api"></script>
<script>
    // create youtube player
    var player;
    var mostrarVideo = true;
    function playVideo() {
        player = new YT.Player('player', {
            height: '370',
            width: '660',
            videoId: 'xuMCi5-Ud-E',
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
    function onYouTubePlayerAPIReady() {
        var div = document.createElement('div');
        div.id = 'player';
        document.getElementById('content').appendChild(div);
        playVideo();
    }
    // autoplay video
    function onPlayerReady(event) {
        event.target.setVolume(10);
        //event.target.playVideo();
    }
    // when video ends
    function onPlayerStateChange(event) {
        if (event.data === 0) {
            document.getElementById("content").className = 'child0';
            document.getElementById('content').innerHTML = "";
            mostrarVideo = false;
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        $(window).scroll(function (event) {
            if (($(window).scrollTop() > 360) & ($(window).scrollTop() < 850)) {
                if (mostrarVideo) {
                    document.getElementById("content").className = 'child370';
                    player.playVideo();
                }
            } else {
                if (mostrarVideo) {
                    document.getElementById("content").className = 'child0';
                    player.pauseVideo();
                }
            }
        });
    });
</script>
<style>
    .child0 {
        height: 0px;
        transition: height 0.4s ease-in;
        overflow: hidden;
    }
    .child370 {
        height: 370px;
        transition: height 0.4s ease-in;
        overflow: hidden;
    }
</style>

