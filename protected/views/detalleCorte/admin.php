<?php
/* @var $this DetalleCorteController */
/* @var $model DetalleCorte */

$this->breadcrumbs=array(
	'Detalle Cortes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DetalleCorte', 'url'=>array('index')),
	array('label'=>'Create DetalleCorte', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#detalle-corte-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Detalle Cortes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-corte-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_corte',
		'codigo',
		'derivado_por',
		'derivado_a',
		'proveido',
		'fecha_derivacion',
		/*
		'hora_derivacion',
		'fecha_recepcion',
		'hora_recepcion',
		'fk_accion',
		'fk_estado',
		'padre',
		'oficial',
		'hijo',
		'fecha_registro',
		'hora_registro',
		'gestion',
		'confirmado',
		'fk_corte',
		'activo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
