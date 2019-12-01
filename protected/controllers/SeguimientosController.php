<?php

class SeguimientosController extends Controller
{


	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','busquedaIndex','derivarDocumento','ajaxEditColumn','addCopiaDigital','eliminarDerivacion','eliminarDerivaciones','viewDocument','documentosLlegar','viewDocumentPendiente','recibirDocumento','pendientesOficiales','derivarDocumentoPendiente','ajaxSendCopyDigital','ajaxDeleteCopyDigital','pendientesDigitales','adminParaAgrupar','addNuriAgrupacion','deleteAgrupacion','viewNurisAgrupados','printCaratulaAgrupacion','changeSeguimiento','adminChangeSeguimiento','ajaxEditProveido','AjaxEditFechaDerivacion','AjaxEditHoraDerivacion', 'AjaxEditFechaRecepcion', 'AjaxEditHoraRecepcion','AdminChangeDerivacion','UpdateSeguimiento','UpdateSeguimientos','AutocompleteUser','adminCorregirDerivacion','updateProveido','reestablecerDerivacion','desarchivoOriginalGestion','administracionArchivoOriginal','desarchivoNuriOriginal','pendientesUsuarioPDF','pendientesUsuarioEXCEL','reportePendientesGeneral','recibirDocumentoBloqueo','documentacionDespachadaPDF','documentacionDespachadaExternaPDF','pendientesArea','recepcionBloque','recibirNuriBloque','viewDocumentSeguimiento','viewDetalleArchivo','busquedaNuriPrincipal','eliminarDerivacionCopia','anadirRespuesta','anadirDocumentoRespuesta','eliminarDocumentoRespuesta','editarDocumentoRespuesta','sendCopyGroup','deleteDerivacion','deleteDerivacionNuevo','sendCopyGroupNew','generarHsInternoPDF','recibirNuri','desagruparNuri','busquedaBloqueo','documentosDerivados','reporteDocumentosDerivadosPDF','documentosAtendidos','documentosLlegarUrgente','adminDigitalesVcd','printBusquedaIndex','adminCartaHistorico','confirmarCopia','pendientesAreaDetalle','pendientesAreaDetalleUser','pendientesAreaDetalleUserReporte','pendientesAreaDetalleUserReporteExcel'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

/*public function gridButtons($model)
{   
    return array(
        'class'=>'CButtonColumn',
        'template'=>'{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => '',
                'click' => '',
                'options' => array(
                    'onclick' => sprintf(
                        'js:removeCity(this, %d, %d);return false;',
                        $model->idCity, $model->idProject
                    ),
                ),                          
            )
        ),
    )
}*/



	public function actionView($id)
	{
		

		$model=new Seguimientos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];

