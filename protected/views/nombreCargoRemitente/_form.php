<?php
/* @var $this NombreCargoRemitenteController */
/* @var $model NombreCargoRemitente */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nombre-cargo-remitente-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_remitente'); ?>
		<?php echo $form->textField($model,'nombre_remitente',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'nombre_remitente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo_remitente'); ?>
		<?php echo $form->textField($model,'cargo_remitente',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'cargo_remitente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
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