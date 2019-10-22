<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimientoses',
);


/*
$fecha_actual = date("Y-m-d");

echo $fecha_actual."<br>";

//sumo 1 día
echo "sumamos 10 dias = ".date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
//resto 1 día
echo "<br> restamos 20 = ".date("Y-m-d",strtotime($fecha_actual."- 20 days")); 
echo "<br> restamos 50 = ".date("Y-m-d",strtotime($fecha_actual."- 50 days")); 
*/
?>

<br>
<b style="font-size: 20px;"></b>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?=$area->area?></h3>
              </div>

          				<div class="table-container">
					    <article id="contenido">
						<div class="table-container">
							<div class="card-body pad table-responsive">

			
			 			<center>
							DOCUMENTOS NO ATENDIDOS POR USUARIOS PERTENECIENTES A: <br>
						   	<b><u><?=$area->area?></u></b> <br>
						   	<b>(Pendientes dentro las Oficinas por tiempo de permanencia)</b>
						</center>
						<br>
						<table class="table-bordered table-striped" cellpadding="5">
		                  <tr style="font-size: 16px; background-color:#086A87; color: white;" >
		              			<th align="center" rowspan="2" valign="middle">&Aacute;rea/Unidad Organizacional</th>
		              			<th align="center" colspan="3"><center>Mayor a 50 d&iacute;as</center></th>
		              			<th align="center" colspan="3"><center>Entre 20 y 50 d&iacute;as</center></th>
		              			<th align="center" colspan="3"><center>Entre 10 y 20 d&iacute;as</center></th>
		              			<th align="center" colspan="3"><center>Menor a 10 d&iacute;as</center></th>
		              	  </tr>
		              	  <tr style="background-color:#086A87; color: white; ">
		              	  		
		              	  		<th><center>No recibidos</center></th>
		              	  		<th><center>Pendientes (Oficiales)</center></th>
		              	  		<th><center>Pendientes (Copias)</center></th>

		              	  		<th><center>No recibidos</center></th>
		              	  		<th><center>Pendientes (Oficiales)</center></th>
		              	  		<th><center>Pendientes (Copias)</center></th>

		              	  		<th><center>No recibidos</center></th>
		              	  		<th><center>Pendientes (Oficiales)</center></th>
		              	  		<th><center>Pendientes (Copias)</center></th>

		              	  		<th><center>No recibidos</center></th>
		              	  		<th><center>Pendientes (Oficiales)</center></th>
		              	  		<th><center>Pendientes (Copias)</center></th>
		              	  </tr>
		              	  <tr>
		              	  	<td style="font-size:11pt;">
		              	  		<a href="index.php?r=seguimientos/pendientesAreaDetalleUser&area=<?=$area->id_area?>">
                  					<i class="fa fa-sitemap"></i> <?=$area->area?>
                				</a>
		              	  			
		              	  	</td>		
		              	  	<td align="center"><?=Seguimientos::getPendientesCincuentaNoRecibidos($area->id_area) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesCincuentaPendientes($area->id_area,1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesCincuentaPendientes($area->id_area,2,0) ?></td>

		              	  	<td align="center"><?=Seguimientos::getPendientesveintecincuentaNoRecibidos($area->id_area) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesveintecincuentaPendientes($area->id_area,1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesveintecincuentaPendientes($area->id_area,2,0) ?></td>

		              	  	<td align="center"><?=Seguimientos::getPendientesdiezveinteNoRecibidos($area->id_area) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezveintePendientes($area->id_area,1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezveintePendientes($area->id_area,2,0) ?></td>

		              	  	<td align="center"><?=Seguimientos::getPendientesdiezNoRecibidos($area->id_area) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezPendientes($area->id_area,1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezPendientes($area->id_area,2,0) ?></td>
		              	  </tr>
		              	  <!-- CODIGO PARA OBTENER AREAS QUE DEPENDEN DE LA GERENCIA-->
		              	  <?php $dataReader=Seguimientos::getAreasDependencia($area->id_area); ?>	
						  <?php foreach ($dataReader as $row) { ?>	
		              	  <tr>
		              	  	<td  style="font-size:11pt;" >
		              	  		<a href="index.php?r=seguimientos/pendientesAreaDetalleUser&area=<?=$row['id_area']?>">
                  					<i class="fa fa-sitemap"></i> <?=$row['area']?>
                				</a>	
		              	  	</td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesCincuentaNoRecibidos($row['id_area']) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesCincuentaPendientes($row['id_area'],1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesCincuentaPendientes($row['id_area'],2,0) ?></td>
		              	  	
		              	  	<td align="center"><?=Seguimientos::getPendientesveintecincuentaNoRecibidos($row['id_area']) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesveintecincuentaPendientes($row['id_area'],1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesveintecincuentaPendientes($row['id_area'],2,0) ?></td>

		              	  	<td align="center"><?=Seguimientos::getPendientesdiezveinteNoRecibidos($row['id_area']) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezveintePendientes($row['id_area'],1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezveintePendientes($row['id_area'],2,0) ?></td>

		              	  	<td align="center"><?=Seguimientos::getPendientesdiezNoRecibidos($row['id_area']) ?></td>	
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezPendientes($row['id_area'],1,1) ?></td>
		              	  	<td align="center"><?=Seguimientos::getPendientesdiezPendientes($row['id_area'],2,0) ?></td>
		              	  </tr>
		              	  <?php } ?>
		                </table>	
		                 <br><br><br><br><br><br><br><br><br>

						        
						    </div>
						</div>
					   </article>
					   
					</div>

              
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>