			$model->derivado_por=Yii::app()->user->id_usuario;
			$model->fecha_derivacion=date('Y-m-d');
			$model->hora_derivacion=date('H:i:s');
			$model->fecha_recepcion="1000-01-01";
			$model->hora_recepcion="00:00:00";
			$model->fk_accion=1;
			$model->fk_estado=3;
			$model->oficial=0;
			$model->hijo=0;
			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');
			$model->gestion=date('Y');
			$model->confirmado=1;
			$model->fk_grupo_derivacion=0;
			if($model->save())
				$this->redirect(array('view','id'=>$model->padre));
		}

		$this->render('view',array(
			'seguimiento'=>$this->loadModel($id),
			//'seguimiento'=>Seguimientos::model()->findByPk($id),
			'model'=>$model,
		));

		

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Seguimientos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_seguimiento));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_seguimiento));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	public function actionEliminarDerivacion($id)
	{
		//$this->loadModel($id)->delete();

		$model=$this->loadModel($id);
		//$user = User::model()->findByPk($userId);
		$model->activo =0;
		$model->update();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionEliminarDerivaciones($id)
	{
		//$this->loadModel($id)->delete();

		$model=$this->loadModel($id);
		//$user = User::model()->findByPk($userId);
		$model->activo =0;
		$model->update();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionEliminarDerivacionCopia($id)
	{
		//$this->loadModel($id)->delete();

		$model=$this->loadModel($id);
		//$user = User::model()->findByPk($userId);
		$model->activo =0;
		$id_seguimiento_padre=$model->padre;
		if ($model->update()) {
			$this->redirect(array('view','id'=>$id_seguimiento_padre));
		}

		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($nuri)
	{
		$dataProvider=new CActiveDataProvider('Seguimientos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionBusquedaIndex($nuri)
	{
		$dataProvider=new CActiveDataProvider('Seguimientos');
		/*$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

		$nuri=trim($nuri);
		$this->render('busquedaIndex',array(
			'dataprovider'=>$dataProvider,
			'nuri'=>$nuri,
		));

	}


	public function actionPrintBusquedaIndex($nuri)
	{

		$header='
				<table width="100%" align="center" style="top: 0mm; left:1mm;">
					<tr>
						<td width="30%"><img src="'.Yii::app()->request->baseUrl.'/images/LogoVIASBoliviaSiaco.png" width="55px" height="65px" /></td>
						<td width="40%">
						<center>
							<p align="center" style="font-size: 16px;"><b>REPORTE SEGUIMIENTO</b></p>
						</center>
						</td>
						<td width="30%" align="right"  style="font-size: 10px;">Fecha/Hora de impresi&oacute;n <br> '.date('d/m/Y H:i:s').'</td>
					</tr>
					</tr>
				</table>
				';


		        $mPDF1 = Yii::app()->ePdf->mpdf();
		        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'L-LETTER');
		        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
		        $mPDF1 = Yii::app()->ePdf->mpdf('', 'L-LETTER','','',15,15,30,15);

				$mPDF1->SetHTMLHeader($header);
				$mPDF1->SetFooter('Sistema de Administración de Correspondencia|Página {PAGENO}/{nbpg}|S.A.C.');

				$mPDF1->SetWatermarkText("S.A.C.");
				$mPDF1->showWatermarkText = true;
				$mPDF1->watermark_font = 'DejaVuSansCondensed';
				$mPDF1->watermarkTextAlpha = 0.1;
				$mPDF1->SetDisplayMode('fullpage');
		       
		        $mPDF1->WriteHTML($this->renderPartial('busquedaIndexPDF', array('nuri'=>$nuri), true));

		        //$mPDF1->Output('I');
		        //$mPDF1->Output('Reporte Seguimiento.pdf',EYiiPdf::OUTPUT_TO_BROWSER);
		        $mPDF1->Output('Reporte Seguimiento.pdf', 'I');
				exit; 
	}

	public function actionRecibirNuri($nuri)
	{


		$this->render('recibirNuri',array(
			'nuri'=>strtoupper($nuri),
		));
	}

	public function actionBusquedaNuriPrincipal($nuri)
	{
		$this->renderPartial('busquedaNuriPrincipal',array(
			'nuri'=>$nuri,
		));
	}


	public function actionBusquedaBloqueo($nuri)
	{
		$this->renderPartial('bloqueoSeguimiento',array(
			'nuri'=>$nuri,
		));
	}


	public function actionDocumentosDerivados()
	{
		$model=new Seguimientos;

		$this->render('documentosDerivados',array(
			'model'=>$model,
			'usuario'=>Yii::app()->user->id_usuario,
		));
	}

	public function actionDocumentosAtendidos()
	{

		$content=$this->renderPartial("documentosAtendidos", array('id_usuario'=>Yii::app()->user->id_usuario,),true);
		Yii::app()->request->sendFile("Documentacion Atendida.xls",$content);

		/*$this->render('documentosAtendidos',array(
			'id_usuario'=>Yii::app()->user->id_usuario,
		));*/
	}


	

	public function actionReporteDocumentosDerivadosPDF()
	{
		// I want a post	
		  if(Yii::app()->request->isPostRequest)
		  {
		    // parse $_POST variables
		    //print_r($_POST["Seguimientos"]);
		    //exit();



				/*header("Content-type: application/vnd.ms-excel");
 				header("Content-Disposition: attachment;Filename=Doc_despacahados.xls");

				$this->renderPartial('reporteDerivadosPDF',array(
					'seguimientos'=>$_POST["Seguimientos"],
				));*/



				$header='
				<table width="100%" align="center" style="top: 0mm; left:1mm;">
					<tr>
						<td width="30%"><img src="'.Yii::app()->request->baseUrl.'/images/logo_abc3.png" width="25px" height="25px" /></td>
						<td width="40%">
						<center>
							<p align="center" style="font-size: 11px;"><b>DOCUMENTACI&Oacute;N DESPACHADA</b></p>
						</center>
						</td>
						<td width="30%" align="center"></td>
					</tr>
					</tr>
				</table>
				';


		        $mPDF1 = Yii::app()->ePdf->mpdf();
		        $mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER');

				$mPDF1->SetHTMLHeader($header);
				$mPDF1->SetFooter('Sistema de Administración de Correspondencia|Página {PAGENO}/{nbpg}|S.A.C.');

				$mPDF1->SetWatermarkText("SAC");
				$mPDF1->showWatermarkText = true;
				$mPDF1->watermark_font = 'DejaVuSansCondensed';
				$mPDF1->watermarkTextAlpha = 0.1;
				$mPDF1->SetDisplayMode('fullpage');
		       
		        $mPDF1->WriteHTML($this->renderPartial('reporteDerivadosPDF', array('seguimientos'=>$_POST["Seguimientos"]), true));
		        $mPDF1->Output('Reporte Derivados.pdf','I');
				exit; 
	 

		  }	
		  else
		    throw new CHttpException(400,"Invalid request. Please do not repeat this request again.");


		exit();
	}


	public function actionAddCopiaDigital($id_documento, $id_hoja_ruta)
	{
		$documentos=Documentos::model()->findByPk($id_documento);
		$hojasRuta=HojasRuta::model()->findByPk($id_hoja_ruta);

		// verifica si existe el usuario destino

		if ($documentos->usuario_destino==0) {
			
			/*$tipoDocumento=TipoDocumento::model()->findByPk($documentos->fk_tipo_documento);*/

			switch ($documentos->fk_tipo_documento) {
					    case 1:
					        $direccion='documentos/updateInforme';
					        break;
					    case 2:
					        $direccion='documentos/updateNota';
					        break;
					    case 3:
					        $direccion='documentos/updateMemorandum';
					        break;
					    case 4:
					        $direccion='documentos/updateCarta';
					        break;
					    case 5:
					        $direccion='documentos/updateCircular';
					        break;
					    case 8:
					        $direccion='documentos/updateInstructivo';
					        break;            
					}
			//$documentos->validate();	
			Yii::app()->user->setFlash('error', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente'></i><br> Es necesario seleccionar al menos un destinatario de la lista.");	
			$this->redirect(array($direccion,'id'=>$documentos->id_documento,'tipo'=>$documentos->fk_tipo_documento));		
		}

		/*
		//codigo para enviar una copia digitas en caso de 
		//enviar el documento a una gerencia regional
		$usuarios=Usuarios::model()->findByPk($documentos->usuario_destino);

		if ($usuarios->fk_nivel==3) {

		// codigo para almacenar una copia del informe a ventanilla Unica
			Seguimientos::saveCopiaDigital($hojasRuta->nur);
		}//if ($usuarios->fk_nivel==3) {
		//codigo para circulares
		if ($documentos->fk_tipo_documento==5) {
			// codigo para derivar  copia digital a ventanilla unica
			Seguimientos::saveCopiaDigital($hojasRuta->nur);
			// codigo para enviar una copia a los intengrantes del grupo 
			Seguimientos::saveCopiaDigitalGroup($hojasRuta->nur,$documentos->grupo_destino);
		}//if ($documentos->fk_tipo_documento==5) {
			*/


		$this->redirect(array('derivarDocumento','id_documento'=>$id_documento,'id_hoja_ruta'=>$id_hoja_ruta));


	}


	public function actionGenerarHsInternoPDF($id_documento,$id_hoja_ruta)
	{
		//$documentos=$this->loadModel($id_documento);
		$documentos=Documentos::model()->findByPk($id_hoja_ruta);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

       /* $this->render('hsInternoPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));*/

        $mPDF1 = Yii::app()->ePdf->mpdf();

        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',8,8,10,12);
		
        //$mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');
        $mPDF1->SetFooter('Original |'.$hojasruta->nur.' |SAC');

		//$mPDF1->SetHTMLHeader($header);
		//$mPDF1->SetHTMLFooter($footer);



        $mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

		//$mPDF1->SetWatermarkImage(Yii::app()->request->baseUrl.'/images/hojas_apiladas.jpg', 1, '', array(110,10));
		//$mPDF1->showWatermarkImage = true;


        $mPDF1->WriteHTML($this->renderPartial('hsInternoPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('HS.pdf','D');
		//exit;  

		$this->redirect(array('site/menuDocumentos'));
		
	}


	public function actionDerivarDocumento($id_documento, $id_hoja_ruta)
	{
		$model=new Seguimientos;
		$documentos=Documentos::model()->findByPk($id_documento);
		$hojasRuta=HojasRuta::model()->findByPk($id_hoja_ruta);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];
			$derivado_a=$_POST['Seguimientos']['derivado_a'];


			if(isset($_POST['original']))
	        {
		        $oficial=1;
		        $numero_copia=0;
		        $correlativo_copia=0;
		        $numero=0;
	        }

		    if(isset($_POST['copia']))
	        {
		        $oficial=0;
		        /*$numero=Seguimientos::numeroCopiaSeguimiento($id_seguimiento);
		        $numero_copia=$seguimientos->numero_copia.".".$numero;*/

		        $numero=Seguimientos::numeroCopiaNuevoDocumento($hojasRuta->nur);
				$numero_copia=$numero;	
				$correlativo_copia=$numero;
			}			
	        if(isset($_POST['terminar']))
	        {
	        	$oficial=1;

		        if (Seguimientos::countSeguimientoNuevo($hojasRuta->nur)==1) {

					Seguimientos::updateConfirmarTerminarNuevo($hojasRuta->nur);

					//Yii::import('application.controllers.DocumentosController'); 
    				//$obj =new DocumentosController(); // preparing object 
    				//echo $obj->generarHsInternoPDF($id_documento, $id_hoja_ruta); exit;
    				//DocumentosController::generarHsInternoPDF($id_documento, $id_hoja_ruta); //exit; // calling method of CservicesController 
    				

    				//header( location: chiapa.php )
    				/*header("Location:index.php?r=documentos/generarHsInternoPDF&id_documento=<?=$hojasRuta->fk_documento?>&id_hoja_ruta=<?=$hojasRuta->id_hoja_ruta?>");  */

    //###########################################################
    	/*$documentos=Documentos::model()->findByPk($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',8,8,10,12);
        $mPDF1->SetFooter('Original |'.$hojasruta->nur.' |S.A.C.');
        $mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');
        $mPDF1->WriteHTML($this->renderPartial('hsInternoPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('HS.pdf','D');*/
        //exit();
    //###########################################################
		$this->redirect(array('site/menuDocumentos'));



				//###############################################################
		        }
		        else{
		        	Seguimientos::mensajeVerificarOficial($hojasRuta->nur);
		        	$this->redirect(array('derivarDocumento','id_documento'=>$id_documento,'id_hoja_ruta'=>$id_hoja_ruta));
		        }
	        }

			if ($derivado_a=='') {
				$model->derivado_a=$documentos->usuario_destino;	
			}
			$model->fecha_derivacion=date('Y-m-d');
			$model->hora_derivacion=date('H:i:s');
			$model->fecha_recepcion="1000-01-01";
			$model->hora_recepcion="00:00:00";
			$model->proveido=strtoupper($model->proveido);
			$model->oficial=$oficial;
			$model->hijo=0;
			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');
			$model->gestion=date('Y');
			$model->confirmado=0;

			$model->padre=0;
			$model->numero_copia=$numero_copia;
			$model->correlativo_copia=$correlativo_copia;
			$model->observado=0;
			$model->accion_archivo='null';


				if($model->save()){
					//$this->redirect(array('view','id'=>$model->id_seguimiento));
					$this->redirect(array('derivarDocumento','id_documento'=>$id_documento,'id_hoja_ruta'=>$id_hoja_ruta));
				}
		} //if(isset($_POST['Seguimientos']))

		
		$this->render('derivarDocumento',array(
			'model'=>$model,
			'documentos'=>$documentos,
			'hojasRuta'=>$hojasRuta,
		));
		


	}


	public function actionDerivarDocumentoPendiente($id_seguimiento)
	{

		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajePendienteDerivacion();		
			$this->redirect(array('seguimientos/pendientesOficiales'));
		}
		//################################################

		//$model=new Seguimientos;
		$model=new Seguimientos;
		$seguimientos=Seguimientos::model()->findByPk($id_seguimiento);
		//$hojasRuta=HojasRuta::model()->findByPk($id_hoja_ruta);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{

			if(isset($_POST['original']))
	        {
		        $oficial=1;
		        $numero_copia=0;
		        $correlativo_copia=0;
		        $numero=0;
	        }

		    if(isset($_POST['copia']))
	        {
		        $oficial=0;
		        /*$numero=Seguimientos::numeroCopiaSeguimiento($id_seguimiento);
		        $numero_copia=$seguimientos->numero_copia.".".$numero;*/


		        if($seguimientos->oficial==1){
					$numero_copia=Seguimientos::numeroCopiaSeguimiento($id_seguimiento);
					$correlativo_copia=$numero_copia;
					//$correlativo_copia=$numero_copia;

					//echo "----> ". $numero_copia;
			
				}
				else{
					// primero verificamos si existe una derivacion de la copia 
					// y si no existe primero derivamos la que esta en los pendientes
					// luego derivamos las ramificaciones
					if(Seguimientos::countSeguimientoCopia($seguimientos->codigo,$seguimientos->id_seguimiento)==0){
						
						$numero_copia=$seguimientos->numero_copia;
						$correlativo_copia=0;
						//$correlativo_copia=$seguimientos->correlativo_copia;
					}
					else{
						$numero=Seguimientos::numeroCopiaSeguimiento($id_seguimiento);
						$numero_copia=$seguimientos->numero_copia.".".$numero;	
						$correlativo_copia=$numero;	
					}
				} //if($seguimientos->oficial==1){ 


	        }

	        if(isset($_POST['terminar']))
	        {	
	        	// por si es documento original
	        	if (Seguimientos::countSeguimientoPadre($seguimientos->codigo,$seguimientos->id_seguimiento)==1) {

					//codigo para actualizar el documento actual y cambiarlo de estado
						$sguimientos=$this->loadModel($id_seguimiento);
						$update=$this->loadModel($id_seguimiento);
						$update->fk_estado=4;
						
						if ($update->update()) {
							
							Seguimientos::updateConfirmEnd($sguimientos->codigo,$sguimientos->id_seguimiento);
							$this->redirect(array('pendientesOficiales'));

						} //if ($update->update()) {

					//###############################################################
		        }
		        else{

		        	// en caso de ser copia solo confirmamos y salimos
		        	if ($seguimientos->oficial==0) {

		        		// verificar si se derivo al menos una copia de las copias
		        		//echo "entro en el if";
		        		//exit;

						$sguimientos=$this->loadModel($id_seguimiento);

		        		if (Seguimientos::countSeguimientoCopia($sguimientos->codigo,$sguimientos->id_seguimiento)>0) {
		        			
			        		//codigo para actualizar el documento actual y cambiarlo de estado
							$update=$this->loadModel($id_seguimiento);
							$update->fk_estado=4;
							
							if ($update->update()) {
								
								Seguimientos::updateConfirmEnd($sguimientos->codigo,$sguimientos->id_seguimiento);
								$this->redirect(array('pendientesDigitales'));

							} //if ($update->update()) {
		        			
		        		}
		        		else{

		        			Seguimientos::mensajeVerificarCopia($seguimientos->codigo);
		        			$this->redirect(array('derivarDocumentoPendiente','id_seguimiento'=>$seguimientos->id_seguimiento));

		        		}

		        		
		        	}
		        	else{
		        		
		        	Seguimientos::mensajeVerificarOficial($seguimientos->codigo);
		        	$this->redirect(array('derivarDocumentoPendiente','id_seguimiento'=>$seguimientos->id_seguimiento));
		        	}

		        }
	        }
			//###############################################################


			$model->attributes=$_POST['Seguimientos'];

			$model->fecha_derivacion=date('Y-m-d');
			$model->hora_derivacion=date('H:i:s');
			$model->fecha_recepcion="1000-01-01";
			$model->hora_recepcion="00:00:00";

			$model->proveido=strtoupper($model->proveido);

			//$model->padre=0;
			$model->oficial=$oficial;
			$model->hijo=0;
			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');
			$model->gestion=date('Y');
			$model->confirmado=0;
			$model->numero_copia=$numero_copia;
			$model->correlativo_copia=$correlativo_copia;
			$model->observado=0;
			$model->accion_archivo='null';

			$id_seguim=Seguimientos::getMaxIdSeguimiento();

			$model->id_seguimiento=$id_seguim;

			
			if($model->save()){
				$this->redirect(array('derivarDocumentoPendiente','id_seguimiento'=>$id_seguimiento));
			}
		}

		$this->render('derivarDocumentoPendiente',array(
			'model'=>$model,
			'seguimientos'=>$seguimientos,
		));
	}

	public function actionAjaxSendCopyDigital($id, $oficial){

		$model=new Seguimientos;

		$seguimientos=$this->loadModel($id);

		if(isset($_POST['Seguimientos']))
		{
			


			$model->attributes=$_POST['Seguimientos'];

			$model->proveido=$_POST['Seguimientos']['proveido'];
			$model->fk_accion=$_POST['Seguimientos']['fk_accion'];
			$model->codigo=$_POST['Seguimientos']['codigo'];
			$model->derivado_por=$_POST['Seguimientos']['derivado_por'];
			$model->derivado_a=$_POST['Seguimientos']['derivado_a'];
			$model->fk_estado=$_POST['Seguimientos']['fk_estado'];
			$model->padre=$_POST['Seguimientos']['padre'];

			$model->fecha_derivacion=date('Y-m-d');
			$model->hora_derivacion=date('H:i:s');
			$model->fecha_recepcion="1000-01-01";
			$model->hora_recepcion="00:00:00";
			$model->gestion=date('Y');

			//$model->padre=0;
			$model->hijo=0;
			$model->oficial=$oficial;
			$model->confirmado=0;
			$model->activo=1;

			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');

			if($model->validate())
            {
				if($model->save()){
					// se renberiza cuando todo salio bien y se almaceno la info
					$this->renderPartial('_ajaxDerivadoDigital', array( 
       				'seguimientos' => $seguimientos,
        			));
				}

			}//if($model->validate())
			else{


				//en caso de ocurrir un error en el registro de datos se nuestra lo siguiente
				// el codigo nos devuelve un objeto json cono resultado de las validaciones
				//se almacenan en un array $error
				//decodificamos ese array con json_decode 
				// para ver el error solo descomentamos //echo $error;
				 $error = CActiveForm::validate($model);
                if($error!='[]')
                    //echo $error; 
                    echo "<p style='color:red; font-size:20px;'>Por favor complete los datos del formulario</p>";

                	/*// cada  campo de validacion como proveido es un array de arrays
                	// para ver  el arary de arrays descomentamos //print_r($myArray); 
					$myArray = json_decode($error, true);
					//print_r($myArray); 
                	
                	// tenemos que ingresar al array interno para acceder al mensaje de validacion por eso  usamos print_r
					echo "<b>"; print_r($myArray['Seguimientos_proveido'][0]); echo "</b><br>";
					echo "<b>"; print_r($myArray['Seguimientos_derivado_a'][0]); echo "</b><br>";
					//echo "<b>"; print_r($myArray['Seguimientos_fk_accion'][0]); echo "</b><br>";*/

					// se renderiza en caso de no pasar por la valildacion
					$this->renderPartial('_ajaxDerivadoDigital',array(
					'seguimientos'=>$seguimientos,
					));
			}
				
		}
		else{
			// se renderiza en caso de no enviar datos o cuando es la primera vez que se muestra
			$this->renderPartial('_ajaxDerivadoDigital',array(
				'seguimientos'=>$seguimientos,
			));
			
		}



	}

	public function actionSendCopyGroup($id_grupo, $id_seguimiento){

		$model=new Seguimientos;
		$grupos= GrupoDerivacion::model()->findByPk($id_grupo);
		$seguimientos= Seguimientos::model()->findByPk($id_seguimiento);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];

			$id_grupo_derivacion=$_POST['Seguimientos']['fk_grupo_derivacion'];
			$codigo=$_POST['Seguimientos']['codigo'];
			$padre=$_POST['Seguimientos']['padre'];
			$proveido=$_POST['Seguimientos']['proveido'];
			//$=$_POST['Seguimientos'][''];

			// codigo para enviar copias digitales a los integrantes del grupo
			$dataReader=Seguimientos::getListIntegrantesGrupo($id_grupo_derivacion);

			foreach ($dataReader as $row) { 	
				$id_usuario=$row['usuario_origen'];

				$envio=new Seguimientos;

				$envio->id_seguimiento = null;
				$envio->codigo=$codigo;
				$envio->derivado_por=Yii::app()->user->id_usuario;
				$envio->derivado_a=$id_usuario;
				$envio->proveido=strtoupper($proveido);
				$envio->fecha_derivacion=date('Y-m-d');
				$envio->hora_derivacion=date('H:i:s');
				$envio->fecha_recepcion="1000-01-01";
				$envio->hora_recepcion="00:00:00";
				$envio->fk_accion=1;
				$envio->fk_estado=3;
				$envio->padre=$padre;
				$envio->oficial=0;
				$envio->hijo=0;
				$envio->fecha_registro=date('Y-m-d');
				$envio->hora_registro=date('H:i:s');
				$envio->gestion=date('Y');
				$envio->confirmado=0;
				$envio->activo=1;
				$envio->fk_grupo_derivacion=$id_grupo_derivacion;
				$envio->fk_principal_agrupacion=0;

				if($seguimientos->oficial==1){
					$envio->numero_copia=Seguimientos::numeroCopiaSeguimiento($id_seguimiento);
					$envio->correlativo_copia=$envio->numero_copia;
				}
				else{
					$numero=Seguimientos::numeroCopiaSeguimiento($id_seguimiento);
					
					$envio->numero_copia=$seguimientos->numero_copia.".".$numero;	
					$envio->correlativo_copia=$numero;	
				}

				$envio->observado=0;
				$envio->accion_archivo='null';
				$envio->isNewRecord = true;
				$envio->save();

			}


			//if($model->save())
				//----- begin new code --------------------
				if (!empty($_GET['asDialog']))
				{
					//Close the dialog, reset the iframe and update the grid
					echo CHtml::script("window.parent.location.reload();window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
					Yii::app()->end();
				}
				else
				//----- end new code --------------------
					
				$this->redirect(array('view','id'=>$model->ADDRESS));
		}

		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->renderPartial('sendCopyGroup',array(
			'model'=>$model,
			'grupos'=>$grupos,
			'seguimientos'=>$seguimientos,
		));

	}


	public function actionSendCopyGroupNew($id_grupo, $id_hoja_ruta){

		$model=new Seguimientos;
		$grupos= GrupoDerivacion::model()->findByPk($id_grupo);
		$hojasRuta= HojasRuta::model()->findByPk($id_hoja_ruta);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];

			$id_grupo_derivacion=$_POST['Seguimientos']['fk_grupo_derivacion'];
			$codigo=$_POST['Seguimientos']['codigo'];
			$padre=$_POST['Seguimientos']['padre'];
			$proveido=$_POST['Seguimientos']['proveido'];
			//$=$_POST['Seguimientos'][''];

			// codigo para enviar copias digitales a los integrantes del grupo
			$dataReader=Seguimientos::getListIntegrantesGrupo($id_grupo_derivacion);

			foreach ($dataReader as $row) { 	
				$id_usuario=$row['usuario_origen'];

				$envio=new Seguimientos;

				$envio->id_seguimiento = null;
				$envio->codigo=$codigo;
				$envio->derivado_por=Yii::app()->user->id_usuario;
				$envio->derivado_a=$id_usuario;
				$envio->proveido=strtoupper($proveido);
				$envio->fecha_derivacion=date('Y-m-d');
				$envio->hora_derivacion=date('H:i:s');
				$envio->fecha_recepcion="1000-01-01";
				$envio->hora_recepcion="00:00:00";
				$envio->fk_accion=1;
				$envio->fk_estado=3;
				$envio->padre=$padre;
				$envio->oficial=0;
				$envio->hijo=0;
				$envio->fecha_registro=date('Y-m-d');
				$envio->hora_registro=date('H:i:s');
				$envio->gestion=date('Y');
				$envio->confirmado=0;
				$envio->activo=1;
				$envio->fk_grupo_derivacion=$id_grupo_derivacion;
				$envio->fk_principal_agrupacion=0;

				
				$numero=Seguimientos::numeroCopiaNuevoDocumento($hojasRuta->nur);
				$envio->numero_copia=$numero;	
				$envio->correlativo_copia=$numero;	
				
				$envio->observado=0;
				$envio->accion_archivo='null';
				$envio->isNewRecord = true;
				$envio->save();

			}


			//if($model->save())
				//----- begin new code --------------------
				if (!empty($_GET['asDialog']))
				{
					//Close the dialog, reset the iframe and update the grid
					echo CHtml::script("window.parent.location.reload(); window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}'); 

						");
					Yii::app()->end();
				}
				else
				//----- end new code --------------------
					
				$this->redirect(array('view','id'=>$model->ADDRESS));
		}

		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->renderPartial('sendCopyGroupNew',array(
			'model'=>$model,
			'grupos'=>$grupos,
			'hojasRuta'=>$hojasRuta,
		));

	}

	public function actionDeleteDerivacion($id_seguimiento){

		$model=$this->loadModel($id_seguimiento);
		//$user = User::model()->findByPk($userId);
		$id=$model->padre;
		$model->activo =0;

		if($model->update()){

				$seguimientos=$this->loadModel($id);
				$this->redirect(array('derivarDocumentoPendiente','id_seguimiento'=>$seguimientos->id_seguimiento));
		}		
	} //confirmarCopia


	public function actionConfirmarCopia($id_seguimiento){

		$model=$this->loadModel($id_seguimiento);
		//$user = User::model()->findByPk($userId);
		$id=$model->padre;
		$model->confirmado=1;

		if($model->update()){

				$seguimientos=$this->loadModel($id);
				$this->redirect(array('derivarDocumentoPendiente','id_seguimiento'=>$seguimientos->id_seguimiento));
		}		
	} //confirmarCopia


	public function actionDeleteDerivacionNuevo($id_seguimiento,$id_hoja_ruta,$id_documento){

		$model=$this->loadModel($id_seguimiento);
		$model->activo=0;

		if($model->update()){
			//$this->redirect(array('derivarDocumento','id_documento'=>$id_documento,'id_hoja_ruta'=>$id_hoja_ruta));
			$this->redirect(array('derivarDocumento','id_documento'=>$id_documento,'id_hoja_ruta'=>$id_hoja_ruta));
		}		
	}



	public function actionAjaxDeleteCopyDigital(){


		/*$connection= Yii::app()->db;
		if(Yii::app()->request->isAjaxRequest)
    	{
    		$model=$this->loadModel($id);
			$update=$connection->createCommand()->
                update("seguimientos",array(
                   "activo"=>0
                ),"id_seguimiento=$id");
                
			$id_seguimiento=$model->padre;
			$seguimientos=$this->loadModel($id_seguimiento);
        	
		echo '----->'.$id;

        $this->renderPartial("_ajaxDerivadoDigital",array('seguimientos'=>$seguimientos),false,true);
        	Yii::app()->end();

		

    	}*/

		$id = $_GET['id'];

		$model=$this->loadModel($id);
		//$user = User::model()->findByPk($userId);
		$id_seguimiento=$model->padre;
		$model->activo =0;
		$model->update();


		$seguimientos=$this->loadModel($id_seguimiento);
		//echo '----->'.$id;

		/*if($model->update())
				$this->redirect(array('derivarDocumentoPendiente','id_seguimiento'=>$id_seguimiento));*/

		$this->renderPartial('_ajaxDerivadoDigital', array( 
       				'seguimientos' => $seguimientos,
        			));

		

	}


	public function actionAddNuriAgrupacion($id_principal,$nuri_p,$id_hijo,$nuri_h,$oficial){

		$model=new Agrupaciones();
		$model->nur_padre=$nuri_p;
		$model->nur_hijo=$nuri_h;
		$model->oficial=$oficial;
		$model->fk_seguimiento_padre=$id_principal;
		$model->fk_seguimiento_hijo=$id_hijo;
		$model->fk_usuario=Yii::app()->user->id_usuario;
		$model->fecha_registro=date('Y-m-d');
		$model->hora_registro=date('H:i:s');
		//$model->

		if ($model->save()) {

			$seguimientos=$this->loadModel($id_hijo);
			$seguimientos->fk_estado=7;
			$seguimientos->hijo=$nuri_p;
			$seguimientos->fk_principal_agrupacion=$id_principal;
			
			if($seguimientos->update()){
				$this->redirect(array('adminParaAgrupar','id_seguimiento'=>$id_principal,'nuri'=>$nuri_p));
			}
		}

	}

	public function actionDeleteAgrupacion($id_agrupacion)
	{
		//$model=$this->loadModel($id);
		$model= Agrupaciones::model()->findByPk($id_agrupacion);

		//$id_seguimiento=$model->padre;
		$nuri=$model->nur_padre;
		$id_seguimiento=$model->fk_seguimiento_padre;
		$id_seguimiento_hijo=$model->fk_seguimiento_hijo;

		$model->activo =0;
		//$model->update();
		if($model->update()){

				// codigo para restaurar a un estado anterior el nuri hijo
				$seguimientos= Seguimientos::model()->findByPk($id_seguimiento_hijo);
				$seguimientos->hijo=0;
				$seguimientos->fk_principal_agrupacion=0;
				if ($seguimientos->oficial==1) {
					$seguimientos->fk_estado=1;
				}
				else{
					$seguimientos->fk_estado=2;	
				}

				if ($seguimientos->update()) {
					
					$this->redirect(array('adminParaAgrupar','id_seguimiento'=>$id_seguimiento,'nuri'=>$nuri));
				}



			}

	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminDigitalesVcd()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('adminDigitalesVcd',array(
			'model'=>$model,
		));
	}


	public function actionAdminParaAgrupar($id_seguimiento,$nuri)
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('adminParaAgrupar',array(
			'model'=>$model,
			'id_seguimiento'=>$id_seguimiento,
			'nuri'=>$nuri,
		));
	}

	public function actionDocumentosLlegar()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('documentosLlegar',array(
			'model'=>$model,
		));
	}

	public function actionDocumentosLlegarUrgente()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('documentosLlegarUrgente',array(
			'model'=>$model,
		));
	}

	public function actionPendientesOficiales()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('pendientesOficiales',array(
			'model'=>$model,

		));
	}

	public function actionDesagruparNuri()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('desagruparNuri',array(
			'model'=>$model,

		));
	}


	public function actionPendientesDigitales()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('pendientesDigitales',array(
			'model'=>$model,
		));
	}

	public function actionRecibirDocumento($id_seguimiento)
	{

		$model=$this->loadModel($id_seguimiento);

		if ($model->oficial==1) {
				$model->fk_estado=1;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
		}
		else{
			if ($model->oficial==0) {
				$model->fk_estado=2;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
			}
			else{
				$model->fk_estado=3;
				$model->confirmado=1;
				echo "Error de recepción por favor consulte con el administrador";	
			}		
		}

		
		//$user = User::model()->findByPk($userId);
		$model->update();

		$this->redirect(array('documentosLlegar'));



		/*$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('documentosLlegar',array(
			'model'=>$model,
		));*/
	}


	public function actionRecibirDocumentoBloqueo($id_seguimiento)
	{

		$model=$this->loadModel($id_seguimiento);

		//echo "--------->".$model->oficial;
		//exit();

		if ($model->oficial==1) {
				$model->fk_estado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
		}
		else{
			if ($model->oficial==0) {
				$model->fk_estado=2;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
			}
			else{
				$model->fk_estado=3;
				echo "Error de recepción por favor consulte con el administrador";	
			}		
		}

		
		//$user = User::model()->findByPk($userId);
		$model->update();

		$this->redirect(array('site/index'));
	}





