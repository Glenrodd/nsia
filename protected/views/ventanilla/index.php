<?php
/* @var $this VentanillaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ventanillas',
);

$this->menu=array(
	array('label'=>'Create Ventanilla', 'url'=>array('create')),
	array('label'=>'Manage Ventanilla', 'url'=>array('admin')),
);
?>

<h1>Ventanillas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
