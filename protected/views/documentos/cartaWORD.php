<head>
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/FileSaver.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.wordexport.js"></script>
    <script>
        jQuery(document).ready(function($) {
            //$("#btnWordExport").click(function (event) {
                   $("#page-content1").wordExport();
            //});

            $("#btnWordExport").click(function (event) {
                   $("#page-content1").wordExport();
            });
        });
    </script>
</head> 
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

if ($id_hoja_ruta!=0) {
    $hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);
}


?>

<!--#####################################################################-->	
<!--#####################################################################-->	
<!--#####################################################################-->	
<!--#####################################################################-->
<!doctype html>
<html>

<body>
    <div class="headerContent no-print">
        <table class='no-print'>
            <tr>
                <td>
                </td>
                <td>
                    <p><input type="button" id="btnWordExport" value="Generar WORD" class='no-print'></p>
                </td>
            </tr>
        </table>
    </div>
    <!-- ------------ HTML Content With Header and Footer in document ------------- -->
    <div>
        <div id="page-content1">
            <html xmlns:v="urn:schemas-microsoft-com:vml"
                  xmlns:o="urn:schemas-microsoft-com:office:office"
                  xmlns:w="urn:schemas-microsoft-com:office:word"
                  xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
                  xmlns="http://www.w3.org/TR/REC-html40">
            <head>
                <meta http-equiv=Content-Type content="text/html; charset=utf-8">
                <title></title>
                <style>
                    v\:* {
                        behavior: url(#default#VML);
                    }

                    o\:* {
                        behavior: url(#default#VML);
                    }

                    w\:* {
                        behavior: url(#default#VML);
                    }

                    .shape {
                        behavior: url(#default#VML);
                    }
                </style>
                <style>
                    @page {
                        mso-page-orientation: portrait;
                        size: 21.59cm 27.94cm;
                        /* mso-page-orientation:portrait;
                    size: 29.7cm 21cm;*/
                     /* margin: arriba derecha abajo izquierda*/
                     /*   margin: 4cm 3cm 4cm 5cm;*/
                        margin: 4cm 3cm 3cm 4cm;
                        font-family: Verdana,Geneva,sans-serif; 
                    }

                    @page Section1 {
                        mso-header-margin: .2in;
                        mso-footer-margin: 1.3in;/* codigo para subir el nuri*/
                        mso-header: h1;
                        mso-footer: f1;
                    }

                    div.Section1 {
                        page: Section1;
                    }

                    table#hrdftrtbl {
                        margin: 0in 0in 0in 900in;
                        width: 1px;
                        height: 1px;
                        overflow: hidden;
                        font-family: Verdana,Geneva,sans-serif; 
                    }


                    p.MsoFooter, li.MsoFooter, div.MsoFooter {
                        margin-left: -3cm;
                        margin-bottom: 56pt; /* codigo para subir el nuri de la carta*/
                        mso-pagination: widow-orphan;
                        tab-stops: center 3.0in right 6.0in;
                        font-size: 12.0pt;
                        font-family: Verdana,Geneva,sans-serif; 
                    }
                    
                    /* codigo para el contenido del documento*/
                    #printsplit1{
                        /*padding-left:4.7cm;
                        padding-right:1.5cm;*/
                    /* margin: arriba derecha abajo izquierda*/
                        /*margin: 1cm 1cm 3cm 3cm;*/ /* margenes para el contenido del documentos*/
                        font-family: Verdana,Geneva,sans-serif; 
                        /*border: 1px;*/
                        width: 100%;
                        font-size: 10.0pt;

                    }
                </style>
                <xml>
                    <w:WordDocument>
                        <w:View>Print</w:View>
                        <w:Zoom>100</w:Zoom>
                        <w:DoNotOptimizeForBrowser />
                    </w:WordDocument>
                </xml>
            </head>

            <body>
                <div class="Section1">
                <div id="printsplit1">
                  <div id="perintbodyContent1" style="font-family:Verdana;">    

                <?php
                        $row_mes=Documentos::getRowExplode($documentos->fecha,'-');
                        $name_mes=Documentos::getNameMonth($row_mes[1]);

                       echo $documentos->fkUsuario->fkRegional->descripcion.", ".$row_mes[2]." de ".$name_mes." de ".$row_mes[0]."<p></p>"; 
                        echo "<b>".$documentos->codigo."</b>";
                        ?>
                        <p></p><br>
                        <p></p><br>
                        <p></p><br>
                        <p></p><br>
                        <span><?php echo $documentos->destinatario_titulo; ?></span><p></p> 

                        <span><?php echo $documentos->destinatario_nombres; ?></span><p></p>
                        
                        
                        <?php if ($documentos->destinatario_cargo!='null' OR $documentos->destinatario_cargo!="") {
                            echo "<span><b>".$documentos->destinatario_cargo."</b></span><p></p>"; 
                        } ?>

                        <?php if ($documentos->destinatario_institucion!='null' OR $documentos->destinatario_institucion!="") {
                            echo "<span><b>".$documentos->destinatario_institucion."</b></span><p></p>"; 
                        } ?>

                        <!--<span><?php //echo "<b>".$documentos->destinatario_institucion."</b>"; ?><p></p>-->
                        Presente.-    
                        
                        <p></p><br><br>
                        <div style="width: 100%">
                         <span>REF.:</span>
                         <span style="display: table; width: 5cm; position: relative;">
                            <b><?php echo $documentos->referencia; ?></b>
                         </span>
                        </div> 
                         <p></p><br>

                        <p style="font-family: Verdana,Geneva,sans-serif; font-size: 10.0pt; text-align: justify; text-justify: inter-word;" align="justify" >
                          <?php 
                            $contenido = str_replace("font-size", " ", $documentos->contenido);
                            $contenido = str_replace("font-family", " ", $contenido);
                          ?>
                          <?=$contenido; ?>
                        </p>

                        <p><br></p><p></p>
                        <center>
                        <?=$documentos->remitente_nombres?><p></p>
                        <b><?=$documentos->remitente_cargo?></b>
                        </center>

                         <br><br><br>
                            <?php if (trim($documentos->adjuntos)!="") { ?>
                            <span style="font-size: 8px;" >
                            Adj.<?=trim($documentos->adjuntos)?>
                            </span><p></p>
                            <?php  }//if () ?>

                            <?php if (trim($documentos->copias)!="") { ?>
                                <span style="font-size: 8px;" >
                                    C.C.<?=trim($documentos->copias)?>
                                </span><p></p>
                            <?php  }//if () ?>
                                
                        
                        <span style="font-size: 8px;" ><?=trim($documentos->fkUsuario->mosca)?></span><p></p>
                </div>            
                </div>            
                   <table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td>
                                <div style='mso-element:header;' id=h1>
                                    <!-- HEADER-tags -->
                                    <p class=MsoHeader>
                                    </p>
                                    <!-- end HEADER-tags -->
                                </div>
                            </td>
                            <td>
                                <div style='mso-element:footer' id=f1 >
                                    <div style="margin-left: -3cm; width: 100%;" >
                                        <div style="font-size: 10px; width: 100%; color: white; background: white;"><?php if ($id_hoja_ruta!=0) { echo "<span style='color:black;'>".$hojasruta->nur."</span>"; } ?></div>
                                    </div>
                                </div>
                                <div style='mso-element:footer' id=ff1 style="color: white; background: white; ">
                                    <p class=MsoFooter><span lang=EN-US style='mso-ansi-language:EN-US;'><div></div><o:p></o:p></span></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

            </body>
        </html>
    </div>
</div>
</body>
</html>








  

