<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */

$this->breadcrumbs=array(
	'Agrupaciones'=>array('index'),
	$model->id_agrupacion,
);

$this->menu=array(
	array('label'=>'List Agrupaciones', 'url'=>array('index')),
	array('label'=>'Create Agrupaciones', 'url'=>array('create')),
	array('label'=>'Update Agrupaciones', 'url'=>array('update', 'id'=>$model->id_agrupacion)),
	array('label'=>'Delete Agrupaciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_agrupacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agrupaciones', 'url'=>array('admin')),
);
?>

<h1>View Agrupaciones #<?php echo $model->id_agrupacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_agrupacion',
		'nur_padre',
		'nur_hijo',
		'oficial',
		'fk_seguimiento_padre',
		'fk_seguimiento_hijo',
		'fk_usuario',
		'fecha_registro',
		'hora_registro',
		'activo',
	),
)); ?>
