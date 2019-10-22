<?php
/* @var $this RegionalesController */
/* @var $data Regionales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_regional')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_regional), array('view', 'id'=>$data->id_regional)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regional')); ?>:</b>
	<?php echo CHtml::encode($data->regional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sigla')); ?>:</b>
	<?php echo CHtml::encode($data->sigla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>