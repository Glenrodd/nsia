<?php
/* @var $this MotivosController */
/* @var $model Motivos */

$this->breadcrumbs=array(
	'Motivoses'=>array('index'),
	$model->id_motivo,
);

/*$this->menu=array(
	array('label'=>'List Motivos', 'url'=>array('index')),
	array('label'=>'Create Motivos', 'url'=>array('create')),
	array('label'=>'Update Motivos', 'url'=>array('update', 'id'=>$model->id_motivo)),
	array('label'=>'Delete Motivos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_motivo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Motivos', 'url'=>array('admin')),
);*/
?>

<h3><strong>Ver Motivo #<?php echo $model->id_motivo; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('motivos/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Actualizar Registro',array('motivos/update','id'=>$model->id_motivo), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      

                      <?php echo CHtml::link('Eliminar Registro',"#", array("submit"=>array('delete', 'id'=>$model->id_motivo), 'confirm' => 'Realmente desea eliminar este registro','class'=>'btn btn-block btn-danger')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Administración',array('motivos/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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
							//'id_motivo',
							'motivo',
							'descripcion',
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




