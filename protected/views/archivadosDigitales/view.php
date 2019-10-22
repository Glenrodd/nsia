<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */

$this->breadcrumbs=array(
	'Archivados Digitales'=>array('index'),
	$model->id_archivado_digital,
);

$this->menu=array(
	array('label'=>'List ArchivadosDigitales', 'url'=>array('index')),
	array('label'=>'Create ArchivadosDigitales', 'url'=>array('create')),
	array('label'=>'Update ArchivadosDigitales', 'url'=>array('update', 'id'=>$model->id_archivado_digital)),
	array('label'=>'Delete ArchivadosDigitales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_archivado_digital),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArchivadosDigitales', 'url'=>array('admin')),
);
?>

<h1>View ArchivadosDigitales #<?php echo $model->id_archivado_digital; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_archivado_digital',
		'codigo',
		'fecha_archivo',
		'hora_archivo',
		'lugar',
		'observaciones',
		'fk_usuario',
		'fk_seguimiento',
		'fecha_registro',
		'hora_registro',
		'gestion',
		'activo',
	),
)); ?>
