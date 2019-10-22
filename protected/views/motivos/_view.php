<?php
/* @var $this MotivosController */
/* @var $data Motivos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_motivo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_motivo), array('view', 'id'=>$data->id_motivo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo')); ?>:</b>
	<?php echo CHtml::encode($data->motivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>