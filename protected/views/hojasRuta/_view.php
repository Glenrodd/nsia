<?php
/* @var $this HojasRutaController */
/* @var $data HojasRuta */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_hoja_ruta')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_hoja_ruta), array('view', 'id'=>$data->id_hoja_ruta)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nur')); ?>:</b>
	<?php echo CHtml::encode($data->nur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro')); ?>:</b>
	<?php echo CHtml::encode($data->nro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora')); ?>:</b>
	<?php echo CHtml::encode($data->hora); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proceso')); ?>:</b>
	<?php echo CHtml::encode($data->proceso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gestion')); ?>:</b>
	<?php echo CHtml::encode($data->gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_documento')); ?>:</b>
	<?php echo CHtml::encode($data->fk_documento); ?>
	<br />

	*/ ?>

</div>