<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agrupaciones-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nur_padre'); ?>
		<?php echo $form->textField($model,'nur_padre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nur_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nur_hijo'); ?>
		<?php echo $form->textField($model,'nur_hijo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nur_hijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oficial'); ?>
		<?php echo $form->textField($model,'oficial'); ?>
		<?php echo $form->error($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_seguimiento_padre'); ?>
		<?php echo $form->textField($model,'fk_seguimiento_padre'); ?>
		<?php echo $form->error($model,'fk_seguimiento_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_seguimiento_hijo'); ?>
		<?php echo $form->textField($model,'fk_seguimiento_hijo'); ?>
		<?php echo $form->error($model,'fk_seguimiento_hijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_usuario'); ?>
		<?php echo $form->textField($model,'fk_usuario'); ?>
		<?php echo $form->error($model,'fk_usuario'); ?>
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
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->