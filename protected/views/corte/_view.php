<?php
/* @var $this CorteController */
/* @var $data Corte */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_corte')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_corte), array('view', 'id'=>$data->id_corte)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_corte')); ?>:</b>
	<?php echo CHtml::encode($data->nro_corte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_corte')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_corte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>