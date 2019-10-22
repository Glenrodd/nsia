<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */

$this->breadcrumbs=array(
	'Hojas Rutas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HojasRuta', 'url'=>array('index')),
	array('label'=>'Manage HojasRuta', 'url'=>array('admin')),
);
?>

<h1>Create HojasRuta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>