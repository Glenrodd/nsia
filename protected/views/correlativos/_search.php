<?php
/* @var $this CorrelativosController */
/* @var $model Correlativos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_correlativo'); ?>
		<?php echo $form->textField($model,'id_correlativo'); ?>
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
		<?php echo $form->label($model,'fk_correlativo'); ?>
		<?php echo $form->textField($model,'fk_correlativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_area'); ?>
		<?php echo $form->textField($model,'fk_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_regional'); ?>
		<?php echo $form->textField($model,'fk_regional'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_tipo_documento'); ?>
		<?php echo $form->textField($model,'fk_tipo_documento'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->