<?php
/* @var $this DetalleGrupoDerivacionController */
/* @var $model DetalleGrupoDerivacion */

$this->breadcrumbs=array(
	'Detalle Grupo Derivacions'=>array('index'),
	$model->id_detalle_grupo_derivacion=>array('view','id'=>$model->id_detalle_grupo_derivacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List DetalleGrupoDerivacion', 'url'=>array('index')),
	array('label'=>'Create DetalleGrupoDerivacion', 'url'=>array('create')),
	array('label'=>'View DetalleGrupoDerivacion', 'url'=>array('view', 'id'=>$model->id_detalle_grupo_derivacion)),
	array('label'=>'Manage DetalleGrupoDerivacion', 'url'=>array('admin')),
);
?>

<h1>Update DetalleGrupoDerivacion <?php echo $model->id_detalle_grupo_derivacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>