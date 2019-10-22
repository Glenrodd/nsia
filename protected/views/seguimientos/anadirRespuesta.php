<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Seguimientoses',
);

$this->menu=array(
	array('label'=>'Create Seguimientos', 'url'=>array('create')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);*/

$this->widget('ext.widgets.loading.LoadingWidget');


//echo "<br> ".$seguimientos->id_seguimiento;
//echo "<br> ".$seguimientos->codigo;

?>

<h5>Añadir respuesta a NUR/NURI <b><?=$seguimientos->codigo?></b></h5>

<section class="content">
 <div class="container-fluid">
  <div class="row">
        <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$seguimientos->codigo?> 
                    <b style="color: darkred;"><u>
                    	
                    	<?php 
                    		if ($seguimientos->oficial==1) {
                    			echo "Original";
                    		}else { echo "Copia Digital"; }
                    	?>
                    </u></b>
                  </span>
            </li>
            <!-- timeline item -->
            <li >
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


              	<div class="card-body pad table-responsive">
	              <table  id="table_seguimiento" border="1" style="font-size:13px; ">
	              	<tr>
		            	<th style="text-align: right; width: 25%;">DERIVADO POR:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td>
			         		<?=Seguimientos::getUsuario($seguimientos->derivado_por)?>
			         	</td>
			         	<th style="text-align:center;">
			         		<b>OPCIONES DISPONIBLES</b>
			         	</th>
			         	<th style="text-align:center;">
			         		<b>DERIVAR</b>
			         	</th>
			         	
			        </tr>
			        <tr>
		            	<th style="text-align: right;">DERIVADO A:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td>
			           		<?=Seguimientos::getUsuario($seguimientos->derivado_a)?>
			           	</td>
			           	<td rowspan="6" style="text-align:center;">
			         		
			         		<?php echo CHtml::link('AÑADIR <b>CARTA</b>',array('seguimientos/anadirDocumentoRespuesta', 'tipo_documento'=>4, 'id_seguimiento'=>$seguimientos->id_seguimiento, 'nuri'=>$seguimientos->codigo, 'oficial'=>$seguimientos->oficial ), array('class'=>'btn btn-block btn-success','onclick'=>'event.stopPropagation(); Loading.show(); return true;')); 
			         		?>
							
							<?php echo CHtml::link('AÑADIR <b>NOTA INTERNA</b>',array('seguimientos/anadirDocumentoRespuesta', 'tipo_documento'=>2, 'id_seguimiento'=>$seguimientos->id_seguimiento, 'nuri'=>$seguimientos->codigo, 'oficial'=>$seguimientos->oficial ), array('class'=>'btn btn-block btn-info','onclick'=>'event.stopPropagation(); Loading.show(); return true;')); ?>
							
							<?php echo CHtml::link('AÑADIR <b>INFORME</b>',array('seguimientos/anadirDocumentoRespuesta', 'tipo_documento'=>1, 'id_seguimiento'=>$seguimientos->id_seguimiento, 'nuri'=>$seguimientos->codigo, 'oficial'=>$seguimientos->oficial ), array('class'=>'btn btn-block btn-primary','onclick'=>'event.stopPropagation(); Loading.show(); return true;')); ?>
			         	</td>
			         	<td rowspan="6" style="text-align:center;">
			         		
			         		<?php echo CHtml::link(' <i class="fa fa-share-square-o"></i> <b>DERIVAR</b>',array('seguimientos/derivarDocumentoPendiente', 'tipo_documento'=>4, 'id_seguimiento'=>$seguimientos->id_seguimiento), array('class'=>'btn btn-app', 'style'=>'color:black;')); 
			         		?>
			         	</td>
			        </tr>
			        <tr>   	
		            	<th style="text-align: right;">DESPACHO:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($seguimientos->fecha_derivacion))." - ".$seguimientos->hora_derivacion?></td>
		            </tr>
			        <tr>	
		            	<th style="text-align: right;">RECEPCI&Oacute;N:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($seguimientos->fecha_recepcion))." - ".$seguimientos->hora_recepcion?></td>
		            </tr>
			        <tr>	
		            	<th style="text-align: right;">ACCI&Oacute;N:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=$seguimientos->fkAccion->accion?></td>
		            </tr>
			        <tr>	
		            	<th style="text-align: right;">ESTADO:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=$seguimientos->fkEstado->estado?></td>
		            </tr>
			        <tr>	
		            	<th style="text-align: right;">PROVE&Iacute;DO:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=$seguimientos->proveido?></td>
		            	
                	</tr>
			      </table>
			     </div>	

              </div>
            </li>
            <!-- END timeline item -->
           
          </ul>
        </div>
 </div>
</section>




<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">NUR/NURI(s) asociados</h3>
              </div>
              <!-- /.card-header -->
              	<div class="row">
          		<!-- right column -->
          			<div class="col-md-12">
			              	<div class="card-body pad table-responsive">
			              		<center><i>Documentos CITEs asociados al NUR/NURI <b><u><?=$seguimientos->codigo?></u></b> por el usuario: <b><?=Yii::app()->user->usuario;?></b> </i></center>
								<table class="table table-bordered table-striped">
								  <tr style="font-size: 14px; background-color: #0489B1; color: white;">
									<th align="center">CITE</th>
									<th align="center">Referencia</th>
									<th align="center">Fecha</th>
									<th></th>
									<th></th>
								  </tr>

								  <?php $dataReader=Seguimientos::getAnadirRespuesta($seguimientos->id_seguimiento); ?>	
								  <?php foreach ($dataReader as $row) { ?>	
								  <tr  style="font-size: 13px;">
								    <td><?=$row['codigo']?></td>
								    <td><?=$row['referencia']?></td>
								    <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha']))?></td>
								    <td align="center">
								    	<?php  
										  echo CHtml::link('<i class="fa fa-pencil" style="font-size:17px;"></i> Editar',array('seguimientos/editarDocumentoRespuesta',
							                 'id_documento'=>$row['id_documento'], 'tipo_documento'=>$row['fk_tipo_documento'], 'id_seguimiento'=>$seguimientos->id_seguimiento),array('class'=>'btn btn-success btn-sm')); 
								        ?>
								    </td>
								    <td align="center">
								    	<?php  
										 echo CHtml::link('<i class="fa fa-times-circle" style="font-size:17px;"></i> Desasociar',array('seguimientos/eliminarDocumentoRespuesta',
										  	'id_hoja_ruta'=>$row['id_hoja_ruta']),array('class'=>'btn btn-danger btn-sm')); 
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
 