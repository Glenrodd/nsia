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
//$tipoDocumento=TipoDocumento::model()->findByPk($tipo_documento);

?>

<h4><strong>Documentos Reservados</strong></h4>


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
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    jQuery('#fecha').datepicker({
        changeMonth: true,
        changeYear: true,
    });
}
");
?>

<br>
<i style="color: #086A87;">Usted puede reservar hasta 15 documentos (<b>CITES</b>) durante la gesti&oacute;n. N&uacute;mero de reservas disponibles <b style="font-size: 20px;" ><u><?=(15-Documentos::getNumeroReservados())?></u></b></i>
<?php 

$estado_documento=1;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentos-grid',
	'dataProvider'=>$model->searchReservado($estado_documento),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		//'id_documento',
		'codigo',
		'destinatario_nombres',
		'referencia',
		//'fecha',
		//############################################################
		 array(
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
		array(
			'name'=>'fk_tipo_documento',
			'header'=>'Tipo Documento',
			'value'=>'$data->fkTipoDocumento->tipo_documento',
			//'filter' => false,
			'filter'=> CHtml::listData(TipoDocumento::model()->findAll(array('order'=>'id_tipo_documento')), 'id_tipo_documento', 'tipo_documento')
		),	
			
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
		array(
			'class'=>'CButtonColumn',
			'template' => '{editar}',//{addUsuario}
			'htmlOptions'=>array('width'=>'100px','style'=>'text-align:center',),
			//'viewButtonUrl'=>'Yii::app()->createUrl("/Documentos/viewMemorandum", array("id"=>$data->id_documento))',
			 //'template' => '{solicitudPdf}',
			'buttons'=>array(


			    'editar' => array(
					'label'=>'<i class="fa fa-edit"></i> Editar',
					'url'=>"CHtml::normalizeUrl(array('documentos/UpdateDocument', 'id_documento'=>\$data->id_documento, 'tipo_documento'=>\$data->fk_tipo_documento 
					        ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array(
										'class'=>'btnView btn btn-default btn-sm',
										'id'=>'Editar Reservado',
										'title'=>'Editar Reservado',
									),
					'visible'=>'$data->getCountSeguimiento($data->id_documento)==0',
			    ), // fin opcion


		     ),
		), // fin buttons
	),
)); ?>
