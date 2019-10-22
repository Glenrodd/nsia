<?php
/* @var $this VentanillaController */
/* @var $model Ventanilla */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_ventanilla'); ?>
		<?php echo $form->textField($model,'id_ventanilla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correlativo'); ?>
		<?php echo $form->textField($model,'correlativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gestion'); ?>
		<?php echo $form->textField($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_usuario'); ?>
		<?php echo $form->textField($model,'fk_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_regional'); ?>
		<?php echo $form->textField($model,'fk_regional'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sigla'); ?>
		<?php echo $form->textField($model,'sigla',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->