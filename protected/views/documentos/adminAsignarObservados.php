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

<br>
<h3><strong>Asignaci&oacute;n de Documentos Observados</strong></h3>

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
	'dataProvider'=>$model->searchGestion($gestion),
	//'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(


		//'id_documento',
		'codigo',
		'destinatario_nombres',
		//'referencia',
		array(
				'name'=>'referencia',
				'header'=>'Referencia',
				'value'=>'$data->referencia',
				'htmlOptions'=>array('style'=>'font-size: 12px',),
			),
		//'fecha',
		array(
				'name'=>'fecha',
				'header'=>'fecha',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))',
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			'htmlOptions'=>array('style'=>'text-align:center',),
			),
		//'hora',
		//'gestion',

		array(
			'name'=>'fk_tipo_documento',
			'header'=>'Tipo Documento',
			'value'=>'$data->fkTipoDocumento->tipo_documento',
			'filter'=> Documentos::getListTipoDocumento(),
			//'filter' => false,
		),

		array(
			'name'=>'fk_usuario',
			'header'=>'Autor',
			'value'=>'$data->fkUsuario->nombre',
			'type' => 'raw',
			'filter' => CHtml::activeTextField($model, 'fkUsuario_nombre'),
			//'filter'=> Documentos::getListTipoDocumento(),
			//'filter' => false,
		),
		array(
			'name'=>'observado',
			'header'=>'Estado Observado',
			'value'=>'$data->observado == 0 ? "Sin observación" : "<b style=color:red;>Doc. Observado</b>"',
			'type' => 'raw',
			//'filter'=> Documentos::getListTipoDocumento(),
			//'filter' => false,
		),



		array(
			'class'=>'CButtonColumn',
			'header'=>'Asignar Observación',
			'template' => '{btnObservar}',//{addUsuario}
			'htmlOptions'=>array('width'=>'150px','style'=>'text-align:center',),
			'buttons'=>array(
			    'btnObservar' => array(

					'label'=>'<i class="fa fa-file-text"></i>  Observar Doc.',
					'url'=>"CHtml::normalizeUrl(array('/documentos/ObservarDocumento', 'id'=>\$data->id_documento, 'gestion'=>\$data->gestion
					        ))",
					'options' => array(
								'class'=>'btnView btn btn-default btn-sm',
								//'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Ver',
							),
			    ), // fin opcion
		     ),
		),  // fin buttons


	),
)); ?>

<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
'id'=>'dlg-address-view',
'options'=>array(
    'title'=>'Documento',
    'autoOpen'=>false, //important!
    'modal'=>true,
    'width'=>'65%',
    'height'=>700,
),
));
?>
<div id="id_view"></div>
<?php $this->endWidget();?>