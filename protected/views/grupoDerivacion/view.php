<?php
/* @var $this GrupoDerivacionController */
/* @var $model GrupoDerivacion */

$this->breadcrumbs=array(
	'Grupo Derivacions'=>array('index'),
	$model->id_grupo_derivacion,
);

/*$this->menu=array(
	array('label'=>'List GrupoDerivacion', 'url'=>array('index')),
	array('label'=>'Create GrupoDerivacion', 'url'=>array('create')),
	array('label'=>'Update GrupoDerivacion', 'url'=>array('update', 'id'=>$model->id_grupo_derivacion)),
	array('label'=>'Delete GrupoDerivacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_grupo_derivacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GrupoDerivacion', 'url'=>array('admin')),
);*/
?>

<h3><strong>Ver Grupo Derivaci&oacute;n #<?php echo $model->id_grupo_derivacion; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('grupoDerivacion/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Actualizar Registro',array('grupoDerivacion/update','id'=>$model->id_grupo_derivacion), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      

                      <?php echo CHtml::link('Eliminar Registro',"#", array("submit"=>array('delete', 'id'=>$model->id_grupo_derivacion), 'confirm' => 'Realmente desea eliminar este registro','class'=>'btn btn-block btn-danger')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Administración',array('grupoDerivacion/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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

              		<?php $this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'attributes'=>array(
							//'id_grupo_derivacion',
							'nombre_grupo',
							//'fk_area',
							array(
								'name'=>'Área/Unidad',
								'value'=>$model->fkArea->area,
							),

							//'fk_usuario',
							array(
								'name'=>'Usuario',
								'value'=>$model->fkUsuario->nombre,
							),
							
							//'fk_regional',
							array(
								'name'=>'Gerencia Regional',
								'value'=>$model->fkRegional->regional,
							),
							
							//'fecha_registro',
							//'hora_registro',
							//'activo',
							array(
								'name'=>'Estado',
								'value'=>$model->activo==1?'Habilitado':'Deshabilitado',
							),
						),
					)); ?>
                  <!-- text input -->
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