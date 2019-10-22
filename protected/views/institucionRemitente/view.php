<?php
/* @var $this InstitucionRemitenteController */
/* @var $model InstitucionRemitente */

$this->breadcrumbs=array(
	'Institucion Remitentes'=>array('index'),
	$model->id_institucion_remitente,
);

$this->menu=array(
	array('label'=>'List InstitucionRemitente', 'url'=>array('index')),
	array('label'=>'Create InstitucionRemitente', 'url'=>array('create')),
	array('label'=>'Update InstitucionRemitente', 'url'=>array('update', 'id'=>$model->id_institucion_remitente)),
	array('label'=>'Delete InstitucionRemitente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_institucion_remitente),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InstitucionRemitente', 'url'=>array('admin')),
);
?>

<h1>View InstitucionRemitente #<?php echo $model->id_institucion_remitente; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_institucion_remitente',
		'institucion_remitente',
		'descripcion',
		'activo',
	),
)); ?>
