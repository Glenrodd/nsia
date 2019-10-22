<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */

$this->breadcrumbs=array(
	'Hojas Rutas'=>array('index'),
	$model->id_hoja_ruta=>array('view','id'=>$model->id_hoja_ruta),
	'Update',
);

$this->menu=array(
	array('label'=>'List HojasRuta', 'url'=>array('index')),
	array('label'=>'Create HojasRuta', 'url'=>array('create')),
	array('label'=>'View HojasRuta', 'url'=>array('view', 'id'=>$model->id_hoja_ruta)),
	array('label'=>'Manage HojasRuta', 'url'=>array('admin')),
);
?>

<h1>Update HojasRuta <?php echo $model->id_hoja_ruta; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>