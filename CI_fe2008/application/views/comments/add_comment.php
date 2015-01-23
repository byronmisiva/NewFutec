Agregar Comentario:
<?php
echo "<form action='".base_url()."comments/add' id='comentario' method='POST'> ";
echo form_input(array('name'=>'user_id','value'=>$user,'id'=>'user_id','type'=>'hidden'));
?>
<div class="white">
<fb:login-button size="medium" background="white" length="short" onlogin="alert('hello');">
</fb:login-button>
</div>
<?php
echo form_input(array('name'=>'story_id','value'=>$story,'id'=>'story_id','type'=>'hidden'));
echo form_input(array('name'=>'comment_id','value'=>$comment_id,'id'=>'comment_id','type'=>'hidden'));
echo form_textarea(array('name'=>'text','rows'=>5,'cols'=>65,'id'=>'text'));
echo "<br>";
echo "<input type='button' name='envio' id='envio' value='Enviar Comentario!' onClick='submit_comment(\"add_comment\");' >";
echo "</form>";
?>