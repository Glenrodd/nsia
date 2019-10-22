<?php
/* @var $this CorteController */
/* @var $model Corte */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'corte-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nro_corte'); ?>
		<?php echo $form->textField($model,'nro_corte'); ?>
		<?php echo $form->error($model,'nro_corte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_corte'); ?>
		<?php echo $form->textField($model,'fecha_corte'); ?>
		<?php echo $form->error($model,'fecha_corte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
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
		<?php echo $form->labelEx($model,'fk_usuario'); ?>
		<?php echo $form->textField($model,'fk_usuario'); ?>
		<?php echo $form->error($model,'fk_usuario'); ?>
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