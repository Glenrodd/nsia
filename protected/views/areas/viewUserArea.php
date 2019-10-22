<?php
/* @var $this AreasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Areases',
);

$this->menu=array(
	array('label'=>'Create Areas', 'url'=>array('create')),
	array('label'=>'Manage Areas', 'url'=>array('admin')),
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
                <h3 class="card-title">Usuarios Asignados </h3>
              </div>
              <!-- /.card-header -->
              	<div class="row">
          			<div class="col-md-12">
          					
			              	<div class="card-body pad table-responsive">
								<table class="table table-bordered table-striped">
								  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
									<th align="center">Nombre</th>
									<th align="center">Cargo</th>
									<th align="center"></th>
								  </tr>
								  <?php $dataReader=Areas::getDetailUsuarios($id_area); ?>	

								  <?php foreach ($dataReader as $row) { ?>	
								  <tr  style="font-size: 13px;">
								    <td><?=$row['nombre']?></td>
								    <td><?=$row['cargo']?></td>
								    <td align="center">
								    	<?php  

										 echo CHtml::link('<i class="fa fa-file-text-o"></i>  Imprimir',array('Seguimientos/pendientesUsuarioEXCEL',
							                 'id_usuario'=>$row['id_usuario']),array('class'=>'btn btn-success', 'style'=>'color:white;')); 
								        ?>

								    </td>

								    
								  </tr>
								 <?php } ?>
								</table>
							
			              </div>
			              <!-- /.card-body -->

          			</div> <!-- / fin col-md-6 -->
          		</div>	









              
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>

