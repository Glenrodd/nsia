<?php

class DocumentosController extends Controller
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
				'actions'=>array('index','view','viewNota','viewInforme','viewCarta','viewCircular','viewMemorandum'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('createInforme','updateInforme','createNota','updateNota','createMemorandum','updateMemorandum','createCarta','updateCarta','createCircular','updateCircular','asignarNuri','administracionNota','administracionInforme','administracionCircular','administracionMemorandum','administracionCarta','administracionReservado','administracionBorrador','documentosSinNuri','asignarNuriPendiente','generarDocumentoPDF','generarCircularPDF','generarInstructivoPDF','generarDocumentoWORD','generarCartaWORD','generarMemorandumWORD','createCartaExterna','updateCartaExterna','createInstructivo','updateInstructivo','viewCartaPDF','adminCartaExterna','updateDocument','adminSinDerivar','adminSinNuri','generarHsInternoPDF','generarHsInternoCopiaPDF','generarHsInternoAdicionPDF','citesGestion','adminDocumentosGestion','citesAsignadosEXCEL','viewDocumentPendiente','autocompleteInstRemitente','autocompleteNombreRemitente','autocompleteCargoRemitente','asignarNuevoCite','asignarNuriCreado','deleteNuriAsociacion','generarCartaPDF','generarMemorandumPDF','administracionObservados','observadosGestion','administracionAsignarObservados','observarDocumento','generarHsExternoPDF','generarHsExternoCopiaPDF','updateInformeRespuesta','updateNotaRespuesta','updateCartaRespuesta','guardarBorrador','updateNotaFormDraft','updateNotaDraft','updateInformeFormDraft','updateInstructivoFormDraft','updateMemorandumFormDraft','updateCartaFormDraft','updateCircularFormDraft','updateInformeDraft','updateCircularFormDraft','updateCircularDraft','updateMemorandumDraft','updateInstructivoDraft','updateCartaDraft','administracionInstructivo','generarMembretadoWORD','updateDocumentDraft','asignarCite','updateDocumentRespuesta','generarInstructivoWORD','updateNotaUser','updateInformeUser','updateCartaUser','updateCircularUser','updateInstructivoUser','viewDocumentMysql','adminCartaHistorico','adminNotaHistorico','adminInformeHistorico','adminMemorandumHistorico','adminCircularHistorico','adminInstructivoHistorico','administracionCartaExterna','citesArea','citesAreaDetalle','citesAreaDetalleReporte','adminDocumentosRegionales'),
				'users'=>array('@'),
			),

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('searchEspecificaCite','resultSearchEspecificaCite','searchEspecificaReferencia','resultSearchEspecificaReferencia','resultsearchEspInstRemitente','searchEspInstRemitente','searchEspNombreRemitente','resultsearchEspNombreRemitente','searchEspSintesis','resultsearchEspSintesis'),
				'users'=>array('@'),
			),

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','documentosGestion','adminDocumentosFecha'),
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
	public function actionView($id)
	{
		$documentos=$this->loadModel($id);

		//$model->save();

		switch ($documentos->fk_tipo_documento) {
					    case 1:
					        $direccion='viewInforme';
					        break;
					    case 2:
					        $direccion='viewNota';
					        break;
					    case 3:
					        $direccion='viewMemorandum';
					        break;
					    case 4:
					        $direccion='viewCarta';
					        break;
					    case 5:
					        $direccion='viewCircular';
					        break;
					    case 8:
					        $direccion='viewInstructivo';
					        break;            
					}

				//echo "---> ".$direccion;
				$this->redirect(array($direccion,'id'=>$documentos->id_documento,));

		/*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
	}

	public function actionViewNota($id)
	{
		$this->render('viewNota',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionViewInforme($id)
	{
		$this->render('viewInforme',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionViewCarta($id)
	{
		$this->render('viewCarta',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionViewCircular($id)
	{
		$this->render('viewCircular',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionViewMemorandum($id)
	{
		$this->render('viewMemorandum',array(
			'model'=>$this->loadModel($id),
		));
	}

	// con esta funcion se puede clonar o duplicar el documento
	public function actionAsignarNuevoCite($id){

		$documentos=$this->loadModel($id);
		$gestion=date('Y');
		$area=Yii::app()->user->id_area;
		$tipoDoc=$documentos->fk_tipo_documento;
		$regional=Yii::app()->user->regional;


		$model = $this->loadModel($id); // $id do registro que será duplicado  
		$model->id_documento = null;
		$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);
		$model->destinatario_titulo='null';
		$model->destinatario_institucion='null';

		$model->fecha=date('Y-m-d');
		$model->hora=date('H:i:s');
		$model->gestion=date('Y');
		$model->fecha_registro=date('Y-m-d');
		$model->hora_registro=date('H:i:s');

		//$model->dependencia = $id;
		$model->isNewRecord = true;
		//$model->save();

		switch ($documentos->fk_tipo_documento) {
					    case 1:
					        $direccion='updateInforme';
					        break;
					    case 2:
					        $direccion='updateNota';
					        break;
					    case 3:
					        $direccion='updateMemorandum';
					        break;
					    case 4:
					        $direccion='updateCarta';
					        break;
					    case 5:
					        $direccion='updateCircular';
					        break;
					    case 8:
					        $direccion='updateInstructivo';
					        break;            
					}

				//echo "---> ".$direccion;

		if($model->save()){
				$this->redirect(array($direccion,'id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
		}
		else{
				//print_r($model->getErrors());
		}

		//$this->redirect(array('update'));

	}


	public function actionAsignarCite($id_documento)
	{
		$documentos=$this->loadModel($id_documento);
		$gestion=date('Y');
		$area=Yii::app()->user->id_area;
		$tipoDoc=$documentos->fk_tipo_documento;
		$regional=Yii::app()->user->regional;


		$model = $this->loadModel($id_documento); // $id do registro que será duplicado  
		$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);
		$model->fk_estado_documento=2;

		switch ($documentos->fk_tipo_documento) {
					    case 1:
					        $direccion='updateInforme';
					        break;
					    case 2:
					        $direccion='updateNota';
					        break;
					    case 3:
					        $direccion='updateMemorandum';
					        break;
					    case 4:
					        $direccion='updateCarta';
					        break;
					    case 5:
					        $direccion='updateCircular';
					        break;
					    case 8:
					        $direccion='updateInstructivo';
					        break;            
					}

				//echo "---> ".$direccion;

		if($model->save()){
				$this->redirect(array($direccion,'id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
		}
		else{
				print_r($model->getErrors());
		}

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateInforme($tipo)
	{

		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();		
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];


			//codigo para almacenar reservados
			if ($model->fk_estado_documento==1 && Documentos::getNumeroReservados()<15)
			  {
				
				$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='Señor';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion=$user->nombre;
				$model->remitente_nombres=$user->cargo;
				$model->remitente_cargo='null';
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
				
				$model->codigo=rand(111111111111111111111111111111111111,99999999999999999999999999999999999);
			}
			else{

				$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
				$model->grupo_destino=$_POST['Documentos']['grupo_destino'];

				$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
				$model->via_cargo = strtoupper($model->via_cargo);

				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;
				$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
				//$model->remitente_nombres=trim($_POST['remitente_nombres']);
				//$model->remitente_cargo=trim($_POST['remitente_cargo']);
				$model->remitente_institucion='null';
				$model->nombre_grupo='null';
				$model->codigo=rand(111111111111111111111111111111111111,99999999999999999999999999999999999);
				$model->ruta_documento='null';
			}

			
			if ($model->validate()) {
				
				$gestion=date('Y');
				$area=Yii::app()->user->id_area;
				$tipoDoc=1;
				$regional=Yii::app()->user->regional;


				//echo "---> ".

				$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);


				if($model->save()){
					Documentos::mensajeCreate();
					$this->redirect(array('updateInforme','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
				Documentos::mensajeErrorCreate();

			}//if ($model->validate()) {
		}

		$this->render('createInforme',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateInforme($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			//$model->remitente_nombres=trim($_POST['remitente_nombres']);
			//$model->remitente_cargo=trim($_POST['remitente_cargo']);
			$model->destinatario_institucion='null';
			$model->destinatario_titulo='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInforme','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInforme',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionUpdateInformeFormDraft($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->destinatario_titulo='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInformeFormDraft','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInformeFormDraft',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateInformeDraft()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		$model=$this->loadModel($_POST['id_documento']);

		//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
		$model->destinatario_nombres=trim($_POST['destinatario_nombres']);
		$model->destinatario_cargo=trim($_POST['destinatario_cargo']);;
		$model->destinatario_titulo='null';
				
		$model->remitente_nombres=trim($_POST['remitente_nombres']);
		$model->remitente_cargo=trim($_POST['remitente_cargo']);

		$model->via_nombres=trim($_POST['via_nombres']);
		$model->via_cargo=trim($_POST['via_cargo']);
				
		$model->referencia=trim($_POST['referencia']);
		$model->contenido=trim($_POST['contenido']);
		$model->adjuntos=trim($_POST['adjuntos']);
		$model->copias=trim($_POST['copias']);
				
		if($model->save()){
		//Documentos::mensajeCreateDraft();

		}//if($model->save()){
		else{	
			Documentos::mensajeErrorCreate();
		}	
		

	}

	public function actionUpdateInformeRespuesta($id,$tipo, $id_seguimiento)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
			$model->destinatario_institucion='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInformeRespuesta','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento, 'id_seguimiento'=>$id_seguimiento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInformeRespuesta',array(
			'model'=>$model,
			'tipo'=>$tipo,
			'seguimientos'=>Seguimientos::model()->findByPk($id_seguimiento),
		));
	}


	public function actionUpdateInformeUser($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
			$model->destinatario_institucion='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInformeUser','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInformeUser',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionCreateNota($tipo)
	{
		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();		
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];

			//codigo para almacenar reservados

			//echo "----> ".Documentos::getNumeroReservados();

			//exit();

			if ($model->fk_estado_documento==1 && Documentos::getNumeroReservados()<15)
			  {

			  	$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
				
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
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
				
				$model->codigo=rand(111111111111111111111111111111111111,99999999999999999999999999999999999);
			}
			else{

				$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
				$model->grupo_destino=$_POST['Documentos']['grupo_destino'];

				$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
				$model->via_cargo = strtoupper($model->via_cargo);

				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;
				$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
				$model->remitente_institucion='null';
				$model->nombre_grupo='null';
				$model->codigo=rand(111111111111111111111111111111111111,99999999999999999999999999999999999);
				$model->ruta_documento='null';
			}

			
			if ($model->validate()) {
				$gestion=date('Y');
				$area=Yii::app()->user->id_area;
				$tipoDoc=2;
				$regional=Yii::app()->user->regional;

				$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);


				if($model->save()){
					Documentos::mensajeCreate();
					$this->redirect(array('updateNota','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
				Documentos::mensajeErrorCreate();
			}//if ($model->validate()) {
		}

		$this->render('createNota',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}



	public function actionGuardarBorrador()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		//if(isset($_POST['Documentos']))
		//{
			//$model->attributes=$_POST['Documentos'];
		$contenido=trim($_POST['contenido']);

		if ($contenido!='') {
				

				if ($_POST['referencia']!='') {
					$referencia=$_POST['referencia'];
				}
				else{
					$referencia='';	
				}

				if ($_POST['destinatario_titulo']!='') { $destinatario_titulo=$_POST['destinatario_titulo'];} else{ $destinatario_titulo='';}

				if ($_POST['destinatario_nombres']!='') { $destinatario_nombres=$_POST['destinatario_nombres'];} else{ $destinatario_nombres='';}
				if ($_POST['destinatario_cargo']!='') { $destinatario_cargo=$_POST['destinatario_cargo'];} else{ $destinatario_cargo='';}
				if ($_POST['destinatario_institucion']!='') { $destinatario_institucion=$_POST['destinatario_institucion'];} else{ $destinatario_institucion='';}

				if ($_POST['remitente_institucion']!='') { $remitente_institucion=$_POST['remitente_institucion'];} else{ $remitente_institucion='';}
				if ($_POST['remitente_nombres']!='') { $remitente_nombres=$_POST['remitente_nombres'];} else{ $remitente_nombres='';}
				if ($_POST['remitente_cargo']!='') { $remitente_cargo=$_POST['remitente_cargo'];} else{ $remitente_cargo='';}

				if ($_POST['via_nombres']!='') { $via_nombres=$_POST['via_nombres'];} else{ $via_nombres='';}
				if ($_POST['via_cargo']!='') { $via_cargo=$_POST['via_cargo'];} else{ $via_cargo='';}
				
				if ($_POST['adjuntos']!='') { $adjuntos=$_POST['adjuntos'];} else{ $adjuntos='';}
				if ($_POST['copias']!='') { $copias=$_POST['copias'];} else{ $copias='';}
				if ($_POST['nro_hojas']!='') { $nro_hojas=$_POST['nro_hojas'];} else{ $nro_hojas='';}




				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo=$destinatario_titulo;
				//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
				$model->destinatario_nombres=$destinatario_nombres;
				$model->destinatario_cargo=$destinatario_cargo;
				$model->destinatario_institucion=$destinatario_institucion;
				
				$model->remitente_institucion=$remitente_institucion;
				$model->remitente_nombres=$remitente_nombres;
				$model->remitente_cargo=$remitente_cargo;
				$model->via_nombres=$via_nombres;
				$model->via_cargo=$via_cargo;
				
				$model->referencia=$referencia;
				
				$model->adjuntos=$adjuntos;
				$model->copias=$copias;
				$model->nro_hojas=$nro_hojas;
				$model->ruta_documento='null';				
				$model->usuario_destino=1;
				$model->grupo_destino=0;
				$model->nombre_grupo='null';

				$model->fk_estado_documento=7;

				$model->referencia=$referencia;
				$model->contenido=$_POST['contenido'];
				$model->fk_tipo_documento=$_POST['fk_tipo_documento'];
				//$model->=$_POST[''];
				
				$model->codigo=rand(1111111111111111111, 99999999999999999999999);



				switch ($_POST['fk_tipo_documento']) {
					    case 1:
					        $direccion='updateInformeFormDraft';
					        break;
					    case 2:
					        $direccion='updateNotaFormDraft';
					        break;
					    case 3:
					        $direccion='updateMemorandumFormDraft';
					        break;
					    case 4:
					        $direccion='updateCartaFormDraft';
					        break;
					    case 5:
					        $direccion='updateCircularFormDraft';
					        break;
					    case 8:
					        $direccion='updateInstructivoFormDraft';
					        break;            
					}


				if($model->save()){

					Documentos::mensajeCreateDraft();

					$satu=$this->createUrl($direccion,array('id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
					echo CJSON::encode(array
					  (
					     'satu'=>$satu,
					  ));
					  Yii::app()->end();
				}//if($model->save()){
				Documentos::mensajeErrorCreate();

		}//if ($_POST['contenido']=='') {		

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateNota($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->destinatario_institucion='null';
			$model->destinatario_titulo='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateNota','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateNota',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionUpdateNotaFormDraft($id,$tipo)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateNotaFormDraft','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateNotaFormDraft',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateNotaDraft()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		$model=$this->loadModel($_POST['id_documento']);

		//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
		$model->destinatario_nombres=trim($_POST['destinatario_nombres']);
		$model->destinatario_cargo=trim($_POST['destinatario_cargo']);;
				
		//$model->remitente_nombres=trim($_POST['remitente_nombres']);
		//$model->remitente_cargo=trim($_POST['remitente_cargo']);

		$model->via_nombres=trim($_POST['via_nombres']);
		$model->via_cargo=trim($_POST['via_cargo']);
				
		$model->referencia=trim($_POST['referencia']);
		$model->contenido=trim($_POST['contenido']);
		$model->adjuntos=trim($_POST['adjuntos']);
		$model->copias=trim($_POST['copias']);
				
		if($model->save()){
		//Documentos::mensajeCreateDraft();

		}//if($model->save()){
		else{	
			Documentos::mensajeErrorCreate();
		}	
		

	}


	public function actionUpdateNotaRespuesta($id,$tipo,$id_seguimiento)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateNotaRespuesta','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento, 'id_seguimiento'=>$id_seguimiento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateNotaRespuesta',array(
			'model'=>$model,
			'tipo'=>$tipo,
			'seguimientos'=>Seguimientos::model()->findByPk($id_seguimiento),
		));
	}

	public function actionUpdateNotaUser($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
			$model->via_cargo = strtoupper($model->via_cargo);
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateNotauser','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateNotaUser',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionCreateInstructivo($tipo)
	{
		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();		
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];

			//codigo para almacenar reservados
			if ($model->fk_estado_documento==1 && Documentos::getNumeroReservados()<15)
			  {
				$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
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
				
				$model->codigo=0;
			}
			else{

				$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
				$model->grupo_destino=$_POST['Documentos']['grupo_destino'];

				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;
				$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
				$model->remitente_institucion='null';
				$model->nombre_grupo='null';
				$model->codigo=0;
				$model->ruta_documento='null';
			}

			
			if ($model->validate()) {
				$gestion=date('Y');
				$area=Yii::app()->user->id_area;
				$tipoDoc=8;
				$regional=Yii::app()->user->regional;

				$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);


				if($model->save()){
					Documentos::mensajeCreate();
					$this->redirect(array('updateInstructivo','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
				Documentos::mensajeErrorCreate();
			}//if ($model->validate()) {
		}

		$this->render('createInstructivo',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateInstructivo($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
			
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInstructivo','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInstructivo',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionUpdateInstructivoUser($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
			
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInstructivoUser','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInstructivoUser',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionUpdateInstructivoFormDraft($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateInstructivoFormDraft','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateInstructivoFormDraft',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateInstructivoDraft()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		$model=$this->loadModel($_POST['id_documento']);

		//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
		$model->destinatario_nombres=trim($_POST['destinatario_nombres']);
		$model->destinatario_cargo=trim($_POST['destinatario_cargo']);;
				
		$model->remitente_nombres=trim($_POST['remitente_nombres']);
		$model->remitente_cargo=trim($_POST['remitente_cargo']);

				
		$model->referencia=trim($_POST['referencia']);
		$model->contenido=trim($_POST['contenido']);
		$model->adjuntos=trim($_POST['adjuntos']);
		$model->copias=trim($_POST['copias']);
				
		if($model->save()){
		//Documentos::mensajeCreateDraft();

		}//if($model->save()){
		else{	
			Documentos::mensajeErrorCreate();
		}	
		

	}


	public function actionCreateMemorandum($tipo)
	{
		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();	
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];

			if ($model->fk_estado_documento==1 && Documentos::getNumeroReservados()<15)
			  {
				$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
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
				
				$model->codigo=0;
			}
			else{
				$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
				$model->grupo_destino=$_POST['Documentos']['grupo_destino'];


				if ($_POST['Documentos']['destinatario_nombres']=='') {
					$model->destinatario_nombres="";				
				}
				if ($_POST['Documentos']['destinatario_cargo']=='') {
					$model->destinatario_cargo="";				
				}

				
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;
				$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
				$model->remitente_institucion='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				$model->nombre_grupo='null';
				//$model->copias='';
				$model->codigo=0;
				$model->ruta_documento='null';
			}

			

			if ($model->validate()) {

				$gestion=date('Y');
				$area=Yii::app()->user->id_area;
				$tipoDoc=3;
				$regional=Yii::app()->user->regional;

				$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);

				if($model->save()){
					Documentos::mensajeCreate();
					$this->redirect(array('updateMemorandum','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
				Documentos::mensajeErrorCreate();
			}//if ($model->validate()) {
		}

		$this->render('createMemorandum',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateMemorandum($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			

			if ($_POST['Documentos']['destinatario_nombres']=='') {
					$model->destinatario_nombres="";				
				}
				if ($_POST['Documentos']['destinatario_cargo']=='') {
					$model->destinatario_cargo='';				
				}	


			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
			$model->destinatario_institucion='null';
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateMemorandum','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateMemorandum',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}




	public function actionUpdateMemorandumFormDraft($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			if ($_POST['Documentos']['destinatario_cargo']=='') {
					$model->destinatario_cargo='';
				}
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateMemorandumFormDraft','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateMemorandumFormDraft',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateMemorandumDraft()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		$model=$this->loadModel($_POST['id_documento']);

		//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
		$model->destinatario_nombres=trim($_POST['destinatario_nombres']);
		$model->destinatario_cargo=trim($_POST['destinatario_cargo']);;
				
		$model->remitente_nombres=trim($_POST['remitente_nombres']);
		$model->remitente_cargo=trim($_POST['remitente_cargo']);

				
		$model->referencia=trim($_POST['referencia']);
		$model->contenido=trim($_POST['contenido']);
		$model->adjuntos=trim($_POST['adjuntos']);
		//$model->copias=trim($_POST['copias']);
				
		if($model->save()){
		//Documentos::mensajeCreateDraft();

		}//if($model->save()){
		else{	
			Documentos::mensajeErrorCreate();
		}	
		

	}


	public function actionCreateCarta($tipo)
	{
		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();	
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];


			if ($model->fk_estado_documento==1 && Documentos::getNumeroReservados()<15)
			  {

			  	$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
				
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='Señor';
				$model->destinatario_nombres=$user->nombre;
				$model->destinatario_cargo=$user->cargo;
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion='null';
				$model->remitente_nombres='null';
				$model->remitente_cargo='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				
				$model->referencia='null';
				$model->contenido='null';
				$model->adjuntos='';
				$model->copias='';
				$model->nro_hojas='';
				$model->ruta_documento='null';				
				$model->usuario_destino=1;
				$model->grupo_destino=0;
				$model->nombre_grupo='null';
				
				$model->codigo=0;
			}
			else{
				$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
				$model->grupo_destino=$_POST['Documentos']['grupo_destino'];

				if ($_POST['Documentos']['destinatario_cargo']=='') {
					$model->destinatario_cargo='';
				}

				//$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;
				$model->remitente_institucion='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				$model->nombre_grupo='null';
				$model->ruta_documento='null';
				$model->usuario_destino=1;
				$model->codigo=0;
			}

			

			if ($model->validate()) {

				$gestion=date('Y');
				$area=Yii::app()->user->id_area;
				$tipoDoc=4;
				$regional=Yii::app()->user->regional;

				$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);

				if($model->save()){
					Documentos::mensajeCreate();
					$this->redirect(array('updateCarta','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
				Documentos::mensajeErrorCreate();
			}//if ($model->validate()) {
		}

		$this->render('createCarta',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateCarta($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCarta','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateCarta',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateCartaFormDraft($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCartaFormDraft','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateCartaFormDraft',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}
	public function actionUpdateCartaDraft()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		$model=$this->loadModel($_POST['id_documento']);

		//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
		$model->destinatario_titulo=trim($_POST['destinatario_titulo']);
		$model->destinatario_nombres=trim($_POST['destinatario_nombres']);
		$model->destinatario_cargo=trim($_POST['destinatario_cargo']);;
		$model->destinatario_institucion=trim($_POST['destinatario_institucion']);
		$model->fecha=trim($_POST['fecha']);
				
		$model->referencia=trim($_POST['referencia']);
		$model->contenido=trim($_POST['contenido']);

				
		$model->remitente_nombres=trim($_POST['remitente_nombres']);
		$model->remitente_cargo=trim($_POST['remitente_cargo']);
		$model->adjuntos=trim($_POST['adjuntos']);
		$model->copias=trim($_POST['copias']);
				
		if($model->save()){
		//Documentos::mensajeCreateDraft();

		}//if($model->save()){
		else{	
			Documentos::mensajeErrorCreate();
		}	
		

	}


	public function actionUpdateCartaRespuesta($id,$tipo,$id_seguimiento)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCartaRespuesta','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento, 'id_seguimiento'=>$id_seguimiento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateCartaRespuesta',array(
			'model'=>$model,
			'tipo'=>$tipo,
			'seguimientos'=>Seguimientos::model()->findByPk($id_seguimiento),
		));
	}


	public function actionUpdateCartaUser($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			if ($model->observado==1) {
				$model->observado=2;
			}

			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCartaUser','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateCartaUser',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionCreateCartaExterna()
	{
		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();	
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$tipo=7;
		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
			$model->grupo_destino=$_POST['Documentos']['grupo_destino'];
			//$model->contenido=;

			if ($_POST['Documentos']['contenido']=='') {
				# code...
				$model->contenido='&nbsp;&nbsp;&nbsp;&nbsp;';
			}

			//$model->fecha=date('Y-m-d');

			//$model->fecha=date('Y-m-d', CDateTimeParser::parse($model->fecha, Yii::app()->locale->dateFormat));

			//$model->codigo;

			if ($_POST['Documentos']['codigo']==' ') {
				$model->codigo=' ';				
			}


			$model->hora=date('H:i:s');
			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');
			$model->gestion=date('Y');
			$model->fk_usuario=Yii::app()->user->id_usuario;
			$model->fk_area=Yii::app()->user->id_area;
			$model->via_nombres='null';
			$model->via_cargo='null';
			$model->nombre_grupo='null';
			$model->copias='null';
			$model->fk_estado_documento=1;
			$model->destinatario_titulo='null';


			$model->remitente_nombres=strtoupper($model->remitente_nombres);
			$model->remitente_cargo=strtoupper($model->remitente_cargo);
			$model->remitente_institucion=strtoupper($model->remitente_institucion);

			$model->destinatario_nombres=strtoupper($model->destinatario_nombres);
			$model->destinatario_cargo=strtoupper($model->destinatario_cargo);
			$model->destinatario_institucion=strtoupper($model->destinatario_institucion);
			
			$model->referencia=strtoupper($model->referencia);
			$model->contenido=strtoupper($model->contenido);
			$model->adjuntos=strtoupper($model->adjuntos);
			$model->codigo=strtoupper($model->codigo);
			//$model->codigo=0;

			//print_r($_FILES["Documentos"]);
			//exit();

			//echo "----> ".$_FILES['documento']['type'];
			//exit();

			/*if(isset($_FILES['documento']) && $_FILES['documento']['type']=='application/pdf'){
				//move_uploaded_file ($_FILES['documento']['tmp_name'] , '../img/upload/'.$_FILES['documento']['name']);
			}*/

			print_r($_FILES['Documentos']);
			echo "<br>";
			print_r($_FILES['Documentos']['type']['ruta_documento']);
			echo "<br>";
			print_r($_FILES['Documentos']['size']['ruta_documento']);
			echo "<br>";
			print_r($_FILES['Documentos']['name']['ruta_documento']);
			//exit();

			if(isset($_FILES['Documentos']) && $_FILES['Documentos']['type']['ruta_documento']=='application/pdf'){

				echo "entro en if";
				//exit();

				$name=time()."-".$_FILES['Documentos']['name']['ruta_documento'];

				//move_uploaded_file ($_FILES['documento']['tmp_name'] , '../img/upload/'.$_FILES['documento']['name']);
				move_uploaded_file ($_FILES['Documentos']['tmp_name']['ruta_documento'] , Yii::getPathOfAlias("webroot").'/uploads/'.date('Y').'/'.$name);

				$model->ruta_documento=$name;
			}
			else{
       				$model->ruta_documento='';

       				echo "entro en else";
					//exit();
	            }






			/*if(isset($_FILES["Documentos"])){

			 if ($_FILES["Documentos"]['size']['ruta_documento']!=0) {	
             
	            //Instanciamos el subidor para el campo fichero del formulario
	            $file=CUploadedFile::getInstance($model,"ruta_documento");
	            //Nombre del fichero
	            $name=time()."-".$file->getName();
	            //$file->getExtensionName()

	           
	            //echo "-----> ".$file->getExtensionName();
	            //exit();

	            //Permitimos tres tipos de fichero
	            //if($file->getExtensionName()=="png" || $file->getExtensionName()=="pdf" || $file->getExtensionName()=="zip"){
	            if($file->getExtensionName()=="pdf" || $file->getExtensionName()=="PDF"){     
	                //Guardamos el fichero 
	                $gestion=date('Y');
	                $file->saveAs(Yii::getPathOfAlias("webroot")."/uploads/".$gestion."/".$name);
	                
	                // codigo para almacenar la ruta del documento
       				$model->ruta_documento=$name;
	                 
	            }else{

	            	// codigo para almacenar la ruta del documento
       				$model->ruta_documento='null';
	                //Crear mensaje flash
	                Yii::app()->user->setFlash('mensaje','Solo ficheros png, pdf o zip');
	                 
	                //Refrescamos pantalla
	                $this->refresh();
	            }

	          }

	          
       		}// fin files  */
       		

			

			if ($model->validate()) {

				$area=Yii::app()->user->id_area;
				$tipoDoc=4;
				$regional=Yii::app()->user->regional;

				//$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);
				//$model->codigo='prueba';

				if($model->save()){

					$gestion=date('Y');
					Documentos::insertNurHojaRuta($gestion,$model->id_documento,$model->codigo);

					Documentos::insertRemitente($model->remitente_nombres,$model->remitente_cargo,$model->remitente_institucion);

					$this->redirect(array('updateCartaExterna','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
			}//if ($model->validate()) {
		}

		$this->render('createCartaExterna',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionUpdateCartaExterna($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];

			$model->remitente_nombres=strtoupper($model->remitente_nombres);
			$model->remitente_cargo=strtoupper($model->remitente_cargo);
			$model->remitente_institucion=strtoupper($model->remitente_institucion);
			$model->destinatario_nombres=strtoupper($model->destinatario_nombres);
			$model->destinatario_cargo=strtoupper($model->destinatario_cargo);
			$model->destinatario_institucion=strtoupper($model->destinatario_institucion);
			$model->adjuntos=strtoupper($model->adjuntos);
			$model->codigo=strtoupper($model->codigo);

			$model->destinatario_titulo='null';



				//print_r($_FILES['Documentos']['name']);
				//print_r($_FILES['Documentos']['size']);
				//print_r($_FILES['Documentos']['type']);
				//exit();


			print_r($_FILES['Documentos']);
			echo "<br>";
			print_r($_FILES['Documentos']['type']['ruta_documento']);
			echo "<br>";
			print_r($_FILES['Documentos']['size']['ruta_documento']);
			echo "<br>";
			print_r($_FILES['Documentos']['name']['ruta_documento']);
			//exit();

			if(isset($_FILES['Documentos']) && $_FILES['Documentos']['type']['ruta_documento']=='application/pdf'){

				echo "entro en if";
				//exit();

				$name=time()."-".$_FILES['Documentos']['name']['ruta_documento'];

				//move_uploaded_file ($_FILES['documento']['tmp_name'] , '../img/upload/'.$_FILES['documento']['name']);
				move_uploaded_file ($_FILES['Documentos']['tmp_name']['ruta_documento'] , Yii::getPathOfAlias("webroot").'/uploads/'.date('Y').'/'.$name);

				$model->ruta_documento=$name;
			}
			else{
       				$model->ruta_documento='';

       				echo "entro en else";
					//exit();
	            }


				/*if(isset($_FILES["Documentos"])){

				//print_r ($_FILES["Documentos"]['size']['ruta_documento']);
					//$model->fecha=date('Y-m-d', CDateTimeParser::parse($model->fecha, Yii::app()->locale->dateFormat));
 				
	            	//exit();

				//exit();	
					
				if ($_FILES["Documentos"]['size']['ruta_documento']!=0) {
					
			        //Instanciamos el subidor para el campo fichero del formulario
			        $file=CUploadedFile::getInstance($model,"ruta_documento");
			            
			                //echo "-----> ".$file->getExtensionName();
			                //exit();

			            //Nombre del fichero
			            $name=time()."-".$file->getName();
			            if($file->getExtensionName()=="pdf"){     
			                $gestion=date('Y');




			                $file->saveAs(Yii::getPathOfAlias("webroot")."/uploads/".$gestion."/".$name);
			                // codigo para almacenar la ruta del documento
		       				$model->ruta_documento=$name;
			            }else{
			            	// codigo para almacenar la ruta del documento
		       				$model->ruta_documento='null';
			                //Crear mensaje flash
			                //Yii::app()->user->setFlash('mensaje','Solo ficheros PDF');
			                //Refrescamos pantalla
			                //$this->refresh();
			            }

		        	}
		        	else
		        	{
		        		$model->ruta_documento=$_POST['Documentos']['fk_documento'];
		        		$model->fk_documento=0;

		        		//echo "error";
		        		//exit();

		        	} //if ($_FILES["Documentos"]['size']['ruta_documento']!=0) {





	       		}// fin files   */

	       //	}//if ($_POST['Documentos']['ruta_documento']!=null 	





			if($model->save()){
				//Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCartaExterna','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		$this->render('updateCartaExterna',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}


	public function actionCreateCircular($tipo)
	{
		// codigo para verificar si el usuario cuenta con destinatarios
		// el la lista de derivacion
		if (Documentos::getCountUserDerivacion()<=0) {
			
			Documentos::mensajeDocumento();	
			$this->redirect(array('site/menuDocumentos'));
		}
		//################################################

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];

			if ($model->fk_estado_documento==1 && Documentos::getNumeroReservados()<15)
			  {
				
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion='null';
				$model->remitente_nombres='null';
				$model->remitente_cargo='null';
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
				
				$model->codigo=0;
			}
			else{
				$model->usuario_destino=$_POST['Documentos']['usuario_destino'];
				$model->grupo_destino=$_POST['Documentos']['grupo_destino'];
				$model->nombre_grupo=$_POST['Documentos']['nombre_grupo'];

				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->gestion=date('Y');
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;
				$model->destinatario_titulo='null';
				$model->destinatario_institucion='null';
				$model->remitente_institucion='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				$model->ruta_documento='null';
				$model->codigo=0;
			}

			

			if ($model->validate()) {

				$gestion=date('Y');
				$area=Yii::app()->user->id_area;
				$tipoDoc=5;
				$regional=Yii::app()->user->regional;

				$model->codigo=Documentos::getCodigo($gestion,$area,$tipoDoc,$regional);

				if($model->save()){
					$this->redirect(array('updateCircular','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
				}//if($model->save()){
			}//if ($model->validate()) {
		}

		$this->render('createCircular',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateCircular($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
			$model->destinatario_institucion='null';
			//$model->nombre_grupo=$_POST['Documentos']['nombre_grupo'];
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCircular','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		
		$this->render('updateCircular',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateCircularUser($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			$model->destinatario_titulo='null';
			$model->destinatario_institucion='null';
			//$model->nombre_grupo=$_POST['Documentos']['nombre_grupo'];
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCircularUser','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		
		$this->render('updateCircularUser',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}




	public function actionUpdateCircularFormDraft($id,$tipo)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			$model->remitente_institucion='null';
			$model->nombre_grupo='null';
			$model->ruta_documento='null';
			//$model->nombre_grupo=$_POST['Documentos']['nombre_grupo'];
			if($model->save()){
				Documentos::mensajeUpdate($model->codigo);
				$this->redirect(array('updateCircularFormDraft','id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			Documentos::mensajeErrorUpdate($model->codigo);
		}

		
		$this->render('updateCircularFormDraft',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	public function actionUpdateCircularDraft()
	{

		$model=new Documentos;

		$usuario=Yii::app()->user->id_usuario;

		$model=$this->loadModel($_POST['id_documento']);

		//$model->destinatario_cargo = strtoupper($model->destinatario_cargo);
		$model->destinatario_nombres=trim($_POST['destinatario_nombres']);
		$model->destinatario_cargo=trim($_POST['destinatario_cargo']);;
				
		$model->remitente_nombres=trim($_POST['remitente_nombres']);
		$model->remitente_cargo=trim($_POST['remitente_cargo']);

				
		$model->referencia=trim($_POST['referencia']);
		$model->contenido=trim($_POST['contenido']);
		$model->adjuntos=trim($_POST['adjuntos']);
		$model->copias=trim($_POST['copias']);
				
		if($model->save()){
		//Documentos::mensajeCreateDraft();

		}//if($model->save()){
		else{	
			Documentos::mensajeErrorCreate();
		}	
		

	}


	public function actionObservadosGestion()
	{
		$dataReader=Documentos::getDocumentosGestion();

		$this->render('observadosGestion',array(
			'dataReader'=>$dataReader,
		));
	}



	public function actionViewCartaPDF()
      {
          //$filename = $_GET['filename'] . '.pdf';
          $filename = $_GET['filename'];
          $filepath = Yii::getPathOfAlias("webroot").'/uploads/'.date('Y').'/'.$filename;

          if(file_exists($filepath))
          {
              // Set up PDF headers
              header('Content-type: application/pdf');
              header('Content-Disposition: inline; filename="'.$filename.'"');
              header('Content-Transfer-Encoding: binary');
              header('Content-Length: ' . filesize($filepath));
              header('Accept-Ranges: bytes');

              // Render the file
              readfile($filepath);
          }
          else
          {
             // PDF doesn't exist so throw an error or something
          	
          	echo "<br>Archivo PDF no encontrado, por favor verifique la informaci&oacute;n  registrada";
          }
      }


	public function actionAsignarNuri($id_documento)
	{
		$usuario=Yii::app()->user->id_usuario;	
		
		$model=$this->loadModel($id_documento);

		$gestion=date('Y');
		//$area=Yii::app()->user->id_area;
		$tipoDoc=6;
		//$regional=Yii::app()->user->regional;
		$nuri=Documentos::getNuri($gestion,$tipoDoc);

		$hojas= new HojasRuta();
		$hojas->nur=$nuri;
		$hojas->codigo=$model->codigo;
		$hojas->nro=0;
		$hojas->fecha=date('Y-m-d');
		$hojas->hora=date('H:i:s');
		$hojas->proceso=4;
		$hojas->fecha_registro=date('Y-m-d');
		$hojas->hora_registro=date('H:i:s');
		$hojas->fk_usuario=$usuario;
		$hojas->gestion=$gestion;
		$hojas->fk_documento=$id_documento;
		$hojas->oficial=1;
		//$hojas->save();

		switch ($model->fk_tipo_documento) {
					    case 1:
					        $direccion='updateInforme';
					        break;
					    case 2:
					        $direccion='updateNota';
					        break;
					    case 3:
					        $direccion='updateMemorandum';
					        break;
					    case 4:
					        $direccion='updateCarta';
					        break;
					    case 5:
					        $direccion='updateCircular';
					        break;
					    case 8:
					        $direccion='updateInstructivo';
					        break;            
					}

			


				//echo "---> ".$direccion;

		if($hojas->insert()){
				// codigo para cambiar el estado del documento a disponible
				$documentos=Documentos::model()->findByPk($id_documento);
				$documentos->fk_estado_documento=2;
				$documentos->save();

				$this->redirect(array($direccion,'id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			else{
				print_r($hojas->getErrors());
			}
		
	}


	public function actionDeleteNuriAsociacion($id_hoja_ruta, $id_documento)
	{
		$usuario=Yii::app()->user->id_usuario;	
		
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

		if (Documentos::getNumeroNurisAsociados($hojasruta->nur)==1) {
			
			$hojasruta->activo=1;
			// codigo para mostrar mensaje 
			Documentos::mensajeEliminarDocumento($hojasruta->nur);
		}
		else{
			// codigo para dar de baja la asociacion de NURI con CITE
			$hojasruta->activo=0;
			$documentos=Documentos::model()->findByPk($id_documento);
			$documentos->fk_estado_documento=5;
			$documentos->save();
		}

		
		$model=$this->loadModel($id_documento);

		switch ($model->fk_tipo_documento) {
					    case 1:
					        $direccion='updateInforme';
					        break;
					    case 2:
					        $direccion='updateNota';
					        break;
					    case 3:
					        $direccion='updateMemorandum';
					        break;
					    case 4:
					        $direccion='updateCarta';
					        break;
					    case 5:
					        $direccion='updateCircular';
					        break;
					    case 8:
					        $direccion='updateInstructivo';
					        break;            
					}

			


				//echo "---> ".$direccion;

		if($hojasruta->save()){
				$this->redirect(array($direccion,'id'=>$model->id_documento,'tipo'=>$model->fk_tipo_documento));
			}
			else{
				print_r($hojasruta->getErrors());
			}
		
	}

	public function actionAsignarNuriPendiente($id_documento)
	{

		$model=new HojasRuta;
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojasRuta']))
		{
			$model->attributes=$_POST['HojasRuta'];
			
			$seguimientos=Seguimientos::model()->findByPk($_POST['HojasRuta']['nro']);

			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');

			$model->gestion=date('Y');
			$model->fecha=date('Y-m-d');
			$model->hora=date('H:i:s');
			$model->fk_usuario=Yii::app()->user->id_usuario;
			$model->proceso=4;
			$model->oficial=$seguimientos->oficial;
			$model->nur=$seguimientos->codigo;
			$model->nur=trim($model->nur);


			
			
			// codigo para dar de baja al anterior alias asigando
			//Alias::updateAlias($id_documento);

			if ($model->validate()) 
			{
				if($model->save())
				{	
					// codigo para cambiar el estado del documento a disponible
					$documentos=Documentos::model()->findByPk($id_documento);
					$documentos->fk_estado_documento=2;
					$documentos->save();	

					//echo "<script>location.reload();</script>";

					if (Yii::app()->request->isAjaxRequest)
					{
						echo CJSON::encode(array(
							'status'=>'success', 
							'div'=>"Informacion Almacenada Correctamente"
							));
						//echo "<script>location.reload();</script>";

				
						exit;				
					}
					else{
						$this->redirect(array('view','id'=>$model->hoja_ruta));
					}
				}
			}//if ($model->validate()) 
		}// fin alias
		
		if (Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				'status'=>'failure', 
				'div'=>$this->renderPartial('asignarNuriPendiente', array('model'=>$model, 'id_documento'=>$id_documento), true)));
			exit;				
		}
		else
			$this->render('asignarNuriPendiente',array('model'=>$model, 'id_documento'=>$id_documento));

	} // fin function

	public function actionAsignarNuriCreado($id_documento)
	{

		$model=new HojasRuta;
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojasRuta']))
		{
			$model->attributes=$_POST['HojasRuta'];
			
			//$hojasruta=HojasRuta::model()->findByPk($_POST['HojasRuta']['nro']);

			$model->fecha_registro=date('Y-m-d');
			$model->hora_registro=date('H:i:s');

			$model->gestion=date('Y');
			$model->fecha=date('Y-m-d');
			$model->hora=date('H:i:s');
			$model->fk_usuario=Yii::app()->user->id_usuario;
			$model->proceso=4;
			$model->oficial=1;
			$model->nur=$_POST['HojasRuta']['nro'];
			$model->nro=0;
			$model->nur=trim($model->nur);


			
			
			// codigo para dar de baja al anterior alias asigando
			//Alias::updateAlias($id_documento);

			if ($model->validate()) 
			{
				if($model->save())
				{
					// codigo para cambiar el estado del documento a disponible
					$documentos=Documentos::model()->findByPk($id_documento);
					$documentos->fk_estado_documento=2;
					$documentos->save();		

					//echo "<script>location.reload();</script>";

					if (Yii::app()->request->isAjaxRequest)
					{
						echo CJSON::encode(array(
							'status'=>'success', 
							'div'=>"Informacion Almacenada Correctamente"
							));
						//echo "<script>location.reload();</script>";

				
						exit;				
					}
					else{
						$this->redirect(array('view','id'=>$model->hoja_ruta));
					}
				}
			}//if ($model->validate()) 
		}// fin alias
		
		if (Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				'status'=>'failure', 
				'div'=>$this->renderPartial('asignarNuriCreado', array('model'=>$model, 'id_documento'=>$id_documento), true)));
			exit;				
		}
		else
			$this->render('asignarNuriCreado',array('model'=>$model, 'id_documento'=>$id_documento));

	} // fin function


	public function actionGenerarDocumentoPDF($id_documento,$id_hoja_ruta)
	{
		

        /*$this->render('documentoPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));

        exit();*/


        /*$pdffilename = 'test.pdf';
        $html2pdf = Yii::app()->ePdf->Html2Pdf();
        $html2pdf->WriteHTML($this->renderPartial('documentoPDF', array('documentos'=>$documentos,
           'hojasruta'=>$hojasruta,), true));
        ob_clean();
        $html2pdf->Output($pdffilename,"I"); // OUTPUT_TO_BROWSER*/

        
        $documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        $header='

        
		<table width="100%" align="center" style="top: 1mm; left:1mm;">
			<tr>
				<td width="30%"><img src="'.Yii::app()->request->baseUrl.'/images/logo_abc3.png" width="110px" height="130px" /></td>
				<td width="40%"><h2><u></u></h2></td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';

		if ($documentos->adjuntos!='') {
			$adjuntos='Adj.: '.$documentos->adjuntos;
		}
		else{ $adjuntos='';}

		if ($documentos->copias!='') {
			$copias='C.C.: '.$documentos->copias;
		}
		else{ $copias='';}

		$footer='
		<table width="100%" align="center" border="1px">
			<tr>
				<td width="20%"><img src="'.Yii::app()->request->baseUrl.'/images/logo_pie.png"/></td>
				<td width="80%" style="text-align:left;" valign="bottom" >
					<i style="font-size:9px;">'.$documentos->fkUsuario->mosca.'</i><br>
					<i style="font-size:7px;">'.$adjuntos.'</i><br>
					<i style="font-size:7px;">'.$copias.'</i></td>
				<td width="30%" style="text-align:right; font-size:8px;" valign="bottom">Página {PAGENO}/{nbpg}</td>
			</tr>
			</tr>
		</table>
		';



        $mPDF1 = Yii::app()->ePdf->mpdf();

        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',5,25,30,31);
		
       // $mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetHTMLFooter($footer);



        //$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

		//$mPDF1->SetWatermarkImage(Yii::app()->request->baseUrl.'/images/hojas_apiladas.jpg', 1, '', array(110,10));
		//$mPDF1->showWatermarkImage = true;



        $mPDF1->WriteHTML($this->renderPartial('documentoPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('documento.pdf','D');
		exit; 



	}



	public function actionGenerarDocumentoWORD($id_documento,$id_hoja_ruta)
	{

		if ($id_hoja_ruta=='') {
			$id_hoja_ruta=0;
		}
		$documentos=$this->loadModel($id_documento);
		//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        $this->render('documentoWORD', array(
           'documentos'=>$documentos,
           'id_hoja_ruta'=>$id_hoja_ruta,
           //'hojasruta'=>$hojasruta,
        ));


       exit();
	}

	public function actionGenerarMembretadoWORD()
	{
        $this->render('membretadoWORD');
       exit();
	}

	public function actionGenerarCartaWORD($id_documento,$id_hoja_ruta)
	{
		if ($id_hoja_ruta=='') {
			$id_hoja_ruta=0;
		}

		$documentos=$this->loadModel($id_documento);
		//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        $this->render('cartaWORD', array(
           'documentos'=>$documentos,
           'id_hoja_ruta'=>$id_hoja_ruta,
           //'hojasruta'=>$hojasruta,
        ));


       exit();
	}

	public function actionGenerarMemorandumWORD($id_documento,$id_hoja_ruta)
	//public function actionGenerarMemorandumWORD($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		if ($id_hoja_ruta=='') {
			$id_hoja_ruta=0;
		}
		//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        $this->render('memorandumWORD', array(
           'documentos'=>$documentos,
           'id_hoja_ruta'=>$id_hoja_ruta,
           //'hojasruta'=>$hojasruta,
        ));


       exit();
	}


	public function actionGenerarInstructivoWORD($id_documento,$id_hoja_ruta)
	//public function actionGenerarMemorandumWORD($id_documento,$id_hoja_ruta)
	{
		if ($id_hoja_ruta=='') {
			$id_hoja_ruta=0;
		}

		$documentos=$this->loadModel($id_documento);
		//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        $this->render('instructivoWORD', array(
           'documentos'=>$documentos,
           'id_hoja_ruta'=>$id_hoja_ruta,
           //'hojasruta'=>$hojasruta,
        ));


       exit();
	}


	

	

	public function actionGenerarCartaPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        /*$this->render('documentoCartaPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));

        exit();*/


        $header='

        
		<table width="100%" align="center" style="top: 1mm; left:1mm;">
			<tr>
				<td width="30%"></td>
				<td width="40%"><h2><u></u></h2></td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';

		if ($documentos->adjuntos!='') {
			$adjuntos='Adj.: '.$documentos->adjuntos;
		}
		else{ $adjuntos='';}


		$footer='
		<table width="100%" align="center" border="1px">
			<tr>
				<td width="10%" style="font-size:8px;">'.$hojasruta->nur.'</td>
				<td width="60%"style="text-align:left;" >
					<i style="font-size:9px;">'.$documentos->fkUsuario->mosca.'</i><br>
					<i style="font-size:7px;">'.$adjuntos.'</i></td>
				<td width="30%" style="text-align:right; font-size:8px;" valign="bottom">Página {PAGENO}/{nbpg}</td>
			</tr>
			</tr>
		</table>
		';



        $mPDF1 = Yii::app()->ePdf->mpdf();

        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',5,25,30,31);
		
       // $mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetHTMLFooter($footer);



        //$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

		//$mPDF1->SetWatermarkImage(Yii::app()->request->baseUrl.'/images/hojas_apiladas.jpg', 1, '', array(110,10));
		//$mPDF1->showWatermarkImage = true;



        $mPDF1->WriteHTML($this->renderPartial('documentoCartaPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('carta.pdf','D');
		exit; 
	}


	public function actionGenerarCircularPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        /*$this->render('documentoCartaPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));

        exit();*/


        $header='

        
		<table width="100%" align="center" style="top: 1mm; left:1mm;">
			<tr>
				<td width="30%"></td>
				<td width="40%"><h2><u></u></h2></td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';

		if ($documentos->adjuntos!='') {
			$adjuntos='Adj.: '.$documentos->adjuntos;
		}
		else{ $adjuntos='';}

		$footer='
		<table width="100%" align="center" border="1px">
			<tr>
				<td width="10%" style="font-size:8px;">'.$hojasruta->nur.'</td>
				<td width="60%"style="text-align:left;" >
					<i style="font-size:9px;">'.$documentos->fkUsuario->mosca.'</i><br>
					<i style="font-size:7px;">'.$adjuntos.'</i></td>
				<td width="30%" style="text-align:right; font-size:8px;" valign="bottom">Página {PAGENO}/{nbpg}</td>
			</tr>
			</tr>
		</table>
		';



        $mPDF1 = Yii::app()->ePdf->mpdf();

        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',5,25,30,31);
		
       // $mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetHTMLFooter($footer);



        //$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

		//$mPDF1->SetWatermarkImage(Yii::app()->request->baseUrl.'/images/hojas_apiladas.jpg', 1, '', array(110,10));
		//$mPDF1->showWatermarkImage = true;



        $mPDF1->WriteHTML($this->renderPartial('documentoCircularPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('circular.pdf','D');
		exit; 
	}


	public function actionGenerarInstructivoPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        /*$this->render('documentoCartaPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));

        exit();*/


        $header='

        
		<table width="100%" align="center" style="top: 1mm; left:1mm;">
			<tr>
				<td width="30%"></td>
				<td width="40%"><h2><u></u></h2></td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';

		if ($documentos->adjuntos!='') {
			$adjuntos='Adj.: '.$documentos->adjuntos;
		}
		else{ $adjuntos='';}

		$footer='
		<table width="100%" align="center" border="1px">
			<tr>
				<td width="10%" style="font-size:8px;">'.$hojasruta->nur.'</td>
				<td width="60%"style="text-align:left;" >
					<i style="font-size:9px;">'.$documentos->fkUsuario->mosca.'</i><br>
					<i style="font-size:7px;">'.$adjuntos.'</i></td>
				<td width="30%" style="text-align:right; font-size:8px;" valign="bottom">Página {PAGENO}/{nbpg}</td>
			</tr>
			</tr>
		</table>
		';



        $mPDF1 = Yii::app()->ePdf->mpdf();

        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',5,25,30,31);
		
       // $mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetHTMLFooter($footer);



        //$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

		//$mPDF1->SetWatermarkImage(Yii::app()->request->baseUrl.'/images/hojas_apiladas.jpg', 1, '', array(110,10));
		//$mPDF1->showWatermarkImage = true;



        $mPDF1->WriteHTML($this->renderPartial('documentoInstructivoPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('circular.pdf','D');
		exit; 
	}


	public function actionGenerarMemorandumPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        /*$this->render('documentoMemorandumPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));

        exit();*/


        $header='

        
		<table width="100%" align="center" style="top: 1mm; left:1mm;">
			<tr>
				<td width="30%"></td>
				<td width="40%"><h2><u></u></h2></td>
				<td width="30%" align="center"></td>
			</tr>
			</tr>
		</table>
		
		';

		if ($documentos->adjuntos!='') {
			$adjuntos='Adj.: '.$documentos->adjuntos;
		}
		else{ $adjuntos='';}

//<td width="10%" style="font-size:8px;">'.$hojasruta->nur.'</td>
		$footer='
		<table width="100%" align="center" border="1px">
			<tr>
				
				<td width="60%"style="text-align:left;" >
					<i style="font-size:9px;">'.$documentos->fkUsuario->mosca.'</i><br>
					<i style="font-size:7px;">'.$adjuntos.'</i></td>
				<td width="30%" style="text-align:right; font-size:8px;" valign="bottom">Página {PAGENO}/{nbpg}</td>
			</tr>
			</tr>
		</table>
		';



        $mPDF1 = Yii::app()->ePdf->mpdf();

        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','',''izquierda,derecha,arriba,abajo);	
        //$mPDF1 = Yii::app()->ePdf->mpdf('', 'P-LETTER','','',5,5,1,1);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',5,25,30,31);
		
       // $mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');

		$mPDF1->SetHTMLHeader($header);
		$mPDF1->SetHTMLFooter($footer);



        //$mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

		//$mPDF1->SetWatermarkImage(Yii::app()->request->baseUrl.'/images/hojas_apiladas.jpg', 1, '', array(110,10));
		//$mPDF1->showWatermarkImage = true;



        $mPDF1->WriteHTML($this->renderPartial('documentoMemorandumPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('memorandum.pdf','D');
		exit; 
	}



	public function actionGenerarHsInternoCopiaPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

       /* $this->render('hsInternoPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));*/

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',8,8,10,12);
		
        $mPDF1->SetFooter('Copia Digital |'.$hojasruta->nur.' |SAC');

        $mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

        $mPDF1->WriteHTML($this->renderPartial('hsInternoCopiaPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('Copias-HS.pdf','I');
		exit;  
		
	}


	public function actionGenerarHsExternoCopiaPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

       /* $this->render('hsInternoPDF', array(
           'documentos'=>$documentos,
           'hojasruta'=>$hojasruta,
        ));*/

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',8,8,10,12);
		
        $mPDF1->SetFooter('Copia Digital |'.$hojasruta->nur.' |SAC');

        $mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

        $mPDF1->WriteHTML($this->renderPartial('hsExternoCopiaPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('Copias-HS.pdf','I');
		exit;  
		
	}

	public function actionGenerarHsInternoPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
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
        $mPDF1->Output('HS.pdf','I');
		exit;  
		
	}


	public function actionGenerarHsExternoPDF($id_documento,$id_hoja_ruta)
	{
		$documentos=$this->loadModel($id_documento);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        /*$this->render('hsExternoPDF', array(
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


        $mPDF1->WriteHTML($this->renderPartial('hsExternoPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('HS Externo.pdf','I');
		exit;  
		
	}

	public function actionGenerarHsInternoAdicionPDF($nur,$oficial)
	{
		//$documentos=$this->loadModel($id_documento);
		//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

		if ($oficial==1) {
			$valor='Original';
		}
		else{
			$valor='Copia Digital';
		}

        $mPDF1 = Yii::app()->ePdf->mpdf();

        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',8,8,15,12);
		
        //$mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SIACO');
        $mPDF1->SetHeader(' '.$valor.' |'.$nur.' | ABC');
        $mPDF1->SetFooter('Sistema de Correspondencia |  | ');

        $mPDF1->SetWatermarkText("SAC");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');


        $mPDF1->WriteHTML($this->renderPartial('hsInternoAdicionPDF','', true));
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('HS_adicion.pdf','D');
		exit;  
	}



	
	public function actionUpdateDocument($id_documento,$tipo_documento)
	{
		$usuario=Yii::app()->user->id_usuario;	
		
		switch ($tipo_documento) {
					    case 1:
					        $direccion='updateInforme';
					        break;
					    case 2:
					        $direccion='updateNota';
					        break;
					    case 3:
					        $direccion='updateMemorandum';
					        break;
					    case 4:
					        $direccion='updateCarta';
					        break;
					    case 5:
					        $direccion='updateCircular';
					        break;
					    case 7:
					        $direccion='updateCartaExterna';
					        break; 
					    case 8:
					        $direccion='updateInstructivo';
					        break;     
					}

			
		$this->redirect(array($direccion,'id'=>$id_documento,'tipo'=>$tipo_documento));

		
	}


	public function actionUpdateDocumentRespuesta($id_documento,$tipo_documento,$id_seguimiento)
	{
		$usuario=Yii::app()->user->id_usuario;	
		
		switch ($tipo_documento) {
					    case 1:
					        $direccion='updateInformeRespuesta';
					        break;
					    case 2:
					        $direccion='updateNotaRespuesta';
					        break;
					    case 4:
					        $direccion='updateCartaRespuesta';
					        break;
					}

			
		$this->redirect(array($direccion,'id'=>$id_documento,'tipo'=>$tipo_documento, 'id_seguimiento'=>$id_seguimiento));

		
	}

	public function actionUpdateDocumentDraft($id_documento,$tipo_documento)
	{
		$usuario=Yii::app()->user->id_usuario;	
		
		switch ($tipo_documento) {
					    case 1:
					        $direccion='updateInformeFormDraft';
					        break;
					    case 2:
					        $direccion='updateNotaFormDraft';
					        break;
					    case 3:
					        $direccion='updateMemorandumFormDraft';
					        break;
					    case 4:
					        $direccion='updateCartaFormDraft';
					        break;
					    case 5:
					        $direccion='updateCircularFormDraft';
					        break;
					    case 8:
					        $direccion='updateInstructivoFormDraft';
					        break;            
					}

		$this->redirect(array($direccion,'id'=>$id_documento,'tipo'=>$tipo_documento));			

					
	}

	
	public function actionObservarDocumento($id, $gestion){
		
		$documentos=Documentos::model()->findByPk($id);
		$documentos->observado=1;
		$cite=$documentos->codigo;
		
		if ($documentos->save()) {
			Documentos::documentoObservado($cite);
			$this->redirect(array('administracionAsignarObservados','gestion'=>$gestion));
		}
		

		
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Documentos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/*public function actionDocumentosSinNuri()
	{
		//$dataProvider=new CActiveDataProvider('Documentos');
		$this->render('documentosSinNuri');
	}*/

	/**
	 * Manages all models.
	 */
	public function actionAdminDocumentosRegionales()
	{
		$model=new Documentos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('adminDocumentosRegionales',array(
			'model'=>$model,
		));
	}

	public function actionAdmin()
	{
		$model=new Documentos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionAdministracionReservado()
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionReservado',array(
			'model'=>$model,
		));
	}

	public function actionAdministracionBorrador()
	{
		$model=new Documentos('searchReservado');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionBorrador',array(
			'model'=>$model,
		));
	}

	public function actionAdministracionObservados()
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionObservados',array(
			'model'=>$model,
		));
	}

	public function actionAdministracionAsignarObservados($gestion)
	{
		$model=new Documentos('searchGestion');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('adminAsignarObservados',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}

	public function actionAdministracionNota($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionNota',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}

	public function actionAdministracionInforme($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionInforme',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}

	public function actionAdministracionCircular($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionCircular',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}

	public function actionAdministracionCarta($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionCarta',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}


	public function actionAdministracionCartaExterna($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionCartaExterna',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}

	public function actionAdministracionMemorandum($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionMemorandum',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}


	public function actionAdministracionInstructivo($tipo_documento,$gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('administracionInstructivo',array(
			'model'=>$model,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}


	public function actionAdminCartaExterna()
	{
		$model=new Documentos('searchDocumento');
		
		$this->render('adminCartaExterna',array(
			'model'=>$model,
		));
	}

	public function actionViewDocumentMysql($id)
	{
		
		//$documentos=Documentos::model()->findByPk($id);
		$this->renderPartial('viewDocumentMysql',array('id'=>$id));
	}


	public function actionAdminCartaHistorico($tipo_documento)
	{
		$this->render('adminCartaHistorico',array(
			'tipo_documento'=>$tipo_documento,
		));
	}
	public function actionAdminNotaHistorico($tipo_documento)
	{
		$this->render('adminNotaHistorico',array(
			'tipo_documento'=>$tipo_documento,
		));
	}
	public function actionAdminInformeHistorico($tipo_documento)
	{
		$this->render('adminInformeHistorico',array(
			'tipo_documento'=>$tipo_documento,
		));
	}
	public function actionAdminMemorandumHistorico($tipo_documento)
	{
		$this->render('adminMemorandumHistorico',array(
			'tipo_documento'=>$tipo_documento,
		));
	}
	public function actionAdminCircularHistorico($tipo_documento)
	{
		$this->render('adminCircularHistorico',array(
			'tipo_documento'=>$tipo_documento,
		));
	}
	public function actionAdminInstructivoHistorico($tipo_documento)
	{
		$this->render('adminInstructivoHistorico',array(
			'tipo_documento'=>$tipo_documento,
		));
	}




	public function actionAdminSinDerivar()
	{
		$this->render('adminSinDerivar');
	}

	public function actionAdminSinNuri()
	{
		$this->render('adminSinNuri');
	}


	public function actionCitesGestion(){

		
		$areas=Areas::model()->findByPk(Yii::app()->user->id_area);
		$this->render('citesGestion',array(
			'areas'=>$areas,
		));
	}


	public function actionDocumentosGestion(){
		//$areas=Areas::model()->findByPk(Yii::app()->user->id_area);
		$this->render('documentosGestion',array(
		));
	}
	public function actionAdminDocumentosFecha($gestion)
	{
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('adminDocumentosFecha',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}


	public function actionCitesArea(){

		
		$areas=Areas::model()->findByPk(Yii::app()->user->id_area);
		$this->render('citesArea',array(
			'area'=>$areas,
		));
	}


	public function actionCitesAreaDetalle($id_area,$tipo_documento)
	{
		$areas=Areas::model()->findByPk($id_area);

		$gestion=date('Y');	
		$model=new Documentos('searchDocumento');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentos']))
			$model->attributes=$_GET['Documentos'];

		$this->render('citesAreaDetalle',array(
			'model'=>$model,
			'gestion'=>$gestion,
			'areas'=>$areas,
			'tipo_documento'=>$tipo_documento,
		));
	}


	public function actionCitesAreaDetalleReporte($id_area,$tipo_documento)
	{
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition: attachment;Filename=cites asignados.xls");

		$areas=Areas::model()->findByPk($id_area);
		$gestion=date('Y');	
		
		$this->renderPartial('citesAreaDetalleReporte',array(
			'gestion'=>$gestion,
			'areas'=>$areas,
			'tipo_documento'=>$tipo_documento,
		));
	}






	public function actionCitesAsignadosEXCEL($tipo_documento,$gestion){

		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition: attachment;Filename=cites asignados.xls");

		$areas=Areas::model()->findByPk(Yii::app()->user->id_area);
		$this->renderPartial('citesAsignadosWEB',array(
			'areas'=>$areas,
			'tipo_documento'=>$tipo_documento,
			'gestion'=>$gestion,
		));
	}


	public function actionAdminDocumentosGestion($gestion){

		
		$areas=Areas::model()->findByPk(Yii::app()->user->id_area);
		$this->render('adminDocumentosGestion',array(
			'gestion'=>$gestion,
		));
	}

	public function actionViewDocumentPendiente($id_documento)
	{
		
		//$seguimiento=Seguimientos::model()->findByPk($id_seguimiento);

		$documentos=$this->loadModel($id_documento);

		//$documentos=Documentos::model()->findByPk($user['fk_documento']);

		if (Yii::app()->request->isAjaxRequest)
	    {
	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('viewDocument', 
	            array(
	               
	               //'documentos'=>$this->loadModel($id),
	               'documentos'=>$documentos,

	               //'model'=>$this->loadModel($id),

	             ),false,true);
	        //js-code to open the dialog    
	          if (!empty($_GET['asDialog'])) 
	            echo CHtml::script('$("#dlg-address-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else{
	    	
		        $this->render('viewDocument', array(
		           'documentos'=>$documentos,
		         ));
	    }
	} 

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Documentos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Documentos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Documentos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documentos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	


/*#########################################################################*/
 //funciones para busqueda
    //BUSQUEDA CITES ESPECIFICO

	public function actionSearchEspecificaCite()
	{
		$model=new Documentos();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->fk_estado_documento=1;
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion='null';
				$model->remitente_nombres='null';
				$model->remitente_cargo='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				
				$model->referencia='null';
				$model->contenido='null';
				$model->adjuntos='null';
				$model->copias='null';
				$model->nro_hojas='null';
				$model->ruta_documento='null';				
				//$model->usuario_destino=0;
				//$model->grupo_destino=1;
				$model->nombre_grupo='null';	

				$model->codigo=trim($model->codigo);
				$model->fk_tipo_documento=trim($model->fk_tipo_documento);
				$model->gestion=trim($model->gestion);

			if($model->validate()){
				$this->redirect(array('resultSearchEspecificaCite','cite'=>$model->codigo,'tipo'=>$model->fk_tipo_documento,'gestion'=>$model->gestion));
			}
		}

		$this->render('searchEspecificaCite',array(
			'model'=>$model,
		));


	} //fin function

	public function actionResultSearchEspecificaCite($cite,$tipo,$gestion)
	{

		$this->render('resultSearchEspecificaCite',array(
			'cite'=>strtoupper($cite),
			'tipo'=>$tipo,
			'gestion'=>$gestion,
		));

	}
//BUSQUEDA POR REFERENCIA ESPECIFICO

	public function actionSearchEspecificaReferencia()
	{
		$model=new Documentos();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->fk_estado_documento=1;
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion='null';
				$model->remitente_nombres='null';
				$model->remitente_cargo='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				
				$model->codigo='null';
				$model->contenido='null';
				$model->adjuntos='null';
				$model->copias='null';
				$model->nro_hojas='null';
				$model->ruta_documento='null';				
				//$model->usuario_destino=0;
				//$model->grupo_destino=1;
				$model->nombre_grupo='null';	





			if($model->validate())
				$this->redirect(array('resultSearchEspecificaReferencia','referencia'=>$model->referencia,'tipo'=>$model->fk_tipo_documento,'gestion'=>$model->gestion));
		}

		$this->render('searchEspecificaReferencia',array(
			'model'=>$model,
		));


	} //fin function

	public function actionResultSearchEspecificaReferencia($referencia,$tipo,$gestion)
	{

		$this->render('resultSearchEspecificaReferencia',array(
			'referencia'=>strtolower($referencia),
			'tipo'=>$tipo,
			'gestion'=>$gestion,
		));

	}


//BUSQUEDA POR INSTITUCION REMITENTE

	public function actionSearchEspInstRemitente()
	{
		$model=new Documentos();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->fk_estado_documento=1;
				$model->fk_tipo_documento=7;
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				//$model->remitente_institucion='null';
				$model->remitente_nombres='null';
				$model->remitente_cargo='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				
				$model->referencia='null';
				$model->codigo='null';
				$model->contenido='null';
				$model->adjuntos='null';
				$model->copias='null';
				$model->nro_hojas='null';
				$model->ruta_documento='null';				
				//$model->usuario_destino=0;
				//$model->grupo_destino=1;
				$model->nombre_grupo='null';	





			if($model->validate())
				$this->redirect(array('resultsearchEspInstRemitente','remitente_institucion'=>$model->remitente_institucion,'tipo'=>$model->fk_tipo_documento,'gestion'=>$model->gestion));
		}

		$this->render('searchEspInstRemitente',array(
			'model'=>$model,
		));


	} //fin function

	public function actionResultsearchEspInstRemitente($remitente_institucion,$tipo,$gestion)
	{

		$this->render('resultsearchEspInstRemitente',array(
			'remitente_institucion'=>strtolower($remitente_institucion),
			'tipo'=>$tipo,
			'gestion'=>$gestion,
		));

	}

	//BUSQUEDA POR NOMBRE REMITENTE

	public function actionSearchEspNombreRemitente()
	{
		$model=new Documentos();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->fk_estado_documento=1;
				$model->fk_tipo_documento=7;
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion='null';
				//$model->remitente_nombres='null';
				$model->remitente_cargo='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				
				$model->referencia='null';
				$model->codigo='null';
				$model->contenido='null';
				$model->adjuntos='null';
				$model->copias='null';
				$model->nro_hojas='null';
				$model->ruta_documento='null';				
				//$model->usuario_destino=0;
				//$model->grupo_destino=1;
				$model->nombre_grupo='null';	





			if($model->validate())
				$this->redirect(array('resultsearchEspNombreRemitente','remitente_nombres'=>$model->remitente_nombres,'tipo'=>$model->fk_tipo_documento,'gestion'=>$model->gestion));
		}

		$this->render('searchEspNombreRemitente',array(
			'model'=>$model,
		));


	} //fin function

	public function actionResultsearchEspNombreRemitente($remitente_nombres,$tipo,$gestion)
	{

		$this->render('resultsearchEspNombreRemitente',array(
			'remitente_nombres'=>strtolower($remitente_nombres),
			'tipo'=>$tipo,
			'gestion'=>$gestion,
		));

	}


	//BUSQUEDA POR NOMBRE REMITENTE

	public function actionSearchEspSintesis()
	{
		$model=new Documentos();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentos']))
		{
			$model->attributes=$_POST['Documentos'];
			
				$model->fecha=date('Y-m-d');
				$model->hora=date('H:i:s');
				$model->fecha_registro=date('Y-m-d');
				$model->hora_registro=date('H:i:s');
				$model->fk_estado_documento=1;
				$model->fk_tipo_documento=7;
				$model->fk_usuario=Yii::app()->user->id_usuario;
				$model->fk_area=Yii::app()->user->id_area;

				$model->destinatario_titulo='null';
				$model->destinatario_nombres='null';
				$model->destinatario_cargo='null';
				$model->destinatario_institucion='null';
				
				$model->remitente_institucion='null';
				$model->remitente_nombres='null';
				$model->remitente_cargo='null';
				$model->via_nombres='null';
				$model->via_cargo='null';
				
				$model->referencia='null';
				$model->codigo='null';
				//$model->contenido='null';
				$model->adjuntos='null';
				$model->copias='null';
				$model->nro_hojas='null';
				$model->ruta_documento='null';				
				//$model->usuario_destino=0;
				//$model->grupo_destino=1;
				$model->nombre_grupo='null';	





			if($model->validate())
				$this->redirect(array('resultsearchEspSintesis','sintesis'=>$model->contenido,'tipo'=>$model->fk_tipo_documento,'gestion'=>$model->gestion));
		}

		$this->render('searchEspSintesis',array(
			'model'=>$model,
		));


	} //fin function

	public function actionResultsearchEspSintesis($sintesis,$tipo,$gestion)
	{

		$this->render('resultsearchEspSintesis',array(
			'sintesis'=>strtolower($sintesis),
			'tipo'=>$tipo,
			'gestion'=>$gestion,
		));

	}		
		




}
