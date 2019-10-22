<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */

$this->breadcrumbs=array(
	'Hojas Rutas'=>array('index'),
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


<h4><strong>NUR(s) Externos creados en la gesti&oacute;n <?=$gestion?></strong></h4>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          	
          	<div class="card-body pad table-responsive">
								<center>
								  <i style="color: #0B4C5F;">
								  <b>Solo podra imprimir las hojas de seguimiento que hayan sido derivadas</b>
								  </i>
								</center>		
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>NUR</b></td>
						               <td align="center"><b>CITE</b></td>
						               <td align="center"><b>DESTINATARIO</b></td>
						               <td align="center"><b>REMITENTE</b></td>
						               <td align="center"><b>INSTITUCION REMITENTE</b></td>
						               <td align="center"><b>REFERENCIA</b></td>
						               <td align="center"><b>FECHA</b></td>
						               <td align="center"><b>Generar H.S.</b></td>
						               <td align="center"><b>Editar</b></td>
						            </tr>
						            <tr>
						               <th align="center"><b>NUR</b></th>
						               <th align="center"><b>CITE</b></th>
						               <th align="center"><b>DESTINATARIO</b></th>
						               <th align="center"><b>REMITENTE</b></th>
						               <th align="center"><b>INSTITUCION REMITENTE</b></th>
						               <th align="center"><b>REFERENCIA</b></th>
						               <th align="center"><b>FECHA</b></th>
						               <td align="center"><b></b></td>
						               <td align="center"><b></b></td>
						            </tr>
						         </thead>

						         <tbody>
						         <?php $dataReader=Seguimientos::getNurExternoCreado(Yii::app()->user->id_usuario,$gestion); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="center"><?=$row['nuri']?></td>
						            <td align="left"><?=$row['cite']?></td>
						            
						            <td align="left">
						            	<?=$row['destinatario']?><br>
						            	<b><i><?=$row['cargo_destinatario']?></i></b>
						            </td>
						            <td align="left">
						            	<?=$row['remitente']?><br>
						            	<b><i><?=$row['cargo_remitente']?></i></b>
						            </td>

						            <td align="left"><?=$row['remitente_institucion']?></td>
						            <td align="left"><?=$row['referencia']?></td>

						            <td align="center"><?=date("d/m/Y", strtotime($row['fecha']));?></td>
						            <td align="center">
						            	<?php if (HojasRuta::getCountNuriDerivado($row['nuri'])>0){ ?>
						            	<a class="btn btn-app" href="index.php?r=documentos/generarHsExternoPDF&id_documento=<?=$row['id_documento']?>&id_hoja_ruta=<?=$row['id_hoja_ruta']?>" style="color: black;">
                  						<i class="fa fa-file-text-o"></i>H.S.
                						</a>
                						<?php } ?>
						            </td>
						            <td align="center">
						            	<a class="btn btn-app" href="index.php?r=documentos/updateDocument&id_documento=<?=$row['id_documento']?>&tipo_documento=7" style="color: black;">
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

