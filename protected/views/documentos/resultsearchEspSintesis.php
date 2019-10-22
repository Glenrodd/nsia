<head>
	<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>-->
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />

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
</head>

<?php 

//echo "----> ".$cite;

?>
	
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-12">
            
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                	<i class="fa fa-server"></i>
                	Resultado de b&uacute;squeda  por <b>S&iacute;ntesis</b></h3>
              </div>
              <!-- /.card-header -->
	              


	              <div class="card-body">

	              	
                	<div class="card-body pad table-responsive">
                		<?php 
                			$tipoDocumentos=TipoDocumento::model()->findByPk($tipo);

                		?>
								<center><h4><u><b><?=$tipoDocumentos->tipo_documento?> (S&iacute;ntesis)</b></u></h4>
								  <i style="color: #0B4C5F;">B&uacute;squeda realizada en registros de la gesti&oacute;n <?=$gestion?>
								  </i>
								</center>		
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="left"><b>NUR</b></td>
						               <td align="left"><b>CITE</b></td>
						               <td align="left"><b>DESTINATARIO</b></td>
						               <td align="left"><b>REFERENCIA</b></td>
						               <td align="left"><b>SINTESIS</b></td>
						               <td align="left"><b>REMITENTE</b></td>
						               <td align="left"><b>INSTITUCI&Oacute;N REMITENTE</b></td>
						               <td align="left"><b>FECHA</b></td>
						               <!--<td align="left"><b></b></td>-->
						            </tr>
						            <tr>
						               <th align="center"><b>NUR</b></th>
						               <th align="center"><b>CITE</b></th>
						               <th align="center"><b>DESTINATARIO</b></th>
						               <th align="center"><b>REFERENCIA</b></th>
						               <th align="center"><b>SINTESIS</b></th>
						               <th align="center"><b>REMITENTE</b></th>
						               <th align="center"><b>INSTITUCION REMITENTE</b></th>
						               <th align="center"><b>FECHA</b></th>
						               <!--<td align="center"><b></b></td>-->
						            </tr>
						         </thead>
						       	 <tbody>

						       	


						         <?php $dataReader=Documentos::getSearchEspecificaSintesis($sintesis,$tipo,$gestion); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="center">
						            	<a href="index.php?r=seguimientos/busquedaIndex&nuri=<?=Documentos::getObtenerNur($row['id_documento'])?>" style="font-size: 16px;">
						            	<?php 
						            		echo Documentos::getObtenerNuriBusqueda($row['id_documento']);

						            		//echo $row2['nur'];
						            	?>
						            	</a>
						            		
						            </td>
						            <td align="left"><?=$row['codigo_cite']?></td>
						            <td align="left">
						            	<?=$row['destinatario']?><br>
						            	<b><i><?=$row['cargo_destinatario']?></i></b>
						            </td>
						            <td align="left"><?=$row['referencia']?></td>
						            <td align="left">
						            	<?=$row['contenido']?><br>
						            </td>
						            <td align="left"><?=$row['remitente_nombres']?></td>
						            <td align="left"><?=$row['institucion_remitente']?></td>
						            <td align="left"><?=$row['fecha']?></td>
						            
						            

						            <!--<td align="center">

						            	<?php /*if (Documentos::getObtenerNuri($row['id_documento'])=="<b style='color:#FA5858;'>Sin NUR/NURI</b>") { 

						            		echo "-";

						            	 } else{*/?>
                						<a class="btn btn-app" href="index.php?r=seguimientos/busquedaIndex&nuri=<? //=Documentos::getObtenerNuri($row['id_documento'])?>" style="color: black;">
                  						<i class="fa fa-paw"></i>Seguimiento
                						</a>
                						<?php //}  ?>
						            </td>-->
						           </tr>
						         <?php } ?>    	 
						         </tbody>
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

	