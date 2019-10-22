<?php
/* @var $this ListaDerivacionController */
/* @var $model ListaDerivacion */

$this->breadcrumbs=array(
	'Lista Derivacions'=>array('index'),
	$model->id_lista_derivacion,
);

$this->menu=array(
	array('label'=>'List ListaDerivacion', 'url'=>array('index')),
	array('label'=>'Create ListaDerivacion', 'url'=>array('create')),
	array('label'=>'Update ListaDerivacion', 'url'=>array('update', 'id'=>$model->id_lista_derivacion)),
	array('label'=>'Delete ListaDerivacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_lista_derivacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ListaDerivacion', 'url'=>array('admin')),
);
?>

<h1>View ListaDerivacion #<?php echo $model->id_lista_derivacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_lista_derivacion',
		'activo',
		'usuario_origen',
		'usuario_destino',
	),
)); ?>
