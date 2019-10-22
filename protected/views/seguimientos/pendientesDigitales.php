<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Create Seguimientos', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seguimientos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<hr>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="icon fa fa-envelope-open-o" style="font-size:40px;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u>Lista de documentaci&oacute;n Digital Pendiente</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-body" >
        <?php echo CHtml::link('<u>Búsqueda Avanzada</u>','#',array('class'=>'search-button')); ?>
          <p style="color:#0B2F3A">
          Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
          </p>
        </div>
    </div>
</div>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php 

//echo Yii::app()->user->area_sad;
//echo Yii::app()->user->usuario;
//echo '<br> Your IP adress is: ' . CHttpRequest::getUserHostAddress();

Yii::import('zii.widgets.grid.CGridView');

class SpecialGridView extends CGridView {
    public $usuario;
    public $area_sad;
    public $ip;
}
?>

<?php $this->widget('SpecialGridView', array(
	'id'=>'seguimientos-grid',
	'dataProvider'=>$model->searchPendientesDigitales(),

  'usuario'=>Yii::app()->user->usuario,
  'area_sad'=>Yii::app()->user->area_sad,
  'ip'=>CHttpRequest::getUserHostAddress(),

	'filter'=>$model,
	'columns'=>array(
		//'id_seguimiento',
		 /*array(
            'name' => 'codigo',
            'value' => '"<a href=\"".Yii::app()->createUrl("admin/rubric/update" , array("id" => $data->id_seguimiento))."\" title=\"Edit\"><i class=\"icon-pencil\">kklkjhlkj</i></a><br>

            <i  class=\"fa fa-files-o\"></i>

                        <a id=\"smoke_confirm\" href=\"".Yii::app()->createUrl("admin/rubric/delete" , array("id" => $data->id_seguimiento))."\" title=\"Delete\"><i class=\"icon-trash\">ssss</i></a>"',
            'type' => 'raw',
        ),

		'codigo',
		array(
			'header'=>'NUR/NURI',	
			'name'=>'codigo',	
			'value'=>'"

					<i  class=\"fa fa-files-o\"></i> <b>".$data->getMostrarCodigo()."</b>
				"',	
            'type' => 'raw',
		),*/
		array(
			'header'=>'Número',	
			'name'=>'numero_copia',	
			'value'=>'$data->numero_copia',	
      'type' => 'raw',
      'htmlOptions'=>array('style'=>'text-align:center',),
		),


    array(
      'header'=>'NUR/NURI', 
      'name'=>'codigo', 
      'value'=>'$data->getMostrarCodigo()', 
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
    ),

		array(
			'header'=>'Derivado Por:',	
			'name'=>'derivado_por',	
			'value'=>'$data->getUsuarioPendientes($data->derivado_por)',	
      'type' => 'raw',
      'htmlOptions'=>array('style'=>'text-align:center; font-size:14px;',),
      'filter' => CHtml::activeTextField($model, 'derivadoPor_nombre'),
		),

		//'derivado_por',
		//'derivado_a',
		//'proveido',
		array(
			'header'=>'Proveído:',	
			'name'=>'proveido',	
			//'value'=>'$data->proveido',
      'value'=>'$data->getReferenciaSintesis($data->codigo,$data->proveido)',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:left; font-size:14px;',),
		),
		array(
      'header'=>'Fecha/Hora Derivación:', 
      'name'=>'fecha_derivacion', 
      'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
            'filter'=>false,
    ),

    array(
      'header'=>'Fecha/Hora Recepción:', 
      'name'=>'fecha_recepcion', 
      'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_recepcion))." - ".$data->hora_recepcion',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
            'filter'=>false,
    ),
		//'fecha_derivacion',
		/*
		'hora_derivacion',
		'fecha_recepcion',
		'hora_recepcion',
		'fk_accion',
		'fk_estado',
		'padre',
		'oficial',
		'hijo',
		'fecha_registro',
		'hora_registro',
		'gestion',
		'confirmado',
		'activo',
		*/
		array(
        'class'=>'CButtonColumn',
        'template' => '{verDetalle}{imprimirHS}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
          'verDetalle'=>
				array(
						'label'=>'<i class="fa fa-desktop"></i> Ver Documento',
					    'url'=>'Yii::app()->createUrl("Seguimientos/viewDocumentPendiente", array("id_seguimiento"=>$data->id_seguimiento,"asDialog"=>1))',
					    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
					    'options'=>array(  
					    'ajax'=>array(
					            'type'=>'POST',
					                // ajax post will use 'url' specified above 
					            'url'=>"js:$(this).attr('href')", 
					            'update'=>'#id_view',
					           ),
					    	'class'=>'btn btn-block btn-primary btn-sm',
                'title'=>'Ver Documento',
					     ),
				    ),
        'imprimirHS' => array(
            'label'=>' <i class="fa fa-file-text-o"></i> Imprimir H.S.',
            'url'=>"CHtml::normalizeUrl(array('Documentos/generarHsInternoAdicionPDF', 'nur'=>\$data->codigo, 'oficial'=>\$data->oficial
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
                  //'class'=>'btn btn-app',
                  'class'=>'btn btn-block btn-default btn-sm',
                  'title'=>'Imprimir Hoja de Seguimiento',
                  //'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

                ),
            ),// fin imprimirHS


          ), // fin buttons


        ),// fin buttons

        array(
        'class'=>'CButtonColumn',
        'template' => '{derivarDocumento}{seguimiento}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

          'derivarDocumento' => array(
            'label'=>'<i class="fa fa-share-square-o"></i> Derivar',
            'url'=>"CHtml::normalizeUrl(array('seguimientos/derivarDocumentoPendiente', 'id_seguimiento'=>\$data->id_seguimiento
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		'class'=>'btn btn-block btn-success btn-sm',
                  'title'=>'Derivar Documento',
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

              	),
              /*'click'=>'function(){return confirm("Realmente desea derivar el NUR/NURI ?  "+$(this).parent().parent().children(":nth-child(1)").text()+" ");}',*/
            ),// fin derivarDocumento
          'seguimiento' => array(
          'label'=>'<i class="fa fa-paw"></i> Seguimiento',
          'url'=>"CHtml::normalizeUrl(array('seguimientos/busquedaIndex', 'nuri'=>\$data->codigo   ))",
          //'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
          'options' => array('class'=>'seguimiento btn btn-block btn-info btn-sm','title'=>'Ver Seguimiento',),
          //'visible'=>'$data->getCountSeguimiento($data->id_documento)>0',
          ), // fin opcion  


          ),
        ),// fin buttons

        array(
        'class'=>'CButtonColumn',
        'template' => '{arhivoDigital}{anadirRespuesta}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

          
        /*  'arhivoDigital' => array(
            'label'=>'<i class="fa fa-archive"></i> Archivo Digital.',
            'url'=>"CHtml::normalizeUrl(array('archivadosDigitales/create', 'id'=>\$data->id_seguimiento
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		'class'=>'arhivoDigital btn btn-block btn-danger',
                  'title'=>'Archivo Digital',
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',
              	),
               'visible'=>'$data->verificarNivelUsuario() > 0',// si funciona
            ),// fin derivarDocumento */

          'arhivoDigital' => array(
            'label'=>'<i class="fa fa-archive"></i> SAD.',
            'url'=>'"http://archivo.abc.gob.bo/tab_envio.php?id_seguimiento=".$data->id_seguimiento."&usuario=".$this->grid->usuario."&linksad=".$this->grid->area_sad."&ip=".$this->grid->ip',
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
                  'class'=>'arhivoDigital btn btn-block btn-danger btn-sm',
                  'title'=>'Archivo Digital',
                  'style'=>'color:white;',
                  'target'=>"_blank",
                  //'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',
                ),
               'visible'=>'$this->grid->area_sad > 0',// si funciona
            ),// fin derivarDocumento


          'anadirRespuesta' => array(
            'label'=>'<i class="fa fa-user-plus"></i> Añadir Respuesta.',
            'url'=>"CHtml::normalizeUrl(array('seguimientos/anadirRespuesta', 'id'=>\$data->id_seguimiento
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
                  'class'=>'btn btn-block btn-default btn-sm',
                  'title'=>'Añadir Respuesta',
                  //'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

                ),
            ),// fin anadirRespuesta


          ),
        ),// fin buttons

	),
)); ?>


<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
'id'=>'dlg-address-view',
'options'=>array(
    'title'=>'Documento Original',
    'autoOpen'=>false, //important!
    'modal'=>true,
    'width'=>'65%',
    'height'=>700,
),
));
?>
<div id="id_view"></div>
<?php $this->endWidget();?>
