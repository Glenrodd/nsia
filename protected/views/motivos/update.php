<?php
/* @var $this MotivosController */
/* @var $model Motivos */

$this->breadcrumbs=array(
	'Motivoses'=>array('index'),
	$model->id_motivo=>array('view','id'=>$model->id_motivo),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Motivos', 'url'=>array('index')),
	array('label'=>'Create Motivos', 'url'=>array('create')),
	array('label'=>'View Motivos', 'url'=>array('view', 'id'=>$model->id_motivo)),
	array('label'=>'Manage Motivos', 'url'=>array('admin')),
); */
?>

<h3><strong>Actualizar Motivo #<?php echo $model->id_motivo; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('motivos/create'), array('class'=>'btn btn-block btn-success')); ?>
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

<?php $this->renderPartial('_form', array('model'=>$model)); ?>