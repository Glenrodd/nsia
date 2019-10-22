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
                <h3 class="card-title">MENU DE DOCUMENTOS</h3>


                
                <div class="card-tools">
		            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
		              <i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		              <i class="fa fa-times"></i></button>
		        </div>

              </div>
            <center>
              <?php 
                // añadir codigo por nivel para mostrar las opciones disponibles por usuario
                /*if (condition) {
                  
                }*/

              ?>
              <div class="card-body">
                <p style="font-size: 26px;">Opciones para generar <b style="color:#8A0808;">nuevos</b> documentos</p>

                <a class="btn btn-app" href="index.php?r=documentos/createCarta&tipo=4" style="color: black;">
                  <i class="fa fa-file-o"></i>CARTA
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/createNota&tipo=2" style="color: black;">
                  <i class="fa fa-file-text"></i>NOTA INTERNA
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/createInforme&tipo=1" style="color: black;">
                  <i class="fa fa-paste"></i>INFORME
                </a>


                <?php if (Yii::app()->user->id_nivel==6) { ?>
                <a class="btn btn-app" href="index.php?r=documentos/createMemorandum&tipo=3" style="color: black;">
                  <i class="fa fa-files-o"></i>MEMORANDUM
                </a>
                <?php } ?>



                <?php if (Yii::app()->user->id_nivel==3 OR Yii::app()->user->id_nivel==1) { ?>
                

                <a class="btn btn-app" href="index.php?r=documentos/createCircular&tipo=5" style="color: black;">
                  <i class="fa fa-file-text-o"></i>CIRCULAR
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/createMemorandum&tipo=3" style="color: black;">
                  <i class="fa fa-files-o"></i>MEMORANDUM
                </a>

                <?php } ?>

                <?php if (Yii::app()->user->usuario=='pre') { ?>

                <a class="btn btn-app" href="index.php?r=documentos/createInstructivo&tipo=8" style="color: black;">
                  <i class="fa fa-file-code-o"></i>INSTRUCTIVO
                </a>
                <?php } ?>

                <a class="btn btn-app" href="index.php?r=documentos/administracionBorrador&tipo=8" style="color: black;">
                  <i class="fa fa-low-vision"></i>BORRADORES
                </a>

                <!--<a class="btn btn-app" href="index.php?r=documentos/documentosSinNuri" style="color: black;">
                  <i class="fa fa-wpforms"></i>DOC. SIN NURI
                </a>-->

                <!--<a class="btn btn-app" href="index.php?r=documentos/createMemorandum&tipo=3" style="color: black;">
                  <i class="fa fa-book"></i>REPORTE GESTI&Oacute;N
                </a>-->
                
                
              </div>



              <hr style="width:95%;">

              <div class="row">
          <div class="col-md-12">
             <div class="card-header">
                <h3 class="card-title" style="font-size: 26px;">
                  <i class="fa fa-edit"></i>
                  Lista de documentos generados en la gesti&oacute;n <?=date('Y')?> por el usuario <b>'<?=Yii::app()->user->usuario?>'</b>
                </h3>
              </div>
            <div class="card-body pad table-responsive" >  
                <table class="table table-bordered text-center" align="center" style="width: 85%;">
                  <tr>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-o"></i> <b>CARTAS</b>',array('documentos/administracionCarta', 'tipo_documento'=>4, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-text"></i> <b>NOTAS INTERNAS</b>',array('documentos/administracionNota', 'tipo_documento'=>2, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-paste"></i> <b>INFORMES</b>',array('documentos/administracionInforme', 'tipo_documento'=>1, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>

                    <?php if (Yii::app()->user->id_nivel==3 OR Yii::app()->user->id_nivel==1) { ?>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-text-o"></i> <b>CIRCULARES</b>',array('documentos/administracionCircular', 'tipo_documento'=>5, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-files-o"></i> <b>MEMORANDUM</b>',array('documentos/administracionMemorandum', 'tipo_documento'=>3, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>

                    <?php } ?>

                    <?php if (Yii::app()->user->usuario=='pre') { ?>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-code-o"></i> <b>INSTRUCTIVOS</b>',array('documentos/administracionInstructivo', 'tipo_documento'=>8, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <?php } ?>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-clone"></i> <b>RESERVADOS</b>',array('documentos/administracionReservado', 'estado_documento'=>1, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      
                    </td>

                    <?php if (Yii::app()->user->id_nivel==6) { ?>
                <td>
                      <?php echo CHtml::link('<i class="fa fa-files-o"></i> <b>MEMORANDUM</b>',array('documentos/administracionMemorandum', 'tipo_documento'=>3, 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                <?php } ?>
                    
                  </tr>
                </table>
            </div>    
         </div>
        </div>


 <?php //if (Yii::app()->user->id_nivel==1) { ?>
      <div class="row">
          <div class="col-md-12">
             <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-edit"></i>
                  Lista de documentos hist&oacute;ricos generados por el usuario <b>'<?=Yii::app()->user->usuario?>'</b><br>
                  Informaci&oacute;n obtenida del <b><u>SIACO</u></b>
                </h3>
              </div>
            <div class="card-body pad table-responsive" >  
                <table class="table table-bordered text-center" align="center" style="width: 85%;">
                  <tr>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-o"></i> <b>CARTAS</b>',array('documentos/adminCartaHistorico', 'tipo_documento'=>'CARTA'), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-text"></i> <b>NOTAS INTERNAS</b>',array('documentos/adminNotaHistorico', 'tipo_documento'=>'NOTA', 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-paste"></i> <b>INFORMES</b>',array('documentos/adminInformeHistorico', 'tipo_documento'=>'INFORME', 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-info')); ?>
                    </td>

                    
                  </tr>

                  <tr>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-text-o"></i> <b>CIRCULARES</b>',array('documentos/adminCircularHistorico', 'tipo_documento'=>'CIRCULAR', 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-files-o"></i> <b>MEMORANDUM</b>',array('documentos/adminMemorandumHistorico', 'tipo_documento'=>'MEMORANDUM', 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <?php //if (Yii::app()->user->usuario=='pre') { ?>
                    <td>
                      <?php echo CHtml::link('<i class="fa fa-file-code-o"></i> <b>INSTRUCTIVOS</b>',array('documentos/adminInstructivoHistorico', 'tipo_documento'=>'INSTRUCTIVO', 'gestion'=>date('Y')), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <?php //} ?>
                    <td>
                      
                    </td>
                    
                  </tr>
                </table>
            </div>    
         </div>
        </div>

<?php // } ?>





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