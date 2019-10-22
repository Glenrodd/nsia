<?php
/* @var $this HojasRutaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hojas Rutas',
);

$this->menu=array(
	array('label'=>'Create HojasRuta', 'url'=>array('create')),
	array('label'=>'Manage HojasRuta', 'url'=>array('admin')),
);
?>

<h1>Hojas Rutas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
