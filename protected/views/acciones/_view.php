<?php
/* @var $this AccionesController */
/* @var $data Acciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_accion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_accion), array('view', 'id'=>$data->id_accion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accion')); ?>:</b>
	<?php echo CHtml::encode($data->accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observacion')); ?>:</b>
	<?php echo CHtml::encode($data->observacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>