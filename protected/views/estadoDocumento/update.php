<?php
/* @var $this EstadoDocumentoController */
/* @var $model EstadoDocumento */

$this->breadcrumbs=array(
	'Estado Documentos'=>array('index'),
	$model->id_estado_documento=>array('view','id'=>$model->id_estado_documento),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List EstadoDocumento', 'url'=>array('index')),
	array('label'=>'Create EstadoDocumento', 'url'=>array('create')),
	array('label'=>'View EstadoDocumento', 'url'=>array('view', 'id'=>$model->id_estado_documento)),
	array('label'=>'Manage EstadoDocumento', 'url'=>array('admin')),
);*/
?>

<h3><strong>Actualizar Estado de Documento #<?php echo $model->id_estado_documento; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('estadoDocumento/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('estadoDocumento/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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