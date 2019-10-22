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

/*$fecha_actual = date("Y-m-d");
		//sumo 10 días
echo "<br> -50 dias ".date("Y-m-d",strtotime($fecha_actual."- 50 days")); 
echo "<br> -20 dias ".date("Y-m-d",strtotime($fecha_actual."- 20 days")); 


echo "<br> -20 dias ".date("Y-m-d",strtotime($fecha_actual."- 20 days")); 
echo "<br> -10 dias ".date("Y-m-d",strtotime($fecha_actual."- 10 days")); */
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
                <h3 class="card-title"><?=$usuarios->nombre?></h3>
              </div>


          				<div class="table-container">
					    <article id="contenido">
						<div class="table-container">
							<div class="card-body pad table-responsive">

			
			 			<center>
							DOCUMENTOS NO ATENDIDOS PERTENECIENTES A: <br>
						   	<b><u><?=htmlentities($usuarios->nombre)?></u></b> <br>
						   	<b><u><?=htmlentities($usuarios->fkArea->area)?></u></b> <br>
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
		              	  <!-- CODIGO PARA OBTENER AREAS QUE DEPENDEN DE LA GERENCIA-->
		              	  <?php //$dataReader=Seguimientos::getUserAreas($usuarios->id_usuario); ?>	
						  <?php //foreach ($dataReader as $row) { ?>	
		              	  <tr>
		              	  	<td style="font-size:11pt;" valign="top" style="border: solid .1pt gray;" >
		              	  		<?=htmlentities($usuarios->nombre)?>
		              	  			
		              	  	</td>	
		              	  	<td style="font-size:12pt;"  align="right" valign="top" style="border: solid .1pt gray;">
		              	  		 <?php $dataReader=Seguimientos::getPendientesCincuentaNoRecibidosUser($usuarios->id_usuario); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>	
		              	  	<td style="font-size:12pt;"  align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php $dataReader=Seguimientos::getPendientesCincuentaPendientesUser($usuarios->id_usuario,1,1); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  				
		              	  	</td>
		              	  	<td style="font-size:12pt;"  align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesCincuentaPendientes1($usuarios->id_usuario,2,0) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesCincuentaPendientesuser($usuarios->id_usuario,2,0); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>
		              	  	
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //Seguimientos::getPendientesveintecincuentaNoRecibidos1($usuarios->id_usuario) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesveintecincuentaNoRecibidosuser($usuarios->id_usuario); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  		
		              	  	</td>	
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesveintecincuentaPendientes1($usuarios->id_usuario,1,1) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesveintecincuentaPendientesUser($usuarios->id_usuario,1,1); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //Seguimientos::getPendientesveintecincuentaPendientes1($usuarios->id_usuario,2,0) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesveintecincuentaPendientesuser($usuarios->id_usuario,2,0); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>

		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesdiezveinteNoRecibidos1($usuarios->id_usuario) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesdiezveinteNoRecibidosUser($usuarios->id_usuario); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>	
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesdiezveintePendientes1($usuarios->id_usuario,1,1) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesdiezveintePendientesUser($usuarios->id_usuario,1,1); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesdiezveintePendientes1($usuarios->id_usuario,2,0) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesdiezveintePendientesUser($usuarios->id_usuario,2,0); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>

		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesdiezNoRecibidos1($usuarios->id_usuario) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesdiezNoRecibidosUser($usuarios->id_usuario); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>	
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesdiezPendientes1($usuarios->id_usuario,1,1) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesdiezPendientesUser($usuarios->id_usuario,1,1); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>
		              	  	<td style="font-size:12pt;" align="right" valign="top" style="border: solid .1pt gray;">
		              	  		<?php //=Seguimientos::getPendientesdiezPendientes1($usuarios->id_usuario,2,0) ?>
		              	  		<?php $dataReader=Seguimientos::getPendientesdiezPendientesUser($usuarios->id_usuario,2,0); ?>	
						  		 <?php foreach ($dataReader as $row) { ?>
						  		 		<?=$row['codigo']."<br>"?>
						  		 <?php } ?>
		              	  			
		              	  	</td>
		              	  </tr>
		              	  <?php //} ?>
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


