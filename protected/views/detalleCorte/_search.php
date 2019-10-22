<?php
/* @var $this DetalleCorteController */
/* @var $model DetalleCorte */
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
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'derivado_por'); ?>
		<?php echo $form->textField($model,'derivado_por'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'derivado_a'); ?>
		<?php echo $form->textField($model,'derivado_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proveido'); ?>
		<?php echo $form->textArea($model,'proveido',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_derivacion'); ?>
		<?php echo $form->textField($model,'fecha_derivacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_derivacion'); ?>
		<?php echo $form->textField($model,'hora_derivacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_recepcion'); ?>
		<?php echo $form->textField($model,'fecha_recepcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_recepcion'); ?>
		<?php echo $form->textField($model,'hora_recepcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_accion'); ?>
		<?php echo $form->textField($model,'fk_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_estado'); ?>
		<?php echo $form->textField($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'padre'); ?>
		<?php echo $form->textField($model,'padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oficial'); ?>
		<?php echo $form->textField($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hijo'); ?>
		<?php echo $form->textField($model,'hijo',array('size'=>45,'maxlength'=>45)); ?>
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
		<?php echo $form->label($model,'gestion'); ?>
		<?php echo $form->textField($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmado'); ?>
		<?php echo $form->textField($model,'confirmado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_corte'); ?>
		<?php echo $form->textField($model,'fk_corte'); ?>
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