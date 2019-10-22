<?php
/* @var $this DetalleCorteController */
/* @var $model DetalleCorte */

$this->breadcrumbs=array(
	'Detalle Cortes'=>array('index'),
	$model->id_corte=>array('view','id'=>$model->id_corte),
	'Update',
);

$this->menu=array(
	array('label'=>'List DetalleCorte', 'url'=>array('index')),
	array('label'=>'Create DetalleCorte', 'url'=>array('create')),
	array('label'=>'View DetalleCorte', 'url'=>array('view', 'id'=>$model->id_corte)),
	array('label'=>'Manage DetalleCorte', 'url'=>array('admin')),
);
?>

<h1>Update DetalleCorte <?php echo $model->id_corte; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>