<?php
/* @var $this SiteController */
/* @var $error array */

if (Yii::app()->user->isGuest){
  $this->redirect(array('login'));
 }

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

    <?php //echo CHtml::link('Link Text',array('controller/action'), array('class'=>'btn btn-info')); ?>
    <h3><b>Opciones disponibles</b></h3>
    <br>



<!-- Main content -->
    <section class="content">
      <!-- =========================================================== -->
       <div class="row">

        	<div class="col-md-6">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header" style="background-color: #086A87; color: white;">
                <h3 class="card-title">Desarchivo Original/Digital</h3>
                
                <div class="card-tools">
		            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
		              <i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		              <i class="fa fa-times"></i></button>
		        </div>

              </div>
            <center>
              <div class="card-body">
                <a class="btn btn-app" href="index.php?r=seguimientos/desarchivoOriginalGestion" style="color: black;">
                  <i class="fa fa-archive"></i>Original
                </a>
                <a class="btn btn-app" href="index.php?r=archivadosDigitales/desarchivoCopiaGestion" style="color: black;">
                  <i class="fa fa-file-zip-o"></i>Copia Digital
                </a>
                
              </div>

            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div><!-- col-md-6-->
          <!--###################################################################-->
          <div class="col-md-6">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header" style="background-color: #086A87; color: white;">
                <h3 class="card-title">Reportes</h3>
                
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
            </div>

              </div>
            <center>
              <div class="card-body">
                <a class="btn btn-app" href="index.php?r=areas/pendientesGeneralEXCEL" style="color: black;">
                  <i class="fa fa-file-text-o"></i>Pendientes General
                </a>
                <a class="btn btn-app" href="index.php?r=areas/adminPendientesAreas" style="color: black;">
                  <i class="fa fa-file-text"></i>Pendientes Area
                </a>
                
              </div>
            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- col-md-6-->
		  </div>
      <!-- /.row -->
      <!-- =========================================================== -->
       <div class="row">

          <div class="col-md-6">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header" style="background-color: #086A87; color: white;">
                <h3 class="card-title">Asignar Usuario - SAD</h3>
                
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
            </div>

              </div>
            <center>
              <div class="card-body">
                
                <a class="btn btn-app" href="index.php?r=usuarios/adminSAD" style="color: black;">
                  <i class="fa fa-vcard-o"></i>Admin. Usuarios
                </a>
                
                
              </div>

            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- col-md-6-->
          <!--###################################################################-->
          <div class="col-md-6">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header" style="background-color: #086A87; color: white;">
                <h3 class="card-title">Reportes</h3>
                
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
            </div>

              </div>
            <center>
              <div class="card-body">
                
                
              </div>
            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- col-md-6-->
      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->

    <!-- jQuery -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script> 