<?php
/* @var $this UsuariosController */
/* @var $data Usuarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_usuario), array('view', 'id'=>$data->id_usuario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo')); ?>:</b>
	<?php echo CHtml::encode($data->cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario')); ?>:</b>
	<?php echo CHtml::encode($data->usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo')); ?>:</b>
	<?php echo CHtml::encode($data->correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mosca')); ?>:</b>
	<?php echo CHtml::encode($data->mosca); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_perfil')); ?>:</b>
	<?php echo CHtml::encode($data->fk_perfil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_regional')); ?>:</b>
	<?php echo CHtml::encode($data->fk_regional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_area')); ?>:</b>
	<?php echo CHtml::encode($data->fk_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_nivel')); ?>:</b>
	<?php echo CHtml::encode($data->fk_nivel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_password')); ?>:</b>
	<?php echo CHtml::encode($data->update_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>