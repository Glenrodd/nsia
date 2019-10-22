<?php
/* @var $this GrupoDerivacionController */
/* @var $model GrupoDerivacion */

$this->breadcrumbs=array(
	'Grupo Derivacions'=>array('index'),
	$model->id_grupo_derivacion=>array('view','id'=>$model->id_grupo_derivacion),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List GrupoDerivacion', 'url'=>array('index')),
	array('label'=>'Create GrupoDerivacion', 'url'=>array('create')),
	array('label'=>'View GrupoDerivacion', 'url'=>array('view', 'id'=>$model->id_grupo_derivacion)),
	array('label'=>'Manage GrupoDerivacion', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Grupo #<?php echo $model->id_grupo_derivacion; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('GrupoDerivacion/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('GrupoDerivacion/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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