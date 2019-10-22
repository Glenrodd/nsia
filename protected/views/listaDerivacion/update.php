<?php
/* @var $this ListaDerivacionController */
/* @var $model ListaDerivacion */

$this->breadcrumbs=array(
	'Lista Derivacions'=>array('index'),
	$model->id_lista_derivacion=>array('view','id'=>$model->id_lista_derivacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List ListaDerivacion', 'url'=>array('index')),
	array('label'=>'Create ListaDerivacion', 'url'=>array('create')),
	array('label'=>'View ListaDerivacion', 'url'=>array('view', 'id'=>$model->id_lista_derivacion)),
	array('label'=>'Manage ListaDerivacion', 'url'=>array('admin')),
);
?>

<h1>Update ListaDerivacion <?php echo $model->id_lista_derivacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>