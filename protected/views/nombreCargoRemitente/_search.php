<?php
/* @var $this NombreCargoRemitenteController */
/* @var $model NombreCargoRemitente */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_nombre_cargo_remitente'); ?>
		<?php echo $form->textField($model,'id_nombre_cargo_remitente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_remitente'); ?>
		<?php echo $form->textField($model,'nombre_remitente',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cargo_remitente'); ?>
		<?php echo $form->textField($model,'cargo_remitente',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
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