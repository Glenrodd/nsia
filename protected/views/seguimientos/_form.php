<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguimientos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'derivado_por'); ?>
		<?php echo $form->textField($model,'derivado_por'); ?>
		<?php echo $form->error($model,'derivado_por'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'derivado_a'); ?>
		<?php echo $form->textField($model,'derivado_a'); ?>
		<?php echo $form->error($model,'derivado_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proveido'); ?>
		<?php echo $form->textArea($model,'proveido',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'proveido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_derivacion'); ?>
		<?php echo $form->textField($model,'fecha_derivacion'); ?>
		<?php echo $form->error($model,'fecha_derivacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_derivacion'); ?>
		<?php echo $form->textField($model,'hora_derivacion'); ?>
		<?php echo $form->error($model,'hora_derivacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_recepcion'); ?>
		<?php echo $form->textField($model,'fecha_recepcion'); ?>
		<?php echo $form->error($model,'fecha_recepcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_recepcion'); ?>
		<?php echo $form->textField($model,'hora_recepcion'); ?>
		<?php echo $form->error($model,'hora_recepcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_accion'); ?>
		<?php echo $form->textField($model,'fk_accion'); ?>
		<?php echo $form->error($model,'fk_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_estado'); ?>
		<?php echo $form->textField($model,'fk_estado'); ?>
		<?php echo $form->error($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'padre'); ?>
		<?php echo $form->textField($model,'padre'); ?>
		<?php echo $form->error($model,'padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oficial'); ?>
		<?php echo $form->textField($model,'oficial'); ?>
		<?php echo $form->error($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hijo'); ?>
		<?php echo $form->textField($model,'hijo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'hijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
		<?php echo $form->error($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_registro'); ?>
		<?php echo $form->textField($model,'hora_registro'); ?>
		<?php echo $form->error($model,'hora_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gestion'); ?>
		<?php echo $form->textField($model,'gestion'); ?>
		<?php echo $form->error($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'confirmado'); ?>
		<?php echo $form->textField($model,'confirmado'); ?>
		<?php echo $form->error($model,'confirmado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->