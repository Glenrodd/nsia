<?php
/* @var $this RegionalesController */
/* @var $model Regionales */

$this->breadcrumbs=array(
	'Regionales'=>array('index'),
	$model->id_regional=>array('view','id'=>$model->id_regional),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Regionales', 'url'=>array('index')),
	array('label'=>'Create Regionales', 'url'=>array('create')),
	array('label'=>'View Regionales', 'url'=>array('view', 'id'=>$model->id_regional)),
	array('label'=>'Manage Regionales', 'url'=>array('admin')),
);*/
?>



<h3><strong>Actualizar Gerencia Regional #<?php echo $model->id_regional; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('regionales/create'), array('class'=>'btn btn-block btn-success')); ?>
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

<?php $this->renderPartial('_form', array('model'=>$model)); ?>