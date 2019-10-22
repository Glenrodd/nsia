<?php
/* @var $this RegionalesController */
/* @var $model Regionales */

$this->breadcrumbs=array(
	'Regionales'=>array('index'),
	$model->id_regional,
);

/*$this->menu=array(
	array('label'=>'List Regionales', 'url'=>array('index')),
	array('label'=>'Create Regionales', 'url'=>array('create')),
	array('label'=>'Update Regionales', 'url'=>array('update', 'id'=>$model->id_regional)),
	array('label'=>'Delete Regionales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_regional),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Regionales', 'url'=>array('admin')),
);*/
?>

<h3><strong>Ver Gerencia Regional #<?php echo $model->id_regional; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('regionales/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Actualizar Registro',array('regionales/update','id'=>$model->id_regional), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      

                      <?php echo CHtml::link('Eliminar Registro',"#", array("submit"=>array('delete', 'id'=>$model->id_regional), 'confirm' => 'Realmente desea eliminar este registro','class'=>'btn btn-block btn-danger')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Administración',array('regionales/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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
							//'id_regional',
							'regional',
							'sigla',
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


