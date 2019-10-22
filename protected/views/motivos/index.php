<?php
/* @var $this MotivosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Motivoses',
);

$this->menu=array(
	array('label'=>'Create Motivos', 'url'=>array('create')),
	array('label'=>'Manage Motivos', 'url'=>array('admin')),
);
?>

<h1>Motivoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
