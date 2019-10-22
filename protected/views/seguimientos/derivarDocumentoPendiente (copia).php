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
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);*/
?>

<h3><strong>Derivaci&oacute;n</strong></h3>
<br>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguimientos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>


	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Los campos con * son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<div class="row">
          			<div class="col-md-6">


          				<div class="card-body pad table-responsive">
		              	 <table class="table table-bordered table-striped" >
				            <tr style="font-size: 16px; " class="bg-success disabled color-palette">
				            	<th style="border: 1px solid darkgray;">NUR/NURI</th>
				            	<th>CITES ASOCIADOS</th>
				            </tr>
				            <tr style="font-size: 16px;"  style="border: 1px solid darkgray;">
				            	<th style="border: 1px solid darkgray;" valign="middle">
				            		<?php 
				            			if ($seguimientos->oficial==1) { ?>
				            				<center>
				            				 <!--<i style="font-size: 43px;" class="fa fa-star-o"></i><br>-->
				            				 <i  style="font-size: 40px; color: darkred;" class="fa fa-hand-peace-o"></i><br>
				            				Documento Oficial
				            				 </center>

				            				
				            		<?php	} else{  		?>
				            				<center>
					            				Copia Digital
				            				 </center>

				            		<?php	}  		?>


				            		<center><p style="font-size:29px; color: darkblue;"><?=$seguimientos->codigo?></p>
				            		</center>
				            	</th>
				            	<td  style="border: 1px solid darkgray;">
				            		<table cellpadding="2px" width="100%" class="table-bordered table-striped" >
					                  <?php 
					                  //  añadir id de edocumento actual para no quede el nuri vacio 
					                    $dataReader=Seguimientos::getListCitesAsignados($seguimientos->id_seguimiento);
					                    foreach ($dataReader as $row2) { 
					                  ?>
					                  <tr  style="font-size: 11px;">
					                      <td align="center">
					                        <?php 
					                          echo $row2['codigo']; 
					                        ?>
					                      </td>
					                  </tr>
					                  
					              <?php } ?>
					                    </table>
				            		
				            	</td>
				            </tr>
				         </table>
				     	</div>
				     	<!-- text input -->
		                  <div class="form-group">
		        			<label>
							<?php echo $form->labelEx($model,'Derivar  a *'); ?>
		        			</label>
		        				<?php 
									if ($model->derivado_a=='') { ?>
										<br>
									 <div class="form-control" id="user_destino">
										<i style="color: darkgray;">Usuario Destino sin Asignar</i>
									 </div>	
									
									<?php }
									else{ ?>
										<div class="form-control"  id="user_destino">
											<?=Seguimientos::getUsuario($model->derivado_a)?>
										</div>	
									<?php }	?>

								<?php echo $form->hiddenField($model,'derivado_a', array('id'=>'derivado_a')); ?>
								<?php echo $form->error($model,'derivado_a'); ?>		
		                  </div>


		                  <div class="form-group">
		        			<label>
							<?php echo $form->labelEx($model,'prove&iacute;do *'); ?>
		        			</label>
							<?php echo $form->textField($model,'proveido',array('class'=>'form-control', 'style'=>'height:80px;')); ?>
							<?php echo $form->error($model,'proveido'); ?>
		                  </div>
		 
		                   <div class="form-group">
		        			<label>
								<?php echo $form->labelEx($model,'Acci&oacute;n *'); ?>
		        			</label>
								<?php //echo $form->textField($model,'fk_accion'); ?>
								<?php echo $form->dropDownList($model,'fk_accion', $model->getListAcciones(), array('empty'=>'Seleccione Acción','class'=>'form-control  select','options' => array('1'=>array('selected'=>true)))); ?>
								<?php echo $form->error($model,'fk_accion'); ?>
		                  </div>

		                   <div class="card-footer">

		                 <div class="card-body pad table-responsive">
		              	 <table class="table table-bordered table-striped" >
		              	 	<tr style="background-color: white;">
		              	 		<td align="left" width="50%">
		              	 			<?php echo CHtml::submitButton($model->isNewRecord ? 'Terminar y Salir' : 'Actualizar', array('class' => 'btn btn-info', 'name' => 'terminar')); ?>
		              	 		</td>
		              	 		<td align="center" >
		              	 			<?php echo CHtml::ajaxSubmitButton ("Derivar Original",
										array('Seguimientos/ajaxSendCopyDigital', 'id'=>$seguimientos->id_seguimiento,'oficial'=>1),
			                        	array('update' => '#data'),
			                        	array('class'=>'btn btn-primary')
			                        	); 

			                        	//echo CHtml::submitButton('Derivar Original', array('class' => 'btn btn-info', 'name' => 'original'));

			                        ?>
		              	 		</td>
		              	 		<td align="right" width="50%">
		              	 			<?php 
									    // ESTA FUNCION SI FUNCIONA CORRECTAMENTE
									    /*echo CHtml::ajaxSubmitButton('Derivar Copia Digital', 
									        CHtml::normalizeUrl(array('Seguimientos/sendCopyDigital')), 
									        array(
									            'data'=>'js:jQuery(this).parents("form").serialize()+
									                "&request=added"',       
									            'success'=>'function(data){
									                $("#data").html(data);
									            }'
									        ), 
									        array(
									            'id'=>'ajaxSubmitBtn', 
									            'name'=>'ajaxSubmitBtn',
									            'class'=>'btn btn-danger'
									        )); */
									    //echo CHtml::submitButton('Derivar Copia', array('class' => 'btn btn-info', 'name' => 'copia'));    
									?>

							<?php echo CHtml::ajaxSubmitButton ("Derivar Copia",
								array('Seguimientos/ajaxSendCopyDigital', 'id'=>$seguimientos->id_seguimiento,'oficial'=>0),
	                        	array('update' => '#data'),
	                        	array('class'=>'btn btn-success')
	                        	); ?>
		              	 		</td>
		              	 	</tr>	
		              	 </table>	
		              	 </div>
	              		</div>
          			</div><!-- FIN col-md-6-->
          			<div class="col-md-6">

				<script type="text/javascript">
				    $(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#example thead th').each( function () {
				        var title = $('#example thead th').eq( $(this).index() ).text();
				        $(this).html( '<input type="text" placeholder="Buscar..." style="width:100%" />' );
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
								  <i style="color: #0B4C5F;">Usted debe presionar sobre el nombre del <b>usuario</b> para enviar el documento </i>
								</center>		
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						            <td></td>	
						               <td align="center"><b>Nombre</b></td>
						               <td align="center"><b>&Aacute;rea/Unidad</b></td>
						            </tr>
						            <tr>
						            	<td></td>	
						                <th align="center"><b>Nombre</b></th>
						                <th align="center"><b>rea/Unidad</b></th>
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php $dataReader=Seguimientos::getListaDerivaciones(); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						           	<td align="center">
						           		<a onclick="javascript:destinatario('<?=$row['nombre_destino'] ?>','<?= $row['id_usuario_destino'] ?>','<?= $row['nombre_destino'] ?>');" style="text-decoration:none; color: black;cursor: pointer" class="btn btn-default btn-sm"><i class="fa fa-reply-all" style="font-size: 18px;"></i></a>
						           	</td>
						            <td align="left" valign="middle">
                  						<a onclick="javascript:destinatario('<?=$row['nombre_destino'] ?>','<?= $row['id_usuario_destino'] ?>','<?= $row['nombre_destino'] ?>');" style="text-decoration:none; color: black;cursor: pointer; font-size: 11px;"><div><?=$row['nombre_destino']?></div></a>
						            </td>
						            <!--<td align="center"><? //=$row['nombre_regional']?></td> -->
						            <td align="center" style="font-size: 11px;"><?=$row['nombre_area']?></td>
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table>


						    	<div class="card-body pad table-responsive"  style="height:200px; overflow:auto; border:1px solid lightgray; border-radius: 5px;">


						    		<?php

						    		
$usuario=Yii::app()->user->id_usuario;
 $sql = "SELECT id_grupo_derivacion, nombre_grupo 
		    	FROM grupo_derivacion
		    	WHERE fk_usuario=$usuario AND activo=1
		    	ORDER BY id_grupo_derivacion ASC";

        $rawdata = Yii::app()->db->createCommand($sql)->queryAll();


        $data = new CArrayDataProvider($rawdata, array(
            'keyField' => 'id_grupo_derivacion',
            'sort' => array(//optional and sortring
                'attributes' => array(
                    'id_grupo_derivacion','nombre_grupo'),
            ),
            'pagination' => array('pageSize' => 5))
        );


Yii::import('zii.widgets.grid.CGridView');
class SpecialGridView extends CGridView {
    public $id_seguimiento;
    public $nuri;
}        

//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('SpecialGridView', array(
    'dataProvider'=>$data,
    'id_seguimiento'=>$seguimientos->id_seguimiento,

    'selectableRows' => 2,
    'columns' => array(        
        array(
            'header' => 'No',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),
        /*array(
            'header' => 'Gerencia Regional',           
            'name' => 'regional',
            //'htmlOptions'=>array('style'=>'text-align:center'),
        ),*/


       

        array(
            'header' => 'GRUPOS',           
            'name' => 'nombre_grupo',
            'htmlOptions'=>array('style'=>'text-align: left; font-size:13px;'),
        ),
        array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            'class' => 'CButtonColumn',
            'template' => '{enviarCopia}',
            'header' => 'Enviar',
            //'value'=>'valor',
            'buttons' => array(

                
                'enviarCopia'=>array(
			    	'label'=>'<i class="fa fa-share"></i>  Enviar Copia',

              		'url'=>'Yii::app()->createUrl("seguimientos/sendCopyGroup",array("id_grupo"=>$data["id_grupo_derivacion"],  "id_seguimiento"=>$this->grid->id_seguimiento, "asDialog"=>1, "gridId"=>$this->grid->id))',


			          	'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
              				//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',
			          'options' => array(
              					'class'=>'enviarCopia btn btn-default btn-sm',
              					'title'=>'Enviar copia digital al grupo'
              						), 	
				),// fin


                 
           ),// fin buttons 
        ), // fin array
        /*array(
            'class'=>'CButtonColumn',
        ),*/
    ),
 ));



