<?php
/* @var $this CorrelativosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Correlativoses',
);

$this->menu=array(
	array('label'=>'Create Correlativos', 'url'=>array('create')),
	array('label'=>'Manage Correlativos', 'url'=>array('admin')),
);
?>

<h1>Correlativoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
