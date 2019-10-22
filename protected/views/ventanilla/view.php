<?php
/* @var $this VentanillaController */
/* @var $model Ventanilla */

$this->breadcrumbs=array(
	'Ventanillas'=>array('index'),
	$model->id_ventanilla,
);

$this->menu=array(
	array('label'=>'List Ventanilla', 'url'=>array('index')),
	array('label'=>'Create Ventanilla', 'url'=>array('create')),
	array('label'=>'Update Ventanilla', 'url'=>array('update', 'id'=>$model->id_ventanilla)),
	array('label'=>'Delete Ventanilla', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_ventanilla),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ventanilla', 'url'=>array('admin')),
);
?>

<h1>View Ventanilla #<?php echo $model->id_ventanilla; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_ventanilla',
		'correlativo',
		'gestion',
		'fk_usuario',
		'activo',
		'fk_regional',
		'sigla',
	),
)); ?>
