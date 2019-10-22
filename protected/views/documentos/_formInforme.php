<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<script type="text/javascript">


function destinatario(valor1, valor2, valor3){	

	$("#destinatario_nombres").val(valor1);
	$("#destinatario_cargo").val(valor2);
	$("#usuario_destino").val(valor3);
}

function via(valor1, valor2){	

	var nombres=$("#via_nombres").val();
	var cargo=$("#via_cargo").val();

	if (nombres=='' && cargo=='') 
	{
		$("#via_nombres").val(valor1);
		$("#via_cargo").val(valor2);		
	}
	else{
		nombres=nombres+';'+valor1;
		cargo=cargo+';'+valor2;
		$("#via_nombres").val(nombres);
		$("#via_cargo").val(cargo);
	}
}
</script>

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
                <h3 class="card-title">Todos los campos con * son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
	              <div class="card-footer" style="background: #E6E6E6;">
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

	              	<!-- text input -->
	                  <div class="form-group">
						 <label>
						</label>
						<?php echo $form->labelEx($model,'CITE'); ?>
						<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>100,'class'=>'form-control', 'readonly'=>true)); ?>
						<?php echo $form->error($model,'codigo'); ?>
	                  </div>

	                  
	                <div class="row">  
	              	<div class="col-md-6">
	              		<div class="card-body">
	              			  
								<?php //echo $form->labelEx($model,'destinatario_titulo'); ?>
								<?php //echo $form->textField($model,'destinatario_titulo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'destinatario_titulo'); ?>
			                  
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_nombres'); ?>
								</label>
								<?php echo $form->textField($model,'destinatario_nombres',array('size'=>60,'maxlength'=>2000,'class'=>'form-control','id'=>'destinatario_nombres')); ?>
								<?php echo $form->error($model,'destinatario_nombres'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_cargo'); ?>
								</label>
								<?php echo $form->textField($model,'destinatario_cargo',array('size'=>60,'maxlength'=>2000,'class'=>'form-control','id'=>'destinatario_cargo')); ?>
								<?php echo $form->error($model,'destinatario_cargo'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'vía_nombres'); ?>
								</label>
								<?php echo $form->textArea($model,'via_nombres',array('rows'=>2, 'cols'=>50,'class'=>'form-control','id'=>'via_nombres')); ?>
								<?php echo $form->error($model,'via_nombres'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'vía_cargo'); ?>
								</label>
								<?php echo $form->textArea($model,'via_cargo',array('rows'=>2, 'cols'=>50,'class'=>'form-control','id'=>'via_cargo')); ?>
								<?php echo $form->error($model,'via_cargo'); ?>
			                  </div>
			                  
								 
								<?php //echo $form->labelEx($model,'destinatario_institucion'); ?>
								
								<?php //echo $form->textField($model,'destinatario_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'destinatario_institucion'); ?>
			                  
			                  
			                  
								<?php //echo $form->labelEx($model,'remitente_institucion'); ?>
								
								<?php //echo $form->textField($model,'remitente_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'remitente_institucion'); ?>
			                  
	              		</div>
	              	</div>	<!-- col-md-6 -->

		              	<div class="col-md-6">
		              		<div class="card-body">

		              			<div class="card card-danger">
					              <div class="card-header">
					                <h3 class="card-title">Destinatarios.</h3>
					              </div>
					              <!-- /.card-header -->
					              <div class="card-body">

					              		<div class="card-body pad table-responsive"  style="height:330px; overflow:auto; border:1px solid lightgray; border-radius: 5px;">
		              
						                <table class="table table-bordered table-striped">
						                  <tr style="font-size: 14px;">
						              			<th align="center">Nombres</th>
						              			<th align="center">&Aacute;rea/Unidad</th>
						              			<th></th>
						              	  </tr>
						              	  <?php 

			  							$dataReader=Documentos::listadoDerivaciones();
									 	foreach($dataReader as $row) {
						              	  ?>
											   
											<tr  style="font-size: 12px;">
											  <td><?=$row["nombre"]?></td>
											  <td><?=$row["nombre_area"]?></td>
											  <td  width="30%">
											  <a onclick="javascript:destinatario('<?=$row['nombre_destino'] ?>','<?= $row['cargo_destino'] ?>','<?= $row['usuario_destino'] ?>');" style="text-decoration:none; color: white;font-size: 12px;" class='btn btn-primary'>Destino</a>
					            
					            			 <a onclick="javascript:via('<?=$row['nombre_destino'] ?>','<?=$row['cargo_destino'] ?>');" style="text-decoration:none; color: white;font-size: 12px;"  class='btn btn-success'>V&iacute;a</a>
    
											   </td>
											</tr>
											    
											<?php } ?>
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
					<?php echo $form->labelEx($model,'referencia'); ?>
					</label>
					<?php echo $form->textArea($model,'referencia',array('rows'=>2, 'cols'=>50,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'referencia'); ?>
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

                  	<?php 
					// codigo añadido para obtener los nombres y cargos de los responsblaes de area en caso de ser gerencia y/o unidad 

						if (Yii::app()->user->id_nivel==3 OR Yii::app()->user->id_nivel==1) {
							$id_usuario=Yii::app()->user->id_usuario;

							 $connection= Yii::app()->db;
	 						 $row=$connection->createCommand("SELECT nombre, cargo 
			 				   FROM alias WHERE fk_usuario=$id_usuario AND activo=1")->query()->read();
	 						 $remitente_nombre=ucwords(strtolower($row['nombre']));
	 						 $remitente_cargo=$row['cargo'];
							//echo "---->".$id_usuario;
						}
						else{
							$remitente_nombre=ucwords(strtolower($remitente->nombre));
							$remitente_cargo=$remitente->cargo;
						}

					?>



					 <i style="font-size: 14px;">En caso de existir m&aacute;s de un remitente es necesario separar los nombres con <b>';'</b> sin espacios</i> <br>	
					 <label>
					<?php echo $form->labelEx($model,'remitente_nombres'); ?>
					</label>

					<?php if ($model->isNewRecord) { ?>
					<?php echo $form->textField($model,'remitente_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control', 'value'=>$remitente_nombre)); ?>
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
						<?php echo $form->textField($model,'remitente_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control', 'value'=>$remitente_cargo)); ?>
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
                  
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'Estado Documento'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_estado_documento'); ?>
					<?php echo $form->dropDownList($model,'fk_estado_documento', $model->getListEstadoDocumento(),array('class'=>'form-control  select','options' => array('0'=>array('selected'=>true)))); ?>
					<?php echo $form->error($model,'fk_estado_documento'); ?>
                  </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer" style="background: #E6E6E6;">
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