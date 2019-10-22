<?php
/* @var $this TipoDocumentoController */
/* @var $model TipoDocumento */

$this->breadcrumbs=array(
	'Tipo Documentos'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List TipoDocumento', 'url'=>array('index')),
	array('label'=>'Manage TipoDocumento', 'url'=>array('admin')),
);*/
?>

<h3><strong>Registrar nuevo Tipo de Documento</strong></h3>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card-body pad table-responsive">    
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Administración',array('tipoDocumento/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
             </div>   
          </div>
        </div>
    </div>
 </section> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>