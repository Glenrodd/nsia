<?php
/* @var $this ListaDerivacionController */
/* @var $model ListaDerivacion */

$this->breadcrumbs=array(
	'Lista Derivacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ListaDerivacion', 'url'=>array('index')),
	array('label'=>'Manage ListaDerivacion', 'url'=>array('admin')),
);
?>

<h1>Create ListaDerivacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>