<?php
/* @var $this DetalleGrupoDerivacionController */
/* @var $data DetalleGrupoDerivacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_detalle_grupo_derivacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_detalle_grupo_derivacion), array('view', 'id'=>$data->id_detalle_grupo_derivacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_grupo_derivacion')); ?>:</b>
	<?php echo CHtml::encode($data->fk_grupo_derivacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_origen')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />


</div>