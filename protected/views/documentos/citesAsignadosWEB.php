<?php 

$tipo=TipoDocumento::model()->findByPk($tipo_documento);

?>

<?php 

//echo "<br>gestion ----> ".$gestion;
//echo "<br>tipo_documento ----> ".$tipo_documento;

?>

								<center><h4><u><b><?=htmlentities($areas->area)?></b></u></h4>
								<center><h4><u><b><?=$tipo->tipo_documento." - ".$gestion?></b></u></h4>	
								</center>		
						        <table id="example<?=$tipo_documento?>" class="display" style="width:95%" border="1">
						         <thead>
						           <tr style="font-size: 16px; background-color: #086A87; padding:6px; color: white;  text-align: center;">
						               <td align="center"><b>NUR/NURI</b></td>
						               <td align="center"><b>CITE</b></td>
						               <td align="center"><b>AUTOR</b></td>
						               <td align="center"><b>REFERENCIA</b></td>
						               <td align="center"><b>FECHA</b></td>
						               <td align="center"><b>DESTINATARIO</b></td>
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
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table>
						