// codigo para editar en linea AJAX
	public function actionAjaxEditColumn(){
        $keyvalue   = $_POST["keyvalue"];   // ie: 'userid123'
        $name       = $_POST["name"];   // ie: 'firstname'
        $old_value  = $_POST["old_value"];  // ie: 'patricia'
        $new_value  = $_POST["new_value"];  // ie: '  paTTy '


        $model=$this->loadModel($keyvalue);

        if ($model->fk_grupo_derivacion==0) {
        	
	        // do some stuff here, and return the value to be displayed..
	        $new_value = ucfirst(trim($new_value));
	        // codigo para modificar el valor de la tabla
	        $connection= Yii::app()->db;
			//consulta para actualizar el campo cantidad_aprobada en la tabla detalle_solicitudes
			$sql_update="UPDATE seguimientos 
			SET proveido='$new_value'
			WHERE id_seguimiento='$keyvalue'
			";
			$command_update=$connection->createCommand($sql_update);
			$command_update->execute();
			//header("Refresh:0");	
        }
        else{

        	$connection= Yii::app()->db;
	 		$dataReader=$connection->createCommand("SELECT id_seguimiento 
		 			FROM seguimientos
		 			WHERE fk_grupo_derivacion=$model->fk_grupo_derivacion AND activo=1 ORDER BY id_seguimiento ASC ")->query();

	 		foreach($dataReader as $row) {

	 			$seguimiento=$this->loadModel($row['id_seguimiento']);
		//$user = User::model()->findByPk($userId);
				$seguimiento->proveido =$new_value;
				$seguimiento->update();
	 		}

        }
 
        // es importante agregar la siguiente linea de codigo
        // para mostrar el resultado en pantalla
        echo $new_value;
		//echo"<script>location.reload();</script>";
    }

    public function actionAjaxEditProveido(){
        $keyvalue   = $_POST["keyvalue"];   // ie: 'userid123'
        $name       = $_POST["name"];   // ie: 'firstname'
        $old_value  = $_POST["old_value"];  // ie: 'patricia'
        $new_value  = $_POST["new_value"];  // ie: '  paTTy '
        $new_value = ucfirst(trim($new_value));
        $model=$this->loadModel($keyvalue);
        $model->proveido=$new_value;
        $model->update();
        /*$connection= Yii::app()->db;
		$sql_update="UPDATE seguimientos 
		SET proveido='$new_value'
		WHERE id_seguimiento='$keyvalue'
		";
		$command=$connection->createCommand($sql_update);
		$command->execute();*/
        // es importante agregar la siguiente linea de codigo
        // para mostrar el resultado en pantalla
        echo $new_value;
		//echo"<script>location.reload();</script>";
    }
    public function actionAjaxEditFechaDerivacion(){
        $keyvalue   = $_POST["keyvalue"];   // ie: 'userid123'
        $name       = $_POST["name"];   // ie: 'firstname'
        $old_value  = $_POST["old_value"];  // ie: 'patricia'
        $new_value  = $_POST["new_value"];  // ie: '  paTTy '
        $new_value = ucfirst(trim($new_value));

        $model=$this->loadModel($keyvalue);
        $model->fecha_derivacion=$new_value;
        $model->update();
        // es importante agregar la siguiente linea de codigo
        // para mostrar el resultado en pantalla
        echo $new_value;
		//echo"<script>location.reload();</script>";
    }
    public function actionAjaxEditHoraDerivacion(){
        $keyvalue   = $_POST["keyvalue"];   // ie: 'userid123'
        $name       = $_POST["name"];   // ie: 'firstname'
        $old_value  = $_POST["old_value"];  // ie: 'patricia'
        $new_value  = $_POST["new_value"];  // ie: '  paTTy '
        $new_value = ucfirst(trim($new_value));

        $model=$this->loadModel($keyvalue);
        $model->hora_derivacion=$new_value;
        $model->update();
        // es importante agregar la siguiente linea de codigo
        // para mostrar el resultado en pantalla
        echo $new_value;
		//echo"<script>location.reload();</script>";
    }
    public function actionAjaxEditFechaRecepcion(){
        $keyvalue   = $_POST["keyvalue"];   // ie: 'userid123'
        $name       = $_POST["name"];   // ie: 'firstname'
        $old_value  = $_POST["old_value"];  // ie: 'patricia'
        $new_value  = $_POST["new_value"];  // ie: '  paTTy '
        $new_value = ucfirst(trim($new_value));

        $model=$this->loadModel($keyvalue);
        $model->fecha_recepcion=$new_value;
        $model->update();
        // es importante agregar la siguiente linea de codigo
        // para mostrar el resultado en pantalla
        echo $new_value;
		//echo"<script>location.reload();</script>";
    }
    public function actionAjaxEditHoraRecepcion(){
        $keyvalue   = $_POST["keyvalue"];   // ie: 'userid123'
        $name       = $_POST["name"];   // ie: 'firstname'
        $old_value  = $_POST["old_value"];  // ie: 'patricia'
        $new_value  = $_POST["new_value"];  // ie: '  paTTy '
        $new_value = ucfirst(trim($new_value));

        $model=$this->loadModel($keyvalue);
        $model->hora_recepcion=$new_value;
        $model->update();
        // es importante agregar la siguiente linea de codigo
        // para mostrar el resultado en pantalla
        echo $new_value;
		//echo"<script>location.reload();</script>";
    }


/*########################################################################*/

    public function actionViewDocumentPendiente($id_seguimiento)
	{
		
		$seguimiento=Seguimientos::model()->findByPk($id_seguimiento);

		/*$user = Yii::app()->db->createCommand()
    		->select('fk_documento')
    		->from('hojas_ruta')
    		->limit(1)
    		->where('nur=:nur AND nro=:nro AND activo=:activo ', 
    				array(':nur'=>$seguimiento->codigo, ':nro'=>0, ':activo'=>1))
    		->queryRow();*/


    	$connection= Yii::app()->db;
	 	$user=$connection->createCommand("SELECT fk_documento 
			 				   FROM hojas_ruta 
			 				   WHERE nur='$seguimiento->codigo' AND nro=0 AND activo=1 limit 1
			 				   ")->query()->read();

	 	//return $row['total'];	

    	
		//$documentos=Documentos::model()->findByPk($user['fk_documento']);

		if (Yii::app()->request->isAjaxRequest)
	    {
	    	/*print_r($user);	
	    	
	    	print_r($user['fk_documento']);	
	        echo "entro al if";

	        echo "---->".$_GET['asDialog'];
	        exit();*/


	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('viewDocument', 
	            array(
	               
	               //'documentos'=>$this->loadModel($id),
	               //'documentos'=>Documentos::model()->findByPk($user['fk_documento']),
	               'id'=>$user['fk_documento'],
	               'documentos'=>Documentos::model()->findByPk($user['fk_documento']),

	               //'model'=>$this->loadModel($id),

	             ),false,true);
	        //js-code to open the dialog    
	          if (!empty($_GET['asDialog'])) 
	            echo CHtml::script('$("#dlg-address-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else{
	    	//print_r($user);
    		//exit();	
    			   //echo "entro al else";
	               //exit();

		        $this->render('viewDocument', array(
		        	
		           'documentos'=>Documentos::model()->findByPk($user['fk_documento']),
		         ));
	    }
	}


	public function actionViewNurisAgrupados($id_seguimiento)
	{
		
		$seguimientos=Seguimientos::model()->findByPk($id_seguimiento);

		if (Yii::app()->request->isAjaxRequest)
	    {
	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('viewNurisAgrupados', 
	            array(
	               
	               //'documentos'=>$this->loadModel($id),
	               'seguimientos'=>$seguimientos,

	               //'model'=>$this->loadModel($id),

	             ),false,true);
	        //js-code to open the dialog    
	          if (!empty($_GET['asDialog'])) 
	            echo CHtml::script('$("#dlg-address-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else{
	    	
		        $this->render('viewNurisAgrupados', array(
		           'seguimientos'=>$seguimientos,
		         ));
	    }
	}


	public function actionPrintCaratulaAgrupacion($id_seguimiento)
	{
		$model=$this->loadModel($id_seguimiento);

        /*$this->render('printCaratulaAgrupacion', array(
           'model'=>$model,
        ));*/


        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
		//$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',derecha,izquierda,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'L-LETTER');
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER');

        # render (full page)
        //$mPDF1->WriteHTML($this->render('reportView', array('id_proyecto'=>$id), true));
        $mPDF1->WriteHTML($this->renderPartial('printCaratulaAgrupacion', array('model'=>$model), true));


        $mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');




        # Load a stylesheet
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);

        # renderPartial (only 'view' of current controller)
        //$mPDF1->WriteHTML($this->renderPartial('report', array(), true));
        # Renders image
        //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        //$mPDF1->Output();


        



        $mPDF1->Output('caratula agrupacion.pdf','D');
		exit; 
	}


	public function actionPendientesUsuarioPDF($id_usuario)
	{
		//$model=$this->loadModel($id_seguimiento);

		//$usuario=Yii::app()->user->id_usuario;

		$usuarios=Usuarios::model()->findByPk($id_usuario);

        /*$this->render('pendientesUsuarioPDF', array(
           'usuarios'=>$usuarios,
        ));*/


        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
		//$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',derecha,izquierda,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'L-LETTER');
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER');
		$mPDF1->SetHeader('ABC |Sistema de Administración Correspondencia| ');
		$mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SAC');


		$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');
       
        # render (full page)
        //$mPDF1->WriteHTML($this->render('pendientesUsuarioPDF', array('usuarios'=>$usuarios), true));
        $mPDF1->WriteHTML($this->renderPartial('pendientesUsuarioPDF', array('usuarios'=>$usuarios), true));


       

        # Load a stylesheet
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
        //$mPDF1->WriteHTML($this->renderPartial('report', array(), true));
        # Renders image
        //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        //$mPDF1->Output();

        $mPDF1->Output('Reporte Pendientes.pdf','D');
		exit; 
	}


	public function actionPendientesUsuarioEXCEL($id_usuario)
	{

		$usuarios=Usuarios::model()->findByPk($id_usuario);

		$content=$this->renderPartial("pendientesUsuarioEXCEL", array('usuarios'=>$usuarios,),true);
		Yii::app()->request->sendFile("pendientes de usuario.xls",$content);

        
	}


	public function actionDocumentacionDespachadaPDF($id_usuario)
	{
		//$model=$this->loadModel($id_seguimiento);

		//$usuario=Yii::app()->user->id_usuario;

		$usuarios=Usuarios::model()->findByPk($id_usuario);


		$content=$this->renderPartial("documentacionDespachadaPDF", array('usuarios'=>$usuarios,),true);
		Yii::app()->request->sendFile("documentos_despachados.xls",$content);

        /*$this->render('documentacionDespachadaPDF', array(
           'usuarios'=>$usuarios,
        ));*/

       /*$header='

        
		<table width="100%" align="center" style="top: 0mm; left:1mm;">
			<tr>
				<td width="30%"><img src="'.Yii::app()->request->baseUrl.'/images/logo_abc3.png" width="25px" height="25px" /></td>
				<td width="40%">
				<center>
					<p align="center" style="font-size: 11px;"><b>DOCUMENTACI&Oacute;N DESPACHADA</b></p>
				</center>
				</td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';


        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
		//$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',derecha,izquierda,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'L-LETTER');
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER');
		//$mPDF1->SetHeader('ABC |Sistema Automatizado de Correspondencia| ');
		

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetFooter('Sistema de Administración de Correspondencia|Página {PAGENO}/{nbpg}|S.A.C.');


		$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');
       
        # render (full page)
        //$mPDF1->WriteHTML($this->render('pendientesUsuarioPDF', array('usuarios'=>$usuarios), true));
        $mPDF1->WriteHTML($this->renderPartial('documentacionDespachadaPDF', array('usuarios'=>$usuarios), true));


       

        # Load a stylesheet
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
        //$mPDF1->WriteHTML($this->renderPartial('report', array(), true));
        # Renders image
        //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        //$mPDF1->Output();

        $mPDF1->Output('Documentos despachados.pdf','D');
		exit; */
	}


	public function actionDocumentacionDespachadaExternaPDF($id_usuario)
	{
		//$model=$this->loadModel($id_seguimiento);

		//$usuario=Yii::app()->user->id_usuario;

		$usuarios=Usuarios::model()->findByPk($id_usuario);

        /*$this->render('documentacionDespachadaPDF', array(
           'usuarios'=>$usuarios,
        ));*/

        $header='

        
		<table width="100%" align="center" style="top: 0mm; left:1mm;">
			<tr>
				<td width="30%"><img src="'.Yii::app()->request->baseUrl.'/images/logo_abc3.png" width="25px" height="25px" /></td>
				<td width="40%">
				<center>
					<p align="center" style="font-size: 11px;"><b>DOCUMENTACI&Oacute;N EXTERNA DESPACHADA</b></p>
				</center>
				</td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';


        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
		//$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',derecha,izquierda,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'L-LETTER');
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER');
		//$mPDF1->SetHeader('ABC |Sistema Automatizado de Correspondencia| ');
		

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetFooter('Sistema de Administración de Correspondencia|Página {PAGENO}/{nbpg}|S.A.C.');


		$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');
       
        # render (full page)
        //$mPDF1->WriteHTML($this->render('pendientesUsuarioPDF', array('usuarios'=>$usuarios), true));
        $mPDF1->WriteHTML($this->renderPartial('documentacionDespachadaExternaPDF', array('usuarios'=>$usuarios), true));


       

        # Load a stylesheet
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
        //$mPDF1->WriteHTML($this->renderPartial('report', array(), true));
        # Renders image
        //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        //$mPDF1->Output();

        $mPDF1->Output('Documentos despachados.pdf','D');
		exit; 
	}

	



    public function actionViewDocument($id)
	{
			
			if (Yii::app()->request->isAjaxRequest)
			{
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$this->renderPartial('viewDocument', array('id'=>$id), true)));
				exit;				
			}
			else
				$this->render('viewDocument',array('id'=>$id));
	}

	public function actionViewDocumentSeguimiento($id)
	{
		
		//$documentos=Documentos::model()->findByPk($id);
		$this->renderPartial('viewDocument',array('id'=>$id));
	}

	public function actionViewDetalleArchivo($id)
	{
		
		$this->renderPartial('viewDetalleArchivo',array('id_seguimiento'=>$id));
	}




	public function actionChangeSeguimiento()
	{
		
		$model=new Seguimientos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];
			$nuri=$_POST['Seguimientos']['codigo'];
			//$seguimientos->codigo=$nur;
			$model->derivado_por=1;
			$model->derivado_a=1;
			$model->proveido='FAVOR SU ATENCIÓN.';
			$model->fecha_derivacion=date('Y-m-d');
			$model->hora_derivacion=date('H:i:s');
			$model->fecha_recepcion="1000-01-01";
			$model->hora_recepcion="00:00:00";
			$model->fk_accion=1;
			$model->fk_estado=3;
			$model->padre=0;
			$model->oficial=0;
			$model->hijo=0;
			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');
			$model->gestion=date('Y');
			$model->confirmado=1;
			$model->fk_grupo_derivacion=0;

			if($model->validate()){
				$this->redirect(array('adminChangeSeguimiento','nuri'=>$nuri));
			}
		}

		$this->render('changeSeguimiento',array(
			'model'=>$model,
		));
	}

	public function actionAdminChangeSeguimiento($nuri)
	{

		$this->render('adminChangeSeguimiento',array(
			'nuri'=>$nuri,
		));
	}


	public function actionAdminChangeDerivacion()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('adminChangeDerivacion',array(
			'model'=>$model,
		));
	}

	public function actionAdminCorregirDerivacion()
	{
		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('adminCorregirDerivacion',array(
			'model'=>$model,
		));
	}








