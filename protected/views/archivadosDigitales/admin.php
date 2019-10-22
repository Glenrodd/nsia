<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */

$this->breadcrumbs=array(
	'Archivados Digitales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ArchivadosDigitales', 'url'=>array('index')),
	array('label'=>'Create ArchivadosDigitales', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#archivados-digitales-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Archivados Digitales</h1>

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
	'id'=>'archivados-digitales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_archivado_digital',
		'codigo',
		'fecha_archivo',
		'hora_archivo',
		'lugar',
		'observaciones',
		/*
		'fk_usuario',
		'fk_seguimiento',
		'fecha_registro',
		'hora_registro',
		'gestion',
		'activo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
