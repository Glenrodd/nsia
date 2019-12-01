<!-- <head>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.treeview.css" />
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.treeview.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo.js"></script>



 


</head> -->
<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$array_meses=array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Create',
);
$nuri=strtoupper($nuri);
?>
             <!-- /.card-body -->
                  <!-- text input -->
                  <!--<i  class="fa fa-paw"></i>
                  <i  class="fa fa-envelope"></i>
                  <i  class="fa fa-user"></i>
                  <i  class="fa fa-comments"></i>
                  <i  class="fa fa-commenting"></i>
                  <i  class="fa fa-pencil"></i>
                  <i  class="fa fa-file-text-o"></i>-->


<?php //echo "-----> ".$nuri ?>
<!-- <center>
<a class="btn btn-app btn-sm" href="index.php?r=seguimientos/printBusquedaIndex&nuri=<?=$nuri?>" target="_blank" style="color:white; background-color:#086A87; ">
    <i class="fa fa-print"></i>Imprimir Seguimiento
</a>
</center> -->
<h3><strong>Detalle de seguimiento </strong></h3>





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
                	B&uacute;squeda de NURI/NUR: <b><?=$nuri?></b>.
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
      <div class="row">
        <br><br><br><br><br><br>
       <?php 
       // codigo para verificar si el nuri esta registrado 
       // en la base de datos Postgres nueva
       // en caso de existir nos muestra el valor de la nueva base de datos

      // echo "-->".Seguimientos::countNuriHojasRuta($nuri);
       if (Seguimientos::countNuriHojasRuta($nuri)>0) {
          $row=Seguimientos::getCabeceraSeguimiento($nuri);
          $tipo_documento=$row['tipo_doc'];
          $fecha_creacion=$row['fecha_creacion'];
          $hora_creacion=$row['hora_creacion'];
          $cite=$row['cite'];
          $adjunto=$row['adjunto'];
          $referencia=$row['referencia'];
          $destinatario=$row['destinatario'];
          $id_doc=$row['id_doc'];
          $remitente_institucion=$row['rem_institucion'];
          $remitente=$row['remitente'];
          $bandera_remitente=0;
          

       }else{
         $tipo_documento=0;
       }
