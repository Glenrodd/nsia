<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);


if (is_numeric($id)) {
//print_r($documentos);
$documentos=Documentos::model()->findByPk($id);
$tipo=TipoDocumento::model()->findByPk($documentos->fk_tipo_documento);
$nuri=Seguimientos::getObtenerNuri($id);
?>
<br>
<!-- codigo para mostrar la cabereca -->
<table width="40%" align="center" >
	<tr align="center">
		<td><h3><b><?=$tipo->tipo_documento?></b></h3></td>
	</tr>
	<tr align="center">
		<td><b><?=$documentos->codigo?></b></td>
	</tr>
	<tr align="center">
		<td><b><?=$nuri?></b></td>
	</tr>
</table>
<hr>

<?php if ($documentos->fk_tipo_documento==4 OR $documentos->fk_tipo_documento==7) { 

 $row_mes=Documentos::getRowExplode($documentos->fecha,'-');
                        $name_mes=Documentos::getNameMonth($row_mes[1]);
?>





                        


<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td>
				<?=$documentos->fkUsuario->fkRegional->descripcion.", ".$row_mes[2]." de ".$name_mes." de ".$row_mes[0]."<br>"?>
				<?="<b>".$documentos->codigo."</b>"?>
				<br><br>
			</td>
		</tr>
		<td>
			<p></p><br>
                        <span><?php echo $documentos->destinatario_titulo; ?></span><br> 

                        <span><?php echo $documentos->destinatario_nombres; ?></span><br>
                        
                        <span><?php if ($documentos->destinatario_cargo!='null') {

                            echo "<b>".$documentos->destinatario_cargo."</b>"; 
                        } ?></span><br>

                        <span><?php echo "<b>".$documentos->destinatario_institucion."</b>"; ?><p></p>
                        Presente.-    
                        
                        <br><br>
                         REF.: <b><?php echo $documentos->referencia."<br>"; ?></b>
		</td>
	</table>





<?php } else { ?>

<table align="center" width="70%" border="0" cellpadding="4"  id="viewCabecera">

	<?php 

    if($documentos->destinatario_nombres!='null')
    {

    $row_destinatario= Documentos::getRowExplode($documentos->destinatario_nombres,';');
    $row_cargo_destinatario= Documentos::getRowExplode($documentos->destinatario_cargo,';');
      
    for($i=0; $i<count($row_destinatario); $i++) {
  ?>
  <tr>
    <th align="left"  width="28%" > 
      <?php if($i==0){ echo "A:";} 
          else{ echo " "; } 
        ?>
        
    </th>
    <td align="left"  width="72%" >
      <?=$row_destinatario[$i]; ?><br>
      <b><?php 

          if ($row_cargo_destinatario[$i]=='null') {
            $cargo='';
          }
          else{
           $cargo=$row_cargo_destinatario[$i]; 
          }
          echo $cargo;
          

        ?></b>
    </td>
  </tr>
  <?php   } //for($i=0; $i<count($row_via); $i++)

    } ?>

	<?php 

		if($documentos->via_nombres!='')
		{

			$row_via= Documentos::getRowExplode($documentos->via_nombres,';');
			$row_cargo_via= Documentos::getRowExplode($documentos->via_cargo,';');
			
			for($i=0; $i<count($row_via); $i++) {
	?>
	<tr>
		<th align="left"  width="28%" > 
			<?php if($i==0){ echo "V&iacute;a:";} 
				  else{ echo " "; }	
				?>
			  
		</th>
		<td align="left"  width="72%" >
			<?=$row_via[$i]; ?><br>
			<b><?=$row_cargo_via[$i]; ?></b>
		</td>
	</tr>
	<?php 	} //for($i=0; $i<count($row_via); $i++)

		}

		$row_remitente=Documentos::getRowExplode($documentos->remitente_nombres,';'); 
		$row_remitente_via=Documentos::getRowExplode($documentos->remitente_cargo,';');

		for($j=0; $j<count($row_remitente); $j++) {
					
	?>
	<tr>
		<th align="left"  width="28%" >
			<?php if($j==0){ echo "De:";} 
				  else{ echo " "; }	
				?>
		</th>
		<td align="left"  width="72%" >
			<?=$row_remitente[$j]; ?><br>
			<b><?=$row_remitente_via[$j]; ?></b>
		</td>
	</tr>
	<?php } ?>
</table>
<br>
<table width="70%" align="center" border="0" id="viewCabecera">
<!-- codigo para mostrar al destinatario y via -->
	<?php if ($documentos->fk_tipo_documento==5) { ?>
	
		<!--<tr>
			<td><b>A: </b></td><td><strong><? //=$documentos->nombre_grupo?></strong></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>De: </b></td><td><? //=$documentos->remitente_nombres?><br><strong><? //=$documentos->remitente_cargo?></strong></td>
		</tr>
		<tr><td><br></td></tr>-->
		

	<?php } ?>
		<tr>
			<td><b>Fecha: </b></td><td><?=date('d/m/Y',strtotime($documentos->fecha));?></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>Referencia: </b></td><td><?=$documentos->referencia?></td>
		</tr>
</table>

<?php } ?>



	<hr>
	<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td>
				<?php if ($documentos->fk_estado_documento==6) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				} else { ?>
				<?=$documentos->contenido?>
				<?php } ?>

			</td>
		</tr>
	</table>
	<br>
	<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td style="font-size: 9px;">
				<i>Adj.<?=$documentos->adjuntos?><br>
				<?=$documentos->copias?><br>
				<?=$documentos->fkUsuario->mosca?></i>
			</td>
		</tr>
	</table>
	<br>