/*public function actionUpdateSeguimiento($id)
{
  $model=$this->loadModel($id);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if(isset($_POST['Seguimientos']))
	{
		$model->attributes=$_POST['Seguimientos'];
		if($model->save())
			//----- begin new code --------------------
			if (!empty($_GET['asDialog']))
			{
				//Close the dialog, reset the iframe and update the grid
				echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
				Yii::app()->end();
			}
			else
			//----- end new code --------------------
				
			$this->redirect(array('view','id'=>$model->ADDRESS));
	}

	//----- begin new code --------------------
	if (!empty($_GET['asDialog']))
		$this->layout = '//layouts/iframe';
	//----- end new code --------------------

	$this->renderPartial('updateSeguimiento',array(
		'model'=>$model,
	));
}*/


public function actionUpdateProveido($id)
{
  $model=$this->loadModel($id);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if(isset($_POST['Seguimientos']))
	{
		$model->attributes=$_POST['Seguimientos'];
		if($model->save())
			//----- begin new code --------------------
			if (!empty($_GET['asDialog']))
			{
				//Close the dialog, reset the iframe and update the grid
				echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
				Yii::app()->end();
			}
			else
			//----- end new code --------------------
				
			$this->redirect(array('view','id'=>$model->ADDRESS));
	}

	//----- begin new code --------------------
	if (!empty($_GET['asDialog']))
		$this->layout = '//layouts/iframe';
	//----- end new code --------------------

	$this->renderPartial('updateProveido',array(
		'model'=>$model,
	));
}



