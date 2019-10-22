<?php
/* @var $this DetalleCorteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalle Cortes',
);

$this->menu=array(
	array('label'=>'Create DetalleCorte', 'url'=>array('create')),
	array('label'=>'Manage DetalleCorte', 'url'=>array('admin')),
);
?>

<h1>Detalle Cortes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
