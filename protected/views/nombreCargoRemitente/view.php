<?php
/* @var $this NombreCargoRemitenteController */
/* @var $model NombreCargoRemitente */

$this->breadcrumbs=array(
	'Nombre Cargo Remitentes'=>array('index'),
	$model->id_nombre_cargo_remitente,
);

$this->menu=array(
	array('label'=>'List NombreCargoRemitente', 'url'=>array('index')),
	array('label'=>'Create NombreCargoRemitente', 'url'=>array('create')),
	array('label'=>'Update NombreCargoRemitente', 'url'=>array('update', 'id'=>$model->id_nombre_cargo_remitente)),
	array('label'=>'Delete NombreCargoRemitente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_nombre_cargo_remitente),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NombreCargoRemitente', 'url'=>array('admin')),
);
?>

<h1>View NombreCargoRemitente #<?php echo $model->id_nombre_cargo_remitente; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_nombre_cargo_remitente',
		'nombre_remitente',
		'cargo_remitente',
		'descripcion',
		'activo',
	),
)); ?>
