<center>
<p style="font-size: 19px;">Detalle de usuarios asignados al grupo<br> 
	<strong><?=$model->nombre_grupo?></strong></p>
</center>	
<br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!--/.col (right) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle de usuarios almacenados para derivar.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

				<div class="row">
		          <div class="col-md-12">
		            <div class="card-body pad table-responsive">
		              	

		                <table class="table table-bordered table-striped">
		                  <tr style="font-size: 16px;">
		              			<th align="center">Nombres</th>
		              			<th align="center">Gerencia Regional</th>
		              			<th align="center">&Aacute;rea/Unidad</th>
		              	  </tr>
		              	  <?php 

			              	$dataReader=Usuarios::getListdetalle($model->id_grupo_derivacion);


						 	foreach($dataReader as $row) {
		              	?>
		              	  <tr style="font-size: 13px;">
		              			<td><?=$row['nombre_destino']?></td>
		              			<td><?=$row['nombre_regional']?></td>
		              			<td><?=$row['nombre_area']?></td>
		              	  </tr>

		              	<?php } ?>
		                </table>
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



