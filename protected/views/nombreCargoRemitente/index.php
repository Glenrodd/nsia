<?php
/* @var $this NombreCargoRemitenteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Nombre Cargo Remitentes',
);

$this->menu=array(
	array('label'=>'Create NombreCargoRemitente', 'url'=>array('create')),
	array('label'=>'Manage NombreCargoRemitente', 'url'=>array('admin')),
);
?>

<h1>Nombre Cargo Remitentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
