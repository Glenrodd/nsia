<?php
/* @var $this NivelesController */
/* @var $data Niveles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_nivel')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_nivel), array('view', 'id'=>$data->id_nivel)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nivel')); ?>:</b>
	<?php echo CHtml::encode($data->nivel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>