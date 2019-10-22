<?php
/* @var $this VentanillaController */
/* @var $data Ventanilla */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ventanilla')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_ventanilla), array('view', 'id'=>$data->id_ventanilla)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correlativo')); ?>:</b>
	<?php echo CHtml::encode($data->correlativo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gestion')); ?>:</b>
	<?php echo CHtml::encode($data->gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_regional')); ?>:</b>
	<?php echo CHtml::encode($data->fk_regional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sigla')); ?>:</b>
	<?php echo CHtml::encode($data->sigla); ?>
	<br />


</div>