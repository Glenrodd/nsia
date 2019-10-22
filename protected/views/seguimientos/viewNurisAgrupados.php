<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);
?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">NUR/NURI(s) agrupados a: <?=$seguimientos->codigo?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<div class="card-body pad table-responsive">
					<table class="table table-bordered table-striped">
					  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
						<th align="center">NUR/NURI</th>
						<th align="center">Tipo</th>
						<th align="center">Prove&iacute;do</th>
						<th align="center">Fecha/Hora Derivaci&oacute;n</th>
					  </tr>
					  <?php $dataReader=Seguimientos::getListaNurisAgrupados($seguimientos->id_seguimiento); ?>	

					  <?php foreach ($dataReader as $row) { ?>	
					  <tr  style="font-size: 13px;">
					    <td><?=$row['nuri']?></td>
					    <td><?=$row['tipo_documento']?></td>
					    <td><?=$row['proveido']?></td>
					    <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha']))." - ".$row['hora']?></td>
					    
					   
					  </tr>
					 <?php } ?>
					</table>
				</div> 	
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