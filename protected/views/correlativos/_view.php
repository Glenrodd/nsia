<?php
/* @var $this CorrelativosController */
/* @var $data Correlativos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_correlativo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_correlativo), array('view', 'id'=>$data->id_correlativo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correlativo')); ?>:</b>
	<?php echo CHtml::encode($data->correlativo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gestion')); ?>:</b>
	<?php echo CHtml::encode($data->gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_correlativo')); ?>:</b>
	<?php echo CHtml::encode($data->fk_correlativo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_area')); ?>:</b>
	<?php echo CHtml::encode($data->fk_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_regional')); ?>:</b>
	<?php echo CHtml::encode($data->fk_regional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_tipo_documento')); ?>:</b>
	<?php echo CHtml::encode($data->fk_tipo_documento); ?>
	<br />

	*/ ?>

</div>