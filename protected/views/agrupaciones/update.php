<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */

$this->breadcrumbs=array(
	'Agrupaciones'=>array('index'),
	$model->id_agrupacion=>array('view','id'=>$model->id_agrupacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Agrupaciones', 'url'=>array('index')),
	array('label'=>'Create Agrupaciones', 'url'=>array('create')),
	array('label'=>'View Agrupaciones', 'url'=>array('view', 'id'=>$model->id_agrupacion)),
	array('label'=>'Manage Agrupaciones', 'url'=>array('admin')),
);
?>

<h1>Update Agrupaciones <?php echo $model->id_agrupacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>