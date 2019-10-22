<head>
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.js"></script>-->
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />
</head> 
<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimientoses',
);


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




              <script type="text/javascript">
				    $(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#example thead th').each( function () {
				        var title = $('#example thead th').eq( $(this).index() ).text();
				        $(this).html( '<input type="text" placeholder="Buscar..." />' );
				        //$(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
				    } );
				    // DataTable
				    var table = $('#example').DataTable( {
				        colReorder: true
				    } );
				      
				    // Apply the filter
				    $("#example thead input").on( 'keyup change', function () {
				        table
				            .column( $(this).parent().index()+':visible' )
				            .search( this.value )
				            .draw();
				    } );
				    } );    



					function destinatario(valor1, valor2){	

						$("#user_destino").html(valor1);
						$("#derivado_a").val(valor2);
						//$("#usuario_destino").val(valor3);
					}
					</script>

          				<div class="table-container">
					    <article id="contenido">
						<div class="table-container">
							<div class="card-body pad table-responsive">
								 <center>
							       		DOCUMENTOS NO ATENDIDOS POR USUARIOS PERTENECIENTES A: <br>
							       		<b><u><?=$area->area?></u></b> <br>
							       		<b>REPORTE GERENCIAL</b>
							     </center>		
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						                <td align="center">Nombre</td>
										<td align="center">Cargo</td>
										<td align="center">No recibidos</td>
										<td align="center">Pendientes Oficiales</td>
										<td align="center">Pendientes Digitales</td>
										<td> Imprimir Reporte</td>
						            </tr>
						            <tr>
						                <th align="center">Nombre</th>
										<th align="center">Cargo</th>
										<th align="center">No recibidos</th>
										<th align="center">Pendientes Oficiales</th>
										<th align="center">Pendientes Digitales</th>
										<th>Imprimir</th>
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php $dataReader=Seguimientos::getUsuariosGerencia($area->id_area); ?>	
						         <?php 

						         	foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left"><?=$row['nombre']?></td>
						            <td align="left"><?=$row['cargo']?></td>
						            <td align="center">
						            	<?=Seguimientos::countQueDebenLlegar(1,$row['id_usuario'])+Seguimientos::countQueDebenLlegar(0,$row['id_usuario'])?>
						            </td>
						            <td align="center">
						            	<?=Seguimientos::countPendientes(1,1,$row['id_usuario'])?>
						            </td>
						            <td align="center">
						            	<?=Seguimientos::countPendientes(0,2,$row['id_usuario'])?>
						            </td>
						            <td align="center">
						            	<?php  

										 echo CHtml::link('<i class="fa fa-file-text-o"></i>  Imprimir',array('Seguimientos/pendientesUsuarioPDF',
							                 'id_usuario'=>$row['id_usuario']),array('class'=>'btn btn-success', 'style'=>'color:white;')); 
								        ?>
						            </td>
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table>
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


