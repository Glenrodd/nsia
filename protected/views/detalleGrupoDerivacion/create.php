<?php
/* @var $this DetalleGrupoDerivacionController */
/* @var $model DetalleGrupoDerivacion */

$this->breadcrumbs=array(
	'Detalle Grupo Derivacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DetalleGrupoDerivacion', 'url'=>array('index')),
	array('label'=>'Manage DetalleGrupoDerivacion', 'url'=>array('admin')),
);
?>

<h1>Create DetalleGrupoDerivacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>