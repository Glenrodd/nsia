<?php
/* @var $this CorrelativosController */
/* @var $model Correlativos */

$this->breadcrumbs=array(
	'Correlativoses'=>array('index'),
	$model->id_correlativo=>array('view','id'=>$model->id_correlativo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Correlativos', 'url'=>array('index')),
	array('label'=>'Create Correlativos', 'url'=>array('create')),
	array('label'=>'View Correlativos', 'url'=>array('view', 'id'=>$model->id_correlativo)),
	array('label'=>'Manage Correlativos', 'url'=>array('admin')),
);
?>

<h1>Update Correlativos <?php echo $model->id_correlativo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>