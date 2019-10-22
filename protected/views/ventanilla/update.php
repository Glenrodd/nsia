<?php
/* @var $this VentanillaController */
/* @var $model Ventanilla */

$this->breadcrumbs=array(
	'Ventanillas'=>array('index'),
	$model->id_ventanilla=>array('view','id'=>$model->id_ventanilla),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ventanilla', 'url'=>array('index')),
	array('label'=>'Create Ventanilla', 'url'=>array('create')),
	array('label'=>'View Ventanilla', 'url'=>array('view', 'id'=>$model->id_ventanilla)),
	array('label'=>'Manage Ventanilla', 'url'=>array('admin')),
);
?>

<h1>Update Ventanilla <?php echo $model->id_ventanilla; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>