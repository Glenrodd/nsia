<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<?php 
$tipoDocumento=TipoDocumento::model()->findByPk($tipo);
?>

<h3 style="color:#0B4C5F;" >
    <i class="icon fa fa-file-text" style="font-size:40px;" ></i>
    <?=$tipoDocumento->tipo_documento?> <i><b>(Borrador)</b></i>
</h3>
<p><i>Es obligatorio asignar <b>CITE</b>  para que el documento desaparezca de la bandeja de borradores.</i><br>
<i>El sistema guardar&aacute; periodicamente la informaci&oacute;n actualizada en el borrador.</i></p>

<head>
	<!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>-->
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>-->
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />

	<script type="text/javascript">
				    $(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#example thead th').each( function () {
				        var title = $('#example thead th').eq( $(this).index() ).text();
				        $(this).html( '<input type="text" placeholder="Buscar..." />' );
				        //$(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
				    } );
				    // DataTable
				    var table = $('#example').DataTable( {
				        colReorder: true
				    } );
				      
				    // Apply the filter
				    $("#example thead input").on( 'keyup change', function () {
				        table
				            .column( $(this).parent().index()+':visible' )
				            .search( this.value )
				            .draw();
				    } );
				    } );    



					function destinatario(valor1, valor2){	

						$("#user_destino").html(valor1);
						$("#derivado_a").val(valor2);
						//$("#usuario_destino").val(valor3);
					}
					</script>
</head>



<script type="text/javascript">



function destinatario(valor1, valor2, valor3){	

	$("#destinatario_nombres").val(valor1);
	$("#destinatario_cargo").val(valor2);
	$("#destinatario_institucion").val(valor3);
}


