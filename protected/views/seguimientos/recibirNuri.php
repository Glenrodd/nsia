<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */



/*$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Create Seguimientos', 'url'=>array('create')),
	array('label'=>'Update Seguimientos', 'url'=>array('update', 'id'=>$model->id_seguimiento)),
	array('label'=>'Delete Seguimientos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_seguimiento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);*/
?>
<br>
<h4>B&uacute;squeda realizada por: <b><?=$nuri?></b></h4>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">

        <div class="row">
              <div class="col-md-12">
                <div class="card-body pad table-responsive">
                  
                 
                    <table class="table table-bordered table-striped">
                      <?php $dataReader=Seguimientos::recibirNuri($nuri); ?> 
                      <?php 
                      foreach ($dataReader as $row){ ?>

                        <tr style="font-size: 14px; color: #0B4C5F;">
                          <td rowspan="3" valign="middle" align="center">
                            <?php 
                              if ($row["oficial"]==1) { ?>
                                <i  class="fa fa-hand-peace-o" style="font-size: 38px;"></i><br>
                              <?php }
                              else{ echo "<br>"; }
                            ?>
                            <b style="font-size: 25px; "><?=$row["nur"]?></b>
                            <?php 
                              if ($row["oficial"]==1) {
                                echo "<br>Original";
                              }
                              else{
                                echo "<br>Copia Digital"; 
                                echo "<br><b>N° ".$row["numero_copia"]."</b>"; 
                              }
                            ?>

                          </td>
                          <th align="center">Derivado por:</th>
                          <th align="center">Derivado a: </th>
                          <th align="center">Despacho: </th>
                          <th align="center">Acci&oacute;n: </th>
                          <th align="center">Estado: </th>
                          <td rowspan="3" valign="middle" align="center">
                            <br>
                             <a class="btn btn-app" href="index.php?r=seguimientos/recibirDocumento&id_seguimiento=<?=$row['id_seguimiento']?>" style="color: black; border: 1px solid #0B4C5F;">
                              <i class="fa fa-download"></i>RECIBIR
                            </a>
                          </td>
                        </tr>
                        <tr  style="font-size: 11px;">
                            <td><?=$row["usuario_origen"]?></td>
                            <td><?=$row["usuario_destino"]?></td>
                            <td><?=date("d/m/Y", strtotime($row["f_derivacion"]));?> <?=$row["h_derivacion"]?></td>
                            <td><?=$row["accion"]?></td>
                            <td><?=$row["estado"]?></td>
                        </tr>
                        <tr style="font-size: 14px; border-bottom: 1px solid red;">
                            <th style="color: #0B4C5F;">Prove&iacute;do: </th>
                            <td colspan="4" style="font-size: 11px;"><?=$row["proveido"]?></td>
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
