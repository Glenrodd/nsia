<?php
/* @var $this CorteController */
/* @var $model Corte */

$this->breadcrumbs=array(
	'Cortes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Corte', 'url'=>array('index')),
	array('label'=>'Create Corte', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#corte-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cortes</h1>

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
	'id'=>'corte-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_corte',
		'nro_corte',
		'fecha_corte',
		'descripcion',
		'fecha_registro',
		'hora_registro',
		/*
		'fk_usuario',
		'activo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
