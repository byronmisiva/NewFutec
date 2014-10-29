<?php
$this->load->view('header');
?>
<div class="header">
    <div class="container ">
        <div class="row fondo-header ">
<?php
echo $cabecera;
?>
        </div>
    </div>
</div>

    <div class="container">
        <!-- Cabecera-->
        <div class="row blanco">
            <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12" id="content">
               <?php
                echo $content;
                ?>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4z" id="sidebar">
                <?php
                echo $sidebar;
                ?>
            </div>
        </div>
    </div>
    <!-- /container -->

<?php
echo $footer;
$this->load->view('footer');
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=595644553876654&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>