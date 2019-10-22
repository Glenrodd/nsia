<?php
/* @var $this GrupoDerivacionController */
/* @var $model GrupoDerivacion */

$this->breadcrumbs=array(
	'Grupo Derivacions'=>array('index'),
	'Create',
);


?>



<h3><strong>Registrar nuevo Grupo</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('GrupoDerivacion/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>