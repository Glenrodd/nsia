<?php
/* @var $this NombreCargoRemitenteController */
/* @var $model NombreCargoRemitente */

$this->breadcrumbs=array(
	'Nombre Cargo Remitentes'=>array('index'),
	$model->id_nombre_cargo_remitente=>array('view','id'=>$model->id_nombre_cargo_remitente),
	'Update',
);

$this->menu=array(
	array('label'=>'List NombreCargoRemitente', 'url'=>array('index')),
	array('label'=>'Create NombreCargoRemitente', 'url'=>array('create')),
	array('label'=>'View NombreCargoRemitente', 'url'=>array('view', 'id'=>$model->id_nombre_cargo_remitente)),
	array('label'=>'Manage NombreCargoRemitente', 'url'=>array('admin')),
);
?>

<h1>Update NombreCargoRemitente <?php echo $model->id_nombre_cargo_remitente; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>