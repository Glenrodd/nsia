<?php
/* @var $this AccionesController */
/* @var $model Acciones */

$this->breadcrumbs=array(
	'Acciones'=>array('index'),
	$model->id_accion=>array('view','id'=>$model->id_accion),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Acciones', 'url'=>array('index')),
	array('label'=>'Create Acciones', 'url'=>array('create')),
	array('label'=>'View Acciones', 'url'=>array('view', 'id'=>$model->id_accion)),
	array('label'=>'Manage Acciones', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Acci&oacute;n #<?php echo $model->id_accion; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('acciones/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('acciones/admin'), array('class'=>'btn btn-block btn-warning')); ?>
                    </td>
                  </tr>
                </table>
            </div>    
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>