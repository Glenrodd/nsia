<?php
/* @var $this VentanillaController */
/* @var $model Ventanilla */

$this->breadcrumbs=array(
	'Ventanillas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ventanilla', 'url'=>array('index')),
	array('label'=>'Manage Ventanilla', 'url'=>array('admin')),
);
?>

<h1>Create Ventanilla</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>