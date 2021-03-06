<?php $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($noticia->title) . '/' . $noticia->id; ?>
<style> .content-gris-sin-margin {margin-bottom: 10px !important;} .color-titular{color:#444444;} .p-l-20{padding-left:10px;}.titular-reciente{font-weight:bold;line-height: 18px;font-size: 13px;text-align:center;}
.img-relacionada{height:80px;overflow:hidden;}.mg-n-10{margin-left: 0}
.tagstorys{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;padding-top: 15px;}
@media screen and (max-width: 415px){.img-relacionada{height:60px;overflow:hidden;}.img-relacionada > img {width: 70px;}
.p-l-20{padding-left:0;}.mg-n-10{margin-left: 0;margin-bottom: 10px;height: 70px;padding-right: 3px;padding-left: 3px;}
.titular-reciente{line-height: 16px;font-size: 12px;text-align:left;}}
@media screen and (max-width: 361px) {.mg-n-10 > a > img {margin-left: 0; margin-right: 0;}.mg-n-10{padding-right: 0;padding-left: 0;}.titular-reciente{line-height: 16px;font-size: 11px;text-align:left;}]
</style>

<div class="row clearfix news-open separador10-xs noticiaabierta">
    <div class="col-md-12 ">
        <div class="col-md-7 margen10r">
            <div class="row">
                <img width="100%" height="100%"
                     src="http://www.futbolecuador.com/imagenes/000295a9fc4f680acd3abcf5cc9a278e.png"
                     style="position: absolute;">
                <img class="img-responsive margen10b margen10r margen0-xs"
                     src="http://www.futbolecuador.com/<?php echo $noticia->thumb400; ?>"
                     alt="<?php echo $noticia->image_name; ?>">
                <?php 
                
                if ($noticia->sponsored == "1"){?>
	                <div class="img-sponsor">
	                 	<img src="<?php echo base_url()?>assets/patrocinador/sponsor.gif?refresh=321" />
	                </div>     
                <?php }?>
                    
                <?php //echo $bannerTop; ?>
            </div>
             <div class="row">
                  <div class="col-xs-12">
                    <?php 
                        $this->load->module('site');
                        $mobile = $this->site->verificarDispositivo();
                        if($mobile == "1"){
                            $this->load->module('banners');
                            echo $this->banners->fe_smart_top();    
                        }
                    ?>
                  </div>
             </div>
            
        </div>
        <div class="margen10lados-sx fechaabierta">
            <?php setlocale(LC_ALL, "es_ES");
            echo $noticia->origen . ", " . ucwords(utf8_encode(strftime("%A %d %B %Y, %HH%M", strtotime($noticia->created)))); ?>
            <h2 class="h2noticiaabierta  "><?php echo $noticia->title; ?></h2>
        </div>
        <div class="margen10lados-sx">
            <h1 class="gris sub margen10lados-sx"><?php echo $noticia->subtitle; ?></h1>
        </div>
        <div class="col-md-5  col-xs-12 margen0">
        <div class="col-md-12 col-xs-12 margen0 hidden-xs hidden-sm">                
        	<div class="row separador10">
				<div class="col-xs-2 text-center">
					<span class='st_facebook_large' displayText='Facebook'></span>
				</div>	
				<div class="col-xs-2 text-center">
					<span class='st_twitter_large' displayText='Tweet'></span>
				</div>
				<div class="col-xs-2 text-center">	
					<span class='st_pinterest_large' displayText='Pinterest'></span>
					</div>	
				<div class="col-xs-2 text-center">	
					<span class='st_flipboard_large' displayText='Flipboard'></span>
				</div>
					
				<div class="col-xs-2 text-center">	
					<span class='st_email_large' displayText='Email'></span>
				</div>
			 </div>
        </div>
        </div>
        <div class="margen10lados-sx  separador5">
            <?php echo html_entity_decode($noticia->lead, ENT_COMPAT, 'UTF-8'); ?>
        </div>
        <div class="videoPublicidad">
          <?php if (strlen($videoPublicidad) > 3) {
            echo $videoPublicidad; 
			}?>
        </div>
        <div class="margen10lados-sx noticia-body">
             <?php 
//		echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8');

           if ($noticia->tema == "1"){
			$this->load->module('encuesta');
			echo $this->encuesta->getFormulario();
            }else if ($noticia->tema == "2"){
            	$this->load->module('surveys');
				echo $this->surveys->encuesta_formulario();
            }else{
            	echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8');
            }   
            ?>
        </div>
        <div class="col-md-5  col-xs-12 margen0 hidden-md hidden-lg">
        <div class="container">
        	<div class="row separador10">
				<div class="col-xs-2 text-center">
					<span class='st_facebook_large' displayText='Facebook'></span>
				</div>	
				<div class="col-xs-2 text-center">
					<span class='st_twitter_large' displayText='Tweet'></span>
				</div>	
				<div class="col-xs-2 text-center">	
					<span class='st_whatsapp_large' displayText='WhatsApp'></span>
				</div>	
				<div class="col-xs-2 text-center">	
					<span class='st_pinterest_large' displayText='Pinterest'></span>
					</div>	
				<div class="col-xs-2 text-center">	
					<span class='st_flipboard_large' displayText='Flipboard'></span>
				</div>
					
				<div class="col-xs-2 text-center">	
					<span class='st_email_large' displayText='Email'></span>
				</div>
			 </div>
        </div>      
        </div>     
        <div class="banerintermedio">
            <?php  echo $banerintermedio; ?>
        </div>      		
        <div class="margen10lados-sx noticia-body separador10 col-xs-12 col-md-12 ">
            <?php if (isset($autor[0]->twitter)) { ?>
                <a href="http://www.twitter.com/<?php echo $autor[0]->twitter; ?>"
                   target="_blank">@<?php echo $autor[0]->twitter; ?></a><br/>
            <?php }
            ?>
            <?php if (isset($autor[0]->mail)) { ?>
                <a href="mailto:<?php echo $autor[0]->mail; ?>"
                   target="_blank"><?php echo $autor[0]->mail; ?></a><br/>
            <?php }
            ?>
		<div class="ebzHere"></div>
        <div class="row">
            <div class="col-xs-12">
                <?php
                    $mobile = $this->site->verificarDispositivo();
                    if($mobile == "1"){
                        $this->load->module('banners');
                        echo $this->banners->FE_Bigboxnews3();    
                    }
                ?> 
            </div>
        </div>  
    <?php if (!strpos($noticia->body, "Lee la noticia completa en")) {
 	  	if ($noticia->tema == "0"){
		if (strlen($tagsStorys) > 3) { ?>
			<div class="col-md-12 column " style="margin-top: 10px;">
                <strong class="color-titular text-uppercase padding-left-2 p-l-20">Te puede interesar</strong>  
            </div>
            <div class="col-xs-12 col-md-12 margen0 tagstorys content-gris-sin-margin">
                <?php echo $tagsStorys; ?>
            </div>
		
            			
        	<?php } 
		}?>
        <?php }?>
            <a href="<?php echo base_url() . "site/noticia/" . $this->story->_urlFriendly($laVozDeLasTribunas[0]->title) . "/" . $laVozDeLasTribunas[0]->id ?>">
                <strong>La voz de las tribunas:</strong> <?php echo $laVozDeLasTribunas[0]->title; ?></a>
            <br/>
            	
        </div>
    </div>
</div>
<div class="col-md-12 column content-gris hidden-xs">
    <div class="col-md-4 col-xs-4 column margen0 hidden lecturas">
        Lecturas <?php echo $noticia->lecturas; ?>
    </div>
    <div class="col-md-12 col-xs-12 column margen0 text-right text-news-zone">
        <?php foreach ($noticia->tags as $key => $tag) {
            echo "<a href=" . base_url() . "site/tags/" . $this->story->_urlFriendly($tag->name) . ">" . $tag->name . "</a>";
            if ($key < count($noticia->tags) - 1) echo ", ";
        } ?>
    </div>
</div>


<div class="col-xs-12 col-md-12 margen0">
    <?php echo $bannerBottom; ?>
</div>
<div class="col-xs-12 col-md-12 backcuadros block-title separador10">
    <h4 class="panel-title">Comentarios </h4>
</div>
<div class="separador10 col-xs-12 col-md-12 center-block" data-href="<?php //echo $url?>">
    <div class="fb-comments" data-href="<?php echo $link ?>" data-width="100%" data-numposts="5"
         data-colorscheme="light"></div>
</div>
<script>
    setTimeout(function () {
        $.post(baseUrl + "site/setloc/<?php echo  $noticia->id;?>");
    }, 2500)
</script>
