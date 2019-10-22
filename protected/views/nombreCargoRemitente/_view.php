<?php
/* @var $this NombreCargoRemitenteController */
/* @var $data NombreCargoRemitente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_nombre_cargo_remitente')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_nombre_cargo_remitente), array('view', 'id'=>$data->id_nombre_cargo_remitente)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_remitente')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_remitente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo_remitente')); ?>:</b>
	<?php echo CHtml::encode($data->cargo_remitente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>