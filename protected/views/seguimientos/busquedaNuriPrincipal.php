<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
$nuri=strtoupper($nuri);

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
                	<!--<i  style="font-size: 20px; color: black;" class="fa fa-search"></i>-->
                	<i  class="fa fa-search"></i>
                	 Seguimiento de NURI/NUR <b><?=$nuri?></b>.
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
      <div class="row">
        <div class="col-md-12">
                    <!-- /.card-header -->
         <div class="card-body">
            

                  <div class="card-body pad table-responsive">

                    <?php $row=Seguimientos::getCabeceraSeguimiento($nuri); 
                      $id_doc=$row['id_doc'];
                    ?>
                   <table class="table-bordered table-striped" id="table_cabecera_seguimiento" style="font-size: 15px;" >
                  <tr>
                    <th><i  class="fa fa-files-o"></i> Tipo Documento</th>
                    <td><?=$row['tipo_doc']?></td>
                    <th><i  class="fa fa-calendar"></i> Fecha/Hora Creaci&oacute;n</th>
                    <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_creacion']))." - ".$row['hora_creacion']?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-pencil"></i> CITE</th>
                    <td>
                        <u><?php echo $row['cite'] ?></u>
                      
                    </td> 
                    <th><i  class="fa fa-chain"></i> Adjuntos</th>
                    <td><?=$row['adjunto']?></td>
                  </tr>
                  <tr>
                    <th><i  class="fa fa-file-text-o"></i> Referencia</th>
                    <td colspan="3"><?=$row['referencia']?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Destinatario</th>
                    <td colspan="3"><?=$row['destinatario']?></td>  
                  </tr>
               </table>
           </div>
                      
         </div>
           <!-- /.card -->
        </div>
       
      </div>   


      <!-- row -->
      <div class="row">
        <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$nuri?> <b style="color: darkred;"><u>Oficial</u></b>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <li class="time-label">
            	<div class="card-body pad table-responsive">
               	 <table  >
		            
		         </table>
			     </div>	
            </li>
            <!-- timeline item -->
            <li >
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


              	<div class="card-body pad table-responsive">
	              <table  id="table_seguimiento" border="1" style="font-size:13px; ">
	              	<tr>
		            	<th>DERIVADO POR:</th>
		            	<th>DERIVADO A:</th>
		            	<th>DESPACHO</th>
		            	<th>RECEPCI&Oacute;N</th>
		            	<th>ACCI&Oacute;N</th>
		            	<th>ESTADO</th>
		            	<th>ADJUNTOS</th>
		            </tr>
		            <?php 

			            $dataReader=Seguimientos::getSearchNuri($nuri,1);
			            foreach($dataReader as $row) {
			            //$total_contrato=$total_contrato+$row['total_contrato'];
			            if (($row['fk_estado']==1) || $row['fk_estado']==3 ) 
                  { $icono='<i class="fa fa-hand-peace-o" style="font-size:24px; color:#610B0B;"></i>'; 
                    $color='font-weight: bold;';
                  }
			            else 
                  { 
                    $icono='<i class="fa fa-paw"  style="font-size: 21px;"></i>'; 
                    $color='';
                  }	
			        ?>
			        <tr>
			         	<td rowspan="2">
			         		<i  class="fa fa-paw" style="font-size: 21px;"></i>
			         		<?=$row['usuario_origen']?>
			         	</td>	
			           	<td rowspan="2">
			           		<?=$icono?><!-- codigo para mostrar el icono  -->
			           		<?=$row['usuario_destino']?>
			           	</td>
			           	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
			           	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_recepcion']))." - ".$row['h_recepcion']?></td>
			           	<td><?=$row['accion']?></td>
			           	<td style="<?=$color?> " ><?=$row['estado']?></td>
			           	<td align="center">
                    <?php 
                    
                    
                    if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                        $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                        foreach($dataReader as $row2) {   

                            echo CHtml::ajaxLink($row2['codigo'],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog', 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            ); echo "<br>";


                        } // fin foreach
                    } // fin if
                    else{
                       echo ""; 
                    }
                    ?>   
                  </td>
			        </tr>
			        <tr>
			         <td colspan="5" style="background-color:#E0ECF8; "><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
			        </tr>
			        <!-- <tr>
			        	<td colspan="7" bgcolor="#BDBDBD"></td>
			        </tr>-->
			        <?php 
        	
			        		} //foreach($dataReader as $row) {
			        	?>
			      </table>
			     </div>	

              </div>
            </li>
            <!-- END timeline item -->
           
          </ul>
        </div>

        <!-- /.col -->
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$nuri?> <b style="color: darkred;"><u>Copias Digitales</u></b>
                  </span>
            </li>
            <!-- /.timeline-label -->
           
            <!-- timeline item -->

            <li >
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">
              	<div class="card card-default collapsed-card">
		              <div class="card-header">
		                <h3 class="card-title">Copia Digital</h3>
			                <div class="card-tools">
				                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
				                  </button>
				            </div>
				            <!-- /.card-tools -->
				       </div>
				        <!-- /.card-header -->
				        <div class="card-body">
				            <div class="table-responsive">
					           <table  id="table_seguimiento" border="1">
					              	<tr>
						            	<th>DERIVADO POR:</th>
						            	<th>DERIVADO A:</th>
						            	<th>DESPACHO</th>
						            	<th>RECEPCI&Oacute;N</th>
						            	<th>ACCI&Oacute;N</th>
						            	<th>ESTADO</th>
						            	<th>ADJUNTOS</th>
						            </tr>
						            <?php 

							            $dataReader=Seguimientos::getSearchNuri($nuri,0);
							            foreach($dataReader as $row) {
							            //$total_contrato=$total_contrato+$row['total_contrato'];
							        ?>	
							       <tr>
						         	<td rowspan="2">
						         		<?=$row['usuario_origen']?>
						         	</td>	
						           	<td rowspan="2">
						           		<?=$row['usuario_destino']?>
						           	</td>
						           	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
						           	<td><?=$row['f_recepcion']." - ".$row['h_recepcion']?></td>
						           	<td><?=$row['accion']?></td>
						           	<td><?=$row['estado']?></td>
						           	<td></td>
						        </tr>
						        <tr>
						        	<td colspan="5"><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
						        </tr>
							        <?php 
				        	
							        		} //foreach($dataReader as $row) {
							        	?>
							  </table>
							</div>
				        </div>
				        <!-- /.card-body -->
				</div>
				<!-- /.card -->




              		

              </div>
            </li>
            <!-- END timeline item -->
            
            
            
            <li>
              <i class="fa fa-clock-o " style="background-color: #0080FF; color: white;"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->




      </div>
      <!-- /.row -->



                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>


        


<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script>-->