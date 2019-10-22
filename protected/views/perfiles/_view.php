<?php
/* @var $this PerfilesController */
/* @var $data Perfiles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_perfil')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_perfil), array('view', 'id'=>$data->id_perfil)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('perfil')); ?>:</b>
	<?php echo CHtml::encode($data->perfil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>