<?php
/* @var $this ListaDerivacionController */
/* @var $data ListaDerivacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lista_derivacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_lista_derivacion), array('view', 'id'=>$data->id_lista_derivacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_origen')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_destino')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_destino); ?>
	<br />


</div>