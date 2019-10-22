<?php
/* @var $this CorrelativosController */
/* @var $model Correlativos */

$this->breadcrumbs=array(
	'Correlativoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Correlativos', 'url'=>array('index')),
	array('label'=>'Manage Correlativos', 'url'=>array('admin')),
);
?>

<h1>Create Correlativos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>