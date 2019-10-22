<?php
/* @var $this TipoDocumentoController */
/* @var $model TipoDocumento */

$this->breadcrumbs=array(
	'Tipo Documentos'=>array('index'),
	$model->id_tipo_documento=>array('view','id'=>$model->id_tipo_documento),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List TipoDocumento', 'url'=>array('index')),
	array('label'=>'Create TipoDocumento', 'url'=>array('create')),
	array('label'=>'View TipoDocumento', 'url'=>array('view', 'id'=>$model->id_tipo_documento)),
	array('label'=>'Manage TipoDocumento', 'url'=>array('admin')),
);*/
?>


<h3><strong>Actualizar Tipo de Documento #<?php echo $model->id_tipo_documento; ?></strong></h3>
<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('tipoDocumento/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                     <?php echo CHtml::link('Administración',array('tipoDocumento/admin'), array('class'=>'btn btn-block btn-warning')); ?>
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