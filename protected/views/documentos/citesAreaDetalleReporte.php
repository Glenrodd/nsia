<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimientoses',
);

$tipoDocumento=TipoDocumento::model()->findByPk($tipo_documento);
?>

        <center>
              
                <b><u><?=htmlentities($areas->area)?></u></b> <br>
                <b>(CITES asignados por &Aacute;rea, Unidad, Gerencia, Subgerencia y Gerencia Regional)</b><br>
                <b><?=$tipoDocumento->tipo_documento?></b><br>
                <b>Gesti&oacute;n <?=date('Y')?></b><br>
        </center>


            <br>
            <table cellpadding="5" width="90%" align="center" style="border: solid 0.1pt gray;" >
                      
                      <tr style="background-color: #086A87; color: white;">
                        <th style="font-size:11pt; text-align: center;">
                          NUR/NURI
                        </th>      
                        <th style="font-size:11pt; text-align: center;">
                          CITE
                        </th>
                        <th style="font-size:11pt; text-align: center;">
                          Destinatario Nombres
                        </th>
                        <th style="font-size:11pt; text-align: center;">
                          Referencia
                        </th>
                        <th style="font-size:11pt; text-align: center;">
                          Fecha
                        </th>
                        <th style="font-size:11pt; text-align: center;">
                          Autor
                        </th>
                        <th style="font-size:11pt; text-align: center;">
                          Estado Documento
                        </th>
                      </tr>
                      <!-- CODIGO PARA OBTENER AREAS QUE DEPENDEN DE LA GERENCIA-->
                      <?php $dataReader=Documentos::getCitesArea($areas->id_area, $tipo_documento, $gestion); ?>  
              <?php foreach ($dataReader as $row) { ?>  
                      <tr>
                        <td  style="font-size:11pt;  text-align: center; border: solid 0.1pt gray;" valign="top">
                            <?=Documentos::getObtenerNur($row['id_documento'])?>
                        </td>
                        <td  style="font-size:11pt;  text-align: center; border: solid 0.1pt gray;" valign="top">
                            <?=$row['cite']?>
                        </td>
                        <td  style="font-size:11pt;  text-align: center; border: solid 0.1pt gray;" valign="top" >
                            <?=htmlentities($row['destinatario'])?> - <b><?=htmlentities($row['cargo_destinatario'])?></b>
                        </td>
                        <td  style="font-size:11pt;  text-align: left; border: solid 0.1pt gray;" valign="top" >
                            <?=htmlentities($row['refer'])?>
                        </td> 
                        <td  style="font-size:11pt;  text-align: center; border: solid 0.1pt gray;"  valign="top">
                            <?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_creacion']))?>
                        </td> 
                        <td  style="font-size:11pt;  text-align: center; border: solid 0.1pt gray;" valign="top" >
                            <?=htmlentities($row['autor'])?> - <b><?=htmlentities($row['cargo_autor'])?></b>
                        </td>
                        <td  style="font-size:11pt;  text-align: center; border: solid 0.1pt gray;" valign="top" >
                            <?=$row['estado_doc']?>
                        </td> 
                      </tr>
                      <?php } ?>
                    </table>  
                     <br><br><br><br>