<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>
<h3>Actualizar Derivaci&oacute;n</h3>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguimientos-form',
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
                <h3 class="card-title">Los campos con * son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<a class="btn btn-app" href="index.php?r=seguimientos/adminCorregirDerivacion" style="color: black;">
                  <i class="fa fa-dedent"></i>Retornar Corregir Derivaci&oacute;n
                </a>

                  <!-- text input -->
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'Usuario Destino (<i>Derivado a</i>) * :'); ?>
        			</label>
					<?php //echo $form->textField($model,'derivado_a',array('class'=>'form-control')); ?>

					<?php
				// echo  $form->hiddenField($model,'fk_producto',array()); // Campo oculto para guardar el ID de la persona seleccionada
				echo $form->hiddenField($model,'derivado_a',array()); // Campo oculto para guardar el ID de la persona seleccionada
				$this->widget('zii.widgets.jui.CJuiAutoComplete',
				array(
					'name'=>'nombre_usuario', // Nombre para el campo de autocompletar
					'model'=>$model,
					'value'=>$model->isNewRecord ? '' : $model->fkUsuario->nombre.'  '.$model->fkUsuario->cargo.'',
					'source'=>$this->createUrl('Seguimientos/autocompleteUser'), // URL que genera el conjunto de datos
					'options'=> array(
					'showAnim'=>'fold',
					'size'=>'70',
					'minLength'=>'3', // Minimo de caracteres que hay que digitar antes de relizar la busqueda
					'select'=>"js:function(event, ui) { 

							$('#Seguimientos_derivado_a').val(ui.item.id); // HTML-Id del campo
						/*  $('#nombreModelo_llaveForanea').val(ui.item.id); // HTML-Id del campo */

						}"
					),
					'htmlOptions'=> array(
						'size'=>160,
						'placeholder'=>'Buscar Usuario...',
						'title'=>'Indique el nmbre de usuario para realizar la busqueda.'
						),
				));  
		?>
					<?php echo $form->error($model,'derivado_a'); ?>
					<i>Solo debe borrar el contenido registrado e ingresar el nuevo destinatario, el sistema autocompletara el dato</i>
                  </div>

                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('class' => 'btn btn-info')); ?>
              </div>
              <hr>

              <div class="card-body pad table-responsive">
			    	<center><i><b>NUR/NURI(s) <?=$model->codigo?></b></i></center>
					<table class="table table-bordered table-striped">
					  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
						<th align="center">NUR/NURI</th>
						<th align="center">Derivado por</th>
						<th align="center">Fecha/Hora Derivaci&oacute;n</th>
						<th align="center">Derivado a</th>
						<th align="center">Prove&iacute;do</th>
						<th align="center">Estado</th>
						<th align="center">Tipo</th>
				    </tr>
				    <tr style="font-size: 14px; background-color: #E0F2F7;">
				    	<td><?=$model->codigo?></td>
				    	<td><?=Seguimientos::getUsuario($model->derivado_por)?></td>
				    	<td><?=date("d/m/Y", strtotime($model->fecha_derivacion));?></td>
				    	<td><?=$model->fkUsuario->nombre?></td>
				    	<td><?=$model->proveido?></td>
				    	<td><?=$model->fkEstado->estado?></td>
				    	<td><?=$model->oficial==1?'Original':'Copia Digital';?></td>
				    	
				    </tr>
				</table>
							
			    </div>





            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>



	<div class="row">
		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'derivado_por'); ?>
		<?php echo $form->hiddenField($model,'derivado_por'); ?>
		<?php echo $form->error($model,'derivado_por'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'proveido'); ?>
		<?php echo $form->hiddenField($model,'proveido',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'proveido'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_derivacion'); ?>
		<?php echo $form->hiddenField($model,'fecha_derivacion'); ?>
		<?php echo $form->error($model,'fecha_derivacion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_derivacion'); ?>
		<?php echo $form->hiddenField($model,'hora_derivacion'); ?>
		<?php echo $form->error($model,'hora_derivacion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_recepcion'); ?>
		<?php echo $form->hiddenField($model,'fecha_recepcion'); ?>
		<?php echo $form->error($model,'fecha_recepcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_recepcion'); ?>
		<?php echo $form->hiddenField($model,'hora_recepcion'); ?>
		<?php echo $form->error($model,'hora_recepcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_accion'); ?>
		<?php echo $form->hiddenField($model,'fk_accion'); ?>
		<?php echo $form->error($model,'fk_accion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_estado'); ?>
		<?php echo $form->hiddenField($model,'fk_estado'); ?>
		<?php echo $form->error($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'padre'); ?>
		<?php echo $form->hiddenField($model,'padre'); ?>
		<?php echo $form->error($model,'padre'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'oficial'); ?>
		<?php echo $form->hiddenField($model,'oficial'); ?>
		<?php echo $form->error($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hijo'); ?>
		<?php echo $form->hiddenField($model,'hijo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'hijo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php echo $form->hiddenField($model,'fecha_registro'); ?>
		<?php echo $form->error($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php echo $form->hiddenField($model,'hora_registro'); ?>
		<?php echo $form->error($model,'hora_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php echo $form->hiddenField($model,'gestion'); ?>
		<?php echo $form->error($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'confirmado'); ?>
		<?php echo $form->hiddenField($model,'confirmado'); ?>
		<?php echo $form->error($model,'confirmado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->