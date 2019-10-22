<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */

$this->breadcrumbs=array(
	'Agrupaciones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Agrupaciones', 'url'=>array('index')),
	array('label'=>'Create Agrupaciones', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#agrupaciones-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Agrupaciones</h1>

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
	'id'=>'agrupaciones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_agrupacion',
		'nur_padre',
		'nur_hijo',
		'oficial',
		'fk_seguimiento_padre',
		'fk_seguimiento_hijo',
		/*
		'fk_usuario',
		'fecha_registro',
		'hora_registro',
		'activo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
