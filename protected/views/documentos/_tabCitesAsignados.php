<head>
	<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>-->
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />

	<script type="text/javascript">
    

    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example<?=$tipo_documento?> thead th').each( function () {
        var title = $('#example<?=$tipo_documento?> thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="" style="width:100%;" />' );
        //$(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );
  
    // DataTable
    var table = $('#example<?=$tipo_documento?>').DataTable( {
        colReorder: true
    } );
      
    // Apply the filter
    $("#example<?=$tipo_documento?> thead input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    } );
    } );    


</script>  
</head>

<?php 

$tipo=TipoDocumento::model()->findByPk($tipo_documento);

?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          	
          	<div class="card-body pad table-responsive">

          		<a class="btn btn-app" href="index.php?r=documentos/CitesAsignadosEXCEL&tipo_documento=<?=$tipo->id_tipo_documento?>&gestion=<?=$gestion?>" style="color: black;">
                  						<i class="fa fa-file-excel-o"></i>Generar Reporte
                </a>

								<center><h4><u><b><?=$tipo->tipo_documento." - ".$gestion?></b></u></h4>
								</center>		
						        <table id="example<?=$tipo_documento?>" class="display" style="width:90%">
						         <thead>
						            <tr>
						               <td align="center"><b>NUR/NURI</b></td>
						               <td align="center"><b>CITE</b></td>
						               <td align="center"><b>AUTOR</b></td>
						               <td align="center"><b>REFERENCIA</b></td>
						               <td align="center"><b>FECHA</b></td>
						               <td align="center"><b>DESTINATARIO</b></td>
						               <td align="center"><b></b></td>
						            </tr>
						            <tr>
						               <th align="center"><b>NUR/NURI</b></th>
						               <th align="center"><b>CITE</b></th>
						               <th align="center"><b>AUTOR</b></th>
						               <th align="center"><b>REFERENCIA</b></th>
						               <th align="center"><b>FECHA</b></th>
						               <th align="center"><b>DESTINATARIO</b></th>
						               <td align="center"><b></b></td>
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php $dataReader=Documentos::getCitesAsignados(Yii::app()->user->id_area,$tipo_documento,$gestion); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="center"><?=$row['nuri']?></td>
						            <td align="center"><?=$row['cite']?></td>
						            <td align="center">
						            	<?=$row['autor']?><br>
						            	<b><i><?=$row['cargo_autor']?></i></b>
						            </td>
						            <td align="left"><?=$row['refer']?></td>
						            
						            <td align="center"><?=date("d/m/Y", strtotime($row['fecha_creacion']));?></td>
						            <td align="center">
						            	<?=$row['destinatario']?><br>
						            </td>

						            <td align="center">
						            	<a class="btn btn-app" href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$row['nuri']?>" style="color: black;">
                  						<i class="fa fa-paw"></i>Seguimiento
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




