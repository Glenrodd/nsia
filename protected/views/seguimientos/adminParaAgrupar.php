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
<div class="row">
    <div class="col-md-4">
        <!-- /.card-header -->
        <div class="card-body">
        	<h5 style="color:#0B4C5F;" ><i class="icon fa fa-laptop" style="font-size:40px;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u  style="font-size: 25px;">Agrupar NUR/NURI(s)</u></b>
            </h5>
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
   <div class="col-md-8">
        <!-- /.card-header -->
        <div class="card-body">
	        <a class="btn btn-app" href="index.php?r=seguimientos/pendientesOficiales" style="color: black;">
                  <i class="fa fa-stack-overflow"></i>Retornar P. Oficiales
            </a>
            <a class="btn btn-app" href="index.php?r=seguimientos/pendientesDigitales" style="color: black;">
                  <i class="fa fa-ravelry"></i>Retornar P. Digitales
            </a>
            <a class="btn btn-app" href="index.php?r=seguimientos/printCaratulaAgrupacion&id_seguimiento=<?=$id_seguimiento?>" style="color: black;">
                  <i class="fa fa-print"></i>Imprimir Caratula
            </a>

            <a class="btn btn-app" href="index.php?r=seguimientos/derivarDocumentoPendiente&id_seguimiento=<?=$id_seguimiento?>" style="color: black;">
                  <i class="fa fa-share-square-o"></i>Derivar
            </a>
            <a class="btn btn-app" href="index.php?r=seguimientos/anadirRespuesta&id=<?=$id_seguimiento?>" style="color: black;">
                  <i class="fa fa-user-plus"></i>Añadir Respuesta
            </a>
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
</div>
<!-- /.row -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
              	<center>
                <h3 class="card-title">NUR/NURI Principal: <b><?=$nuri?></b></h3>
                </center>
              </div>
              <!-- /.card-header -->
              	<div class="row">
          		<!-- right column -->
          			<div class="col-md-6">
			              	<div class="card-body pad table-responsive">
			              		<center><i>NUR/NURI(s) agrupados por el usuario: <b><?=Yii::app()->user->usuario;?></b> </i></center>
								<table class="table table-bordered table-striped">
								  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
									<th align="center">NUR/NURI</th>
									<th align="center">Prove&iacute;do</th>
									<th></th>
								  </tr>
								  <?php $dataReader=Seguimientos::getListaNurisAgrupados($id_seguimiento); ?>	

								  <?php foreach ($dataReader as $row) { ?>	
								  <tr  style="font-size: 13px;">
								    <td><?=$row['nuri']?><br>
								    	<i style="font-size: 10px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i>
								    </td>
								    <td><?=$row['proveido']?></td>
								    <td align="center">
								    	<?php  

										    echo CHtml::link('<i class="fa fa-times-circle" style="font-size:17px;"></i> Desagrupar',array('Seguimientos/deleteAgrupacion',
							                                         'id_agrupacion'=>$row['id_agrupacion']),array('class'=>'btn btn-danger btn-sm')); 
								        ?>

								    </td>
								  </tr>
								 <?php } ?>
								</table>
							
			              </div>
			              <!-- /.card-body -->

          			</div> <!-- / fin col-md-6 -->
          			<div class="col-md-6">
          					
			              	<div class="card-body pad table-responsive" style="height:500px; overflow:auto; border:1px solid lightgray; border-radius: 5px;"" >
			              		<center><i>NUR/NURI(s) agrupados en general</i></center>
								<table class="table table-bordered table-striped">
								  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
									<th align="center">NUR/NURI</th>
									<th align="center">Prove&iacute;do</th>
									<th align="center">Usuario</th>
								  </tr>
								  <?php $dataReader2=Seguimientos::getListaNurisAgrupadosCompleto($nuri); ?>	

								  <?php foreach ($dataReader2 as $row2) { ?>	
								  <tr  style="font-size: 12px;">
								    <td><?=$row2['nuri']?><br>
								    	<i style="font-size:9px; font-weight: bold; text-align: center;" ><?=$row2['tipo_documento']?></i>
								    </td>
								    <td><?=$row2['proveido']?></td>
								    <td><?=$row2['usuario_agrupacion']?></td>
								    
								  </tr>
								 <?php } ?>
								</table>
							
			              </div>
			              <!-- /.card-body -->

          			</div> <!-- / fin col-md-6 -->
          		</div>	
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>




<!--<p style="color:#0B2F3A">
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>-->

<?php //echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php 
Yii::import('zii.widgets.grid.CGridView');

class SpecialGridView extends CGridView {
    public $id_seguimiento;
    public $nuri;
}
?>

<?php $this->widget('SpecialGridView', array(
	'id'=>'seguimientos-grid',
	'dataProvider'=>$model->searchParaAgrupar($id_seguimiento),
	'id_seguimiento'=>$id_seguimiento,
	'nuri'=>$nuri,
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
			'value'=>'"<b>".$data->codigo."</b>"',	
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center;',),
		),

		array(
			'header'=>'Tipo',	
			'name'=>'oficial',	
			'value'=>'$data->oficial==1?"Original":"Copia Digital"',	
            'type' => 'raw',
            'filter' => array(1 => 'Original', 0 => 'Copia Digital'),
            'htmlOptions'=>array('style'=>'text-align:center;',),
		),

		array(
			'header'=>'Derivado Por:',	
			'name'=>'derivado_por',	
			'value'=>'$data->getUsuarioPendientes($data->derivado_por)',	
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center; font-size:14px;',),
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
		/*array(
			'header'=>'Fecha/Hora Derivación:',	
			'name'=>'fecha_derivacion',	
			'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
            'type' => 'raw',
            'htmlOptions'=>array('style'=>'text-align:center',),
		),*/


		//############################################################
		 array(
		 		'header'=>'Fecha/Hora Derivación:',	
	            'name' => 'fecha',
	            //'value'=>'$data->fecha',
	            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
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
		            	'id'=>'fecha_derivacion',
		            	),

		            ),
	            true),

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
        'template' => '{recibirDocumento}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'130px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

          'recibirDocumento' => array(
            'label'=>' Agrupar',
            'url'=>"CHtml::normalizeUrl(array('Seguimientos/addNuriAgrupacion', 'id_principal'=>\$this->grid->id_seguimiento, 'nuri_p'=>\$this->grid->nuri, 'id_hijo'=>\$data->id_seguimiento,'nuri_h'=>\$data->codigo, 'oficial'=>\$data->oficial
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		'class'=>'btn btn-block btn-success  fa fa-tasks',
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

              	),
              'visible'=>'$data->getCountNurisAgrupados($data->id_seguimiento) == 0',
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

