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
				        $(this).html( '<input type="text" placeholder="Buscar..."  style="width:100%;" />' );
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
          <div class="col-md-12">
          	
          	<div class="card-body pad table-responsive">
								<center><h4><u>Detalle de documentaci&oacute;n disponibles</u></h4>
								  <i style="color: #0B4C5F;">Documentaci&oacute;n generada por el usuario sin <b>NUR/NURI</b> asignado <br>
								  <b>La siguiente informaci&oacute;n a&uacute;n puede ser actualizada.</b>
								  </i>
								</center>		
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>CITE</b></td>
						               <td align="center"><b>DESTINATARIO</b></td>
						               <td align="center"><b>REFERENCIA</b></td>
						               <td align="center"><b>FECHA</b></td>
						               <td align="center"><b>TIPO</b></td>
						               <td align="center"><b>ESTADO</b></td>
						               <td align="center"><b></b></td>
						            </tr>
						            <tr>
						               <th align="center"><b>CITE</b></th>
						               <th align="center"><b>DESTINATARIO</b></th>
						               <th align="center"><b>REFERENCIA</b></th>
						               <th align="center"><b>FECHA</b></th>
						               <th align="center"><b>TIPO</b></th>
						               <th align="center"><b>ESTADO</b></th>
						               <td align="center"><b></b></td>
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php $dataReader=Documentos::getDocumentosSinNuri(); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="center"><?=$row['cite']?></td>
						            <td align="center">
						            	<?=$row['destinatario']?><br>
						            </td>
						            <td align="left"><?=$row['refer']?></td>
						            <td align="center"><?=date("d/m/Y", strtotime($row['fecha_creacion']));?></td>
						            <td align="center"><?=$row['tipo_doc']?></td>
						            <td align="center"><?=$row['estado_doc']?></td>
						            <td align="center">
						            	<a class="btn btn-app" href="index.php?r=documentos/updateDocument&id_documento=<?=$row['id_documento']?>&tipo_documento=<?=$row['id_tipo_documento']?>" style="color: black;">
                  						<i class="fa fa-edit"></i>Editar
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

