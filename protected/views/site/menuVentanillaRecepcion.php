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
    <h3><b>Ventanilla de Recepci&oacute;n</b></h3>
    <br>



<!-- Main content -->
    <section class="content">
      <!-- =========================================================== -->
       <div class="row">

        	<div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header"  style="background-color: #086A87; color: white;">
                <h3 class="card-title">Opciones disponibles</h3>
                
                <div class="card-tools">
		            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
		              <i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		              <i class="fa fa-times"></i></button>
		        </div>

              </div>
            <center>
              <div class="card-body">
              
                <a class="btn btn-app" href="index.php?r=documentos/createCartaExterna" style="color: black;">
                  <i class="fa fa-file-archive-o"></i> 
                  <b class="parpadea text">
                    RECEPCI&Oacute;N EXTERNA
                  </b>
                </a>

                <a href="index.php?r=seguimientos/adminCorregirDerivacion" class="btn btn-app" style="color: black;">
                  <i class="fa fa-external-link"></i> Corregir Derivaci&oacute;n
                </a>

                <a href="index.php?r=seguimientos/documentacionDespachadaExternaPDF&id_usuario=<?=Yii::app()->user->id_usuario;?>" class="btn btn-app" style="color: black;">
                  <i class="fa fa-file-pdf-o"></i> Doc. Despachada
                </a>

                <a href="index.php?r=hojasRuta/administracionCartaExterna&tipo_documento=7&gestion=<?=date('Y')?>" class="btn btn-app" style="color: black;">
                  <i class="fa fa-pencil-square"></i> Modificar/Imprimir HS
                </a>

                <a href="index.php?r=hojasRuta/menuGestionExterno" class="btn btn-app" style="color: black;">
                  <i class="fa fa-pencil-square"></i> Modificar/Imprimir HS (Gestion)
                </a>



                <!--<a class="btn btn-app" href="index.php?r=hojasRuta/menuGestionExterno" style="color: black;">
                  <i class="fa fa-newspaper-o"></i> NURI(s) Creados
                </a>-->

                <a class="btn btn-app" href="index.php?r=usuarios/updatePassword" style="color: black;">
                  <i class="fa fa-users"></i> Cambiar Contraseña
                </a>

                <a class="btn btn-app" href="index.php?r=hojasRuta/nurFechaExterno" style="color: black;">
                  <i class="fa fa-calendar"></i> NURI(s) por Fechas
                </a>

                <!--<a class="btn btn-app" href="index.php?r=documentos/adminCartaExterna" style="color: black;">
                  <i class="fa fa-list"></i>Admin. Cartas Externas
                </a>-->
                <a class="btn btn-app"  href="index.php?r=motivos/admin" style="color: black;">
                  <i class="fa fa-list-alt"></i> Motivos Carta Externa
                </a>
                
              </div>

            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div><!-- col-md-12-->
          
		  </div>
      <!-- /.row -->
      <!-- =========================================================== -->
      





    </section>
    <!-- /.content -->

    <!-- jQuery -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script> 