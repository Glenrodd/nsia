<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>

<center>
<i>Detalle de Nuris derivados sin recepci&oacute;n, usted puede modificar las derivaciones</i>
</center>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
              	<h3 class="card-title">
              	<i class="fa fa-tasks"></i>
              	Detalle de NUR/NURI(s) sin recepcion <b></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                <a class="btn btn-app" href="index.php?r=site/menuAdministracion" style="color: black;">
                  <i class="fa fa-dedent"></i>Retornar Administraci&oacute;n
                </a>

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
	'id'=>'seguimientos-grid',
	'dataProvider'=>$model->searchChangeDrivacion(),
	'filter'=>$model,
	'columns'=>array(
		//'codigo',
		array(
			'header'=>'NUR/NURI',	
			'name'=>'codigo',	
			'value'=>'$data->getMostrarCodigo()',	
			//'value'=>'$data->codigo',	
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
		),
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
		array(
        		'name'=>'fecha_derivacion',
        		'header'=>'Fecha/Hora Derivación',
        		//'value'=>'date("d/m/Y",$data->fecha_derivacion)',
        		'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
				//'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				//'action'=>array('/Seguimientos/AjaxEditFechaDerivacion'),
				'htmlOptions'=>array('style'=>'text-align:center; padding-left:20px; font-size:12px;'),
			),
		array(
				'name'=>'derivado_a',
				'header'=>'Derivado A',
				'value'=>'$data->getUsuario($data->derivado_a)',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				'filter' => false,
			),

		array(
        		'name'=>'fecha_recepcion',
        		'header'=>'Fecha/Hora Recepción',
        		'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_recepcion))." - ".$data->hora_recepcion',
        		//'value'=>'date("m/d/Y",$data->fecha_recepcion)',
				//'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				//'action'=>array('/Seguimientos/AjaxEditFechaRecepcion'),
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
			),
		array(
        		'name'=>'proveido',
        		'header'=>'Proveído',
				//'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				//'action'=>array('/Seguimientos/AjaxEditProveido'),
				'htmlOptions'=>array('style'=>'text-align:left; padding-left:5px; font-size:12px;'),
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
				'filter' => false,
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),*/
		array(
        'class'=>'CButtonColumn',
        'template' => '{addUsuario}', //{ingresoPdf}{verDetalle}{verExcel} {verificarIngreso}
        'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
			/*'cambiarDerivacion'=>
			    array(
			    	'label'=>'  Modificar',
			       	'url'=>'$this->grid->controller->createUrl("UpdateSeguimiento", array("id"=>$data->id_seguimiento,"asDialog"=>1,"gridId"=>$this->grid->id))',
			          	'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
              				//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',
			          'options' => array(
              					'class'=>'btn btn-block btn-success  fa fa-tasks',
              						), 	
				),// fin */
			'addUsuario' => array(
			    'label'=>' Mod. Derivación',
			    'url'=>"CHtml::normalizeUrl(array('updateSeguimientos', 'id'=>\$data->id_seguimiento
			        ))",
			//'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
			'options' => array('class'=>'addUsuario btn btn-block btn-success fa fa-tasks'),
			    ),

          ),
        ),// fin buttons
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
	    'title'=>'Detail view',
	    'autoOpen'=>false,
	    'modal'=>true,
	    'width'=>750,
	    'height'=>400,
	),
	));
?>
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>