public function actionReestablecerDerivacion($id)
{
  
  		$model=$this->loadModel($id);


  		//echo "----> ".$model->padre;

  		//exit;

		if ($model->padre==0) {
			// codigo para documentos nuevos, generados por el usuario
			// primero contamos los nuris derivados
			$derivados=Seguimientos::countDerivados($model->codigo, 0);
			// segundo contamos los que no estan recepcionados,
			// deberia ser igual a la cantidad de derivados
			$no_recibidos=Seguimientos::countNoRecepcionados($model->codigo, 0);

			if ($derivados==$no_recibidos) {
				// codigo para cambiar el estado de las derivaciones
				Seguimientos::updateReestablecerNuevo($model->codigo);
				Seguimientos::mensajeExitoReestablecer($model->codigo);
			}
			else{
				Seguimientos::mensajeErrorReestablecer($model->codigo);
			}

  		}
  		else{

  			// CODIGO PARA REESTABLECER SOLO NURI PENDIENTES
  			// primero contamos los nuris derivados
			$derivados=Seguimientos::countDerivados($model->codigo, $model->padre);
			// segundo contamos los que no estan recepcionados,
			// deberia ser igual a la cantidad de derivados
			$no_recibidos=Seguimientos::countNoRecepcionados($model->codigo, $model->padre);

			if ($derivados==$no_recibidos) {
				// codigo para cambiar el estado de las derivaciones
				Seguimientos::updateReestablecerPendiente($model->codigo,$model->padre);
				Seguimientos::mensajeExitoReestablecer($model->codigo);
			}
			else{
				Seguimientos::mensajeErrorReestablecer($model->codigo);
			}


  			/*// codigo para actualizar la derivacion hijo
  			$id_seguimiento=$model->padre;
  			$model->activo=0;		
  			$model->save();

  			// codigo para actualizar la derivacion padre
  			$seguimientos=$this->loadModel($id_seguimiento);
  			$seguimientos->fk_estado=1;
  			$seguimientos->save();*/
  		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$this->redirect(array('adminCorregirDerivacion'));

}

public function actionUpdateSeguimientos($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];
			if($model->save())
				$this->redirect(array('updateSeguimientos','id'=>$model->id_seguimiento));
		}

		$this->render('updateSeguimiento',array(
			'model'=>$model,
		));
	}

