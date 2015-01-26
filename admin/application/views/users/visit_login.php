<div id='login' align='center' style='margin-top: 10px;'>

    <div
        style='border-bottom: 1px solid #023962; background-color: #FAFBFF; padding: 13px; text-align: left; font-size: 12px; color: #023962;'>
        Únete a nuestra alineación titular.<br>
        Regístrate y disfruta de la red social del futbol ecuatoriano:<br>
        Promociones, Boletines, Comentarios, Fotos, Videos y mucho mas.

        <ul style='margin: 0px; padding: 15px;'>
            <li style='height: 30px; display: inline;border: 1px solid #A4C3E0; padding: 5px; -moz-border-radius: 0.5em; margin: 3px; background-color: #023962; font-weight: bold;'>
                <a href='<?= base_url(); ?>users/register' style='text-decoration: none;color: white'>Regístrate</a>
            </li>
            <li style='height: 30px; display: inline;border: 1px solid #A4C3E0; padding: 5px; -moz-border-radius: 0.5em; margin: 3px; margin-left: 100px; background-color: #023962; font-weight: bold; '>
                <a href=''
                   onClick='Modalbox.show("<?= base_url(); ?>users/forgot", {title: " ", width: 500 }); return false;'
                   style='text-decoration: none;color: white'>Olvidaste tu clave</a>
            </li>
        </ul>
    </div>

    <form action="<?= base_url(); ?>users/log_in" method="post" id="myform" onsubmit="return false">
        <table class='tabla' style="border: 1px solid #023962; background-color: white; margin-top: 10px;"
               cellspacing='0' cellpadding='0'>
            <tr>
                <td colspan='2'>
                    <div
                        style='font-size: 12px; color: red; margin-left: 15px;'><?= validation_errors(); ?><?= $error; ?></div>
                </td>
            </tr>

            <tr>
                <td class='label' style='color: #023962;'>Usuario:</td>
                <td class='data'><input type="text" name="nick"/></td>
            </tr>
            <tr>
                <td class='label' style='color: #023962;'>Clave:</td>
                <td class='data'><input type="password" name="password"/></td>
            </tr>
            <tr>
                <td colspan="2" align="right" class='button'></td>
            </tr>
        </table>

        <div style='margin-top: 10px; text-align: center; border-top: 1px solid #023962; padding-top:10px;'>
            <input type="submit" name="submit" value="Ingresar"
                   onclick="Modalbox.show('<?= base_url(); ?>users/log_in', {title: ' ',method: 'post', params: Form.serialize('myform') }); return false;"/>
            <input type="button" value="Cerrar" onclick="Modalbox.hide(); return false;"/>
        </div>
    </form>
</div>
<div id='footer'>
    <table cellspacing='0' cellpadding='0' width='100%'>
        <tr>
            <td align='left'><?= img('imagenes/popups/logo_misiva.jpg'); ?></td>
            <td align='right'><?= img('imagenes/popups/logo_smg.jpg'); ?></td>
        </tr>
    </table>
</div>