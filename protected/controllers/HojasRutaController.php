<?php

class HojasRutaController extends Controller
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
				'actions'=>array('create','update','menuGestion','menuGestionExterno','adminGestion','adminGestionExterno','nurFechaExterno','administracionCartaExterna'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new HojasRuta;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojasRuta']))
		{
			$model->attributes=$_POST['HojasRuta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_hoja_ruta));
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

		if(isset($_POST['HojasRuta']))
		{
			$model->attributes=$_POST['HojasRuta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_hoja_ruta));
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
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('HojasRuta');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionNurFechaExterno()
	{
		$model=new HojasRuta;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojasRuta']))
		{
			$model->attributes=$_POST['HojasRuta'];
			
			$inicio=$_POST['HojasRuta']['fecha'];
			$fin=$_POST['HojasRuta']['fecha_registro'];
			//if($model->save())
			//$this->redirect(array('view','id'=>$model->id_hoja_ruta));

			$model->nur='123';
			$model->codigo='123';
			$model->nro='0';

			//$model->fecha=date('Y-m-d');
			//$model->fecha_registro=date('Y-m-d');
			$model->proceso=4;
			$model->hora_registro=date('H:i:s');
			$model->hora=date('H:i:s');
			$model->fk_usuario=1;
			$model->gestion=date('Y');

			if ($model->validate()) {
				

			//########################################################################################

			header("Content-type: application/vnd.ms-excel");
 			header("Content-Disposition: attachment;Filename=cites asignados.xls");

			$this->renderPartial('nurFechaExternoPDF',array(
				'fecha_inicio'=>$inicio,
				'fecha_fin'=>$fin,
				'usuarios'=>Usuarios::model()->findByPk(Yii::app()->user->id_usuario)
			));
			exit();


			/*$mPDF1 = Yii::app()->ePdf->mpdf();

	        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER');
			$mPDF1->SetHeader('ABC |Sistema de Administración Correspondencia| ');
			$mPDF1->SetFooter(' |Página {PAGENO}/{nbpg}|SAC');

			$mPDF1->SetWatermarkText("SAC");
			$mPDF1->showWatermarkText = true;
			$mPDF1->watermark_font = 'DejaVuSansCondensed';
			$mPDF1->watermarkTextAlpha = 0.1;
			$mPDF1->SetDisplayMode('fullpage');
	       
	        $mPDF1->WriteHTML($this->renderPartial('nurFechaExternoPDF', array(
	        	'fecha_inicio'=>$inicio,
				'fecha_fin'=>$fin,
				'usuarios'=>Usuarios::model()->findByPk(Yii::app()->user->id_usuario),), true));

	        $mPDF1->Output('Reporte Pendientes.pdf','D');
			exit;	 */
			//########################################################################################	
			} //if ($model->validate()) {
			
			
			/*$this->render('nurFechaExternoPDF',array(
			'fecha_inicio'=>$inicio,
			'fecha_fin'=>$fin,
			'usuarios'=>Usuarios::model()->findByPk(Yii::app()->user->id_usuario),

			));*/
		}

		$this->render('nurFechaExterno',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HojasRuta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HojasRuta']))
			$model->attributes=$_GET['HojasRuta'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminGestion($gestion)
	{
		$model=new HojasRuta('searchGestion');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HojasRuta']))
			$model->attributes=$_GET['HojasRuta'];

		$this->render('adminGestion',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}

	public function actionAdminGestionExterno($gestion)
	{
		$model=new HojasRuta('searchGestion');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HojasRuta']))
			$model->attributes=$_GET['HojasRuta'];

		$this->render('adminGestionExterno',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}

	public function actionAdministracionCartaExterna($gestion)
	{
		$model=new HojasRuta('searchGestion');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HojasRuta']))
			$model->attributes=$_GET['HojasRuta'];

		$this->render('administracionCartaExterna',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}

	public function actionMenuGestion()
	{
		$row=HojasRuta::getGestion();

		$this->render('menuGestion',array(
			'row'=>$row,
		));
	}

	public function actionMenuGestionExterno()
	{
		$row=HojasRuta::getGestion();

		$this->render('menuGestionExterno',array(
			'row'=>$row,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HojasRuta the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HojasRuta::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HojasRuta $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hojas-ruta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


}