public function actionAutocompleteUser($term) 
	{
		$criteria = new CDbCriteria;
		$criteria->compare('LOWER(nombre)', strtolower($_GET['term']), true);
		$criteria->compare('LOWER(cargo)', strtolower($_GET['term']), true, 'OR');
		$criteria->order = 'id_usuario';
		$criteria->limit = 30; 
		$data = Usuarios::model()->findAll($criteria);

		if (!empty($data))
		{
			$arr = array();
			foreach ($data as $item) {
				$arr[] = array(
				'id' => $item->id_usuario,
				'value' => $item->nombre.' '.$item->cargo,
				'label' => $item->nombre.' '.$item->cargo,
				//'value' => $item->interno.' '.$item->nombre,
				//'label' => $item->interno.' '.$item->nombre,
				);
			}
		}
		else
		{
			$arr = array();
			$arr[] = array(
				'id' => '',
				'value' => 'No se han encontrado resultados para su búsqueda',
				'label' => 'No se han encontrado resultados para su búsqueda',
				);
		}
			
			echo CJSON::encode($arr);
	}	


// DESARCHIVO DE NURIS ORIGINALES

	public function actionDesarchivoOriginalGestion()
	{
		$row=Seguimientos::getArchivoOriginalGestion();

		$this->render('desarchivoGestionOriginal',array(
			'row'=>$row,
		));
	}

	public function actionAdministracionArchivoOriginal($gestion)
	{

		$model=new Seguimientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguimientos']))
			$model->attributes=$_GET['Seguimientos'];

		$this->render('administracionArchivoOriginal',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}

	public function actionDesarchivoNuriOriginal($id)
	{
		
		// codigo para cambiar el estado en la tabla seguimientos
		$model=$this->loadModel($id);
		$gestion=$model->gestion;
		$model->fk_estado=1;
		$model->save();

		$this->redirect(array('administracionArchivoOriginal','gestion'=>$gestion));
	}// fin function



	public function actionPendientesArea()
	{
		
		$area=Areas::model()->findByPk(Yii::app()->user->id_area);

		$this->render('pendientesArea',array(
			'area'=>$area,
		));
	}

	public function actionPendientesAreaDetalle()
	{
		
		$area=Areas::model()->findByPk(Yii::app()->user->id_area);

		$this->render('pendientesAreaDetalle',array(
			'area'=>$area,
		));
	}

	public function actionPendientesAreaDetalleUser($area)
	{
		$area=Areas::model()->findByPk($area);
		$this->render('pendientesAreaDetalleUser',array(
			'area'=>$area,
		));
	}

	public function actionPendientesAreaDetalleUserReporte($id_usuario)
	{
		$usuarios=Usuarios::model()->findByPk($id_usuario);

		//header("Content-type: application/vnd.ms-excel");
 		//header("Content-Disposition: attachment;Filename=cites asignados.xls");

		$this->render('pendientesAreaDetalleUserReporte',array(
			'usuarios'=>$usuarios,
		));


		//$content=$this->renderPartial("pendientesAreaDetalleUserReporte", array('usuarios'=>$usuarios,),true);
		//Yii::app()->request->sendFile("pendientes de usuario.xls",$content);
	}

	public function actionPendientesAreaDetalleUserReporteExcel($id_usuario)
	{
		$usuarios=Usuarios::model()->findByPk($id_usuario);

		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition: attachment;Filename=cites asignados.xls");

		$this->renderPartial('pendientesAreaDetalleUserReporte',array(
			'usuarios'=>$usuarios,
		));


		//$content=$this->renderPartial("pendientesAreaDetalleUserReporte", array('usuarios'=>$usuarios,),true);
		//Yii::app()->request->sendFile("pendientes de usuario.xls",$content);
	}

	public function actionRecepcionBloque()
	{
		$model=new Seguimientos;

		$this->render('recepcionBloque',array(
			'model'=>$model,
			'usuario'=>Yii::app()->user->id_usuario,
		));
	}

	

	public function actionRecibirNuriBloque()
	{
		// I want a post	
		  if(Yii::app()->request->isPostRequest)
		  {
		    // parse $_POST variables

		    print_r($_POST["Seguimientos"]);

		    $nuris='';

		    foreach($_POST["Seguimientos"]['id_seguimiento'] as $key => $val) {
		      
		     $model=$this->loadModel($val);

		     	$nuris=$nuris."<br> -> ".$model->codigo;

				if ($model->oficial==1) {
						$model->fk_estado=1;
						$model->fecha_recepcion=date('Y-m-d');
						$model->hora_recepcion=date('H:i:s');
				}
				else{
					if ($model->oficial==0) {
						$model->fk_estado=2;
						$model->fecha_recepcion=date('Y-m-d');
						$model->hora_recepcion=date('H:i:s');
					}
					else{
						$model->fk_estado=3;
						echo "Error de recepción por favor consulte con el administrador";	
						
						Yii::app()->user->setFlash('error', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente'></i><br>
							Error de recepción de NUR/NURI <b>$model->codigo</b> por favor consulte con el administrador del sistema		 	
		 				");
					}		
				}

				
				//$user = User::model()->findByPk($userId);
				$model->update();

		    }// fin foreach
		    //$this->redirect(array("list"));
		    Seguimientos::mensajeRecepcionBloque($nuris);
		    $this->redirect(array('seguimientos/recepcionBloque'));


		  }	
		  else
		    throw new CHttpException(400,"Invalid request. Please do not repeat this request again.");


		exit();
	}

	public function actionAnadirRespuesta($id){

		$seguimientos=Seguimientos::model()->findByPk($id);

		$this->render('anadirRespuesta',array(
			'seguimientos'=>$seguimientos,
		));
	}
	public function actionAnadirDocumentoRespuesta($tipo_documento,$id_seguimiento,$nuri, $oficial){

		//$seguimientos=Seguimientos::model()->findByPk($id);
		$gestion=date('Y');
		$area=Yii::app()->user->id_area;
		$regional=Yii::app()->user->regional;

		//$user=Usuarios::
		$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
		//Yii::app()->user->id_usuario;

		//codigo para generar el documento solicitado
		$model = new Documentos();
		$model->id_documento = null;
		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);

		$cite=$model->codigo;

		$model->fecha=date('Y-m-d');
		$model->hora=date('H:i:s');
		$model->fecha_registro=date('Y-m-d');
		$model->hora_registro=date('H:i:s');
		$model->gestion=date('Y');
		$model->fk_usuario=Yii::app()->user->id_usuario;
		$model->fk_tipo_documento=$tipo_documento;
		$model->fk_estado_documento=2;
		$model->fk_documento=0;
		$model->fk_motivo=0;
		$model->fk_area=Yii::app()->user->id_area;

		$model->destinatario_titulo='Señor';
		$model->destinatario_nombres='null';
		$model->destinatario_cargo='null';
		$model->destinatario_institucion='null';
				
		$model->remitente_institucion='null';
		$model->remitente_nombres=$user->nombre;
		$model->remitente_cargo=$user->cargo;
		$model->via_nombres='';
		$model->via_cargo='';
				
		$model->referencia='null';
		$model->contenido='null';
		$model->adjuntos='';
		$model->copias='';
		$model->nro_hojas='';
		$model->ruta_documento='null';				
		$model->usuario_destino=1;
		$model->grupo_destino=0;
		$model->nombre_grupo='null';

		$model->isNewRecord = true;
		

		if ($model->save()) {
			// codigo para almacenar un nuevo registro en la tabla hojas ruta
			$hojas = new HojasRuta();
			$hojas->id_hoja_ruta = null;

			$hojas->nur=$nuri;
			$hojas->codigo=$cite;
			$hojas->nro=$id_seguimiento;
			$hojas->fecha=date('Y-m-d');
			$hojas->hora=date('H:i:s');
			$hojas->proceso=4;
			$hojas->fecha_registro=date('Y-m-d');
			$hojas->hora_registro=date('H:i:s');
			$hojas->fk_usuario=Yii::app()->user->id_usuario;
			$hojas->gestion=date('Y');
			$hojas->activo=1;
			$hojas->fk_documento=$model->id_documento;
			$hojas->oficial=$oficial;

			$hojas->isNewRecord = true;
			
			if ($hojas->save()) {
				$this->redirect(array('anadirRespuesta','id'=>$id_seguimiento));
			}
			else{
				echo print_r($hojas->getErrors());	
			}
		}//if ($model->save()) {
		else{
			echo print_r($model->getErrors());
		}	

		
	}

	public function actionEliminarDocumentoRespuesta($id_hoja_ruta){

		// codigo para desvincular el CITE del NURI
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);
		$id_seguimiento=$hojasruta->nro;
		$id_documento=$hojasruta->fk_documento;
		$hojasruta->activo=0;
		$hojasruta->save();
		
		//codigo para cambiar el estado del CITE a PENDIENTE
		$documentos=Documentos::model()->findByPk($id_documento);
		$documentos->fk_estado_documento=5;
		$documentos->save();

		// codigo para redireccionar
		$this->redirect(array('anadirRespuesta','id'=>$id_seguimiento));
	}

	public function actionEditarDocumentoRespuesta($id_documento, $tipo_documento, $id_seguimiento){

		switch ($tipo_documento) {
					    case 1:
					        $direccion='documentos/updateInformeRespuesta';
					        break;
					    case 2:
					        $direccion='documentos/updateNotaRespuesta';
					        break;
					    case 3:
					        $direccion='documentos/updateMemorandumRespuesta';
					        break;
					    case 4:
					        $direccion='documentos/updateCartaRespuesta';
					        break;
					    case 5:
					        $direccion='documentos/updateCircularRespuesta';
					        break;
					    case 7:
					        $direccion='documentos/updateCartaExternaRespuesta';
					        break;            
					}

			
		$this->redirect(array($direccion,'id'=>$id_documento,'tipo'=>$tipo_documento,'id_seguimiento'=>$id_seguimiento));


	}


		
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Seguimientos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Seguimientos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Seguimientos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seguimientos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
