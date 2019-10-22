<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);*/
?>




<?php 
$tipoDocumento=TipoDocumento::model()->findByPk($tipo);
?>

<h3 style="color:#0B4C5F;" >
    <i class="icon fa fa-file-text" style="font-size:40px;" ></i>
    <?=$tipoDocumento->tipo_documento?>
</h3>
<p><i>Es obligatorio asignar CITE y NURI al documento</i></p>



<!-- CODIGO PARA EL BORRADOR DE LA NOTA INTERNA, ESTA PARTE DE CODIGO SE USA PARA QUE EL SISTEMA GUARDE
AUTOMATICAMENTE UN BORRADOR DEL CONTENIDO DE LA NOTE INTERNA
 -->

<script type="text/javascript">
  setInterval(
     function(){
        var statusnya=$("#statuta").val(); // averiguar si hay una función de guardado automático en ejecución
        if(statusnya!="on")  // si no hay ninguna función en ejecución, ejecute la función
        {
           $("#buttonSave").attr("disabled",true);  // Mientras la función se esté ejecutando, el usuario no puede presionar el botón Guardar

           var referencia=$("#Documentos_referencia").val();  // capturar el valor del formulario de entrada
           // codigo para obtener el contenido del textarea embebido con el ckeditor
           var contenido = CKEDITOR.instances['contenido'].getData();
           var fk_tipo_documento=$("#Documentos_fk_tipo_documento").val();
           



           var destinatario_nombres=$("#destinatario_nombres").val();
           var destinatario_cargo=$("#destinatario_cargo").val();
           var via_nombres=$("#via_nombres").val();
           var via_cargo=$("#via_cargo").val();

           var remitente_nombres=$("#Documentos_remitente_nombres").val();  // capturar el valor del formulario de entrada
           var remitente_cargo=$("#Documentos_remitente_cargo").val();  // capturar el valor del formulario de entrada
           var adjuntos=$("#Documentos_adjuntos").val();  // capturar el valor del formulario de entrada
           var copias=$("#Documentos_copias").val();  // capturar el valor del formulario de entrada
           
           var destinatario_titulo='';  // capturar el valor del formulario de entrada
           var destinatario_institucion='';  // capturar el valor del formulario de entrada
           var remitente_institucion='';  // capturar el valor del formulario de entrada
           var nro_hojas='';  // capturar el valor del formulario de entrada




           //var data2 = $("#Namamodel_data2").val();
           
           //alert('referencia '+ referencia);
           //alert('contenido '+ contenido);
           //alert('fk_tipo_documento '+ fk_tipo_documento);

           $.ajax({
              url: "<?php echo Yii::app()->createUrl('documentos/GuardarBorrador')?>",  // llama a una función para guardar automáticamente
              type:"post",
              dataType :"json",
              data:{"referencia" : referencia,"contenido":contenido,"fk_tipo_documento":fk_tipo_documento, "destinatario_nombres":destinatario_nombres, "destinatario_cargo":destinatario_cargo, "via_nombres":via_nombres, "via_cargo":via_cargo, "remitente_nombres":remitente_nombres, "remitente_cargo":remitente_cargo, "adjuntos":adjuntos, "copias":copias, "destinatario_titulo":destinatario_titulo, "destinatario_institucion":destinatario_institucion, "remitente_institucion":remitente_institucion, "nro_hojas":nro_hojas},
              beforeSend: function() {
                    $("#statuta").val("on");
              },
              success : function(data){
                    $("#statuta").val("off");
                    if(data.satu.length > 0){
                       window.location=data.satu;  // si los datos se guardan correctamente, se redireccionará
                    }
                    else{
                       $("#buttonSave").attr("disabled",false);
                    }
              },
          });
       }
       else{ alert('error'); }
    }, 
    90000000  // la operación de guardado automático se realiza cada 5 minutos  ej. 15000 son 15 segundos
  );
</script>


<?php $this->renderPartial('_formNota', array('model'=>$model,'tipo'=>$tipo)); ?>