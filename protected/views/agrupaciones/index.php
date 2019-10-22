<?php
/* @var $this AgrupacionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Agrupaciones',
);

$this->menu=array(
	array('label'=>'Create Agrupaciones', 'url'=>array('create')),
	array('label'=>'Manage Agrupaciones', 'url'=>array('admin')),
);
?>

<h1>Agrupaciones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
