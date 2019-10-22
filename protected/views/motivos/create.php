<?php
/* @var $this MotivosController */
/* @var $model Motivos */

$this->breadcrumbs=array(
	'Motivoses'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Motivos', 'url'=>array('index')),
	array('label'=>'Manage Motivos', 'url'=>array('admin')),
);*/
?>

<h3><strong>Registrar nuevo Motivo (Carta Externa)</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('motivos/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>