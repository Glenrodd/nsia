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




<?php
$tipoDocumento=TipoDocumento::model()->findByPk($tipo_documento);
?>

<h3><strong>Administraci&oacute;n de Documentos - <?=$tipoDocumento->tipo_documento?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Retornar',array('site/menuDocumentos'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section>  

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
/*Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    jQuery('#fecha').datepicker({
        changeMonth: true,
        changeYear: true,
    });
}
");*/
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentos-grid',
	'dataProvider'=>$model->searchDocumento($tipo_documento,$gestion),
	'filter'=>$model,
	//'afterAjaxUpdate' => 'reinstallDatePicker',
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
		 /*array(
	            'name' => 'fecha',
	            //'value'=>'$data->fecha',
	            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))',
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

            ),   */         

		//############################################################
			array(
				'name'=>'fecha',
				'header'=>'fecha',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))',
				'filter' => false,
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),
		//'hora',
		array(
			'name'=>'hora',
			'header'=>'Hora',
			'value'=>'$data->hora',
			'filter' => false,
		),
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
		array(
			'class'=>'CButtonColumn',
			'template' => '{nuevoCite}{verDetalle}',//{addUsuario}
			'htmlOptions'=>array('width'=>'210px','style'=>'text-align:center',),

			//'viewButtonUrl'=>'Yii::app()->createUrl("/Documentos/viewNota", array("id"=>$data->id_documento))',
			 //'template' => '{solicitudPdf}',
			'buttons'=>array(
			    /*'btnView' => array(
					'label'=>'<i class="fa fa-eye"></i> Ver',
					'url'=>"CHtml::normalizeUrl(array('/Documentos/viewNota', 'id'=>\$data->id_documento
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array(
								'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Ver',
							),
			    ), // fin opcion*/

			    'nuevoCite' => array(
					'label'=>'<i class="fa fa-plus-square"></i> Nuevo <b>CITE</b>',
					'url'=>"CHtml::normalizeUrl(array('/documentos/asignarNuevoCite', 'id'=>\$data->id_documento
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array(
								'class'=>'nuevoCite btn btn-app btn-sm',
								'title'=>'Asignar nuevo CITE',
							),
			    ), // fin opcion

			    'verDetalle'=>array(
						'label'=>'<i class="fa fa-desktop"></i> Ver Documento',
					    'url'=>'Yii::app()->createUrl("Documentos/viewDocumentPendiente", array("id_documento"=>$data->id_documento,"asDialog"=>1))',
					    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
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
		), // fin buttons


		array(
			'class'=>'CButtonColumn',
			'template' => '{seguimiento}{editar}',//{imprimirDocumento}
			'htmlOptions'=>array('width'=>'200px','style'=>'text-align:center',),

			//'viewButtonUrl'=>'Yii::app()->createUrl("/Documentos/viewNota", array("id"=>$data->id_documento))',
			 //'template' => '{solicitudPdf}',
			'buttons'=>array(
				'imprimirDocumento' => array(
					'label'=>'<i class="fa fa-file-pdf-o"></i> Imprimir',
					'url'=>"CHtml::normalizeUrl(array('documentos/generarCartaPDF', 'id_documento'=>\$data->id_documento, 'id_hoja_ruta'=>\$data->getObtenerIDNuri(\$data->id_documento)
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'imprimirDocumento btn btn-app btn-sm', 'title'=>'Imprimir'),
			    ), // fin opcion

			    'seguimiento' => array(
					'label'=>'<i class="fa fa-paw"></i> Seguimiento',
					'url'=>"CHtml::normalizeUrl(array('seguimientos/busquedaIndex', 'nuri'=>\$data->getObtenerNur(\$data->id_documento)
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'seguimiento btn btn-app btn-sm', 'title'=>'Seguimiento'),
					//'visible'=>'$data->getCountSeguimiento($data->id_documento)>0',
			    ), // fin opcion

			    'editar' => array(
					'label'=>'<i class="fa fa-edit"></i> Editar',
					'url'=>"CHtml::normalizeUrl(array('documentos/updateCartaUser', 'id'=>\$data->id_documento, 'tipo'=>\$data->fk_tipo_documento 
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'seguimiento btn btn-app btn-sm', 'title'=>'Editar'),
					//'visible'=>'$data->getCountSeguimiento($data->id_documento)==0',
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
