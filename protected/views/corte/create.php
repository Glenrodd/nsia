<?php
/* @var $this CorteController */
/* @var $model Corte */

$this->breadcrumbs=array(
	'Cortes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Corte', 'url'=>array('index')),
	array('label'=>'Manage Corte', 'url'=>array('admin')),
);
?>

<h1>Create Corte</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>