<?php
/* @var $this NivelesController */
/* @var $model Niveles */

$this->breadcrumbs=array(
	'Niveles'=>array('index'),
	$model->id_nivel=>array('view','id'=>$model->id_nivel),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Niveles', 'url'=>array('index')),
	array('label'=>'Create Niveles', 'url'=>array('create')),
	array('label'=>'View Niveles', 'url'=>array('view', 'id'=>$model->id_nivel)),
	array('label'=>'Manage Niveles', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Nivel de Usuario #<?php echo $model->id_nivel; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('niveles/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('niveles/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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