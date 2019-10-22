<?php
/* @var $this DetalleGrupoDerivacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalle Grupo Derivacions',
);

$this->menu=array(
	array('label'=>'Create DetalleGrupoDerivacion', 'url'=>array('create')),
	array('label'=>'Manage DetalleGrupoDerivacion', 'url'=>array('admin')),
);
?>

<h1>Detalle Grupo Derivacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
