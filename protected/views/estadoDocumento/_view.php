<?php
/* @var $this EstadoDocumentoController */
/* @var $data EstadoDocumento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado_documento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_estado_documento), array('view', 'id'=>$data->id_estado_documento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_documento')); ?>:</b>
	<?php echo CHtml::encode($data->estado_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>