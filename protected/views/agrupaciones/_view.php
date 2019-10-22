<?php
/* @var $this AgrupacionesController */
/* @var $data Agrupaciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_agrupacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_agrupacion), array('view', 'id'=>$data->id_agrupacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nur_padre')); ?>:</b>
	<?php echo CHtml::encode($data->nur_padre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nur_hijo')); ?>:</b>
	<?php echo CHtml::encode($data->nur_hijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oficial')); ?>:</b>
	<?php echo CHtml::encode($data->oficial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_seguimiento_padre')); ?>:</b>
	<?php echo CHtml::encode($data->fk_seguimiento_padre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_seguimiento_hijo')); ?>:</b>
	<?php echo CHtml::encode($data->fk_seguimiento_hijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>