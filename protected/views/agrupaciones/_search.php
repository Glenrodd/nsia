<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_agrupacion'); ?>
		<?php echo $form->textField($model,'id_agrupacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nur_padre'); ?>
		<?php echo $form->textField($model,'nur_padre',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nur_hijo'); ?>
		<?php echo $form->textField($model,'nur_hijo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oficial'); ?>
		<?php echo $form->textField($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_seguimiento_padre'); ?>
		<?php echo $form->textField($model,'fk_seguimiento_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_seguimiento_hijo'); ?>
		<?php echo $form->textField($model,'fk_seguimiento_hijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_usuario'); ?>
		<?php echo $form->textField($model,'fk_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_registro'); ?>
		<?php echo $form->textField($model,'hora_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->