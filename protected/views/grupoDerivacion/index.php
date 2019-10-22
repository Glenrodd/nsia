<?php
/* @var $this GrupoDerivacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Grupo Derivacions',
);

$this->menu=array(
	array('label'=>'Create GrupoDerivacion', 'url'=>array('create')),
	array('label'=>'Manage GrupoDerivacion', 'url'=>array('admin')),
);
?>

<h1>Grupo Derivacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
