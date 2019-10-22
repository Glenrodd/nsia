<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */

$this->breadcrumbs=array(
	'Agrupaciones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Agrupaciones', 'url'=>array('index')),
	array('label'=>'Manage Agrupaciones', 'url'=>array('admin')),
);
?>

<h1>Create Agrupaciones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>