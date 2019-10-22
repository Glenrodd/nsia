<?php
/* @var $this NombreCargoRemitenteController */
/* @var $model NombreCargoRemitente */

$this->breadcrumbs=array(
	'Nombre Cargo Remitentes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NombreCargoRemitente', 'url'=>array('index')),
	array('label'=>'Manage NombreCargoRemitente', 'url'=>array('admin')),
);
?>

<h1>Create NombreCargoRemitente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>