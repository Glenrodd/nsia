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
                        margin: 4.5cm 1cm 3cm 1cm;
                        font-family: Verdana,Geneva,sans-serif; 
                    }

                    @page Section1 {
                        mso-header-margin: .2in;
                        mso-footer-margin: .5in;
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
                        margin: 0in;
                        margin-bottom: 56pt; /* codigo para subir el nuri de la carta*/
                        mso-pagination: widow-orphan;
                        tab-stops: center 3.0in right 6.0in;
                        font-size: 12.0pt;
                        font-family: Verdana,Geneva,sans-serif; 
                    }
                    
                    /* codigo para el contenido del documento*/
                    #printsplit1{
                        padding-left:2.7cm;
                        padding-right:1.5cm;
                        font-family: Verdana,Geneva,sans-serif; 
                        border: 1px;
                        width: 100%;

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
                <p>
                <!-----Export body ------>
                 <table id="printsplit1">
                  <tbody id="perintbodyContent1" style="font-family:Verdana;">
                   <tr>
                    <td>   
                        <div style="font-size: 13px;">
                        <?php
                        $row_mes=Documentos::getRowExplode($documentos->fecha,'-');
                        $name_mes=Documentos::getNameMonth($row_mes[1]);

                        echo $documentos->fkUsuario->fkRegional->descripcion.", ".$row_mes[2]." de ".$name_mes." de ".$row_mes[0]."<br>"; 
                        echo "<b>".$documentos->codigo."</b>";
                        ?>
                        </div>
                        <br><br><br>
                        <div style="font-size: 13px;">
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

                        <div  style="font-size: 13px;">
                        REF.: <b><u><?php echo $documentos->referencia."<br>"; ?></u></b>
                        </div>
                        <br><br>
                        <!-- CODIGO PARA MOSTRAR EL CONTENIDO DEL DOCUMENTO-->
                        <div id="cuerpo_contenido"   style="font-size: 13px; text-align: justify;">
                        <?=$documentos->contenido; ?>
                        </div>
                        <br><br>
                        <div>
                        
                        <i style="font-size: 8px;" >Adj.<?=$documentos->adjuntos?></i><br>
                        <i style="font-size: 8px;" >C.C.<?=$documentos->copias?></i><br>
                        <i style="font-size: 8px;" >C.C.<?=$documentos->fkUsuario->mosca?></i>
                        
                        </div> 
                    </td>
                   </tr>
                  </tbody>
                 </table>
                <!-----End Export body ------>
                </p>
                    <br />
                    <table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td>
                                <div style='mso-element:header;' id=h1>
                                    <!-- HEADER-tags -->
                                    <p class=MsoHeader>

                                        <!--<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #736D6E">-->
                                            <!--<table border="0" width="100%" cellpadding="0" cellspacing="0" style="position: absolute;" >
                                            <tr>
                                                <td width="100%" align="left" style="position: absolute;">
                                                    <img align="center" src='<?php //echo Yii::app()->request->baseUrl; ?>/images/logo_abc3.png' crossOrigin='Anonymous' width="95px" height="110px" style="position:absolute;" />
                                                </td>

                                            </tr>
                                        </table>-->


                                    </p>
                                    <!-- end HEADER-tags -->
                                </div>
                            </td>
                            <td>
                                <div style='mso-element:footer' id=f1>
                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" >
                                        <tr>
                                            <td>
                                                <!--<img align="center" src='<?php //echo Yii::app()->request->baseUrl;?>/images/pie2.png' crossOrigin='Anonymous' />-->
                                            </td>
                                            <td width="50%" align="left" valign="top">
                                                <i style="font-size: 10px;" ><?php if ($id_hoja_ruta!=0) { echo $hojasruta->nur; } ?></i>
                                                <label id="lblFormSetNo"></label>
                                            </td>
                                            <td width="50%" align="right">
                                                <p class=MsoFooter style="font-size:10px; ">
                                                    <span style='mso-tab-count:2'></span>
                                                    
                                                        <!-- end FOOTER-tags -->
                                                    </span>
                                                </p>

                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <!--<div style='mso-element:header' id=fh1>
                                    <p class=MsoHeader><span lang=EN-US style='mso-ansi-language:EN-US'>&nbsp;<o:p></o:p></span></p>
                                </div>-->
                                <!--<div style='mso-element:footer' id=ff1>
                                    <p class=MsoFooter><span lang=EN-US style='mso-ansi-language:EN-US'>&nbsp;<o:p></o:p></span></p>
                                </div>-->

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








  

