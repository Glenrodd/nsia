<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	$model->id_seguimiento=>array('view','id'=>$model->id_seguimiento),
	'Update',
);

$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Create Seguimientos', 'url'=>array('create')),
	array('label'=>'View Seguimientos', 'url'=>array('view', 'id'=>$model->id_seguimiento)),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);
?>

<h1>Update Seguimientos <?php echo $model->id_seguimiento; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>