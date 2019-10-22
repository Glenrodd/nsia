<?php
/* @var $this AliasController */
/* @var $model Alias */

$this->breadcrumbs=array(
	'Aliases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Alias', 'url'=>array('index')),
	array('label'=>'Manage Alias', 'url'=>array('admin')),
);
?>

<h1>Create Alias</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'id'=>$id)); ?>