<?php
/* @var $this DetalleGrupoDerivacionController */
/* @var $model DetalleGrupoDerivacion */

$this->breadcrumbs=array(
	'Detalle Grupo Derivacions'=>array('index'),
	$model->id_detalle_grupo_derivacion,
);

$this->menu=array(
	array('label'=>'List DetalleGrupoDerivacion', 'url'=>array('index')),
	array('label'=>'Create DetalleGrupoDerivacion', 'url'=>array('create')),
	array('label'=>'Update DetalleGrupoDerivacion', 'url'=>array('update', 'id'=>$model->id_detalle_grupo_derivacion)),
	array('label'=>'Delete DetalleGrupoDerivacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_detalle_grupo_derivacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DetalleGrupoDerivacion', 'url'=>array('admin')),
);
?>

<h1>View DetalleGrupoDerivacion #<?php echo $model->id_detalle_grupo_derivacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_detalle_grupo_derivacion',
		'fk_grupo_derivacion',
		'usuario_origen',
		'activo',
	),
)); ?>
