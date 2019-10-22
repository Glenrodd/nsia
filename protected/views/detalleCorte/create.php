<?php
/* @var $this DetalleCorteController */
/* @var $model DetalleCorte */

$this->breadcrumbs=array(
	'Detalle Cortes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DetalleCorte', 'url'=>array('index')),
	array('label'=>'Manage DetalleCorte', 'url'=>array('admin')),
);
?>

<h1>Create DetalleCorte</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>