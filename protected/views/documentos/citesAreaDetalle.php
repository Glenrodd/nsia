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

//echo "---> ".$areas->id_area;
?>

<h4><strong>Cites asignados - <?=$tipoDocumento->tipo_documento?> (<?=$areas->area?>) </strong></h4>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-mail-reply"></i> Retornar',array('documentos/citesArea'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>

                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-excel-o"></i> Reporte',array('documentos/citesAreaDetalleReporte','id_area'=>$areas->id_area,'tipo_documento'=>$tipo_documento), array('class'=>'btn btn-block btn-info')); ?>
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
<center>
<div style="width: 95%;">


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentos-grid',
	'dataProvider'=>$model->searchDocumentoCiteArea($tipo_documento,$gestion,$areas->id_area),
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

            ),  */          

		//############################################################
			array(
				'name'=>'fecha',
				'header'=>'Fecha/Hora',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))." - ".$data->hora',
				'filter' => false,
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),

		array(
				'name'=>'fk_usuario',
				'header'=>'Autor',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->fkUsuario->nombre',
				'filter' => false,
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),		

		array(
				'name'=>'fk_estado_documento',
				'header'=>'Estado Doc.',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->fkEstadoDocumento->estado_documento',
				'filter'=> CHtml::listData(EstadoDocumento::model()->findAll(array('order'=>'id_estado_documento')), 'id_estado_documento', 'estado_documento'),
				//'filter' => false,
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),	
		//'hora',
			
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
			'template' => '{seguimiento}',//{addUsuario}{imprimirDocumento}
			'htmlOptions'=>array('width'=>'90px','style'=>'text-align:center',),

			//'viewButtonUrl'=>'Yii::app()->createUrl("/Documentos/viewNota", array("id"=>$data->id_documento))',
			 //'template' => '{solicitudPdf}',
			'buttons'=>array(
				/*'imprimirDocumento' => array(
					'label'=>'<i class="fa fa-file-pdf-o"></i> Imprimir',
					'url'=>"CHtml::normalizeUrl(array('documentos/generarDocumentoPDF', 'id_documento'=>\$data->id_documento, 'id_hoja_ruta'=>\$data->getObtenerIDNuri(\$data->id_documento)
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'imprimirDocumento btn btn-app btn-sm', 'title'=>'Imprimir Documento'),
			    ), // fin opcion */

			    'seguimiento' => array(
					'label'=>'<i class="fa fa-paw"></i> Seguimiento',
					'url'=>"CHtml::normalizeUrl(array('seguimientos/busquedaIndex', 'nuri'=>\$data->getObtenerNur(\$data->id_documento)
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'seguimiento btn btn-app btn-sm', 'title'=>'Seguimiento'),
					//'visible'=>'$data->getCountSeguimiento($data->id_documento)>0',
			    ), // fin opcion

			    /*'editar' => array(
					'label'=>'<i class="fa fa-edit"></i> Editar',
					'url'=>"CHtml::normalizeUrl(array('documentos/updateInformeUser', 'id'=>\$data->id_documento, 'tipo'=>\$data->fk_tipo_documento 
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'seguimiento btn btn-app btn-sm', 'title'=>'Editar'),
					//'visible'=>'$data->getCountSeguimiento($data->id_documento)==0',
			    ), // fin opcion */


		     ),
		), // fin buttons
	),
)); ?>



</div>
</center>

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




