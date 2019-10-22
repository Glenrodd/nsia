<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */

$this->breadcrumbs=array(
	'Archivados Digitales'=>array('index'),
	$model->id_archivado_digital=>array('view','id'=>$model->id_archivado_digital),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArchivadosDigitales', 'url'=>array('index')),
	array('label'=>'Create ArchivadosDigitales', 'url'=>array('create')),
	array('label'=>'View ArchivadosDigitales', 'url'=>array('view', 'id'=>$model->id_archivado_digital)),
	array('label'=>'Manage ArchivadosDigitales', 'url'=>array('admin')),
);
?>

<h1>Update ArchivadosDigitales <?php echo $model->id_archivado_digital; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>