<?php
} else{ 

$row=Seguimientos::getBusquedaDocumentoMYSQL($id);

$nuri=Seguimientos::getObtenerNuriMysql($id);
?>


<br>
<!-- codigo para mostrar la cabereca -->
<table width="40%" align="center" >
	<tr align="center">
		<td><h3><b><?=$row['tipo_documento'] ?></b></h3></td>
	</tr>
	<tr align="center">
		<td><b><?=$row['cite']?></b></td>
	</tr>
	<?php 
		if ($row['tipo_documento']=='CARTA EXTERNA' OR $row['tipo_documento']=='CARTA') {
			?>
			<tr align="center">
			<td><b><?=$row['cite_original']?></b></td>
			</tr>
		<?php }
	?>

	<tr align="center">
		<td><b><?=$nuri?></b></td>
	</tr>

</table>
<hr>

<?php 
if ($row['tipo_documento']=='CARTA EXTERNA' OR $row['tipo_documento']=='CARTA') {

$row_fecha=explode(' ', $row['fecha']);
$row_mes=Documentos::getRowExplode($row_fecha[0],'-');
$name_mes=Documentos::getNameMonth($row_mes[1]);

?>
<br>

<table width="90%" align="center" border="0" id="viewContenido">
<!-- codigo para mostrar al destinatario y via -->
		<tr>
			<td>
				<?=$row_mes[2]." de ".$name_mes." de ".$row_mes[0]?><br>
				<?="<b>".$row['cite']."</b>"?><br>
			</td>
		</tr>
		
</table>
<br><br>
<table width="90%" align="center" border="0" id="viewContenido">
<!-- codigo para mostrar al destinatario y via -->
		<tr>
			<td>
				<?=$row['destinatario_titulo']?><br>
				<?=$row['destinatario_nombres']?><br>
				<b><?=$row['destinatario_cargo']?><br>
				<?=$row['destinatario_institucion']?></b><br><br>
			</td>
		</tr>
		
		<tr>
			<td>
				<b>Referencia: &nbsp;&nbsp;&nbsp;&nbsp;</b><?=$row['referencia']?>
			</td>
		</tr>
</table>




<?php 
}
else { 
?>

<table width="70%" align="center" border="0" id="viewCabecera">
<!-- codigo para mostrar al destinatario y via -->
		<tr>
			<td valign="top" width="13%"><b>A: </b></td>
			<td>
				<?=$row['destinatario_nombres']?><br>
				<b><?=$row['destinatario_cargo']?></b>	
			</td>
		</tr>
		<?php if($row['via_nombres']!=''){ ?>
		<tr><td><br></td></tr>
		<tr>
			<td valign="top" width="13%"><b>V&iacute;a: </b></td>
			<td>
				<?=$row['via_nombres']?><br>
				<b><?=$row['via_cargo']?></b>	
			</td>
		</tr>
		<?php } ?>
		<tr><td><br></td></tr>
		<tr>
			<td valign="top" width="13%"><b>De: </b></td>
			<td>
				<?=$row['remitente_nombres']?><br>
				<b><?=$row['remitente_cargo']?></b>	
			</td>
		</tr>
</table>
<table width="70%" align="center" border="0" id="viewCabecera">
<!-- codigo para mostrar al destinatario y via -->
		<tr>
			<td><b>Fecha: </b></td><td><?=date('d/m/Y',strtotime($row['fecha']));?></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td valign="top"><b>Referencia: &nbsp;&nbsp;&nbsp;&nbsp;</b></td><td><?=$row['referencia']?></td>
		</tr>
</table>
<?php 
}
?>	
<br>


<hr>
<table  width="90%" align="center" border="0" id="viewContenido">
	<tr>
		<td>
			<?=$row['contenido']?>
		</td>
	</tr>
</table>

<br>
<table  width="90%" align="center" border="0" id="viewContenido">
<tr>
	<td style="font-size: 9px;">
		<i>Adj. <?=$row['adjuntos']?> <br>
		<?=$row['mosca']?><br>
		<?=$row['copias']?>
		</i>
	</td>
</tr>
</table>
<br>


<?php } ?>



