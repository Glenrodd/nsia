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

                 <a class="btn btn-app" href="index.php?r=documentos/asignarNuevoCite&id=<?=$model->id_documento?>" style="color: black; " onclick="event.stopPropagation(); Loading.show(); return true;" >
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
                        array('class'=>'btn btn-app', 'id'=>'nuris_pend',
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

                <?php echo CHtml::link(' <i class="fa fa-outdent"></i>NURIs Creados', "",  
                      // the link for open the dialog
                        array('class'=>'btn btn-app', 'id'=>'nuris_creados',
                        'style'=>'cursor: pointer; text-decoration: none; color:black;',
                        'onclick'=>"{addNuriCreado(); $('#dialogNuri').dialog('open');}"));?>  

                <a class="btn btn-app" href="index.php?r=site/menuDocumentos" style="color: black;">
                  <i class="fa fa-list"></i>Admin. Documentos
                </a>




                <?php 
                  // verificar si esta asignado al documento
                  if (Documentos::countDocumentos($model->id_documento)!=0) { 
                     if (Documentos::getCountUserDerivacion()>0) {

                      // codigo para verificar si el nuri es nuevo y no tiene derivaciones
                      // en caso de no tener muestra el boton derivar  documento nuevo
                       if(Documentos::countNurNuevoSeguimiento($row['nur'])==0) { ?>

                          <a class="btn btn-app" href="index.php?r=seguimientos/derivarDocumento&id_documento=<?=$model->id_documento?>&id_hoja_ruta=<?=$row['id_hoja_ruta']?>" style="color: black;">
                            <i class="fa fa-share-square-o"></i>Derivar
                          </a>

                       <?php } ?>

                        <?php 

                        // codigo para verificar si el documento fue asociado al inicio o es un documento asociado
                        // a un nueri pendiente esto lo realizamos y lo comprobamos con el id del docuemnto
                        // si nro=0 es el documento asociado al inicio del tramite

                        if(Documentos::verificarDocumentoOriginal($model->id_documento)!=0) { 

                            // cosigo para verificar si esta en los pendientes del usuario
                            if(Documentos::countNurSeguimientoPendiente($row['nur'],$row['nro'])>0) { ?>

                              <a class="btn btn-app" href="index.php?r=seguimientos/derivarDocumentoPendiente&id_seguimiento=<?=$row['nro']?>" style="color: black;">
                                <i class="fa fa-share-square-o"></i>Derivar Pendiente
                              </a>
                       <?php 
                            } //if(Documentos::countNurNuevoSeguimiento($row['nur'],$row['nro'])>0) { 
                        } //if(Documentos::verificarDocumentoOriginal($model->id_documento)==0) { 
                ?>
                <!-- ################################################################ -->

                    <?php   

                    } //if (Documentos::getCountUserDerivacion()>0) {
                        else{ ?>
                          <br>
                          <i style="color:#0B4C5F; font-size: 16px;"> 
                            No puede derivar el documento sin tener agregados usuarios en la lista de derivaci&oacute;n 
                          </i>
                                            
                   <?php    }    
                     } //if (Documentos::countDocumentos($model->id_documento)!=0) {    
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

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogClassroom',
    'options'=>array(
        'title'=>'Asignar NUR/NURI Pendiente',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'60%',
        'height'=>470,
    ),
));?>
<div class="divForForm"></div>

<?php $this->endWidget();?>
<!--##################################################################-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogNuri',
    'options'=>array(
        'title'=>'Asignar NUR/NURI Creado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'60%',
        'height'=>470,
    ),
));?>
<div class="divForFormNuri"></div>

<?php $this->endWidget();?>
<!--##################################################################-->



    <script type="text/javascript">
// here is the magic
function addClassroom()
{
  <?php echo CHtml::ajax(array(
      'url'=>array('documentos/asignarNuriPendiente', 'id_documento'=>$model->id_documento),
      'data'=> "js:$(this).serialize()",
      'type'=>'post',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        if (data.status == 'failure')
        {
          $('#dialogClassroom div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
          $('#dialogClassroom div.divForForm form').submit(addClassroom);
        }
        else
        {
          $('#dialogClassroom div.divForForm').html(data.div);
          setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
          location.reload();
        }
        
      } ",
      ))?>;
  return false; 
  
}

// codigo para mostrar nuris creados sin derivar

function addNuriCreado()
{
  <?php echo CHtml::ajax(array(
      'url'=>array('documentos/asignarNuriCreado', 'id_documento'=>$model->id_documento),
      'data'=> "js:$(this).serialize()",
      'type'=>'post',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        if (data.status == 'failure')
        {
          $('#dialogNuri div.divForFormNuri').html(data.div);
                          // Here is the trick: on submit-> once again this function!
          $('#dialogNuri div.divForFormNuri form').submit(addNuriCreado);
        }
        else
        {
          $('#dialogNuri div.divForFormNuri').html(data.div);
          setTimeout(\"$('#dialogNuri').dialog('close') \",3000);
          location.reload();
        }
        
      } ",
      ))?>;
  return false; 
  
}

</script>     


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