<?php
/* @var $this ListaDerivacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lista Derivacions',
);

$this->menu=array(
	array('label'=>'Create ListaDerivacion', 'url'=>array('create')),
	array('label'=>'Manage ListaDerivacion', 'url'=>array('admin')),
);
?>

<h1>Lista Derivacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
