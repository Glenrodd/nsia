<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	$model->id_documento,
);

/*$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Create Documentos', 'url'=>array('create')),
	array('label'=>'Update Documentos', 'url'=>array('update', 'id'=>$model->id_documento)),
	array('label'=>'Delete Documentos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_documento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);*/
?>




<h3><strong>Ver Carta #<?php echo $model->id_documento; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>

                      <?php echo CHtml::link('Administración Cartas',array('documentos/administracionCarta','tipo_documento'=>$model->fk_tipo_documento,'gestion'=>$model->gestion), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>

                </table>
            </div>    
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section> 


 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->

                 

					<?php $this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'attributes'=>array(
							//'id_documento',
							/*array(               
					            'label'=>'City',
					            'type'=>'raw',
					            'value'=>CHtml::link(CHtml::encode($model->contenido),
					                                 array('city/view','id'=>$model->contenido)),
					        ),*/
					        array(               
					            'label'=>'NURI/NUR',
					            'type'=>'raw',
					            'value'=>$model->verificarNuri($model->id_documento),
					            'htmlOptions'=>array('style'=>'text-align:center; font-size:33px; color:red;'),
					            
					        ),
							'codigo',
							//'destinatario_titulo',
							'destinatario_nombres',
							'destinatario_cargo',
							//'via_nombres',
							//'via_cargo',
							'destinatario_institucion',
							//'remitente_institucion',
							'referencia',
							'contenido:html',
							'remitente_nombres',
							'remitente_cargo',
							'adjuntos',
							'copias',
							array(
								'name'=>'Estado Documento',
								'value'=>$model->fkEstadoDocumento->estado_documento,
							),
							//'fecha',
							array(
								'name'=>'Fecha/Hora',
								'value'=>Yii::app()->dateFormatter->format("dd/MM/y",strtotime($model->fecha))." - ".$model->hora,
							),
							//'hora',
							//'nro_hojas',
							//'gestion',
							//'fecha_registro',
							//'hora_registro',
							//'fk_usuario',
							//'fk_tipo_documento',
							array(
								'name'=>'Tipo Documento',
								'value'=>$model->fkTipoDocumento->tipo_documento,
							),
							//'fk_estado_documento',
							//'fk_area',
							array(
								'name'=>'Área/Unidad',
								'value'=>$model->fkArea->area,
							),
							//'fk_documento',
							//'ruta_documento',
							//'activo',
							array(
								'name'=>'Estado',
								'value'=>$model->activo==1?'Habilitado':'Deshabilitado',
							),
						),
					)); ?>
                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>


