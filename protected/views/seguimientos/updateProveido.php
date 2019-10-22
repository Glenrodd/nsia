<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>
<center>
<u>
<h4>ACTUALIZAR PROVE&Iacute;DO</h4>
</u>
</center>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	

                  <!-- text input -->
                  <div class="form-group">
        			<label style="vertical-align: top;"><b>
					<?php echo $form->labelEx($model,'Prove&iacute;do * :'); ?></b>
        			</label>
					<?php echo $form->textArea($model,'proveido',array('rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'proveido'); ?>
                  </div>

                  
              </div>
              <!-- /.card-body -->
              <br>
              <center>
              <div class="card-footer">
              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('class' => 'btn btn-info')); ?>
              </div>
              </center>
              <hr>

              <div class="card-body pad table-responsive">
			    	<center><i><b>NUR/NURI(s) <?=$model->codigo?></b></i></center>
					<table class="table table-bordered table-striped" cellpadding="3">
					  <tr style="font-size: 12px; background-color: #0489B1; color: white;">
						<th align="center">NUR/NURI</th>
						<th align="center">Fecha/Hora Derivaci&oacute;n</th>
						<th align="center">Derivado a</th>
						<th align="center">Prove&iacute;do</th>
						<th align="center">Estado</th>
						<th align="center">Tipo</th>
				    </tr>
				    <tr style="font-size: 12px; background-color: #E0F2F7;" >
				    	<td align="center"><?=$model->codigo?></td>
				    	<td align="center"><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($model->fecha_derivacion))?></td>
				    	<td align="center"><?=$model->fkUsuario->nombre?></td>
				    	<td><?=$model->proveido?></td>
				    	<td align="center"><?=$model->fkEstado->estado?></td>
				    	<td align="center"><?=$model->oficial==1?'Original':'Copia Digital';?></td>
				    	
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
		<?php echo $form->hiddenField($model,'derivado_a',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'derivado_a'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'proveido'); ?>
		
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