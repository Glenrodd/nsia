<?php
/* @var $this CorteController */
/* @var $model Corte */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_corte'); ?>
		<?php echo $form->textField($model,'id_corte'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nro_corte'); ?>
		<?php echo $form->textField($model,'nro_corte'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_corte'); ?>
		<?php echo $form->textField($model,'fecha_corte'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>500)); ?>
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
		<?php echo $form->label($model,'fk_usuario'); ?>
		<?php echo $form->textField($model,'fk_usuario'); ?>
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