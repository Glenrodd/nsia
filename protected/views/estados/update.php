<?php
/* @var $this EstadosController */
/* @var $model Estados */

$this->breadcrumbs=array(
	'Estadoses'=>array('index'),
	$model->id_estado=>array('view','id'=>$model->id_estado),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Estados', 'url'=>array('index')),
	array('label'=>'Create Estados', 'url'=>array('create')),
	array('label'=>'View Estados', 'url'=>array('view', 'id'=>$model->id_estado)),
	array('label'=>'Manage Estados', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Estado #<?php echo $model->id_estado; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('estados/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('estados/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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