/*       else{

          $row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
          $tipo_documento=$row['tipo_documento'];
          $fecha_creacion=$row['fecha'];
          $hora_creacion='';
          $cite=$row['cite'];
          $adjunto=$row['adjuntos'];
          $referencia=$row['referencia'];
          $destinatario=$row['destinatario'];
          $remitente_institucion=$row['remitente_institucion'];
          $remitente=$row['remitente'].' - '.$row['remitente_cargo'];
          $id_doc=$cite;
          $bandera_remitente=0;

          if ($tipo_documento=='CARTA EXTERNA') {
            $remitente=1;
          }

       }*/



       ?> 

        <div class="col-md-9"><!-- inicio -->
         <div class="card-body">       
                  <div class="card-body pad table-responsive">
                    <?php //$row=Seguimientos::getCabeceraSeguimiento($nuri); 
                      //$id_doc=$row['id_doc'];
                    ?>
                   <table class="table-bordered table-striped" id="table_cabecera_seguimiento" style="font-size: 15px;" >
                  <tr>
                    <th><i  class="fa fa-files-o"></i> Tipo Documento</th>
                    <td><?=$tipo_documento?></td>
                    <th><i  class="fa fa-calendar"></i> Fecha/Hora Creaci&oacute;n</th>
                    <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($fecha_creacion))." - ".$hora_creacion?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-pencil"></i> CITE</th>
                    <td>
                       <?php 
                       // codigo para mostrar los documentos asociados
                       // en el nuevo sistema
                       if (Seguimientos::countNuriHojasRuta($nuri)>0) {

                        $dataReader=Documentos::getNurisAsociados($nuri);
                        $l=0;
                        foreach($dataReader as $row2) {  ?>
                        <div class="tooltip3 tooltip-effect-1"><div class="tooltip-item">   
                        <?php    $l++;
                            echo CHtml::ajaxLink($row2['codigo'],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['id_documento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog'.$l, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            ); echo "<br>"; ?>
                          </div>
                        <div class="tooltip-content clearfix" style="padding-left: 12px;"><div class="tooltip-text">Click en el enlace para ver el documento  </div>
                         </div>
                        </div><!-- tooltip3 tooltip-effect-1-->  
                        <br>
                      <?php  } // fin foreach

                       }
                       /*else{
                          //$row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
                          $dataReader=Seguimientos::getNurisAsociadosMYSQL($nuri);
                          $i=0;
                          foreach($dataReader as $row2) {  ?>
                          <div class="tooltip3 tooltip-effect-1"><div class="tooltip-item">   
                          <?php    $i++;
                              echo CHtml::ajaxLink($row2['codigo'],
                                $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['codigo'])),
                              array(
                                  'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                              ),
                              array('id'=>'showJuiDialog0'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                              ); echo "<br>"; ?>
                            </div>
                          <div class="tooltip-content clearfix" style="padding-left: 12px;"><div class="tooltip-text">Click en el enlace para ver el documento  </div>
                           </div>
                          </div><!-- tooltip3 tooltip-effect-1-->  
                          <br>
                        <?php  } // fin foreach
                        }*/
                       ?> 




                    </td> 
                    <th><i  class="fa fa-chain"></i> Adjuntos</th>
                    <td><?=$adjunto?></td>
                  </tr>
                  <tr>
                    <th><i  class="fa fa-commenting-o"></i> Referencia</th>
                    <td colspan="3"><?=$referencia?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user"></i> Remitente</th>
                    <td colspan="3"><?=$remitente?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Destinatario</th>
                    <td colspan="3"><?=$destinatario?></td>  
                  </tr>
                  <?php 
                    if ($tipo_documento=='CARTA EXTERNA') {
                  ?>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Instituci&oacute;n Remitente</th>
                    <td colspan="3"><?=$remitente_institucion?></td>  
                  </tr>
                  <?php } ?>

                  <?php 

                    //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SAC
                    if (count(Seguimientos::listaCartaExterna($nuri))>0){ ?>
                    
                    <tr>
                      <th><i  class="fa fa-file-text-o "></i> Documento Escaneado</th>
                      <td colspan="3">
                        <?php 
                        $dataReader=Seguimientos::listaCartaExterna($nuri); 
                        foreach ($dataReader as $row2) {
                          
                          echo CHtml::link(
                            "<b style='color:#0074DE;'>".$row2['codigo']."</b>",
                            Yii::app()->createUrl('/Documentos/viewCartaPDF', array('filename' => $row2['ruta_documento'])) ,
                            array('class'=>'','target'=>'_blank', 'style'=>'color: black;'));
                          echo "<br>";
                        }
                        ?>
                      </td>  
                    </tr>
                      
                  <?php  }//if (count(Seguimientos::listaCartaExterna($nuri))>0){ 
                    else{ 

                      //echo "else";

                        //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SIACO
                        if($tipo_documento=='CARTA EXTERNA') {
                          // codigo para separar la fecha del cite asociado al nuri y visualizar
                          $fecha_aso=explode(' ', $fecha_creacion);
                          $fecha=explode('-',$fecha_aso[0]);
                          $anio=$fecha[0];
                          $mes=$fecha[1]+0;
                          //$numero=($mes-1);
                          $nombre_mes=$array_meses[$mes-1];
                          $dia=$fecha[2];
                          for ($i=0; $i <count($array_meses) ; $i++) { 
                            //echo "<br>".$array_meses[$i];
                          }

                          $nuevo_cite = str_replace("/", "_", $cite); 
                    ?>
                         <tr>
                            <th><i  class="fa fa-file-text-o "></i> Documento Escaneado</th>
                            <td colspan="3">
                              <a href="http://siaco.abc.gob.bo/documentos/<?=$anio?>/<?=$nombre_mes?>/<?=$dia?>/<?=$nuevo_cite?>/<?=$nuevo_cite?>.PDF" target="_blank" ><?=$cite?></a>
                              <!--<a href="doc_siaco/<?=$anio?>/<?=$nombre_mes?>/<?=$dia?>/<?=$nuevo_cite?>/<?=$nuevo_cite?>.PDF" target="_blank" ><?=$cite?></a>-->
                            </td>  
                          </tr>
                    <?php 
                        }//if($tipo_documento=='CARTA EXTERNA') {
                  } //else{
                  ?>
                  


                  <!--############## CODIGO PARA MSTRAR SI EL NURI PERTENECE A UN AGRUPADO DEL SAC-->
                  <?php if (Seguimientos::countNuriSecundarioAgrupacion($nuri)>0) { 
                        $nuri_principal=Seguimientos::getNuriPrincipal($nuri); 
                  ?>
                  <tr>
                    <th><i  class="fa fa-group"></i> Agrupaci&oacute;n</th>
                    <td colspan="3" style="color:darkred;">Una copia de este documento pertenece al NUR/NURI Principal 

                      <div class="tooltip3 tooltip-effect-1">
                        <div class="tooltip-item">


                          <a href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$nuri_principal?>"><?=$nuri_principal?></a>
                          <?php 
                           /*echo CHtml::ajaxLink($nuri_principal,
                              $this->createUrl('seguimientos/busquedaNuriPrincipal', array("nuri"=>$nuri_principal)),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    'style'=>'font-size:20px; ',
                                  ) // not very useful, but hey...
                            );*/
                          ?>
                        </div>
                        <div class="tooltip-content clearfix" style="padding-left: 12px;">
                          <div class="tooltip-text"> Usted puede ver el seguimiento del NUR/NURI Principal seleccionando este enlace  </div>
                         </div>
                        </div><!-- tooltip3 tooltip-effect-1-->
                      </td>  
                    </tr>

                    <?php 
                    }
                  ?>
                
               </table>
           </div>
                      
         </div>
           <!-- /.card -->
        </div><!-- fin -->

       
               

        <div class="col-md-3">
           <!-- /.card-header -->
          <div class="card-body">

            <!-- codigo obtenido de la raiz-->
            <!-- http://localhost/jquery-treeview-master/demo/ -->
            <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 

               $principal=' PRINCIPAL';
             } 
             else{ 

              $principal=''; 
            /*  if (Seguimientos::getListaNurisAgrupadossSIACOCount($nuri)) {
                $principal=' PRINCIPAL';
              }
              else{

              $principal=''; 
            }*/

            }
             ?>
            <h6 style="color:#0174DF; font-weight: bold;"><b><u>NUR/NURI <?=$principal?></u></b></h6>
              <ul id="browser" class="filetree">
                <li><i class="fa fa-folder-open-o" style="font-size: 21px;"></i>&nbsp;&nbsp;<b style="font-size:22px; color:#0B3861;"><?=$nuri?></b>
                  <ul>


                    <?php 
                    /* if (Seguimientos::getListaNurisAgrupadossSIACOCount($nuri)) {
                          $dataReader2=Seguimientos::getListaNurisAgrupadossSIACO($nuri); 
                           ?> 
                           <?php foreach ($dataReader2 as $row3) {  ?>
                               <li><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;

                              <a href="index.php?r=Seguimientos/busquedaIndex&nuri=<?=$row3['nur_s']?>"><?=$row3['nur_s']?></a>

                                <?php 
                           
                        
                          ?>

                          <?php  }

                        } */

                           ?>



                    <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 
                        $dataReader=Seguimientos::listaAgrupacion($nuri); 
                        foreach ($dataReader as $row2) {
                      ?>
                      <li><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;
                        
                          <a href="index.php?r=Seguimientos/busquedaIndex&nuri=<?=$row2['nur_hijo']?>"><?=$row2['nur_hijo']?></a>
                          <?php /* 
                           echo CHtml::ajaxLink($row2['nur_hijo'],
                              $this->createUrl('seguimientos/busquedaNuriPrincipal', array("nuri"=>$row2['nur_hijo'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    //'style'=>'font-size:20px; ',
                                  ) // not very useful, but hey...
                            );
                          */?>

                        
                      </li>
                    <?php 
                          } // fin foreach
                        } ?>
                  </ul>
                </li>

              </ul><!-- fin ul-->

                      
          </div>
                  <!-- /.card -->
          </div>
               <!-- /.col -->
      </div>   




   
            
              
            


			     

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogClassroom',
    'options'=>array(
        'title'=>'Documento',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'60%',
        'height'=>670,
        'draggable' => false,
        //'position'=>array(600,600), 
        'position'=> array('my'=> "center", 'at'=> "center"),
        //'position'=>array('my'=>'center','at'=>'center', 'of' => ''),
    ),
));?>
<div class="divForForm"></div>

