<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Crear nuevo usuario',
);

/*$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>


<!-- 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-edit"></i>
                  Operaciones
                </h3>
              </div>
              <div class="card-body pad table-responsive">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php //echo CHtml::link('Administración',array('usuarios/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
              </div>
           </div>   
          </div>
        </div>
    </div>
 </section> -->

<h3><strong>Registrar nuevo usuario</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('usuarios/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section>  

<?php $this->renderPartial('_form', array('model'=>$model)); ?>