<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Manage',
);


?>

<h3>Archivo gesti&oacute;n <?=$gestion?></h3> 
<h4><i>(Documentos Originales)</i></h4> 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
              	<h3 class="card-title">
              	<i class="fa fa-tasks"></i>
              	Detalle de NUR/NURI(s) archivados en el SAD <b></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
<p style="color:#0B2F3A">
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php
/* function to re install date picker after filter the result. if you don’t use it then after filter the result calendar will not shown in filter box */
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    jQuery('#fecha').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:'yy-mm-dd',
        language:'es',
    });
}
");


Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    jQuery('#fecha2').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:'yy-mm-dd',
        language:'es',
    });
}
");
?>

<?php 

	

	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seguimientos-grid',
	'dataProvider'=>$model->searchArchivoSAD(),
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'filter'=>$model,
	'columns'=>array(
		'codigo',
		//'derivado_por',
		array(
				'name'=>'derivado_por',
				'header'=>'Derivado Por',
				'value'=>'$data->getUsuario($data->derivado_por)',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				'filter' => false,
			),
		//'derivado_a',
		//'proveido',
		/*array(
        		'name'=>'fecha_derivacion',
        		'header'=>'Fecha/Hora Derivación',
        		//'value'=>'date("d/m/Y",$data->fecha_derivacion)',
        		'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
				//'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				//'action'=>array('/Seguimientos/AjaxEditFechaDerivacion'),
				'htmlOptions'=>array('style'=>'text-align:center; padding-left:20px; font-size:12px;'),
			),*/

		//############################################################
		 array(
	            'name' => 'fecha_derivacion',
	            //'header'=>'Fecha Derivación',
	            //'value'=>'$data->fecha',
	            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." ". $data->hora_derivacion',
	            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		            'model' => $model,
		            'attribute' => 'fecha_derivacion',
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

	            //'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;'),

            ),            

		//############################################################

		array(
				'name'=>'derivado_a',
				'header'=>'Derivado A',
				'value'=>'$data->getUsuario($data->derivado_a)',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				'filter' => false,
			),

		//############################################################
		 array(
	            'name' => 'fecha_recepcion',
	            //'header'=>'Fecha Derivación',
	            //'value'=>'$data->fecha',
	            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_recepcion))." ". $data->hora_recepcion',
	            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		            'model' => $model,
		            'attribute' => 'fecha_recepcion',
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
		            	'id'=>'fecha2',

		            	),

		            ),
	            true),

	            //'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;'),

            ),            

		//############################################################

		/*array(
        		'name'=>'fecha_recepcion',
        		'header'=>'Fecha/Hora Recepción',
        		'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_recepcion))." - ".$data->hora_recepcion',
        		//'value'=>'date("m/d/Y",$data->fecha_recepcion)',
				//'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				//'action'=>array('/Seguimientos/AjaxEditFechaRecepcion'),
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
			),*/
		
		array(
        		'name'=>'proveido',
        		'header'=>'Proveído',
				'htmlOptions'=>array('style'=>'text-align:left; width:30%; padding-left:15px;'),
			),	
		array(
				'name'=>'fk_estado',
				'header'=>'Estado',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->fkEstado->estado',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				'filter' => false,
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),
		/*array(
				'name'=>'oficial',
				'header'=>'Tipo',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->oficial==1?"Original":"Copia Digital"',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				'filter' => array(1 => 'Original', 0 => 'Copia Digital'),
			),*/

        array(
        'class'=>'CButtonColumn',
        'header'=>'Desarchivar NUR/NURI',
        'template' => '{reestablecerDerivacion}', //{ingresoPdf}{verDetalle}{verExcel} {verificarIngreso}
        'htmlOptions'=>array('style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
			'reestablecerDerivacion' => array(
			    'label'=>'<i class="fa fa-archive"></i> Desarchivar',
			    //'url'=>"CHtml::normalizeUrl(array('seguimientos/updateSeguimientos', 'id'=>\$data->id_seguimiento
			      //  ))",

			    'url'=>'Yii::app()->createUrl("seguimientos/desarchivoNuriOriginal", array("id"=>$data->id_seguimiento))',
			//'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				'options' => array('class'=>'reestablecerDerivacion btn btn-app'),
				
				//'visible'=>'$data->oficial>0',

				 'click'=>'function(){return confirm("Realmente desea desarchivar el NUR/NURI ?  "+$(this).parent().parent().children(":nth-child(1)").text()+" ");}',

			    ),

          ),
        ),// fin buttons

        /*array(
        'class'=>'CButtonColumn',
        'template' => '{cambiarDerivacion}{addUsuario}', //{ingresoPdf}{verDetalle}{verExcel} {verificarIngreso}
        'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
			'cambiarDerivacion'=>
			    array(
			    	'label'=>'<i class="fa fa-dedent"></i>  Modificar',
			       	'url'=>'$this->grid->controller->createUrl("UpdateSeguimiento", array("id"=>$data->id_seguimiento,"asDialog"=>1,"gridId"=>$this->grid->id))',
			          	'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
              				//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',
			          'options' => array(
              					'class'=>'btn btn-app',
              						), 	
				),// fin
			'addUsuario' => array(
			    'label'=>'<i class="fa fa-dedent"></i> Añadir a la Lista',
			    'url'=>"CHtml::normalizeUrl(array('updateSeguimientos', 'id'=>\$data->id_seguimiento
			        ))",
			'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
			'options' => array('class'=>'addUsuario'),
			    ),

          ),
        ),// fin buttons  */



	),
)); ?>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>

<?php
//--------------------- begin new code --------------------------
   // add the (closed) dialog for the iframe
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'cru-dialog',
	'options'=>array(
	    'title'=>'Actualizar Proveído',
	    'autoOpen'=>false,
	    'modal'=>true,
	    'width'=>890,
	    'height'=>500,
	),
	));
?>
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>