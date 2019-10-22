<?php
/* @var $this AccionesController */
/* @var $model Acciones */

$this->breadcrumbs=array(
	'Acciones'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Acciones', 'url'=>array('index')),
	array('label'=>'Manage Acciones', 'url'=>array('admin')),
);*/
?>


<h3><strong>Registrar nueva Acci&oacute;n</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('acciones/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>