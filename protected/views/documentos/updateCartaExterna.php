<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	$model->id_documento=>array('view','id'=>$model->id_documento),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Create Documentos', 'url'=>array('create')),
	array('label'=>'View Documentos', 'url'=>array('view', 'id'=>$model->id_documento)),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);*/


?>

<?php 
 $tipoDocumento=TipoDocumento::model()->findByPk($tipo);
 $row=Documentos::getNuriHojasRuta($model->id_documento);
?>
<!-- Main content -->
    <section class="content">
      <!-- =========================================================== -->
        <div class="row">

          <div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
            <center>
              <div class="card-body">
                <a class="btn btn-app" href="index.php?r=documentos/generarDocumentoPDF&id_documento=<?=$model->id_documento?>&id_hoja_ruta=<?=$row['id_hoja_ruta']?>" style="color: black;">
                  <i class="fa fa-file-text-o"></i>Generar Documento
                </a>
                <?php 
                echo CHtml::link(
                    '<i class="fa fa-file-pdf-o"></i> Ver Archivo PDF',
                    Yii::app()->createUrl('/Documentos/viewCartaPDF', array('filename' => $model->ruta_documento)) ,
                    array('class'=>'btn btn-app','target'=>'_blank', 'style'=>'color: black;'));
                ?>
                <a class="btn btn-app" href="index.php?r=site/menuDocumentos" style="color: black;">
                  <i class="fa fa-list"></i>Admin. Cartas Externas
                </a>  
                <?php 
                  // verificar si esta asignado al documento
                  if (Documentos::countDocumentos($model->id_documento)!=0) { 
                     if (Documentos::getCountUserDerivacion()>0) {

                    ?>
                    <a class="btn btn-app" href="index.php?r=seguimientos/derivarDocumento&id_documento=<?=$model->id_documento?>&id_hoja_ruta=<?=$row['id_hoja_ruta']?>" style="color: black;">
                      <i class="fa fa-share-square-o"></i>Derivar
                    </a>

                  <?php 
                        } //if (Documentos::getCountUserDerivacion()>0) {
                        else{ ?>
                          <br>
                          <i style="color:#0B4C5F; font-size: 16px;"> 
                            No puede derivar el documento sin tener agregados usuarios en la lista de derivaci&oacute;n 
                          </i>
                                            
                   <?php    }    
                     }   
                  ?>

                
                
              </div>
            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
        <!-- /.row -->



    </section>
    <!-- /.content -->  

 


<div class="row">
    <div class="col-md-4">
        <!-- /.card-header -->
        <div class="card-body">
        <div class="alert alert-primary alert-dismissible">
            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
            <h4><i class="icon fa fa-check"></i>
            <b><?=$tipoDocumento->tipo_documento?></b>
          </h4>
        </div>
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
   <div class="col-md-4">
        <!-- /.card-header -->
        <div class="card-body">
        <div class="alert alert-primary alert-dismissible">
           <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <center>
            <h4>
              <?php if ($row['nur']!='') { ?>
                  <strong><?=$row['nur']?></strong>
             <?php } ?>
                </center>
            </h4>
        </div>
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
   <div class="col-md-4">
        <!-- /.card-header -->
        <div class="card-body">
        
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
</div>
<!-- /.row -->





<?php $this->renderPartial('_formCartaExterna', array('model'=>$model,'tipo'=>$tipo)); ?>