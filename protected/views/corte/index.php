<?php
/* @var $this CorteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cortes',
);

$this->menu=array(
	array('label'=>'Create Corte', 'url'=>array('create')),
	array('label'=>'Manage Corte', 'url'=>array('admin')),
);
?>

<h1>Cortes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
