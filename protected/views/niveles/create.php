<?php
/* @var $this NivelesController */
/* @var $model Niveles */

$this->breadcrumbs=array(
	'Niveles'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Niveles', 'url'=>array('index')),
	array('label'=>'Manage Niveles', 'url'=>array('admin')),
);*/
?>



<h3><strong>Registrar nuevo Nivel de Usuario</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('niveles/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>