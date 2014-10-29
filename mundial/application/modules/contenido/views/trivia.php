<!-- Galería imágenes  -->
<!--<div class="col-md-12 trivia separador">
    <div class="row">
        <div class="col-md-12 cabecera-partidos">
            <h2>
                <div class="iconos sprite-icono_trivia"></div>
                Trivia
            </h2>
        </div>
        <div class="col-md-12 movi-headline-regular titulo">Demuestra cuanto sabes de la historia de los mundiales, comparte tu resultado y desafía
            a tus amigos.
        </div>

        <div class="col-md-12 movi-headline-regular titulo">Pregunta 1 de 10</div>
        <div class="col-md-12 ">En el primer gol de Maradona contra Inglaterra en el Mundial de México 86..</div>
        <div class="col-md-12 ">
            <ul>
                <li>La asistencia fue de Jorge Valdano.</li>
                <li>Diego fue a festejarlo detrás del arco</li>
                <li>Argentina jugó con la camiseta suplente.</li>
                <li>Diego convirtió el tanto con la mano derecha</li>

            </ul>
        </div>
        <div class="col-md-12 text-right">
            Siguiente >
        </div>
    </div>


</div>-->
<!-- Fin  Galería imágenes  -->
<div id="trivia" class="col-md-12 trivia separador">
 
<div class="row">
        <div class="col-md-12 cabecera-partidos">
            <h2>
                <div class="iconos sprite-icono_trivia"></div>
                Trivia
            </h2>
        </div>

<div class="col-md-12 titulo movistar-text">Demuestra cuanto sabes de la historia de los mundiales, comparte tu resultado y desafía a tus amigos.</div>
<div id="carousel-trivia" class="carousel slide col-md-12">
            <!-- Carousel items -->
 <div class="carousel-inner texto-azul">

   <div class="active item" data-slide-number="0">
        <div class="conten-partidos titulo">Pregunta 1 de 8</div>
        <div class="conten-partidos">¿En qué país se jugó el primer mundial organizado por FIFA?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta1" onclick="respuestas('1-1')"> Alemania</input></li>
                <li><input type="radio" name="pregunta1" onclick="respuestas('1-2')"> Italia</input></li>
                <li><input type="radio" name="pregunta1" onclick="respuestas('1-3')"> Uruguay</input></li>

            </ul>
        </div>

        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="next" id="siguientePregunta">Siguiente</a>
    </div>
    </div>

    <div class="item" data-slide-number="1">
        <div class="conten-partidos titulo">Pregunta 2 de 8</div>
        <div class="conten-partidos">¿Contra qué selección Maradona anotó el famoso gol de la Mano de Dios?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta2" onclick="respuestas('2-1')"> Uruguay</input></li>
                <li><input type="radio" name="pregunta2" onclick="respuestas('2-2')"> Inglaterra</input></li>
                <li><input type="radio" name="pregunta2" onclick="respuestas('2-3')"> Francia</input></li>

            </ul>
        </div>
        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
       <?php
