<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	$model->id_documento,
);

$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Create Documentos', 'url'=>array('create')),
	array('label'=>'Update Documentos', 'url'=>array('update', 'id'=>$model->id_documento)),
	array('label'=>'Delete Documentos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_documento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);
?>

<h1>View Documentos #<?php echo $model->id_documento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_documento',
		'codigo',
		'destinatario_titulo',
		'destinatario_nombres',
		'destinatario_cargo',
		'destinatario_institucion',
		'remitente_nombres',
		'remitente_cargo',
		'remitente_institucion',
		'referencia',
		'contenido',
		'fecha',
		'hora',
		'adjuntos',
		'copias',
		'via_nombres',
		'via_cargo',
		'nro_hojas',
		'gestion',
		'fecha_registro',
		'hora_registro',
		'fk_usuario',
		'fk_tipo_documento',
		'fk_estado_documento',
		'fk_area',
		'fk_documento',
		'ruta_documento',
		'activo',
	),
)); ?>
