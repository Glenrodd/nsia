<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Manage',
);
?>
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
				        $(this).html( '<input type="text" placeholder="Buscar..." style="width:100%;" />' );
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


<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Retornar menu documentos',array('site/menuDocumentos'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section>  
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          	
          	<div class="card-body pad table-responsive">
								<center><h4><u>Detalle de <b>NUR/NURI(s) y CIRCULARES </b> disponibles</u></h4>
								  <i style="color: #0B4C5F;">Documentaci&oacute;n generada por el usuario <b><?=Yii::app()->user->usuario;?></b> en el <b>SIACO</b> <br>
								  </i>
								</center>		
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>NUR</b></td>
						               <td align="center"><b>CITE</b></td>
						               <td align="center"><b>DESTINATARIO</b></td>
						               <td align="center"><b>REFERENCIA</b></td>
						               <td align="center"><b>FECHA</b></td>
						               <td align="center"><b></b></td>
						            </tr>
						            <tr>
						               <th align="center"><b>NUR</b></th>
						               <th align="center"><b>CITE</b></th>
						               <th align="center"><b>DESTINATARIO</b></th>
						               <th align="center"><b>REFERENCIA</b></th>
						               <th align="center"><b>FECHA</b></th>
						               <td align="center"><b></b></td>
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php $dataReader=Documentos::adminDocumentoHistorico($tipo_documento); ?>	
						         <?php 
						         $i=0;
						         foreach ($dataReader as $row) { 
						         $i++;	

						         	?>	
						           <tr>
						            <td align="center"><?=$row['nuri']?></td>
						            <td align="center"><?=$row['cite']?></td>
						            <td align="center">
						            	<?=$row['destinatario_nombres']?><br>
						            	<b><?=$row['destinatario_cargo']?></b><br>
						            </td>
 						            <td align="left"><?=$row['referencia']?></td>
						            <td align="center"><?=date("d/m/Y", strtotime($row['fecha']));?></td>
						            <td align="center">

						            <?php 
						            	echo CHtml::ajaxLink(' <i class="fa fa-desktop"></i> Ver doc.',
				                              $this->createUrl('documentos/viewDocumentMysql', array("id"=>$row['cite'])),
				                            array(
				                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
				                            ),
				                            array('id'=>'showJuiDialog'.$i, 'name'=>'showJuiDialog00'.$i, 'style'=>'color:#0174DF; font-weight: bold;',
				                            	'class'=>'btn btn-default btn-sm',
				                            ) // not very useful, but hey...
				                            ); echo "<p></p>";
						            ?>

                						<a class="btn btn-default btn-sm" href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$row['nuri']?>" style="color: black;">
                  						<i class="fa fa-paw"></i> Seguimiento.
                						</a>
                						
						            </td>
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table>
			</div>      
			
      	  </div>
        </div>
        <!-- ./row -->
    </div>
 </section>  


<?php 
// codigo para mostrar el popup dinamico mencionado en la tabla de seguimiento
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'juiDialog3',
                'options'=>array(
                    'title'=>'Documento',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'60%',
                    'height'=>670,
                ),

                ));

$this->endWidget();
//############################################
?>