/*        $dominio = $_SERVER['HTTP_HOST'];
        $session = $_SERVER['REQUEST_URI'];
        $url = "http://" . $dominio . $seccion;
        echo $url;
        */?>
                  <a href="#carousel-trivia" data-slide="prev">Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" data-slide="next">Siguiente</a>
    </div>
    </div>

    <div class="item" data-slide-number="2">
        <div class="conten-partidos titulo">Pregunta 3 de 8</div>
        <div class="conten-partidos">¿Cuál es el único futbolista en toda la historia en ganar 3 copas mundiales?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta3" onclick="respuestas('3-1')"> Pelé</input></li>
                <li><input type="radio" name="pregunta3" onclick="respuestas('3-2')"> Maradona</input></li>
                <li><input type="radio" name="pregunta3" onclick="respuestas('3-3')"> Ronaldo</input></li>

            </ul>
        </div>
        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="prev">Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" data-slide="next">Siguiente</a>
    </div>
    </div>

    <div class="item" data-slide-number="3">
        <div class="conten-partidos titulo">Pregunta 4 de 8</div>
        <div class="conten-partidos">¿Cuál es el máximo goleador de los mundiales?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta4" onclick="respuestas('4-1')"> Klose</input></li>
                <li><input type="radio" name="pregunta4" onclick="respuestas('4-2')"> Ronaldo</input></li>
                <li><input type="radio" name="pregunta4" onclick="respuestas('4-3')"> Muller</input></li>

            </ul>
        </div>
        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="prev">Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" data-slide="next">Siguiente</a>
    </div>
    </div>
    

    <div class="item" data-slide-number="4">
        <div class="conten-partidos titulo">Pregunta 5 de 8</div>
        <div class="conten-partidos">¿Qué selección quedó campeona en el mundial de Korea-Japón 2002?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta5" onclick="respuestas('5-1')"> Brasil</input></li>
                <li><input type="radio" name="pregunta5" onclick="respuestas('5-2')"> Alemania</input></li>
                <li><input type="radio" name="pregunta5" onclick="respuestas('5-3')"> Italia</input></li>

            </ul>
        </div>
        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="prev">Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" data-slide="next">Siguiente</a>
    </div>
    </div>

   <div class="item" data-slide-number="5">
        <div class="conten-partidos titulo">Pregunta 6 de 8</div>
        <div class="conten-partidos">¿Qué jugador marcó el primer gol de Ecuador en mundiales?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta6" onclick="respuestas('6-1')"> Edison Méndez</input></li>
                <li><input type="radio" name="pregunta6" onclick="respuestas('6-2')"> Agustín Delgado</input></li>
                <li><input type="radio" name="pregunta6" onclick="respuestas('6-3')"> Ivan Kaviedes</input></li>

            </ul>
        </div>
        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="prev">Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" data-slide="next">Siguiente</a>
    </div>
    </div>
   
   <div class="item" data-slide-number="6">
        <div class="conten-partidos titulo">Pregunta 7 de 8</div>
        <div class="conten-partidos">¿Quién marcó el gol en la final del mundial de Sudáfrica 2010?</div>
        <div class="margen0">
            <ul class="movi-headline-regular">
                <li><input type="radio" name="pregunta7" onclick="respuestas('7-1')"> Andrés Iniesta</input></li>
                <li><input type="radio" name="pregunta7" onclick="respuestas('7-2')"> David Villa</input></li>
                <li><input type="radio" name="pregunta7" onclick="respuestas('7-3')"> Fernando Torres</input></li>

            </ul>
        </div>

        <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="prev" >Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" data-slide="next">Siguiente</a>
    </div>
    </div>

    <div class="item" data-slide-number="7">
        <div class="conten-partidos titulo">Pregunta 8 de 8</div>
        <div class="conten-partidos">¿Cuál fue el último año en que Alemania quedó campeón del mundo?</div>
        <div class="margen0">
            <ul>
                <li><input type="radio" name="pregunta8" onclick="respuestas('8-1')"> 1974</input></li>
                <li><input type="radio" name="pregunta8" onclick="respuestas('8-2')"> 1954</input></li>
                <li><input type="radio" name="pregunta8" onclick="respuestas('8-3')"> 1990</input></li>

            </ul>
        </div>
     <div class="clearfix"></div>
  <!-- Controls -->
    <div class="carousel-controls text-right">
                  <a href="#carousel-trivia" data-slide="prev">Anterior</a>
                  <span>|</span>
                  <a href="#carousel-trivia" id="calcular" onclick="calcular()">Calcular</a>
    </div>


    </div>
   </div>
   <form action="trivia.php" method="post" id="form_trivia">
    <input type="hidden" id="resp1" name="resp1" value="0">
    <input type="hidden" id="resp2" name="resp2" value="0">
    <input type="hidden" id="resp3" name="resp3" value="0">
    <input type="hidden" id="resp4" name="resp4" value="0">
    <input type="hidden" id="resp5" name="resp5" value="0">
    <input type="hidden" id="resp6" name="resp6" value="0">
    <input type="hidden" id="resp7" name="resp7" value="0">
    <input type="hidden" id="resp8" name="resp8" value="0">
  </form>
</div>
<div class="col-md-12 titulo conten-partidos " id="result" ></div>
</div>
</div>
<script>

function respuestas($val){
      var $res = $val.split("-");
      $('#resp'+$res[0]).val($res[1]);
      if($res[0]!=8){
       $('#siguientePregunta').click();
      }else{
        calcular();
      }
}


function muestraTrivia(){
       clearForm();
      $('#carousel-trivia').css('display', 'block');
      $('#result').html('');
      $('#result').css('display', 'none');
}

function clearForm(){
    for(var i=1;i<=8; i++){
        $('input:radio[name=pregunta'+i+']:checked').prop('checked', false);
         $('#resp'+i).val("");
    }
     $("#carousel-trivia").carousel(0);
}



function calcular(){    

     var myArray = [ $('#resp1').val(), $('#resp2').val(), $('#resp3').val(), $('#resp4').val(), $('#resp5').val(), $('#resp6').val(), $('#resp7').val(),$('#resp8').val() ];
     if(myArray[0]==0){
        alert('Ingrese la Respuesta de la pregunta 1');
        $("#carousel-trivia").carousel(0);
     }else if(myArray[1]==0){
        alert('Ingrese la Respuesta de la pregunta 2');
         $("#carousel-trivia").carousel(1);
     }else if(myArray[2]==0){
        alert('Ingrese la Respuesta de la pregunta 3');
         $("#carousel-trivia").carousel(2);
     }else if(myArray[3]==0){
        alert('Ingrese la Respuesta de la pregunta 4');
        $("#carousel-trivia").carousel(3);
     }else if(myArray[4]==0){
        alert('Ingrese la Respuesta de la pregunta 5');
         $("#carousel-trivia").carousel(4);
     }else if(myArray[5]==0){
        alert('Ingrese la Respuesta de la pregunta 6');
        $("#carousel-trivia").carousel(5);
     }else if(myArray[6]==0){
        alert('Ingrese la Respuesta de la pregunta 7');
        $("#carousel-trivia").carousel(6);
     }else if(myArray[7]==0){
        alert('Ingrese la Respuesta de la pregunta 8');
        $("#carousel-trivia").carousel(7);
     }else {

          $.ajax({  
              type: "POST",  
              url: baseUrl+"site/resultado_trivia",  
              data: $('#form_trivia').serialize(),
              success: function( response ) {
                    $('#carousel-trivia').css('display', 'none');
                    $('#result').append("<div class='movi-headline-regular text-center'><h3>Felicitaciones has obtenido</br> <span class='trivia-respuesta'>"+response+" / 8"+"</span> </br>puntos</h3></div>");
                     $('#result').append('<div class="clearfix"></div>');
                    $('#result').append('<div class="row boton-more-fondo"><a class="boton-more" onclick="muestraTrivia()">Mostrar Trivia</a></div>');
                } 
            });
  }
}
</script>
