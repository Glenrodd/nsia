<?php
/* @var $this AgrupacionesController */
/* @var $model Agrupaciones */

$this->breadcrumbs=array(
	'Agrupaciones'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Agrupaciones', 'url'=>array('index')),
	array('label'=>'Manage Agrupaciones', 'url'=>array('admin')),
);*/
?>

<br>
<h4><b>Detalle de NUR/NURI(s) agrupados</b></h4>

<a class="btn btn-app" href="index.php?r=agrupaciones/terminarAgrupacion&id_seguimiento=<?=$seguimientos->id_seguimiento?>"  style="color: white; background-color: #0489B1;" >
    <i class="fa fa-check-square-o"></i>Terminar
</a>

 <a class="btn btn-app" href="index.php?r=seguimientos/printCaratulaAgrupacion&id_seguimiento=<?=$seguimientos->id_seguimiento?>"  style="color: white; background-color: #0489B1;" ">
    <i class="fa fa-print"></i>Imprimir Caratula
 </a>

<br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
              	<h5>NUR/NURI Principal : <b><?=$seguimientos->codigo?></b></h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

        <div class="row">
              <div class="col-md-12">
              		
              		<p><b>Nota.-</b> Una vez eliminado el <code>NUR/NURI</code> agrupado este retornar&aacute; a la bandeja de pendientes del usuario que realiz&oacute; este proceso.</p>

                <div class="card-body pad table-responsive">
                  
                 
                    <table class="table table-bordered table-striped">

                        <tr style="font-size: 16px; color: #0B4C5F;">
                          <th align="center">NUR/NURI Agrupado </th>
                          <th align="center">Usuario </th>
                          <th align="center">Tipo </th>
                          <th align="center">Fecha:</th>
                          <th align="center">Acci&oacute;n: </th>
                        </tr>
                      <?php $dataReader=Seguimientos::getListaNurisAgrupadosCompleto($seguimientos->codigo); ?>
                      <?php foreach ($dataReader as $row){ ?>
                        <tr  style="font-size: 14px;">
                            <td><?=$row['nuri']?></td>
                            <td><?=$row['usuario_agrupacion']?></td>
                            <td><?=$row['tipo_documento']?></td>
                            <td><?=$row['fecha_agrupacion']?></td>
                            <td>
                            	<a class="btn btn-default btn-sm"  style="color: white; background-color: #0489B1;"  href="index.php?r=agrupaciones/deleteAgrupacion&id_agrupacion=<?=$row['id_agrupacion']?>&id_seguimiento=<?=$seguimientos->id_seguimiento?>">
                              <i class="fa fa-times"></i> Desagrupar
                            </a>
                            </td>
                        </tr>
                      <?php }//foreach ($dataReader as $row) ?>
                  </table>
                    
              </div> 
              </div>
              <!-- /.col -->

            </div>
            <!-- /.row -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
