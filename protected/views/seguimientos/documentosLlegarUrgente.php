<script type="text/javascript">
    
function getBuscarRecibir(){  
    
    var valor=$("#inputBuscarRecibir").val();
    valor = valor.trim();

      if (valor=='' || valor=='*') {
          alert('Es necesario ingresar un dato válido');
      }
      else{
          location.href = 'index.php?r=seguimientos/recibirNuri&nuri='+valor;
          //alert(valor);
      }
}

  
</script>

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
          <h5 style="color:#0B4C5F;" ><i class="icon fa fa-envelope-o" style="font-size:40px;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u>Lista de documentaci&oacute;n URGENTE que debe llegar (Recepci&oacute;n)</u></b>
          </h5>
       


    <center>
   <div class="form-inline ml-3" style="width: 80%;">
              <div class="input-group input-group-sm" >

              <?php echo CHtml::beginForm('index.php?r=seguimientos/recibirNuri','get', array('class'=>'form-inline ml-3')); ?>

                <?php //echo CHtml::label('ingrese nuri','user01',array('class'=>'small'))?>
                <?php echo CHtml::textField('nuri','',array('id'=>'inputBuscar','class'=>'form-control form-control-navbar', 'placeholder'=>'Recibir NUR/NURI...', 'aria-label'=>'Search'))?>
                <?php //echo CHtml::submitButton(".<i class='fa fa-search'></i>",array('class'=>'btn btn-navbar')); ?>

                <button class="btn btn-info btn-sm" >
                          <i class="fa fa-download" style="font-size: 20px;"></i> Recibir
                </button>

              <?php echo CHtml::endForm(); ?>
              </div>
          </div>  
	</center>






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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seguimientos-grid',
	'dataProvider'=>$model->searchQueDebenLlegarUrgente(),
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
			'header'=>'NUR/NURI',	
			'name'=>'codigo',	
			'value'=>'$data->getMostrarCodigo()',	
			//'value'=>'$data->codigo',	
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
		),

		array(
			'header'=>'Derivado Por:',	
			'name'=>'derivado_por',	
			'value'=>'$data->getUsuarioPendientes($data->derivado_por)',	
			//'value'=>'$data->derivado_por',	
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
			'header'=>'Fecha/Hora Derivación:',	
			'name'=>'fecha_derivacion',	
			'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
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
        'template' => '{verDetalle}{seguimiento}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
          'verDetalle'=>
				array(
						'label'=>'<i class="fa fa-desktop"></i> Ver Doc.',
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
					    	//<i class="fa fa-desktop"></i>
					    	
					     ),
					    
				    ), // fin opcion
			'seguimiento' => array(
					'label'=>'<i class="fa fa-paw"></i> Seguimiento',
					'url'=>"CHtml::normalizeUrl(array('seguimientos/busquedaIndex', 'nuri'=>\$data->codigo   ))",
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
					'options' => array('class'=>'seguimiento btn btn-block btn-info btn-sm', 'title'=>'Ver Seguimiento',),
					//'visible'=>'$data->getCountSeguimiento($data->id_documento)>0',
			    ), // fin opcion	
          ),


        ),// fin buttons

        array(
        'class'=>'CButtonColumn',
        'template' => '{recibirDocumento}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

          'recibirDocumento' => array(
            'label'=>'<i class="fa fa-pencil-square-o"></i> Recibir',
            'url'=>"CHtml::normalizeUrl(array('Seguimientos/recibirDocumento', 'id_seguimiento'=>\$data->id_seguimiento
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		'class'=>'btn btn-block btn-success btn-sm',
              		'title'=>'Recibir Documento',
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

              	),
              'click'=>'function(){return confirm("Realmente desea recibir el NUR/NURI ?  "+$(this).parent().parent().children(":nth-child(1)").text()+" ");}',
              
              //'click'=>'function(){return confirm("Realmente desea recibir el NUR/NURI $data->codigo   ?");}',

              /*'click' => function($data) {
            		$id = $data->id;
            	return "js:function() { alert($id); return false;}";
           	},*/



            ),
            		
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
