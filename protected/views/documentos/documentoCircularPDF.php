<style>
  .cuerpo {
    padding-top: 20mm;
    padding-left: 3.3cm;
    padding-right: 0.6cm;
    padding-bottom: 3.5cm;
    width: 90%;
  }

  #cuerpo_contenido table tbody tr, #cuerpo_contenido table td, #cuerpo_contenido table th{
    	border: 0.5px solid black;
    	border-left: 0.5px solid black;
    	border-right: 0.5px solid black;
    	border-collapse: collapse;
    	
  }
  #cuerpo_contenido table tbody tr td {
    	border-left: 0.5px solid black;
    	border-right: 0.5px solid black;
    	border-collapse: collapse;
  }       

        
</style>
<?php 
switch($documentos->fk_tipo_documento) {
					    case 1:
					        $tipo='INFORME';
					        break;
					    case 2:
					        $tipo='NOTA INTERNA';
					        break;
					    case 3:
					        $tipo='MEMORANDUM';
					        break;
					    case 4:
					        $tipo='CARTA';
					        break;
					    case 5:
					        $tipo='CIRCULAR';
					        break;        
					}
?>

<div class="cuerpo">
<!--#####################################################################-->		

<table align="center">
	<tr>
		<th align="center" style="font-size:20px; font-family: Verdana;">
			<?=$tipo?>
		</th>
	</tr>
	<tr>
		<th align="center" style="font-size: 15px;  font-family: Verdana;">
			<?=$documentos->codigo?>
		</th>
	</tr>
	<tr>
		<th align="center" style="font-size: 15px;  font-family: Verdana;">
			<?=$hojasruta->nur?>
		</th>
	</tr>
</table>
<br>
<!-- CODIGO PARA MOSTRAR NOMBRES EN EL DOCUMENTO -->
<table align="center" width="85%" border="0" cellpadding="4">

	<?php 

    if($documentos->destinatario_nombres!='null')
    {

      $row_via= Documentos::getRowExplode($documentos->destinatario_nombres,';');
      $row_cargo_via= Documentos::getRowExplode($documentos->destinatario_cargo,';');
      
      for($i=0; $i<count($row_via); $i++) {
  ?>
  <tr>
    <th align="left"  width="15%" style="font-size: 15px; font-family: Verdana;"> 
      <?php if($i==0){ echo "A:";} 
          else{ echo " "; } 
        ?>
        
    </th>
    <td align="left"  width="85%" style="font-size: 15px; font-family: Verdana;">
      <?=$row_via[$i]; ?><br>
      <b><?php 

          if ($row_cargo_via[$i]=='null') {
            $cargo='';
          }
          else{
           $cargo=$row_cargo_via[$i]; 
          }
          echo $cargo;
          

        ?></b>
    </td>
  </tr>
  <?php   } //for($i=0; $i<count($row_via); $i++)

    } ?>

	
	<?php 	
		$row_remitente=Documentos::getRowExplode($documentos->remitente_nombres,';'); 
		$row_remitente_via=Documentos::getRowExplode($documentos->remitente_cargo,';');

		for($j=0; $j<count($row_remitente); $j++) {
					
	?>
	<tr>
		<th align="left"  width="15%" style="font-size: 15px; font-family: Verdana;">
			<?php if($j==0){ echo "De:";} 
				  else{ echo " "; }	
				?>
		</th>
		<td align="left"  width="85%" style="font-size: 15px; font-family: Verdana;">
			<?=$row_remitente[$j]; ?><br>
			<b><?=$row_remitente_via[$j]; ?></b>
		</td>
	</tr>
	<?php } ?>
</table>

<!-- CODIGO PARA LA FECHA Y REFERENCIA -->
<br>
<table align="left" width="95%" border="0" cellpadding="4">
	<tr>
		<th align="left" width="15%" style="font-size: 15px; font-family: Verdana;">Fecha: </th>
		<td align="left" width="85%" style="font-size: 15px; font-family: Verdana;">
			<?php
				$row_mes=Documentos::getRowExplode($documentos->fecha,'-');
				$name_mes=Documentos::getNameMonth($row_mes[1]);
				echo $row_mes[2]." de ".$name_mes." de ".$row_mes[0];
				 
			?>
		</td>
	</tr>

	<tr>
		<th align="left" width="15%" style="font-size: 15px; font-family: Verdana;">Referencia: </th>
		<td align="left" width="85%" style="font-size: 15px; font-family: Verdana;">
			<b><u><?=$documentos->referencia; ?></u></b>
		</td>
	</tr>
</table>

<!-- CODIGO PARA MOSTRAR EL CONTENIDO DEL DOCUMENTO-->
<div id="cuerpo_contenido" style="font-size: 15px;  font-family: Verdana;">
<?php

$contenido = str_replace("border-right:solid windowtext 1.0pt;", " ", $documentos->contenido);
$contenido = str_replace("border:solid windowtext 1.0pt;", " ", $contenido);

echo $contenido; 

?>
</div>


<!-- CODIGO PARA MOSTRAR EL NOMBRE DE LA FIRMA -->
<table align="center" width="100%" border="0" cellpadding="4">

	<tr>
	<?php 

		$row_remitente= Documentos::getRowExplode($documentos->remitente_nombres,';');
		$row_cargo_remitente= Documentos::getRowExplode($documentos->remitente_cargo,';');
			
		for($j=0; $j<count($row_remitente); $j++) {
		//for($i=0; $i<6; $i++) {
	?>
		<td align="center"  style="font-size: 15px; font-family: Verdana;">
			<br><br><br>
			<?php echo $row_remitente[$j]; ?><br>
			<b><?php echo $row_cargo_remitente[$j]; ?></b>
		</td>
	<?php 
			if(($i+1)%3==0)
			{
				echo "</tr><tr>";
			}//fin if
		} // fin for
	?>
	</tr>
</table>	

	


<!--#####################################################################-->	
</div>
  

