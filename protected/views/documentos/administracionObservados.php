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
<h3><strong>Administraci&oacute;n de Documentos Observados</strong></h3>

<p style="color:#0B2F3A">
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php
/* function to re install date picker after filter the result. if you don’t use it then after filter the result calendar will not shown in filter box */
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    jQuery('#fecha').datepicker({
        changeMonth: true,
        changeYear: true,
    });
}
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentos-grid',
	'dataProvider'=>$model->searchDocumentoObservado(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		//'id_documento',
		array(
			'name'=>'id_documento',
			'header'=>'NUR/NURI',
			'value'=>'$data->getObtenerNuri($data->id_documento)',
			'type'=>'raw',
			'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center',),
		),

		'codigo',
		'destinatario_nombres',
		'referencia',
		//'fecha',
		//############################################################
		 array(
	            'name' => 'fecha',
	            'header'=>'Fecha/Hora',
	            //'value'=>'$data->fecha',
	            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))." - ".$data->hora',
	            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		            'model' => $model,
		            'attribute' => 'fecha',
		            'language' => 'es',
		            'options'=>array(
			            'dateFormat'=>'yy-mm-dd',
			            //'dateFormat'=>'mm/dd/yy',
			            'changeYear'=>'true',
			            'changeMonth'=>'true',
			            'showAnim' =>'slide',
			            'yearRange'=>'2000:'.(date('Y')+1),
		            	),
		            'htmlOptions'=>array(
		            	'id'=>'fecha',
		            	),

		            ),
	            true),

            ),            

		//############################################################
		/*array(
				'name'=>'fecha',
				'header'=>'fecha',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))',
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),*/
		//'hora',
		/*array(
			'name'=>'hora',
			'header'=>'Hora',
			'value'=>'$data->hora',
			'filter' => false,
		),*/	
		/*
		'gestion',
		'destinatario_titulo',
		'destinatario_cargo',
		'destinatario_institucion',
		'remitente_nombres',
		'remitente_cargo',
		'remitente_institucion',
		'contenido',
		'adjuntos',
		'copias',
		'via_nombres',
		'via_cargo',
		'nro_hojas',
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
		/*array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'180px','style'=>'text-align:center',),
		),*/

		array(
			'class'=>'CButtonColumn',
			'template' => '{btnEdit}',//{addUsuario}
			'htmlOptions'=>array('width'=>'140px','style'=>'text-align:center',),

			//'viewButtonUrl'=>'Yii::app()->createUrl("/Documentos/viewNota", array("id"=>$data->id_documento))',
			 //'template' => '{solicitudPdf}',
			'buttons'=>array(
			    'btnEdit' => array(
					'label'=>'<i class="fa fa-edit"></i> Editar',
					'url'=>"CHtml::normalizeUrl(array('/documentos/updateDocument', 'id_documento'=>\$data->id_documento, 'tipo_documento'=>\$data->fk_tipo_documento
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array(
								'class'=>'btnEdit btn btn-app btn-sm',
								'title'=>'Editar Documento',
							),
			    ), // fin opcion
		     ),
		), // fin buttons

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

