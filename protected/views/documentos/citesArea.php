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
							DETALLE AREAS Y DEPENDENCIAS DISPONIBLES GESTION <?=date('Y')?><br><br>
						   	<b><u><?=$area->area?></u></b> <br>
                <b>(CITES asignados por Área, Unidad, Gerencia, Subgerencia y Gerencia Regional)</b>
						   	
						</center>
						<br>
						<table class="table-bordered table-striped" cellpadding="5" width="90%" align="center">
		                  
		              	  <tr>
		              	  	<td style="font-size:11pt; text-align: center;">
		              	  		<center>
                  					<span style="font-size: 14pt;" ><i class="fa fa-sitemap" ></i> <?=$area->area?></span>
                				</center>
                				<table width="100%">
                					<tr>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$area->id_area?>&tipo_documento=4" >
                  								<i class="fa fa-reorder" ></i> Cartas
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$area->id_area?>&tipo_documento=2" >
                  								<i class="fa fa-reorder" ></i> Notas
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$area->id_area?>&tipo_documento=1" >
                  								<i class="fa fa-reorder" ></i> Informes
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$area->id_area?>&tipo_documento=5" >
                  								<i class="fa fa-reorder" ></i> Circulares
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$area->id_area?>&tipo_documento=3" >
                  								<i class="fa fa-reorder" ></i> Memorandum
                							</a></center>
                						</td>
                					</tr>
                				</table>
		              	  	</td>		
		              	  </tr>
		              	  <!-- CODIGO PARA OBTENER AREAS QUE DEPENDEN DE LA GERENCIA-->
		              	  <?php $dataReader=Seguimientos::getAreasDependencia($area->id_area); ?>	
						  <?php foreach ($dataReader as $row) { ?>	
		              	  <tr>
		              	  	<td  style="font-size:11pt;  text-align: center;" >
		              	  		<br>
		              	  		<center>
                  					<span style="font-size: 14pt;" ><i class="fa fa-sitemap" ></i> <?=$row['area']?></span>
                				</center>
                				<table width="100%">
                					<tr>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$row['id_area']?>&tipo_documento=4" >
                  								<i class="fa fa-reorder" ></i> Cartas
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$row['id_area']?>&tipo_documento=2" >
                  								<i class="fa fa-reorder" ></i> Notas
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$row['id_area']?>&tipo_documento=1" >
                  								<i class="fa fa-reorder" ></i> Informes
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$row['id_area']?>&tipo_documento=5" >
                  								<i class="fa fa-reorder" ></i> Circulares
                							</a></center>
                						</td>
                						<td width="20%">
                							<center><a class="btn btn-block btn-success" style="width:90%;" href="index.php?r=documentos/citesAreaDetalle&id_area=<?=$row['id_area']?>&tipo_documento=3" >
                  								<i class="fa fa-reorder" ></i> Memorandum
                							</a></center>
                						</td>
                					</tr>
                				</table>
		              	  		
		              	  	</td>	
		              	  </tr>
		              	  <?php } ?>
		                </table>	
		                 <br><br><br><br>

						        
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


