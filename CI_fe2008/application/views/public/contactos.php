

<div id="MB_content"  >
    <div style="margin: 0px; padding: 0px;">




        <form onsubmit="return false" id="myform2" method="post" action="http://www.futbolecuador.com/popups/contact_us">
            <input type="hidden" value="Contacto desde futbolecuador.com" id="from" name="from">

            <div
                style="background-color: #FAFBFF; padding: 3px; text-align: left; font-size: 12px; color: #456884; margin: 10px;">
                <h1>Contactos</h1>
                <p>Redacción: <a href="mailto:lotero@futbolecuador.com?Subject= " target="_top">lotero@futbolecuador.com</a></p>
                <p>Publicidad: <a href="mailto:ddelosreyes@futbolecuador.com?Subject= " target="_top">ddelosreyes@futbolecuador.com</a>
                </p>
                Tu opinión nos interesa.<br>Escríbenos tus comentarios y sugerencias.
            </div>
            <div id="register">
                <fieldset id="personal">
                    <legend>Contáctanos</legend>
                    <ol>
                        <li>
                            <label class="left">Nombre: </label>
                            <input type="text" value="" name="nombre" class="MB_focusable">
                        </li>
                        <li>
                            <label class="left">E-mail: </label>
                            <input type="text" size="20" id="email" name="email" class="MB_focusable">
                        </li>
                        <li>
                            <label class="left">Mensaje: </label>
                            <textarea rows="5" cols="34" id="mensaje" name="mensaje" class="MB_focusable"></textarea>
                        </li>
                    </ol>
                </fieldset>
                <div style="margin: 10px;">
                    <input type="submit"
                           onclick="Modalbox.show('http://www.futbolecuador.com/popups/contact_us', {title: ' ',method: 'post', params: Form.serialize('myform3'),'' }); return false;"
                           value="Enviar" id="Submit" name="Submit" class="MB_focusable">
                </div>
            </div>
        </form>
    </div>

</div>