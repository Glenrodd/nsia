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
                        /*margin: 4.5cm 1cm 3cm 1cm;*/

                        margin: 4cm 3cm 3cm 4cm;
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
                        margin-bottom: .0001pt;
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
                <div  id="printsplit1">
                    <div  id="perintbodyContent1" style="font-family:Verdana;">

                        <center>
                            <b style="font-size:14.0pt;"><?=$tipo?></b><br>
                            <b style="font-size:10.0pt;"><?=$documentos->codigo?></b><br>
                            <b style="font-size:10.0pt;"><?php if ($id_hoja_ruta!=0) { echo $hojasruta->nur; } ?></b>
                        </center>

                        <br><br>
                        <span style="font-size: 10.0pt; font-family: Verdana;" ><b>A:</b></span>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <span style="font-size: 10.0pt; font-family: Verdana;" >
                           <?=$documentos->destinatario_nombres; ?><br>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                               <b><?=$documentos->destinatario_cargo; ?></b> 
                        </span>


                        <p></p><br>
                        <span style="font-size: 10.0pt; font-family: Verdana;" ><b>De:</b></span>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 10.0pt; font-family: Verdana;" >
                           <?=$documentos->remitente_nombres; ?><br>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <b><?=$documentos->remitente_cargo; ?></b> 
                        </span>
                        <p></p><br>

                        
                        <span style="font-size: 10.0pt; font-family: Verdana;" ><b>Fecha:</b></span>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 10.0pt; font-family: Verdana;" >
                           <?php
                                $row_mes=Documentos::getRowExplode($documentos->fecha,'-');
                                $name_mes=Documentos::getNameMonth($row_mes[1]);
                                echo $row_mes[2]." de ".$name_mes." de ".$row_mes[0];
                            ?> 
                        </span>
                        <p></p><p></p><p></p>
                        
                        <span style="font-size: 10.0pt; font-family: Verdana;" ><b>Objeto:</b></span>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 10.0pt; font-family: Verdana;" >
                           <b><?=$documentos->referencia; ?></b>
                        </span>

                        <p></p><p><br></p>
                        <span style="font-size: 10.0pt; text-align: justify; " >
                        <?=$documentos->contenido; ?>
                        </span>
                        <p></p><p></p><p></p>
                        <?php if (trim($documentos->adjuntos)!="") { ?>
                            <span style="font-size: 8px;" >
                            Adj.<?=trim($documentos->adjuntos)?>
                            </span><p></p>
                            <?php  }//if () ?>

                        <span style="font-size: 8px;" ><?=rtrim($documentos->fkUsuario->mosca)?></span>
                    
                    </div>    
                </div>

                 <!--<table id="printsplit1">
                  <tbody id="perintbodyContent1" style="font-family:Verdana;">
                   <tr>
                    <td>   
                       



                    </td>
                   </tr>
                  </tbody>
                 </table>-->
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
                                            <table border="0" width="100%" cellpadding="0" cellspacing="0" style="position: absolute;  margin-left:-3cm;" >
                                            <tr>
                                                <td width="100%" align="left" style="position: absolute;">
                                                    <img align="center" src='<?php echo Yii::app()->request->baseUrl; ?>/images/logo_abc3.png' crossOrigin='Anonymous' width="95px" height="110px" style="position:absolute;  margin-left:-3cm;" />
                                                </td>

                                            </tr>
                                        </table>


                                    </p>
                                    <!-- end HEADER-tags -->
                                </div>
                            </td>
                            <td>



                                <div style='mso-element:footer' id=f1 >
                                    <div style="margin-left: -3cm; width: 100%;" >
                                        <div style="font-size: 10px; width: 100%; color: white; background: white;">
                                            <img align="center" src='<?php echo Yii::app()->request->baseUrl;?>/images/pie2.png' crossOrigin='Anonymous' style=" position:absolute;  margin-left:-3cm;">
                                        </div>
                                    </div>
                                </div>
                                <div style='mso-element:footer' id=ff1 style="color: white; background: white; ">
                                    <p class=MsoFooter><span lang=EN-US style='mso-ansi-language:EN-US;'><div></div><o:p></o:p></span></p>
                                </div>



                                <!--<div style='mso-element:footer' id=f1>
                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" style='position: absolute;  margin-left:-3cm;'  >
                                        <tr>
                                            <td>
                                                <img align="center" src='<?php //echo Yii::app()->request->baseUrl;?>/images/pie2.png' crossOrigin='Anonymous' style='position: absolute;  margin-left:-3cm;'  />
                                            </td>
                                            <td width="50%" align="left">
                                                <i style="font-size: 8px;" >Adj.<?=$documentos->adjuntos?></i><br>
                                                <i style="font-size: 9px;" ><b><?=$documentos->fkUsuario->mosca?></b></i>
                                                <label id="lblFormSetNo"></label>
                                            </td>
                                            <td width="50%" align="right">
                                                <p class=MsoFooter style="font-size:10px; ">
                                                    <span style='mso-tab-count:2'></span>
                                                    P&aacute;gina <span style='mso-field-code: PAGE '>
                                                        <span style='mso-no-proof:yes'></span> from <span style='mso-field-code: NUMPAGES '></span>
                                                    </span>
                                                </p>

                                            </td>
                                        </tr>
                                    </table>

                                </div>-->
                                <!--<div style='mso-element:header' id=fh1>
                                    <p class=MsoHeader><span lang=EN-US style='mso-ansi-language:EN-US'>&nbsp;<o:p></o:p></span></p>
                                </div>
                                <div style='mso-element:footer' id=ff1>
                                    <p class=MsoFooter><span lang=EN-US style='mso-ansi-language:EN-US'>&nbsp;<o:p></o:p></span></p>
                                </div>-->

                            </td>
                        </tr>
                    </table> <!-- <table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'> -->
                </div> <!-- <div class="Section1"> -->

            </body>
        </html>
    </div>
</div>
</body>
</html>








  

