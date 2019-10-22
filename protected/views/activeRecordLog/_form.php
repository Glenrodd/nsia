<?php
/* @var $this ActiveRecordLogController */
/* @var $model ActiveRecordLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'active-record-log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'model'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idmodel'); ?>
		<?php echo $form->textField($model,'idmodel'); ?>
		<?php echo $form->error($model,'idmodel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field'); ?>
		<?php echo $form->textField($model,'field',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'field'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creationdate'); ?>
		<?php echo $form->textField($model,'creationdate'); ?>
		<?php echo $form->error($model,'creationdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php echo $form->textField($model,'userid',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'old_value'); ?>
		<?php echo $form->textField($model,'old_value',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'old_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_value'); ?>
		<?php echo $form->textField($model,'new_value',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'new_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->