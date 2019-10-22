<?php
/* @var $this EstadoDocumentoController */
/* @var $model EstadoDocumento */

$this->breadcrumbs=array(
	'Estado Documentos'=>array('index'),
	$model->id_estado_documento,
);

/*$this->menu=array(
	array('label'=>'List EstadoDocumento', 'url'=>array('index')),
	array('label'=>'Create EstadoDocumento', 'url'=>array('create')),
	array('label'=>'Update EstadoDocumento', 'url'=>array('update', 'id'=>$model->id_estado_documento)),
	array('label'=>'Delete EstadoDocumento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_estado_documento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstadoDocumento', 'url'=>array('admin')),
);*/
?>

<h3><strong>Ver Estado de Documento #<?php echo $model->id_estado_documento; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('estadoDocumento/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Actualizar Registro',array('estadoDocumento/update','id'=>$model->id_estado_documento), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      

                      <?php echo CHtml::link('Eliminar Registro',"#", array("submit"=>array('delete', 'id'=>$model->id_estado_documento), 'confirm' => 'Realmente desea eliminar este registro','class'=>'btn btn-block btn-danger')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Administración',array('estadoDocumento/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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
							//'id_estado_documento',
							'estado_documento',
							'descripcion',
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



