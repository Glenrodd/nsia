<?php
/* @var $this EstadoDocumentoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estado Documentos',
);

$this->menu=array(
	array('label'=>'Create EstadoDocumento', 'url'=>array('create')),
	array('label'=>'Manage EstadoDocumento', 'url'=>array('admin')),
);
?>

<h1>Estado Documentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
