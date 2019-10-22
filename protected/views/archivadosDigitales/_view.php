<?php
/* @var $this ArchivadosDigitalesController */
/* @var $data ArchivadosDigitales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_archivado_digital')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_archivado_digital), array('view', 'id'=>$data->id_archivado_digital)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->hora_archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lugar')); ?>:</b>
	<?php echo CHtml::encode($data->lugar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_seguimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fk_seguimiento); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>