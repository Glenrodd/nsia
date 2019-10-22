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
<center>
    <?php //echo CHtml::link('Link Text',array('controller/action'), array('class'=>'btn btn-info')); ?>
</center>


<!-- Main content -->
    <section class="content">
      <!-- =========================================================== -->
        <div class="row">

        	<div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-search"></i> Opciones de B&uacute;squeda</h3>
                
                <div class="card-tools">
  		            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
  		              <i class="fa fa-minus"></i></button>
  		            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
  		              <i class="fa fa-times"></i></button>
		            </div>

              </div>
            <center>
              <div class="card-body">

                <?php  if (Yii::app()->user->id_perfil==1) { ?>
                <a class="btn btn-app" href="index.php?r=documentos/searchEspSintesis" style="color: black;">
                  <i class="fa fa-file-text-o"></i>S&iacute;ntesis
                </a>
                <?php  } ?>

                <a class="btn btn-app" href="index.php?r=documentos/searchEspSintesis" style="color: black;">
                  <i class="fa fa-file-text-o"></i>S&iacute;ntesis
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/searchEspNombreRemitente" style="color: black;">
                  <i class="fa fa-user"></i>Nombre Remitente
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/searchEspecificaCite" style="color: black;">
                  <i class="fa fa-address-book-o"></i><b>CITE</b>
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/searchEspecificaReferencia" style="color: black;">
                  <i class="fa fa-align-center"></i>Referencia
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/searchEspInstRemitente" style="color: black;">
                  <i class="fa fa-building-o"></i>Instituci&oacute;n Remitente
                </a>
                

                <!--<a class="btn btn-app" href="index.php?r=perfiles/admin" style="color: black;">
                  <i class="fa fa-user"></i>Perfil de Usuario
                </a>-->
                
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

    <!-- jQuery -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script> 