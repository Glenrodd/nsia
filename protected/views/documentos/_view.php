<?php
/* @var $this DocumentosController */
/* @var $data Documentos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_documento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_documento), array('view', 'id'=>$data->id_documento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatario_titulo')); ?>:</b>
	<?php echo CHtml::encode($data->destinatario_titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatario_nombres')); ?>:</b>
	<?php echo CHtml::encode($data->destinatario_nombres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatario_cargo')); ?>:</b>
	<?php echo CHtml::encode($data->destinatario_cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatario_institucion')); ?>:</b>
	<?php echo CHtml::encode($data->destinatario_institucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remitente_nombres')); ?>:</b>
	<?php echo CHtml::encode($data->remitente_nombres); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('remitente_cargo')); ?>:</b>
	<?php echo CHtml::encode($data->remitente_cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remitente_institucion')); ?>:</b>
	<?php echo CHtml::encode($data->remitente_institucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referencia')); ?>:</b>
	<?php echo CHtml::encode($data->referencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contenido')); ?>:</b>
	<?php echo CHtml::encode($data->contenido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora')); ?>:</b>
	<?php echo CHtml::encode($data->hora); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adjuntos')); ?>:</b>
	<?php echo CHtml::encode($data->adjuntos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('copias')); ?>:</b>
	<?php echo CHtml::encode($data->copias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('via_nombres')); ?>:</b>
	<?php echo CHtml::encode($data->via_nombres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('via_cargo')); ?>:</b>
	<?php echo CHtml::encode($data->via_cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_hojas')); ?>:</b>
	<?php echo CHtml::encode($data->nro_hojas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gestion')); ?>:</b>
	<?php echo CHtml::encode($data->gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_registro')); ?>:</b>
	<?php echo CHtml::encode($data->hora_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fk_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_tipo_documento')); ?>:</b>
	<?php echo CHtml::encode($data->fk_tipo_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_estado_documento')); ?>:</b>
	<?php echo CHtml::encode($data->fk_estado_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_area')); ?>:</b>
	<?php echo CHtml::encode($data->fk_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_documento')); ?>:</b>
	<?php echo CHtml::encode($data->fk_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruta_documento')); ?>:</b>
	<?php echo CHtml::encode($data->ruta_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>