<?php
/* @var $this PerfilesController */
/* @var $model Perfiles */

$this->breadcrumbs=array(
	'Perfiles'=>array('index'),
	$model->id_perfil=>array('view','id'=>$model->id_perfil),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Perfiles', 'url'=>array('index')),
	array('label'=>'Create Perfiles', 'url'=>array('create')),
	array('label'=>'View Perfiles', 'url'=>array('view', 'id'=>$model->id_perfil)),
	array('label'=>'Manage Perfiles', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Perfil #<?php echo $model->id_perfil; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('perfiles/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('perfiles/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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