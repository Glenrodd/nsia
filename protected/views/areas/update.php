<?php
/* @var $this AreasController */
/* @var $model Areas */

$this->breadcrumbs=array(
	'Areases'=>array('index'),
	$model->id_area=>array('view','id'=>$model->id_area),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Areas', 'url'=>array('index')),
	array('label'=>'Create Areas', 'url'=>array('create')),
	array('label'=>'View Areas', 'url'=>array('view', 'id'=>$model->id_area)),
	array('label'=>'Manage Areas', 'url'=>array('admin')),
);*/
?>


<h3><strong>Actualizar &Aacute;rea/Unidad #<?php echo $model->id_area; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('areas/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('areas/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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