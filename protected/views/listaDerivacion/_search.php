<?php
/* @var $this ListaDerivacionController */
/* @var $model ListaDerivacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_lista_derivacion'); ?>
		<?php echo $form->textField($model,'id_lista_derivacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_origen'); ?>
		<?php echo $form->textField($model,'usuario_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_destino'); ?>
		<?php echo $form->textField($model,'usuario_destino'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->