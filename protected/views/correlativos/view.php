<?php
/* @var $this CorrelativosController */
/* @var $model Correlativos */

$this->breadcrumbs=array(
	'Correlativoses'=>array('index'),
	$model->id_correlativo,
);

$this->menu=array(
	array('label'=>'List Correlativos', 'url'=>array('index')),
	array('label'=>'Create Correlativos', 'url'=>array('create')),
	array('label'=>'Update Correlativos', 'url'=>array('update', 'id'=>$model->id_correlativo)),
	array('label'=>'Delete Correlativos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_correlativo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Correlativos', 'url'=>array('admin')),
);
?>

<h1>View Correlativos #<?php echo $model->id_correlativo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_correlativo',
		'correlativo',
		'gestion',
		'fk_correlativo',
		'fk_area',
		'fk_regional',
		'activo',
		'fk_tipo_documento',
	),
)); ?>
