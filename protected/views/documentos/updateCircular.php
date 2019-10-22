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

 
 $tipoDocumento=TipoDocumento::model()->findByPk($tipo);
 $row=Documentos::getNuriHojasRuta($model->id_documento);

 $this->widget('ext.widgets.loading.LoadingWidget');
//echo "<br> ------>".$model->id_documento;
//echo "<br> ------>".$tipo;
//exit;
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

                 <a class="btn btn-app" href="index.php?r=documentos/asignarNuevoCite&id=<?=$model->id_documento?>" style="color: black;" onclick="event.stopPropagation(); Loading.show(); return true;" >
                  <i class="fa fa-plus-square"></i>Asignar Nuevo <b>CITE</b>
                </a> 

               <?php 
                  // verificar si esta asignado al documento
                  if (Documentos::countDocumentos($model->id_documento)==0) { ?>
                     
                     <?php echo CHtml::link('<i class="fa fa-pencil-square-o"></i>Asignar Nuevo NURI',
                            array('documentos/asignarNuri',
                                         'id_documento'=>$model->id_documento,
                                         ),
                            array('class'=>'btn btn-app', 'id'=>'nuris_pendientes',
                                  'style'=>'cursor: pointer; text-decoration: none; color: white; background-color: #0489B1;',
                                  'confirm' => 'Esta seguro de asignar un nuevo NURI ?')
                     ); ?>

                     <?php echo CHtml::link(' <i class="fa fa-stack-overflow"></i>NURIs Pendientes', "",  
                      // the link for open the dialog
                        array('class'=>'btn btn-app', 'id'=>'nuris_pendie',
                        'style'=>'cursor: pointer; text-decoration: none; color:black;',
                        'onclick'=>"{addClassroom(); $('#dialogClassroom').dialog('open');}"));?>



                  <?php }
                  else{ ?>
                      <a class="btn btn-app" style="color: gray;">
                        <i class="fa fa-pencil-square-o"></i>Asignar NURI
                      </a>
                  <?php }

               ?>
               
                <!--<a class="btn btn-app" href="index.php?r=areas/admin" style="color: black;">
                  <i class="fa fa-file-word-o"></i>Generar Word
                </a>-->
                <?php if ($row['id_hoja_ruta']!='') { ?>

                <a class="btn btn-app" href="index.php?r=documentos/generarCircularPDF&id_documento=<?=$model->id_documento?>&id_hoja_ruta=<?=$row['id_hoja_ruta']?>" style="color: black;">
                  <i class="fa fa-file-pdf-o"></i>Generar Documento
                </a>

               <?php //if (Yii::app()->user->id_usuario==1) { ?>
                <a class="btn btn-app" href="index.php?r=documentos/generarMemorandumWORD&id_documento=<?=$model->id_documento?>&id_hoja_ruta=<?=$row['id_hoja_ruta']?>" style="color: black;">
                  <i class="fa fa-file-word-o"></i>Generar Word
                </a>

                <?php } ?>


                <?php //} ?>

                <a class="btn btn-app" href="index.php?r=site/menuDocumentos" style="color: black;">
                  <i class="fa fa-list"></i>Admin. Documentos
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
          <h3 style="color:#0B4C5F;" >
            <i class="icon fa fa-file-text-o" style="font-size:40px;" ></i>
            <?=$tipoDocumento->tipo_documento?>
          </h3>
        </div>
      <!-- /.card -->
    </div>
   <!-- /.col -->
   <div class="col-md-4">
        <!-- /.card-header -->
        <div class="card-body">
           <div class="nuri">
          <center>
            <h4 style="color:#1B4C89; font-size:30px;">
              <?php if ($row['nur']!='') { ?>
                  <strong><u><?=$row['nur']?></u></strong>
             <?php } ?>
            </h4>
          </center>
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



<?php $this->renderPartial('_formCircular', array('model'=>$model,'tipo'=>$tipo)); ?>