<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documentos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><strong><u>Documentos Gerencia Regional</u></strong></h3><br>

<p style="color:#0B2F3A">
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentos-grid',
	'dataProvider'=>$model->searchRegional(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id_documento',
			'header'=>'NUR/NURI',
			'value'=>'$data->getObtenerNuri($data->id_documento)',
			'type'=>'raw',
			'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center; width:120px;',),
		),

		'codigo',
		'destinatario_nombres',
		'referencia',
		array(
				'name'=>'fk_area',
				'header'=>'Área/Unidad',
				'value'=>'$data->fkArea->area',
				//'filter' => false,
				'filter'=> CHtml::listData(Areas::model()->findAll(array("condition"=>"t.fk_regional=".Yii::app()->user->regional, 'order'=>'id_area')), 'id_area', 'area'),
							),
		array(
			'name'=>'fk_estado_documento',
			'header'=>'Estado Doc.',
			'value'=>'$data->fkEstadoDocumento->estado_documento',
			//'filter'=> CHtml::listData(TipoDocumento::model()->findAll(array("condition"=>"t.id_tipo_documento!=6", 'order'=>'id_tipo_documento')), 'id_tipo_documento', 'tipo_documento'),
			'type'=>'raw',
			'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center; width:90px;',),
		),


		array(
			'name'=>'fk_tipo_documento',
			'header'=>'Tipo Doc.',
			'value'=>'$data->fkTipoDocumento->tipo_documento',
			'filter'=> CHtml::listData(TipoDocumento::model()->findAll(array("condition"=>"t.id_tipo_documento!=6", 'order'=>'id_tipo_documento')), 'id_tipo_documento', 'tipo_documento'),
			'type'=>'raw',
			//'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center; width:90px;',),
		),


		array(
			'name'=>'fecha',
			'header'=>'Fecha/Hora',
			'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))." - ".$data->hora',
			'type'=>'raw',
			'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center',),
		),

		array(
			'name'=>'fk_usuario',
			'header'=>'Usuario',
			'value'=>'$data->fkUsuario->nombre',
			'type'=>'raw',
			'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:left',),

		),

		array(
			'name'=>'gestion',
			'header'=>'gestion',
			'value'=>'$data->gestion',
			'type'=>'raw',
			//'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center; width:90px;',),
		),
		/*
		'id_documento',
		'codigo',
		'destinatario_titulo',
		'destinatario_nombres',
		'destinatario_cargo',
		'destinatario_institucion',
		'remitente_nombres',
		'remitente_cargo',
		'remitente_institucion',
		'referencia',
		'contenido',
		'fecha',
		'hora',
		'adjuntos',
		'copias',
		'via_nombres',
		'via_cargo',
		'nro_hojas',
		'gestion',
		'fecha_registro',
		'hora_registro',
		'fk_usuario',
		'fk_tipo_documento',
		'fk_estado_documento',
		'fk_area',
		'fk_documento',
		'ruta_documento',
		'activo',
		*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}',
			//'visible'=>'$data->fk_tipo_documento!=7',
		),
	),
)); ?>
