<?php
/* @var $this InstitucionRemitenteController */
/* @var $data InstitucionRemitente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_institucion_remitente')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_institucion_remitente), array('view', 'id'=>$data->id_institucion_remitente)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('institucion_remitente')); ?>:</b>
	<?php echo CHtml::encode($data->institucion_remitente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>