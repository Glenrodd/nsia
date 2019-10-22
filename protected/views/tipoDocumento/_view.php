<?php
/* @var $this TipoDocumentoController */
/* @var $data TipoDocumento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_documento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tipo_documento), array('view', 'id'=>$data->id_tipo_documento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_documento')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_documento); ?>
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