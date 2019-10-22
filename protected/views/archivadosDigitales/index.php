<?php
/* @var $this ArchivadosDigitalesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Archivados Digitales',
);

$this->menu=array(
	array('label'=>'Create ArchivadosDigitales', 'url'=>array('create')),
	array('label'=>'Manage ArchivadosDigitales', 'url'=>array('admin')),
);
?>

<h1>Archivados Digitales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
