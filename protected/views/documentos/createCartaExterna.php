<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);*/
?>




<?php 
$tipoDocumento=TipoDocumento::model()->findByPk($tipo);
?>

<div class="row">
    <div class="col-md-12">
        <!-- /.card-header -->
        <div class="card-body">
        <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-file-zip-o" style="font-size:40px;" ></i>
			RECEPCI&Oacute;N CARTA EXTERNA</h4>
        </div>
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
</div>
<!-- /.row -->
<!--<h3 style="color:#0B4C5F;" >
    <i class="icon fa fa-file-zip-o" style="font-size:40px;" ></i>
    <? //=$tipoDocumento->tipo_documento?>
</h3>-->

<?php $this->renderPartial('_formCartaExterna', array('model'=>$model,'tipo'=>$tipo)); ?>