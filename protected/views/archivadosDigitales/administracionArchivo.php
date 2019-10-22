<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */

$this->breadcrumbs=array(
	'Archivados Digitales'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List ArchivadosDigitales', 'url'=>array('index')),
	array('label'=>'Create ArchivadosDigitales', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#archivados-digitales-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><b>Archivo Digital Gesti&oacute;n  <?=$gestion?></b></h3>
<h4><i>(Copias Digitales)</i></h4> 


<?php //echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
</div><!-- search-form -->



<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">NUR/NURI(s) </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<p style="color:#0B2F3A">
				Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
				</p>



              		<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'archivados-digitales-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					//'id_archivado_digital',
					//'codigo',
					array(
							'name'=>'codigo',
							'header'=>'NUR/NURI',
							'value'=>'$data->codigo',
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					//'fecha_archivo',
					array(
							'name'=>'fecha_archivo',
							'header'=>'Fecha/Hora Archivo',
							'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_archivo))." - ".$data->hora_archivo',
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					//'hora_archivo',
					//'lugar',
					'observaciones',
					array(
							'name'=>'fk_usuario',
							'header'=>'Usuario Archivo',
							'value'=>'$data->fkUsuario->nombre',
							'filter'=>false,
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					array(
							'name'=>'codigo',
							'header'=>'Área/Unidad',
							'value'=>'$data->fkUsuario->fkArea->area',
							'filter'=>false,
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					/*
					'fk_usuario',
					'fk_seguimiento',
					'fecha_registro',
					'hora_registro',
					'gestion',
					'activo',
					*/
					array(
			        'class'=>'CButtonColumn',
			        'template' => '{verDetalle}{desarchivar}',
			        'htmlOptions'=>array('width'=>'200px','style'=>'text-align:center',),
			        //'template' => '{solicitudPdf}',
			        'buttons'=>array(
			            
			             
			             'verDetalle'=>
							array(
									'label'=>'<i class="fa fa-desktop"></i> Ver Detalle',
								    'url'=>'Yii::app()->createUrl("ArchivadosDigitales/verDetalleNuri", array("id"=>$data->fk_seguimiento,"asDialog"=>1))',
								    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/window.png',
								    'options'=>array(  
								    'ajax'=>array(
								            'type'=>'POST',
								                // ajax post will use 'url' specified above 
								            'url'=>"js:$(this).attr('href')", 
								            'update'=>'#id_view',
								           ),
								        'class'=>'verDetalle btn btn-app'
								     ),
							    ),
						 'desarchivar' => array(
			                  'label'=>'<i class="fa fa-archive"></i> Desarchivar',
			                  'url'=>"CHtml::normalizeUrl(array('ArchivadosDigitales/desarchivoNuri', 'id'=>\$data->id_archivado_digital
			                    ))",
			                      //'imageUrl'=>Yii::app()->request->baseUrl.'/images/archive.png',
			                    'options' => array('class'=>'desarchivar btn btn-app'),

			                     'click'=>'function(){return confirm("Realmente desea desarchivar el NUR/NURI ?  "+$(this).parent().parent().children(":nth-child(1)").text()+" ");}',
			              ),

			          ),
			        ), // fin buttons
				),
			)); ?>
                 
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>




<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
'id'=>'dlg-address-view',
'options'=>array(
    'title'=>'Desarchivo',
    'autoOpen'=>false, //important!
    'modal'=>true,
    'width'=>950,
    'height'=>500,
),
));
?>
	<div id="id_view"></div>

<?php $this->endWidget();?>