?>

<?php
//--------------------- begin new code --------------------------
   // add the (closed) dialog for the iframe
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'cru-dialog',
	'options'=>array(
	    'title'=>'Enviar copias digitales',
	    'autoOpen'=>false,
	    'modal'=>true,
	    'width'=>890,
	    'height'=>500,
	),
	));
?>
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>


		              
						                
						        </div>

						    </div>
						</div>
					   </article>
					   
					</div>

          			</div><!-- FIN col-md-6-->	
          		</div>
              <!-- /.row -->
              <hr style="background-color:#A4A4A4;">
              <!-- .row -->
              <div class="row">
          		<div class="col-md-12">
          			<div id="data">
   					<?php $this->renderPartial('_ajaxDerivadoDigital', array('seguimientos'=>$seguimientos)); ?>
					</div>

						<?php /*echo CHtml::ajaxButton ("Update data",
                              CController::createUrl('helloWorld/UpdateAjax'), 
                              array('update' => '#data'));*/
						?>
          		</div>	
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



	<div class="row">
		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('size'=>45,'maxlength'=>45, 'value'=>$seguimientos->codigo)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'derivado_por'); ?>
		<?php echo $form->hiddenField($model,'derivado_por',array('value'=>Yii::app()->user->id_usuario)); ?>
		<?php echo $form->error($model,'derivado_por'); ?>
	</div>



	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_estado'); ?>
		<?php echo $form->hiddenField($model,'fk_estado',array('value'=>3)); ?>
		<?php echo $form->error($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'padre'); ?>
		<?php echo $form->hiddenField($model,'padre', array('value'=>$seguimientos->id_seguimiento)); ?>
		<?php echo $form->error($model,'padre'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_derivacion'); ?>
		<?php //echo $form->textField($model,'fecha_derivacion'); ?>
		<?php //echo $form->error($model,'fecha_derivacion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_derivacion'); ?>
		<?php //echo $form->textField($model,'hora_derivacion'); ?>
		<?php //echo $form->error($model,'hora_derivacion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_recepcion'); ?>
		<?php //echo $form->textField($model,'fecha_recepcion'); ?>
		<?php //echo $form->error($model,'fecha_recepcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_recepcion'); ?>
		<?php //echo $form->textField($model,'hora_recepcion'); ?>
		<?php //echo $form->error($model,'hora_recepcion'); ?>
	</div>

	

	<div class="row">
		<?php //echo $form->labelEx($model,'oficial'); ?>
		<?php echo $form->hiddenField($model,'oficial', array('value'=>$seguimientos->oficial)); ?>
		<?php echo $form->error($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hijo'); ?>
		<?php //echo $form->textField($model,'hijo',array('size'=>45,'maxlength'=>45)); ?>
		<?php //echo $form->error($model,'hijo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
		<?php //echo $form->error($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'confirmado'); ?>
		<?php //echo $form->textField($model,'confirmado'); ?>
		<?php //echo $form->error($model,'confirmado'); ?>
	</div>

	

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->





