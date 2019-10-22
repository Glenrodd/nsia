<?php
/* @var $this ActiveRecordLogController */
/* @var $data ActiveRecordLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::encode($data->action); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmodel')); ?>:</b>
	<?php echo CHtml::encode($data->idmodel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field')); ?>:</b>
	<?php echo CHtml::encode($data->field); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creationdate')); ?>:</b>
	<?php echo CHtml::encode($data->creationdate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::encode($data->userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('old_value')); ?>:</b>
	<?php echo CHtml::encode($data->old_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('new_value')); ?>:</b>
	<?php echo CHtml::encode($data->new_value); ?>
	<br />

	*/ ?>

</div>