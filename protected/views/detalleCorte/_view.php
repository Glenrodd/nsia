<?php
/* @var $this DetalleCorteController */
/* @var $data DetalleCorte */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_corte')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_corte), array('view', 'id'=>$data->id_corte)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('derivado_por')); ?>:</b>
	<?php echo CHtml::encode($data->derivado_por); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('derivado_a')); ?>:</b>
	<?php echo CHtml::encode($data->derivado_a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proveido')); ?>:</b>
	<?php echo CHtml::encode($data->proveido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_derivacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_derivacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_derivacion')); ?>:</b>
	<?php echo CHtml::encode($data->hora_derivacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_recepcion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_recepcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_recepcion')); ?>:</b>
	<?php echo CHtml::encode($data->hora_recepcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_accion')); ?>:</b>
	<?php echo CHtml::encode($data->fk_accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_estado')); ?>:</b>
	<?php echo CHtml::encode($data->fk_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('padre')); ?>:</b>
	<?php echo CHtml::encode($data->padre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oficial')); ?>:</b>
	<?php echo CHtml::encode($data->oficial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hijo')); ?>:</b>
	<?php echo CHtml::encode($data->hijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gestion')); ?>:</b>
	<?php echo CHtml::encode($data->gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmado')); ?>:</b>
	<?php echo CHtml::encode($data->confirmado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_corte')); ?>:</b>
	<?php echo CHtml::encode($data->fk_corte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>