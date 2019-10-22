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

<h3><strong>Administraci&oacute;n de Documentos <?=$gestion?></strong></h3>

<i>Usted puede cambiar la fecha de los documentos creados seleccionando el campo deseado</i>



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
	'filter'=>$model,
	'columns'=>array(
		//'id_documento',
		array(
			'name'=>'id_documento',
			'header'=>'NUR/NURI',
			'value'=>'$data->getObtenerNuri($data->id_documento)',
			'type'=>'raw',
			'filter' => false,
		),
		'codigo',
		'destinatario_nombres',
		'referencia',
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
		array(
			'name'=>'hora',
			'header'=>'Hora',
			'value'=>'$data->hora',
			'filter' => false,
		),	
		//'gestion',

		array(
			'name'=>'gestion',
			'header'=>'Gestión',
			'value'=>'$data->gestion',
			'filter' => false,
			'htmlOptions'=>array('style'=>'text-align:center',),
		),

		array(
			'name'=>'fk_tipo_documento',
			'header'=>'Hora',
			'value'=>'$data->fkTipoDocumento->tipo_documento',
			'filter'=> Documentos::getListTipoDocumento(),
			//'filter' => false,
		),
		/*
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

		/*array(
			'class'=>'CButtonColumn',
			'template' => '{btnView}{verDetalle}',//{addUsuario}
			'htmlOptions'=>array('width'=>'210px','style'=>'text-align:center',),
			'buttons'=>array(
			    'btnView' => array(
					'label'=>'<i class="fa fa-eye"></i> Ver',
					'url'=>"CHtml::normalizeUrl(array('/Documentos/viewNota', 'id'=>\$data->id_documento
					        ))",
					'options' => array(
								'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Ver',
							),
			    ), // fin opcion

			    'verDetalle'=>array(
						'label'=>'<i class="fa fa-desktop"></i> Ver Documento',
					    'url'=>'Yii::app()->createUrl("Documentos/viewDocumentPendiente", array("id_documento"=>$data->id_documento,"asDialog"=>1))',
					    'options'=>array(  
					    'ajax'=>array(
					            'type'=>'POST',
					                // ajax post will use 'url' specified above 
					            'url'=>"js:$(this).attr('href')", 
					            'update'=>'#id_view',
					           ),
					    	'class'=>'verDetalle btn btn-app btn-sm',
					    	'title'=>'Ver Documento',
					     ),


				), // fin opcion

				
		     ),
		), */ // fin buttons


		/*array(
			'class'=>'CButtonColumn',
			'template' => '{imprimirDocumento}{seguimiento}',//{addUsuario}
			'htmlOptions'=>array('width'=>'210px','style'=>'text-align:center',),
			'buttons'=>array(
				'imprimirDocumento' => array(
					'label'=>'<i class="fa fa-file-pdf-o"></i> Imprimir',
					'url'=>"CHtml::normalizeUrl(array('documentos/generarDocumentoPDF', 'id_documento'=>\$data->id_documento, 'id_hoja_ruta'=>\$data->getObtenerIDNuri(\$data->id_documento)
					        ))",
					'options' => array('class'=>'imprimirDocumento btn btn-app btn-sm'),
			    ), // fin opcion
			    'seguimiento' => array(
					'label'=>'<i class="fa fa-paw"></i> Seguimiento',
					'url'=>"CHtml::normalizeUrl(array('seguimientos/busquedaIndex', 'nuri'=>\$data->getObtenerNuri(\$data->id_documento)
					        ))",
					'options' => array('class'=>'seguimiento btn btn-app btn-sm'),
					'visible'=>'$data->getCountSeguimiento($data->id_documento)>0',
			    ), // fin opcion
		     ),
		), */// fin buttons


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

