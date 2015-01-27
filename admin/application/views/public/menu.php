<div
    style='position:absolute; left:0px; width:968px; height:41px; background-image:url("<?= base_url(); ?>/imagenes/template/public/fondo_menu2l.jpg");'>

    <!-- AQUI EMPIEZA EL MENU PRINCIPAL -->
    <div id='menu_principal'>
        <a href='<?= base_url(); ?>'><img src="<?= base_url(); ?>imagenes/template/menu/barra_01.png" border="0"
                                          title="Inicio" alt="Inicio"
                                          onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_01.png'"
                                          onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_01.png'"/></a>
        <a href='#' onclick="$('menu_principal').hide();new Effect.SlideDown('menu_equipos'); return false;"><img
                src="<?= base_url(); ?>/imagenes/template/menu/barra_02n.png" border="0" title="Equipos" alt="Equipos"
                onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_02n.png'"
                onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_02n.png'"/></a>
        <a href='#' onclick="$('menu_principal').hide();new Effect.Appear('menu_futbol'); return false;"><img
                src="<?= base_url(); ?>/imagenes/template/menu/barra_03n.png" border="0" title="Fútbol Nacional"
                alt="Fútbol Nacional"
                onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_03n.png'"
                onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_03n.png'"/></a>
        <a href='<?= base_url(); ?>en-el-exterior'><img src="<?= base_url(); ?>imagenes/template/menu/barra_04n.png"
                                                             border="0" title="En el Exterior"
                                                             alt="En el Exterior"
                                                             onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_04n.png'"
                                                             onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_04n.png'"/></a>
        <a href='#' onclick="$('menu_principal').hide();new Effect.Appear('menu_copas'); return false;"><img
                src="<?= base_url(); ?>/imagenes/template/menu/barra_05n.png" border="0" title="Copas" alt="Copas"
                onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_05n.png'"
                onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_05n.png'"/></a>
        <a href='<?= base_url(); ?>eliminatorias'><img
                src="<?= base_url(); ?>imagenes/template/menu/eliminatoriasn.png" border="0" title="Eliminatorias"
                alt="Eliminatorias"
                onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/eliminatorias_rolln.png'"
                onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/eliminatoriasn.png'"/></a>
        <a href='<?= base_url(); ?>zona-fe'><img src="<?= base_url(); ?>imagenes/template/menu/zona-fe.png"
                                                             border="0" title="ZonaFE" alt="ZonaFE"
                                                             onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/zona-fe-roll.png'"
                                                             onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/zona-fe.png'"/></a>

        <a href='<?= base_url(); ?>femagazine'><img
                src="<?= base_url(); ?>imagenes/template/menu/femagazinen.png" border="0" title="FE Magazine"
                alt="FE Magazine" onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/femagazinen.png'"
                onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/femagazinen.png'"/></a>


    </div>

    <!-- AQUI EMPIEZAN LOS MENUS SECUNDARIOS -->
    <div id='menu_equipos' style='position:absolute; display:none; width:775px;'>
        <div style='position:relative; width:100px;'>
            <div style='position:absolute; left:0px; width:150px;'>
                <a href='<?= base_url(); ?>'><img src="<?= base_url(); ?>/imagenes/template/menu/barra_01.png"
                                                  border="0" title="Inicio" alt="Inicio"
                                                  onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_01.png'"
                                                  onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_01.png'"/></a>
                <a href='#' onclick="$('menu_equipos').hide();new Effect.Appear('menu_principal'); return false;"><img
                        src="<?= base_url(); ?>/imagenes/template/menu/equipos.png" border="0" title="Equipos"
                        alt="Equipos"/></a>
            </div>
            <div style='position:absolute; left:150px; top:5px; width:400px;'>
                <?php
                $search = array('�', '�', '�', '�', 'ú', '�', '�', '�', '�', '�', '�', '�', ' ');
                $replace = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N', '-');
                foreach ($equipos as $opc)
                    echo "<a href='" . base_url() . "equipo/" . generate_user_permalink(str_replace($search, $replace, $opc->name)) . "' onmouseover=\"$('menu_nombre').innerHTML='" . $opc->name . "';\" onmouseout=\"$('menu_nombre').innerHTML='';\" ><img src='" . base_url() . $opc->thumb_shield . "' title='" . $opc->name . "'  alt='" . $opc->name . "' border='0'  /></a>";
                ?>
            </div>
            <div id='menu_nombre'
                 style='position:absolute; left:560px; top:10px; width:200px; color:white; font-family: arial,sans-serif; font-size:14px;'>
            </div>
        </div>
    </div>

    <div id='menu_futbol' style='position:absolute; display:none;'>
        <div style='position:relative; width:100px;'>
            <div style='position:absolute; left:0px; width:200px;'>
                <a href='<?= base_url(); ?>'><img src="<?= base_url(); ?>/imagenes/template/menu/barra_01.png"
                                                  border="0" title="Inicio" alt="Inicio"
                                                  onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_01.png'"
                                                  onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_01.png'"/></a>
                <a href='#' onclick="$('menu_futbol').hide();new Effect.Appear('menu_principal'); return false;"><img
                        src="<?= base_url(); ?>/imagenes/template/menu/fut_nac.png" border="0" title="Fútbol Nacional"
                        alt="Fútbol Nacional"/></a>
            </div>
            <div style='position:absolute; left:200px; width:400px;'>
                <?php
                foreach ($futbol as $opc) {
                    echo "<a href='" . base_url() .  generate_user_permalink(str_replace(" ", "_", $opc['name'])) . "' onmouseover=\"$('menu_nombre').innerHTML='" . $opc['name'] . "';\" onmouseout=\"$('menu_nombre').innerHTML='';\" ><img src='" . base_url() . $opc['image'] . "' title='" . $opc['name'] . "'  alt='" . $opc['name'] . "' border='0' onmouseover=\"this.src ='" . base_url() . $opc['over'] . "'\" onmouseout=\"this.src ='" . base_url() . $opc['image'] . "'\" /></a>";
                }
                ?>
            </div>
        </div>
    </div>

    <div id='menu_copas' style='position:absolute; display:none;'>
        <div style='position:relative; width:100px;'>
            <div style='position:absolute; left:0px; width:130px;'>
                <a href='<?= base_url(); ?>'><img src="<?= base_url(); ?>/imagenes/template/menu/barra_01.png"
                                                  border="0" title="Inicio" alt="Inicio"
                                                  onmouseover="this.src ='<?= base_url(); ?>/imagenes/template/menu/rollover_01.png'"
                                                  onmouseout="this.src ='<?= base_url(); ?>/imagenes/template/menu/barra_01.png'"/></a>
                <a href='#' onclick="$('menu_copas').hide();new Effect.Appear('menu_principal'); return false;"><img
                        src="<?= base_url(); ?>/imagenes/template/menu/copas.png" border="0" title="Fútbol Nacional"
                        alt="Fútbol Nacional"/></a>
            </div>
            <div style='position:absolute; left:130px; width:500px;'>
                <?php
                foreach ($copas as $opc) {
                    echo "<a href='" . base_url()  . generate_user_permalink(str_replace(" ", "_", $opc['name'])) . "' onmouseover=\"$('menu_nombre').innerHTML='" . $opc['name'] . "';\" onmouseout=\"$('menu_nombre').innerHTML='';\" ><img src='" . base_url() . $opc['image'] . "' title='" . $opc['name'] . "'  alt='" . $opc['name'] . "' border='0' onmouseover=\"this.src ='" . base_url() . $opc['over'] . "'\" onmouseout=\"this.src ='" . base_url() . $opc['image'] . "'\" /></a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
function generate_user_permalink($str){
	 setlocale(LC_ALL, 'en_US.UTF8');
	 $plink = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	 $plink = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $plink);
	 $plink = strtolower(trim($plink, '-'));
	 $plink = preg_replace("/[\/_| -]+/", '-', $plink);

	return $plink;

}
?>
