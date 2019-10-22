<?php
/* @var $this VentanillaController */
/* @var $model Ventanilla */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ventanilla-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_ventanilla'); ?>
		<?php echo $form->textField($model,'id_ventanilla'); ?>
		<?php echo $form->error($model,'id_ventanilla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correlativo'); ?>
		<?php echo $form->textField($model,'correlativo'); ?>
		<?php echo $form->error($model,'correlativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gestion'); ?>
		<?php echo $form->textField($model,'gestion'); ?>
		<?php echo $form->error($model,'gestion'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'fk_regional'); ?>
		<?php echo $form->textField($model,'fk_regional'); ?>
		<?php echo $form->error($model,'fk_regional'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sigla'); ?>
		<?php echo $form->textField($model,'sigla',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sigla'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->