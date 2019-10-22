<?php
/* @var $this RegionalesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Regionales',
);

$this->menu=array(
	array('label'=>'Create Regionales', 'url'=>array('create')),
	array('label'=>'Manage Regionales', 'url'=>array('admin')),
);
?>

<h1>Regionales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
