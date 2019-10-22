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

<br><br>
<div class="cuerpo" style="font-size: 15px;  font-family: Verdana;">
<!--#####################################################################-->		

<div>
<?php
$row_mes=Documentos::getRowExplode($documentos->fecha,'-');
$name_mes=Documentos::getNameMonth($row_mes[1]);

echo $documentos->fkUsuario->fkRegional->descripcion.", ".$row_mes[2]." de ".$name_mes." de ".$row_mes[0]."<br>"; 
echo "<b>".$documentos->codigo."</b>";
?>
</div>
<br><br><br>
<div>
<?php
echo $documentos->destinatario_titulo."<br>"; 
echo $documentos->destinatario_nombres."<br>"; 
if ($documentos->destinatario_cargo!='null') {
	echo $documentos->destinatario_cargo."<br>"; 
}
echo $documentos->destinatario_institucion."<br>"; 

?>
Presente.-
</div>
<br>

<div>
REF.:<b><u>
<?php
echo $documentos->referencia."<br>"; 
?></u></b>
</div>
<br><br>




<!-- CODIGO PARA MOSTRAR EL CONTENIDO DEL DOCUMENTO-->
<div id="cuerpo_contenido" style="font-size: 15px;  font-family: Verdana;">
<?php

$contenido = str_replace("border-right:solid windowtext 1.0pt;", " ", $documentos->contenido);
$contenido = str_replace("border:solid windowtext 1.0pt;", " ", $contenido);

echo $contenido; 

?>
</div>


<!--#####################################################################-->	
</div>
  

