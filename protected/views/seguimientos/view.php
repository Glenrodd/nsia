<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */



/*$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Create Seguimientos', 'url'=>array('create')),
	array('label'=>'Update Seguimientos', 'url'=>array('update', 'id'=>$model->id_seguimiento)),
	array('label'=>'Delete Seguimientos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_seguimiento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);*/
?>

<script type="text/javascript">
	function destinatario(valor1, valor2){	
		$("#derivado_a").val(valor1);
		$("#usuario_destino").val(valor2);
	}
</script>	

<h3><strong>Derivar Copias digitales </strong></h3>





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
                	NURI/NUR: <b><?=$seguimiento->codigo?> (Original)</b>.
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


      <!-- row -->
      <div class="row">
        <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$seguimiento->codigo?> <b style="color: darkred;"><u>Oficial</u></b>
                  </span>
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

			            $dataReader=Seguimientos::getSearchNuri($seguimiento->codigo,1);
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
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">

        	<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">
                </h3>
              </div>

        		<div class="card-body">

        		<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'seguimientos-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
				<?php echo $form->errorSummary($model); ?>


        		<!-- text input -->
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'derivado_a'); ?>
        			</label>
					<?php echo $form->textField($model,'hijo',array('class'=>'form-control', 'id'=>'derivado_a')); ?>
					<?php echo $form->error($model,'hijo'); ?>
                  </div>
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'proveído'); ?>
        			</label>
        			<?php echo $form->textArea($model,'proveido',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'proveido'); ?>
                  </div>
                  
            </div>
              <!-- /.card-body -->
            <div class="card-footer">
              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('class' => 'btn btn-info')); ?>
             </div>
           </div>  


		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('value'=>$seguimiento->codigo)); ?>
		<?php echo $form->error($model,'codigo'); ?>

		<?php //echo $form->labelEx($model,'padre'); ?>
		<?php echo $form->hiddenField($model,'padre', array('value'=>$seguimiento->id_seguimiento)); ?>
		<?php echo $form->error($model,'padre'); ?>

		
		<?php echo $form->hiddenField($model,'derivado_a',array('class'=>'form-control', 'id'=>'usuario_destino')); ?>
		<?php echo $form->error($model,'derivado_a'); ?>

<br><br>
	

<?php $this->endWidget(); ?>



                  

        </div><!-- col-md-6 -->
        <div class="col-md-6">
        	<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">
                </h3>
              </div>

        	<div class="card-body">

        		<div class="card-body pad table-responsive" style="height:360px; overflow:auto; border:1px solid lightgray; border-radius: 5px;">
        		
		              
						                <table class="table table-bordered table-striped">
						                  <tr style="font-size: 14px;">
						              			<th align="center">Nombres</th>
						              			<th align="center">&Aacute;rea/Unidad</th>
						              			<th></th>
						              	  </tr>
						              	  <?php 

			  							$dataReader=Documentos::listadoDerivaciones();
									 	foreach($dataReader as $row) {
						              	  ?>
											   
											<tr  style="font-size: 12px;">
											  <td><?=$row["nombre_destino"]?></td>
											  <td><?=$row["cargo_destino"]?></td>
											  <td width="20%">


											  <a onclick="javascript:destinatario('<?=$row['nombre_destino'] ?>','<?= $row['usuario_destino'] ?>');" style="text-decoration:none; color: white;font-size: 12px;" class='btn btn-primary'>Destino</a>
    
											   </td>
											</tr>
											    
											<?php } ?>
						                </table>
						            </div>


                  
            </div>
           </div>
        </div><!-- col-md-6 -->
      </div>
      <div class="row">
      	<!-- /.col -->
        <div class="col-md-12">

        	<!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$seguimiento->codigo?> <b style="color: darkred;"><u>Copias Digitales</u></b>
                  </span>
            </li>
           
            <!-- timeline item -->
            <li >
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


              	<div class="table-responsive">
					           <table  id="table_seguimiento" border="1">
					              	<tr>
						            	<th>DERIVADO POR:</th>
						            	<th>DERIVADO A:</th>
						            	<th>DESPACHO</th>
						            	<th>RECEPCI&Oacute;N</th>
						            	<th>ACCI&Oacute;N</th>
						            	<th>ESTADO</th>
						            	<th></th>
						            </tr>
						            <?php 

							            $dataReader=Seguimientos::getSearchNuri($seguimiento->codigo,0);
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
						           	<td>
                          <?php echo CHtml::link('<i  class="fa fa-remove"></i> Eliminar',array('seguimientos/eliminarDerivacionCopia', 'id'=>$row['id_seguimiento']), array('class'=>'btn btn-block btn-danger')); ?>      
                        </td>
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
            </li>
            <!-- END timeline item -->
          </ul>
        </div>
        <!-- /.col -->
      </div>  	





                  
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
