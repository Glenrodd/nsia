<?php
/* @var $this DetalleGrupoDerivacionController */
/* @var $model DetalleGrupoDerivacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalle-grupo-derivacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_grupo_derivacion'); ?>
		<?php echo $form->textField($model,'fk_grupo_derivacion'); ?>
		<?php echo $form->error($model,'fk_grupo_derivacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario_origen'); ?>
		<?php echo $form->textField($model,'usuario_origen'); ?>
		<?php echo $form->error($model,'usuario_origen'); ?>
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