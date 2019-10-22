<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->id_usuario=>array('view','id'=>$model->id_usuario),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'View Usuarios', 'url'=>array('view', 'id'=>$model->id_usuario)),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Usuario #<?php echo $model->id_usuario; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('usuarios/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('usuarios/admin'), array('class'=>'btn btn-block btn-info')); ?>
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