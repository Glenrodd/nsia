<?php
/* @var $this InstitucionRemitenteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Institucion Remitentes',
);

$this->menu=array(
	array('label'=>'Create InstitucionRemitente', 'url'=>array('create')),
	array('label'=>'Manage InstitucionRemitente', 'url'=>array('admin')),
);
?>

<h1>Institucion Remitentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
