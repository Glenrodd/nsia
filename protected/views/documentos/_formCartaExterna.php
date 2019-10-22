<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<head>
	<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
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
	$("#usuario_destino").val(valor3);
}


function remitente(valor1, valor2, valor3){	

	$("#remitente_nombres").val(valor1);
	$("#remitente_cargo").val(valor2);
	$("#remitente_institucion").val(valor3);
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
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
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
	           		echo CHtml::submitButton($model->isNewRecord ? 'Crear Carta y NUR' : 'Modificar Carta', array(
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
						<?php echo $form->labelEx($model,'CITE Original *'); ?>
						<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>100,'class'=>'form-control', 'style'=>'border: solid 1px #848484;')); ?>
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
								<?php echo $form->labelEx($model,'fecha de la carta *'); ?>
								</label>
								<?php //echo $form->textField($model,'fecha',array('class'=>'form-control')); ?>

								



								<?php

								if ($model->isNewRecord) {
									 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'model'=>$model,
										'name'=>'publishDate',
										'attribute'=>'fecha',
										'language' => 'es',
										

										'htmlOptions' => array('readonly'=>"readonly", 'class'=>'shadowdatepicker form-control','value'=>date('Y-m-d'), 'style'=>'border: solid 1px #848484;'),

										'options'=>array(
											
											'autoSize'=>true,
											'dateFormat'=>'yy-mm-dd',
											//'dateFormat'=>'dd/mm/yy',

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
											//'minDate'=>'date("Y-m-d")', 
											//'minDate'=>'-2m', 
											//'minDate'=>'2015-07-01', 
											'maxDate'=> "+20Y",
										),
									)); 
								} 
								else{

									 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'model'=>$model,
										'name'=>'publishDate',
										'attribute'=>'fecha',
										'language' => 'es',

										'htmlOptions' => array('readonly'=>"readonly", 'class'=>'shadowdatepicker form-control', 'style'=>'border: solid 1px #848484;'),

										'options'=>array(
											
											'autoSize'=>true,
											'dateFormat'=>'yy-mm-dd',
											//'dateFormat'=>'dd/mm/yy',

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
											//'minDate'=>'date("Y-m-d")', 
											//'minDate'=>'-2m', 
											//'minDate'=>'2015-07-01', 
											'maxDate'=> "+20Y",
										),
									)); 
									}?>


								<?php echo $form->error($model,'fecha'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'remitente *'); ?>
								</label>
								<?php echo $form->textField($model,'remitente_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'remitente_nombres', 'style'=>'border: solid 1px #848484;')); ?>
								
								<?php echo $form->error($model,'remitente_nombres'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'cargo remitente *'); ?>
								</label>
								<?php echo $form->textField($model,'remitente_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'remitente_cargo', 'style'=>'border: solid 1px #848484;')); ?>
								
								<?php echo $form->error($model,'remitente_cargo'); ?>
			                  </div>
			                   <div class="form-group">
								 <label>
								 	<?php echo $form->labelEx($model,'institución remitente *'); ?>
								</label>
									<?php echo $form->textField($model,'remitente_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'remitente_institucion', 'style'=>'border: solid 1px #848484;' )); ?>

								<?php echo $form->error($model,'remitente_institucion'); ?>
			                   </div>	 
			                  
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario *'); ?>
								</label>
								<?php 
									

								/*if ($model->isNewRecord) {
									$row=Documentos::getNamePresidencia();
									$nombre=$row['nombre'];
									$cargo=$row['cargo'];
									echo $form->textField($model,'destinatario_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_nombres','value'=>$nombre)); 
								}
								else{*/

									echo $form->textField($model,'destinatario_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_nombres', 'style'=>'border: solid 1px #848484;')); 
								//}

								?>
								<?php echo $form->error($model,'destinatario_nombres'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'cargo destinatario *'); ?>
								</label>
								<?php 
								/*if ($model->isNewRecord) {
									echo $form->textField($model,'destinatario_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_cargo','value'=>$cargo)); 
								}
								else{*/
									echo $form->textField($model,'destinatario_cargo',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_cargo', 'style'=>'border: solid 1px #848484;')); 
								//}	
								?>
								<?php echo $form->error($model,'destinatario_cargo'); ?>
			                  </div>
			                  <div class="form-group">
								 <label>
								<?php echo $form->labelEx($model,'destinatario_instituci&oacute;n *'); ?>
								</label>
								<?php 

									if ($model->isNewRecord) {
									$nombreInstitucion='Administradora Boliviana de Carreteras';	

									echo $form->textField($model,'destinatario_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_institucion', 'value'=>$nombreInstitucion, 'style'=>'border: solid 1px #848484;')); 
									}
									else{
										echo $form->textField($model,'destinatario_institucion',array('size'=>60,'maxlength'=>200,'class'=>'form-control','id'=>'destinatario_institucion', 'style'=>'border: solid 1px #848484;')); 	
									}
								?>
								<?php echo $form->error($model,'institucion destinatario'); ?>
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
					                <h3 class="card-title">Destinatario/Remitente.</h3>
					              </div>
					              <!-- /.card-header -->
					              <div class="card-body">

					              		<div class="card-body pad table-responsive"  style="height:500px; overflow:auto; border:1px solid lightgray; border-radius: 5px;">
		              
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
											  <td width="20%">


											  <a onclick="javascript:destinatario('<?=$row['nombre_destino'] ?>','<?= $row['cargo_destino'] ?>','<?= $row['usuario_destino'] ?>');" style="text-decoration:none; color: white;font-size: 12px;" class='btn btn-primary'>Destino</a>
    
											   </td>
											</tr>
											    
											<?php } ?>
						                </table>
						            </div>
						            <!--##########################################-->
						          <!--  <div class="card-body pad table-responsive" style="height:400px; overflow:auto;  border-radius: 5px;">


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

						           // $regional=Yii::app()->user->regional;
						         //	$dataReader=Documentos::getInstitucionRemitente(); 
						         ?>	
						         <?php // foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left">
						            		<? //=$row['nombre_remitente']?><br>
						            	<i><b><? //=$row['cargo_remitente']?><b></i>	
						            	
						            </td>
						            
						            <td align="left"><? //=$row['institucion_remitente']?></td>
						            <td>
						            	<a onclick="javascript:remitente('<? //=$row['nombre_remitente'] ?>','<? //= $row['cargo_remitente'] ?>','<? //= $row['institucion_remitente'] ?>');" style="text-decoration:none; color: white;font-size: 12px;" class='btn btn-info'>Remitente</a>
						            </td>
						            
						           </tr>
						         <?php // } ?>
						         </tbody>
						    	</table>
						            </div>-->





					                
					                   
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
						<?php echo $form->textArea($model,'referencia',array('rows'=>4, 'cols'=>50,'class'=>'form-control', 'style'=>'border: solid 1px #848484;')); ?>
						<?php echo $form->error($model,'referencia'); ?>
			      </div>
                  
                  
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'S&iacute;ntesis'); ?>
					</label>
					<?php echo $form->textArea($model,'contenido',array('rows'=>6, 'cols'=>50,'class'=>'form-control', 'style'=>'border: solid 1px #848484;')); ?>
					<?php echo $form->error($model,'contenido'); ?>
                  </div>


                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'Motivo'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_motivo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_motivo', $model->getListMotivo(), array('empty'=>'Seleccione Motivo','class'=>'form-control  select', 'style'=>'border: solid 1px #848484;')); ?>
					<?php echo $form->error($model,'fk_motivo'); ?>
                  </div>


                   <div class="form-group">
					<label>
						<?php echo $form->labelEx($model,'Subir Documento '); ?>
						<i>(Solo archivos PDF)</i>
					</label>
						<br>
						<?php 

							if (!$model->isNewRecord) { ?>
								
								<i style="font-size: 12px; color:#8A2908; " ><b>Archivo: </b><?=$model->ruta_documento?></i>

							<?php 

							//echo $form->textField($model,'ruta_documento',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); 
							}


							echo CHtml::activeFileField($model,'ruta_documento', array('class'=>'form-control', 'style'=>'border: solid 1px #848484;'));
						?>
						<?php echo $form->error($model,'ruta_documento'); ?>
			       </div>
                  
                  
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'adjuntos'); ?>
					</label>
					<?php echo $form->textField($model,'adjuntos',array('size'=>60,'maxlength'=>200,'class'=>'form-control', 'style'=>'border: solid 1px #848484;')); ?>
					<?php echo $form->error($model,'adjuntos'); ?>
                  </div>



                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'nro_hojas'); ?>
					</label>
					<?php echo $form->textField($model,'nro_hojas',array('size'=>60,'maxlength'=>200,'class'=>'form-control', 'style'=>'border: solid 1px #848484;')); ?>
					<?php echo $form->error($model,'nro_hojas'); ?>
                  </div>



                  
              </div>
              <!-- /.card-body -->

              <div class="card-footer" style="background: #E6E6E6;">
           		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear Carta y NUR' : 'Modificar Carta', array(
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
		<?php //echo $form->hiddenField($model,'nro_hojas',array('size'=>60,'maxlength'=>100)); ?>
		<?php //echo $form->error($model,'nro_hojas'); ?>
	
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
		<?php 

			if($model->isNewRecord)
			{
				echo $form->hiddenField($model,'fk_documento'); 
			}
			else{
				echo $form->hiddenField($model,'fk_documento', array('value'=>$model->ruta_documento)); 
			}
		?>
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