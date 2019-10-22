<?php
/* @var $this CorteController */
/* @var $model Corte */

$this->breadcrumbs=array(
	'Cortes'=>array('index'),
	$model->id_corte,
);

$this->menu=array(
	array('label'=>'List Corte', 'url'=>array('index')),
	array('label'=>'Create Corte', 'url'=>array('create')),
	array('label'=>'Update Corte', 'url'=>array('update', 'id'=>$model->id_corte)),
	array('label'=>'Delete Corte', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_corte),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Corte', 'url'=>array('admin')),
);
?>

<h1>View Corte #<?php echo $model->id_corte; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_corte',
		'nro_corte',
		'fecha_corte',
		'descripcion',
		'fecha_registro',
		'hora_registro',
		'fk_usuario',
		'activo',
	),
)); ?>
