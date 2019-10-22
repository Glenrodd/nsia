<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!--/.col (right) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle de NUR/NURI.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

				<div class="row">
		          <div class="col-md-12">
		            <div class="card-body pad table-responsive">
			    	<center><i><b>NUR/NURI(s) <?=$model->codigo?></b></i></center>
					<table class="table table-bordered table-striped">
					  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
						<th align="center">NUR/NURI</th>
						<th align="center">Derivado por</th>
						<th align="center">Fecha/Hora Derivaci&oacute;n</th>
						<th align="center">Derivado a</th>
						<th align="center">Prove&iacute;do</th>
						<th align="center">Estado</th>
						<th align="center">Tipo</th>
				    </tr>
				    <tr style="font-size: 14px; background-color: #E0F2F7;">
				    	<td><?=$model->codigo?></td>
				    	<td><?=Seguimientos::getUsuario($model->derivado_por)?></td>
				    	<td align="center"><?=date("d/m/Y", strtotime($model->fecha_derivacion))." ". $model->hora_derivacion;?></td>
				    	<td><?=$model->fkUsuario->nombre?></td>
				    	<td><?=$model->proveido?></td>
				    	<td><?=$model->fkEstado->estado?></td>
				    	<td><?=$model->oficial==1?'Original':'Copia Digital';?></td>
				    	
				    </tr>
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



