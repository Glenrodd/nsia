<?php
/* @var $this DetalleCorteController */
/* @var $model DetalleCorte */

$this->breadcrumbs=array(
	'Detalle Cortes'=>array('index'),
	$model->id_corte,
);

$this->menu=array(
	array('label'=>'List DetalleCorte', 'url'=>array('index')),
	array('label'=>'Create DetalleCorte', 'url'=>array('create')),
	array('label'=>'Update DetalleCorte', 'url'=>array('update', 'id'=>$model->id_corte)),
	array('label'=>'Delete DetalleCorte', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_corte),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DetalleCorte', 'url'=>array('admin')),
);
?>

<h1>View DetalleCorte #<?php echo $model->id_corte; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_corte',
		'codigo',
		'derivado_por',
		'derivado_a',
		'proveido',
		'fecha_derivacion',
		'hora_derivacion',
		'fecha_recepcion',
		'hora_recepcion',
		'fk_accion',
		'fk_estado',
		'padre',
		'oficial',
		'hijo',
		'fecha_registro',
		'hora_registro',
		'gestion',
		'confirmado',
		'fk_corte',
		'activo',
	),
)); ?>
