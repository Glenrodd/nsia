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
          <h5 style="color:#0B4C5F;" ><i class="icon fa fa-folder-open-o" style="font-size:40px;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u>Lista de NUR/NURI(s) para desagrupar</u></b>
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

<div class="card-body pad table-responsive">


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seguimientos-grid',
	'dataProvider'=>$model->searchDesagrupar(),
	'filter'=>$model,
  //'itemsCssClass' => 'table table-striped table-bordered table-hover table-condensed',
	'columns'=>array(
		array(
			'header'=>'NUR/NURI Principal',	
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
			'value'=>'$data->proveido',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:left; font-size:14px;',),
		),
		array(
			'header'=>'Fecha Derivación:',	
			'name'=>'fecha_derivacion',	
			'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
		),

		array(
			'header'=>'NUR/NURI(s) Agrupados',	
			'name'=>'codigo',	
			'value'=>'$data->getMostrarAgrupacion()',	
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:left',),
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
        'template' => '{desagrupar}{derivarDocumento}{seguimiento}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

          'desagrupar' => array(
            'label'=>'<i class="fa fa-user-times"></i> Desagrupar',
            'url'=>"CHtml::normalizeUrl(array('agrupaciones/detalleAgrupacion', 'id_seguimiento'=>\$data->id_seguimiento
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		'class'=>'btn btn-block btn-danger',
                  'title'=>'desagrupar NUR/NURI',
              	),
            ),// fin derivarDocumento

          'derivarDocumento' => array(
            'label'=>'<i class="fa fa-share-square-o"></i> Derivar',
            'url'=>"CHtml::normalizeUrl(array('Seguimientos/derivarDocumentoPendiente', 'id_seguimiento'=>\$data->id_seguimiento
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		'class'=>'btn btn-block btn-success',
                  'title'=>'Derivar Documento',
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

              	),
              //'visible'=>'$data->oficial > 0',// si funciona
              /*'click'=>'function(){return confirm("Realmente desea derivar el NUR/NURI ?  "+$(this).parent().parent().children(":nth-child(1)").text()+" ");}',*/
            ),// fin derivarDocumento

            

            'seguimiento' => array(
          'label'=>'<i class="fa fa-paw"></i> Seguimiento',
          'url'=>"CHtml::normalizeUrl(array('seguimientos/busquedaIndex', 'nuri'=>\$data->codigo   ))",
          //'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
          'options' => array('class'=>'seguimiento btn btn-block btn-info', 'title'=>'Ver Seguimiento',),
          //'visible'=>'$data->getCountSeguimiento($data->id_documento)>0',
          ), // fin opcion

            



          ),
        ),// fin buttons

        

	),
)); ?>

</div>






