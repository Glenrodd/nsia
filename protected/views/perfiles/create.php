<?php
/* @var $this PerfilesController */
/* @var $model Perfiles */

$this->breadcrumbs=array(
	'Perfiles'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Perfiles', 'url'=>array('index')),
	array('label'=>'Manage Perfiles', 'url'=>array('admin')),
);*/
?>

<h3><strong>Registrar nuevo Perfil</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('perfiles/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>