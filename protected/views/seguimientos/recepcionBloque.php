<?php 
 


?>
<head>
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.js"></script>-->
    
    <!--<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />-->
</head> 

<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimientoses',
);


?>

<script language="javascript">
  function byebye ()
  {
    // need a confirmation before submiting
    if (confirm('Esta seguro de recepcionar los NUR/NURI(s) seleccionados ?'))			
      $("#myForm").submit ();
  }

  $(document).ready(function(){
    // powerful jquery ! Clicking on the checkbox 'checkAll' change the state of all checkbox  
    $('.checkAll').click(function () {
      $("input[type='checkbox']:not([disabled='disabled'])").attr('checked', this.checked);
    });
  });
</script>


<?php echo CHtml::beginForm("index.php?r=Seguimientos/RecibirNuriBloque", "post", array("id"=>"myForm")); ?>

<h3></h3>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Recepci&oacute;n por bloque.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<div class="row">
          			
          			<div class="col-md-12">

				<script type="text/javascript">
					/*
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
				    } );    */
					</script>




          				<div class="table-container">
					    <article id="contenido">
						<div class="table-container">
							<div class="card-body pad table-responsive">
								<center><h4><u><b>RECEPCI&Oacute;N INTERNA</b></u></h4>

								  <i style="color: #0B4C5F;">Usted puede seleccionar varios NUR/NURI(s) para realizar la recepci&oacute;n correspondiente</i>

								  <br><br>
								   <?php echo CHtml::activeCheckBox($model, "id_seguimiento", array ("class" => "checkAll", 'style'=>'font-size:50px;')); ?>
								   Seleccionar todo <br>
								<button
							  	  type="button"				
								  onClick="byebye()" class="btn btn-info" style="color:white;"
								><i class="fa fa-stack-exchange"></i>
								  Recibir NURI(s)
								  </button>
						<br><br>		  
						<table class="table table-bordered table-striped">
					        <tr style="background-color:#0489B1; color:white;">
					            <th align="left">Seleccione</th>
					            <th align="center">NUR/NURI</th>
					            <th align="left">Derivado por</th>
					            <th align="left">Prove&iacute;do</th>
					            <th align="left">Fecha/Hora</th>
				            </tr>
	   			          	<?php $dataReader=Seguimientos::getNoRecibidosUsuario(Yii::app()->user->id_usuario); ?>	
						         <?php foreach ($dataReader as $row) { 
						         $id_seguimiento=$row['id_seguimiento']	;
						         ?>
				           <tr style="font-size: 12px;">
					           	<td style="text-align:center; background-color:#0489B1;">
						           		<?php echo CHtml::activeCheckBox($model, "id_seguimiento[]", array('value'=>$id_seguimiento, 'uncheckValue' => NULL)); ?>
						           	</td>
						            <td align="center">
						            	
						            	<?php if($row['tipo_documento']=='ORIGINAL'){ ?>
						            	<i  class="fa fa-hand-peace-o" style="font-size: 20px; color: darkblue;"></i><br>
						            	<?php } ?>
						            	<i><b><?=$row['tipo_documento']?></b></i><br>
						            	<?=$row['nuri']?>
						            </td>
						            <td align="left">
						            <?=$row['usuario_origen']?>
						            </td>
						            <td align="left"><?=$row['proveido']?></td>
						            <td align="left"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
						            
						           </tr>
						         <?php } ?>    	 
		                </table> 
						</center>		

						    	<!--##########################################-->
						        <!--<table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="left"><b>Seleccione</b></td>
						               <td align="center"><b>NUR/NURI</b></td>
						               <td align="left"><b>Derivado Por</b></td>
						               <td align="left"><b>Prove&iacute;do</b></td>
						               <td align="left"><b>Fecha/Hora</b></td>
						               
						            </tr>
						            <tr>
						                <td align="left"><b></b></td>
						                <th align="center"><b>NUR/NURI</b></th>
						                <th align="left"><b>Derivado Por</b></th>
						                <th align="left"><b>Proveido</b></th>
						                <th align="left"><b>Fecha/Hora</b></th>
						                
						            </tr>
						         </thead>
						       	 <tbody> -->
						         <?php //$dataReader=Seguimientos::getNoRecibidosUsuario(Yii::app()->user->id_usuario); ?>	
						         <?php //foreach ($dataReader as $row) { 
						         //$id_seguimiento=$row['id_seguimiento']	;
						         ?>

						         <!--  <tr>
						           	<td style="text-align:center; background-color:#0489B1; ">
						           		<?php //echo CHtml::activeCheckBox($model, "id_seguimiento[]", array('value'=>$id_seguimiento, 'uncheckValue' => NULL)); ?>
						           	</td>
						            <td align="center">
						            	
						            	<?php //if($row['tipo_documento']=='ORIGINAL'){ ?>
						            	<i  class="fa fa-hand-peace-o" style="font-size: 28px; color: darkblue;"></i><br>
						            	<?php //} ?>
						            	<i><b><? //=$row['tipo_documento']?></b></i><br>
						            	<? //=$row['nuri']?>
						            </td>
						            <td align="left">
						            <? //=$row['usuario_origen']?>
						            </td>
						            <td align="left"><? //=$row['proveido']?></td>
						            <td align="left"><? //=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
						            
						           </tr>
						         <?php //} ?>    	 
						         </tbody>
						    	</table> -->
						    	<!--##########################################-->
						  



						    </div>
						</div>
					   </article>
					   
					</div>

          			</div><!-- FIN col-md-6-->	
          		</div>
              <!-- /.row -->
              <hr style="background-color:#A4A4A4;">
              <!-- .row -->
             

          			
                 
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
