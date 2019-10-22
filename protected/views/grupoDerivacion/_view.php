<?php
/* @var $this GrupoDerivacionController */
/* @var $data GrupoDerivacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_grupo_derivacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_grupo_derivacion), array('view', 'id'=>$data->id_grupo_derivacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_grupo')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_grupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_area')); ?>:</b>
	<?php echo CHtml::encode($data->fk_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_regional')); ?>:</b>
	<?php echo CHtml::encode($data->fk_regional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>