<?php
/* @var $this InstitucionRemitenteController */
/* @var $model InstitucionRemitente */

$this->breadcrumbs=array(
	'Institucion Remitentes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InstitucionRemitente', 'url'=>array('index')),
	array('label'=>'Manage InstitucionRemitente', 'url'=>array('admin')),
);
?>

<h1>Create InstitucionRemitente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>