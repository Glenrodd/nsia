<?php
/* @var $this InstitucionRemitenteController */
/* @var $model InstitucionRemitente */

$this->breadcrumbs=array(
	'Institucion Remitentes'=>array('index'),
	$model->id_institucion_remitente=>array('view','id'=>$model->id_institucion_remitente),
	'Update',
);

$this->menu=array(
	array('label'=>'List InstitucionRemitente', 'url'=>array('index')),
	array('label'=>'Create InstitucionRemitente', 'url'=>array('create')),
	array('label'=>'View InstitucionRemitente', 'url'=>array('view', 'id'=>$model->id_institucion_remitente)),
	array('label'=>'Manage InstitucionRemitente', 'url'=>array('admin')),
);
?>

<h1>Update InstitucionRemitente <?php echo $model->id_institucion_remitente; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>