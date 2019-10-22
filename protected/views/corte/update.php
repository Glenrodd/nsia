<?php
/* @var $this CorteController */
/* @var $model Corte */

$this->breadcrumbs=array(
	'Cortes'=>array('index'),
	$model->id_corte=>array('view','id'=>$model->id_corte),
	'Update',
);

$this->menu=array(
	array('label'=>'List Corte', 'url'=>array('index')),
	array('label'=>'Create Corte', 'url'=>array('create')),
	array('label'=>'View Corte', 'url'=>array('view', 'id'=>$model->id_corte)),
	array('label'=>'Manage Corte', 'url'=>array('admin')),
);
?>

<h1>Update Corte <?php echo $model->id_corte; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>