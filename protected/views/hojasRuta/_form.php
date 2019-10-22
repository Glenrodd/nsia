<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hojas-ruta-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_hoja_ruta'); ?>
		<?php echo $form->textField($model,'id_hoja_ruta'); ?>
		<?php echo $form->error($model,'id_hoja_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nur'); ?>
		<?php echo $form->textField($model,'nur',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nur'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nro'); ?>
		<?php echo $form->textField($model,'nro'); ?>
		<?php echo $form->error($model,'nro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora'); ?>
		<?php echo $form->textField($model,'hora'); ?>
		<?php echo $form->error($model,'hora'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proceso'); ?>
		<?php echo $form->textField($model,'proceso'); ?>
		<?php echo $form->error($model,'proceso'); ?>
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
		<?php echo $form->labelEx($model,'gestion'); ?>
		<?php echo $form->textField($model,'gestion'); ?>
		<?php echo $form->error($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_documento'); ?>
		<?php echo $form->textField($model,'fk_documento'); ?>
		<?php echo $form->error($model,'fk_documento'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->