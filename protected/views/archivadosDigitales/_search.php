<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_archivado_digital'); ?>
		<?php echo $form->textField($model,'id_archivado_digital'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_archivo'); ?>
		<?php echo $form->textField($model,'fecha_archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_archivo'); ?>
		<?php echo $form->textField($model,'hora_archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lugar'); ?>
		<?php echo $form->textField($model,'lugar',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observaciones'); ?>
		<?php echo $form->textField($model,'observaciones',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_usuario'); ?>
		<?php echo $form->textField($model,'fk_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_seguimiento'); ?>
		<?php echo $form->textField($model,'fk_seguimiento'); ?>
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
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->