<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function addClassroom()
{
  <?php echo CHtml::ajax(array(
      'url'=>array('seguimientos/viewDocument', 'id'=>$id_doc),
      'data'=> "js:$(this).serialize()",
      'type'=>'post',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        if (data.status == 'failure')
        {
          $('#dialogClassroom div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
          $('#dialogClassroom div.divForForm form').submit(addClassroom);
        }
        else
        {
          $('#dialogClassroom div.divForForm').html(data.div);
          setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
        }
        
      } ",
      ))?>;
  return false; 
  
}

</script>



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
                  $i=0;
			            foreach($dataReader as $row) {

			            //$total_contrato=$total_contrato+$row['total_contrato'];
			            if (($row['fk_estado']==1) || $row['fk_estado']==3 ) 
                  { $icono='<i class="fa fa-hand-peace-o" style="font-size:24px; color:#610B0B;"></i>'; 
                    $color='font-weight: bold;';
                    if ($row['confirmado']==1) {  $confirmado=' ';  }
                    else{ $confirmado='<i style="color:red; font-size:11px;">Sin confirmar</i>'; } //
                  }
			            else 
                  { 
                    $icono='<i class="fa fa-paw"  style="font-size: 21px;"></i>'; 
                    $color='';
                    $confirmado='';
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
			           	<td style="<?=$color?>">
                            <?php
                              
                              if ($row['fk_estado']==5) {

                                echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado'],
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog300000'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    ); echo "<br>";
                              }
                              else{
                                echo $row['estado']."<br>";
                                echo $confirmado;

                              }

                            ?>
                  </td>
			           	<td align="center">
                    <?php 
                    
                    
                    if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                        $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                        foreach($dataReader as $row2) {  

                            $num2=rand(11111111111,9999999999);   
                            $i++;
                            echo CHtml::ajaxLink($row2['codigo'],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog'.$num2, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
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
              	<div class="card card-default "><!--collapsed-card-->
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
					           <table  id="table_seguimiento" border="1"  style="font-size:13px; ">
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
                        $i=0;
							          $dataReader=Seguimientos::getSearchNuri($nuri,0);
							          foreach($dataReader as $row) {
                          $i++;
							            //$total_contrato=$total_contrato+$row['total_contrato'];
							        ?>	
							       <tr>
						         	<td rowspan="2">
                           <div class="numero_copia">
                              <?php
                                  if ($row['copia_padre']=='0') { $numero=''; }
                                  else { $numero=$row['copia_padre']; }
                                  echo $numero;
                               ?>
                            </div>
						         		<?=$row['usuario_origen']?>
						         	</td>	
						           	<td rowspan="2">
                            <div class="numero_copia">
                              <?=$row['numero_copia']?>
                            </div>

						           		<?=$row['usuario_destino']?>
						           	</td>
						           	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
						           	<td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_recepcion']))." - ".$row['h_recepcion']?></td>
						           	<td><?=$row['accion']?></td>
						           	<td>
                            <?php
                              
                              if ($row['fk_estado']==6) {

                                echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado'],
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog3'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    ); echo "<br>";

                                $confirmado=' ';
                              }
                              else{
                                echo $row['estado'];
                                if ($row['confirmado']==1) {  $confirmado=' ';  }
                              else{ $confirmado='<br> <i style="color:red; font-size:11px;">Sin confirmar</i>'; } 

                              }

                              echo $confirmado;

                            ?>
                              
                        </td>
						           	<td>
                            <?php 
                    
                    
                          if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                              $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                              foreach($dataReader as $row2) {   
                                $num3=rand(111111,999999);
                                  $i++;
                                  echo CHtml::ajaxLink($row2['codigo'],
                                    $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                                  array(
                                      'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                  ),
                                  array('id'=>'showJuiDialog'.$num3, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
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