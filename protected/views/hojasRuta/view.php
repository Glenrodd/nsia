<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */

$this->breadcrumbs=array(
	'Hojas Rutas'=>array('index'),
	$model->id_hoja_ruta,
);

$this->menu=array(
	array('label'=>'List HojasRuta', 'url'=>array('index')),
	array('label'=>'Create HojasRuta', 'url'=>array('create')),
	array('label'=>'Update HojasRuta', 'url'=>array('update', 'id'=>$model->id_hoja_ruta)),
	array('label'=>'Delete HojasRuta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_hoja_ruta),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HojasRuta', 'url'=>array('admin')),
);
?>

<h1>View HojasRuta #<?php echo $model->id_hoja_ruta; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_hoja_ruta',
		'nur',
		'codigo',
		'nro',
		'fecha',
		'hora',
		'proceso',
		'fecha_registro',
		'hora_registro',
		'fk_usuario',
		'gestion',
		'activo',
		'fk_documento',
	),
)); ?>