</script>




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

           var id_documento=$("#id_documento").val();  // capturar el valor del formulario de entrada
           var destinatario_titulo=$("#Documentos_destinatario_titulo").val();  // capturar el valor del formulario de entrada
           var destinatario_nombres=$("#destinatario_nombres").val();  // capturar el valor del formulario de entrada
           var destinatario_cargo=$("#destinatario_cargo").val();  // capturar el valor del formulario de entrada
           var destinatario_institucion=$("#destinatario_institucion").val();  // capturar el valor del formulario de entrada
           var fecha=$("#publishDate").val();  // capturar el valor del formulario de entrada
           var referencia=$("#Documentos_referencia").val();  // capturar el valor del formulario de entrada
           
           // codigo para obtener el contenido del textarea embebido con el ckeditor
           var contenido = CKEDITOR.instances['contenido'].getData();

           var remitente_nombres=$("#Documentos_remitente_nombres").val();
           var remitente_cargo=$("#Documentos_remitente_cargo").val();
           var adjuntos=$("#Documentos_adjuntos").val();
           var copias=$("#Documentos_copias").val();
           

           //var data2 = $("#Namamodel_data2").val();
           
           //alert('referencia '+ referencia);
           //alert('contenido '+ contenido);
           //alert('fk_tipo_documento '+ fk_tipo_documento);

           $.ajax({
              url: "<?php echo Yii::app()->createUrl('documentos/updateCartaDraft')?>",  // llama a una función para guardar automáticamente
              type:"post",
              dataType :"json",
              data:{"id_documento":id_documento, "destinatario_titulo":destinatario_titulo, "destinatario_nombres":destinatario_nombres, "destinatario_cargo":destinatario_cargo, "destinatario_institucion":destinatario_institucion, "fecha":fecha, "referencia":referencia, "contenido":contenido, "remitente_nombres":remitente_nombres, "remitente_cargo":remitente_cargo, "adjuntos":adjuntos, "copias":copias},
              beforeSend: function() {
                    $("#statuta").val("on");
                    // codigo para llamar al mensaje emergente
              		myFunction();
              },
              success : function(data){

              		//$("#resultado").load("guardaddo");


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
    //15000  // la operación de guardado automático se realiza cada 15 segundos
    300000 // la opreacion almacenara el autoguaradado cada 5 minutos
  );
</script>

<!--#######################################################-->
<script type="text/javascript">
	function myFunction() {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");
  // Add the "show" class to DIV
  x.className = "show";
  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>

<!-- codigo para mostrar la ventana emergente -->
<!--<button onclick="myFunction()">Show Snackbar</button>-->
<!-- The actual snackbar -->
<div id="snackbar">
	<i class='fa fa-floppy-o' id='mensaje_emergente' style='color:lightgray;'></i><br>
		 		Borrador guardado automaticamente. <?=date('d/m/Y')?> <?=date('H:i:s')?>
</div>


<!-- ####################################################################################################### -->
<input type="hidden" id="id_documento" name="id_documento" value="<?=$model->id_documento?>">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-12">
            
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Borrador almacenado autom&aacute;ticamente por el sistema.</h3>
              </div>
              <!-- /.card-header -->
	              <div class="card-footer" style="background: #E6E6E6;">
	              	<?php echo CHtml::link('Asignar nuevo <b>CITE</b>',array('documentos/asignarCite',
                                         'id_documento'=>$model->id_documento
                                         
                       		),
  							array(	
		          				'class' => 'btn btn-primary',
		           				'onclick'=>'event.stopPropagation();
			       				Loading.show(); 
			       				return true;'
			       			)); 
                    ?>
	           		<?php 
	           		$this->widget('ext.widgets.loading.LoadingWidget');
	           		
	           		echo CHtml::submitButton($model->isNewRecord ? 'Crear Documento' : 'Modificar Documento', 
           			array(
           				'class' => 'btn btn-success',
           				'onclick'=>'event.stopPropagation();
        				Loading.show(); 
        				return true;'
           			)); ?>
	              </div>


	              <div class="card-body">
	                <div class="row">  
	              	<div class="col-md-6">
	              		<div class="card-body">
	              			  
								<?php //echo $form->labelEx($model,'destinatario_titulo'); ?>
								<?php //echo $form->textField($model,'destinatario_titulo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'destinatario_titulo'); ?>

							   <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_t&iacute;tulo'); ?>
								</label>

								 <?php echo $form->dropDownList($model,'destinatario_titulo', 
		                              array('Señor'=>'Señor', 'Señora'=> 'Señora', 'Señores'=>'Señores'), 
		                              array('empty'=>'Seleccione T&iacute;tulo','class'=>'form-control  select')
		                            ); ?>

								<?php echo $form->error($model,'destinatario_titulo'); ?>
			                  </div>	 
			                  
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_nombres'); ?>
								</label>
								<?php echo $form->textField($model,'destinatario_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_nombres')); ?>
								<?php echo $form->error($model,'destinatario_nombres'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_cargo'); ?>
								</label>
								<?php echo $form->textField($model,'destinatario_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_cargo')); ?>
								<?php echo $form->error($model,'destinatario_cargo'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_instituci&oacute;n'); ?>
								</label>
								<?php echo $form->textField($model,'destinatario_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_institucion')); ?>
								<?php echo $form->error($model,'destinatario_institucion'); ?>
			                  </div>

			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'Fecha'); ?>
								</label>
								<?php //echo $form->textField($model,'fecha',array('class'=>'form-control','id'=>'destinatario_nombres')); ?>
								<?php 

								$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			                      'model'=>$model,
			                      'name'=>'publishDate',
			                      'attribute'=>'fecha',
			                      'language' => 'es',

			                      'htmlOptions' => array('readonly'=>"readonly", 'class'=>'shadowdatepicker form-control'),

			                      'options'=>array(

			                          'autoSize'=>true,
			                          'dateFormat'=>'yy-mm-dd',
			                          //'buttonImage'=>Yii::app()->baseUrl.'/images/calendario.jpg',
			                          //'buttonImageOnly'=>true,
			                          //'buttonText'=>'Fecha',
			                          'selectOtherMonths'=>true,
			                          'showAnim'=>'slide',
			                          'showButtonPanel'=>true,
			                          //'showOn'=>'button',
			                          'showOtherMonths'=>true,
			                          'changeMonth' => 'true',
			                          'changeYear' => 'true',
			                          'minDate'=>'date("Y-m-d")',
			                          //'minDate'=>'-2m',
			                          //'minDate'=>'2000-01-01',
			                          //'maxDate'=> date('Y-m-d'),
			                      ),
			                  ));

								?>

								<?php echo $form->error($model,'fecha'); ?>
			                  </div>

			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'referencia'); ?>
								</label>
								<?php echo $form->textArea($model,'referencia',array('rows'=>2, 'cols'=>50,'class'=>'form-control')); ?>
								<?php echo $form->error($model,'referencia'); ?>
			                  </div>
			                  
			                  
								 
								<?php //echo $form->labelEx($model,'destinatario_institucion'); ?>
								
								<?php //echo $form->textField($model,'destinatario_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'destinatario_institucion'); ?>
			                  
			                  
			                  
								<?php //echo $form->labelEx($model,'remitente_institucion'); ?>
								
								<?php //echo $form->textField($model,'remitente_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'remitente_institucion'); ?>
			                  
	              		</div>
	              	</div><!-- col-md-6 -->	
	              	<div class="col-md-6">
		              		<div class="card-body">

		              			<div class="card card-danger">
					              <div class="card-header">
					                <h3 class="card-title">Destinatarios.</h3>
					              </div>
					              <!-- /.card-header -->
					              <div class="card-body">
					              	<div class="card-body pad table-responsive"  style="height:350px; overflow:auto; border-radius: 5px;">
		              					<table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>Nombres</b></td>
						               <td align="center"><b>Instituci&oacute;n</b></td>
						               <td align="center"><b></b></td>
						               
						            </tr>
						            <tr>
						               <th align="center"><b>Nombres</b></th>
						               <th align="center"><b>Instituci&oacute;n</b></th>
						               <td align="center"><b></b></td>
						               
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php 

						         $regional=Yii::app()->user->regional;
						         	$dataReader=Documentos::getInstitucionRemitente(); 
						         ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left">
						            		<?=$row['nombre_remitente']?><br>
						            	<i><b><?=$row['cargo_remitente']?><b></i>	
						            	
						            </td>
						            
						            <td align="left"><?=$row['institucion_remitente']?></td>
						            <td>
						            	<a onclick="javascript:destinatario('<?=$row['nombre_remitente'] ?>','<?= $row['cargo_remitente'] ?>','<?= $row['institucion_remitente'] ?>');" style="text-decoration:none; color: white;font-size: 12px;" class='btn btn-info'>Destino</a>
						            </td>
						            
						           </tr>
						         <?php } ?>
						         </tbody>
						    	</table>
						                
						            </div>
					              </div>
					              <!-- /.card-body -->
					            </div>
					            <!-- /.card -->
		              		</div>
		              	</div><!-- col-md-6 -->





	              </div>
                
                  
                  
                  
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'contenido'); ?>
					</label>
					<?php //echo $form->textArea($model,'contenido',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>

					<?php
							$this->widget('application.extensions.ckeditor.CKEditor', 
									array(
											'model'=>$model,
											'attribute'=>'contenido',
											'name'=>'contenido',
											'language'=>'spanish',
											'editorTemplate'=>'full',
											'skin'=>'office2003',
											
											/*'editorTemplate'=>'advanced',
											'toolbar'=>array(
											     array('Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','Image','Flash', '-', 'About')
											),*/	

										 )
									);
							
					?>



					<?php echo $form->error($model,'contenido'); ?>
                  </div>
                  <?php 
                  	$remitente=Documentos::getRemitente();
                  ?>
                  <div class="form-group">
					 <i style="font-size: 14px;">En caso de existir m&aacute;s de un remitente es necesario separar los nombres con <b>';'</b> sin espacios</i> <br>	
					 <label>
					<?php echo $form->labelEx($model,'remitente_nombres'); ?>
					</label>

					<?php if ($model->isNewRecord) { ?>
					<?php echo $form->textField($model,'remitente_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control', 'value'=>$remitente->nombre)); ?>
					<?php } else { ?>
					<?php echo $form->textField($model,'remitente_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
					<?php } ?>

					<?php echo $form->error($model,'remitente_nombres'); ?>
                  </div>
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'remitente_cargo'); ?>
					</label>
					<?php if ($model->isNewRecord) { ?>
						<?php echo $form->textField($model,'remitente_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control', 'value'=>$remitente->cargo)); ?>
					<?php echo $form->error($model,'remitente_cargo'); ?>
					<?php } else { ?>
						<?php echo $form->textField($model,'remitente_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
					<?php } ?>
                  </div>

                  
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'adjuntos'); ?>
					</label>
					<?php echo $form->textField($model,'adjuntos',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'adjuntos'); ?>
                  </div>
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'copias'); ?>
					</label>
					<?php echo $form->textField($model,'copias',array('size'=>60,'maxlength'=>300,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'copias'); ?>
                  </div>
                  
                  
              </div>
              <!-- /.card-body -->

              <div class="card-footer" style="background: #E6E6E6;">
              	<?php echo CHtml::link('Asignar nuevo <b>CITE</b>',array('documentos/asignarCite',
                                         'id_documento'=>$model->id_documento,
                                         
                       		),
  							array(	
		          				'class' => 'btn btn-primary',
		           				'onclick'=>'event.stopPropagation();
			       				Loading.show(); 
			       				return true;'
			       			)); 
                    ?>
           		<?php 
           		echo CHtml::submitButton($model->isNewRecord ? 'Crear Documento' : 'Modificar Documento', 
           			array(
           				'class' => 'btn btn-success',
           				'onclick'=>'event.stopPropagation();
        				Loading.show(); 
        				return true;'
           			)); ?>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

		<?php //echo $form->labelEx($model,'fecha'); ?>
		<?php //echo $form->textField($model,'fecha'); ?>
		<?php //echo $form->error($model,'fecha'); ?>


	<?php 

	//echo "usuario ---> ".Yii::app()->user->id_usuario;
	//echo "area ---> ".Yii::app()->user->id_area;
	
	?>	

		<?php //echo $form->labelEx($model,'cite'); ?>
		<?php echo $form->hiddenField($model,'codigo'); ?>
		<?php echo $form->error($model,'codigo'); ?>
		
		<?php //echo $form->labelEx($model,'hora'); ?>
		<?php //echo $form->textField($model,'hora'); ?>
		<?php //echo $form->error($model,'hora'); ?>
	
		<?php //echo $form->labelEx($model,'nro_hojas'); ?>
		<?php echo $form->hiddenField($model,'nro_hojas',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nro_hojas'); ?>
	
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
		<?php //echo $form->error($model,'gestion'); ?>
	
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
	
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>
	
		<?php //echo $form->labelEx($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
		<?php //echo $form->error($model,'fk_usuario'); ?>

		<?php //echo $form->labelEx($model,'fk_estado_documento'); ?>
		<?php echo $form->hiddenField($model,'fk_estado_documento'); ?>
		<?php echo $form->error($model,'fk_estado_documento'); ?>
	
		<?php //echo $form->labelEx($model,'fk_tipo_documento'); ?>
		<?php echo $form->hiddenField($model,'fk_tipo_documento', array('value'=>$tipo)); ?>
		<?php echo $form->error($model,'fk_tipo_documento'); ?>
	
		<?php //echo $form->labelEx($model,'fk_area'); ?>
		<?php //echo $form->textField($model,'fk_area'); ?>
		<?php //echo $form->error($model,'fk_area'); ?>
	
		<?php //echo $form->labelEx($model,'fk_documento'); ?>
		<?php echo $form->hiddenField($model,'fk_documento'); ?>
		<?php echo $form->error($model,'fk_documento'); ?>
	
		<?php //echo $form->labelEx($model,'ruta_documento'); ?>
		<?php //echo $form->textField($model,'ruta_documento',array('size'=>60,'maxlength'=>100)); ?>
		<?php //echo $form->error($model,'ruta_documento'); ?>
	
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>


		<?php //echo $form->labelEx($model,'usuario_destino'); ?>
		<?php echo $form->hiddenField($model,'usuario_destino',array('id'=>'usuario_destino', 'value'=>1)); ?>
		<?php echo $form->error($model,'usuario_destino'); ?>

		<?php //echo $form->labelEx($model,'grupo_destino'); ?>
		<?php echo $form->hiddenField($model,'grupo_destino',array('id'=>'grupo_destino')); ?>
		<?php echo $form->error($model,'grupo_destino'); ?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->