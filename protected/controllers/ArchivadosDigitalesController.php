<?php

class ArchivadosDigitalesController extends Controller
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
				'actions'=>array('create','update','archivoGestion','adminGestion','desarchivoCopiaGestion','administracionArchivo','VerDetalleNuri','desarchivoNuri'),
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
	public function actionCreate($id)
	{
		$model=new ArchivadosDigitales;
		$seguimientos=Seguimientos::model()->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ArchivadosDigitales']))
		{
			$model->attributes=$_POST['ArchivadosDigitales'];
			$model->fecha_archivo=date('Y-m-d');	
			$model->hora_archivo=date('H:i:s');	
			$model->fecha_registro=date('Y-m-d');	
			$model->hora_registro=date('H:i:s');	
			//$model->gestion=date('Y');	
			$model->lugar='Archivo '.$model->gestion;	
			$model->fk_usuario=Yii::app()->user->id_usuario;	

			
			if($model->save()){

				$seguimientos->fk_estado=6;
				if($seguimientos->save()){
					$this->redirect(array('seguimientos/adminDigitalesVcd'));
				}


			}
		}

		$this->render('create',array(
			'model'=>$model,
			'seguimientos'=>$seguimientos,
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

		if(isset($_POST['ArchivadosDigitales']))
		{
			$model->attributes=$_POST['ArchivadosDigitales'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_archivado_digital));
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ArchivadosDigitales');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionArchivoGestion()
	{
		$row=ArchivadosDigitales::getArchivoGestion();

		$this->render('archivoGestion',array(
			'row'=>$row,
		));
	}
	public function actionAdminGestion($gestion)
	{
		$model=new ArchivadosDigitales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArchivadosDigitales']))
			$model->attributes=$_GET['ArchivadosDigitales'];

		$this->render('adminGestion',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}


	public function actionDesarchivoCopiaGestion()
	{
		$row=ArchivadosDigitales::getArchivoGestion();

		$this->render('desarchivoCopiaGestion',array(
			'row'=>$row,
		));
	}
	public function actionAdministracionArchivo($gestion)
	{
		$model=new ArchivadosDigitales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArchivadosDigitales']))
			$model->attributes=$_GET['ArchivadosDigitales'];

		$this->render('administracionArchivo',array(
			'model'=>$model,
			'gestion'=>$gestion,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ArchivadosDigitales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArchivadosDigitales']))
			$model->attributes=$_GET['ArchivadosDigitales'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ArchivadosDigitales the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ArchivadosDigitales::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ArchivadosDigitales $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='archivados-digitales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionVerDetalleNuri($id){
	

		if (Yii::app()->request->isAjaxRequest)
	    {
	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('verDetalleNuri', 
	            array(
	               
	               'model'=>Seguimientos::model()->findByPk($id),
	               //'model'=>$this->loadModel($id),

	             ),false,true);
	        //js-code to open the dialog    
	          if (!empty($_GET['asDialog'])) 
	            echo CHtml::script('$("#dlg-address-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else{
	    	
		        $this->render('verDetalleNuri', array(
		           'model'=>$this->loadModel($id),
		         ));
	    }

	} // fun function

	public function actionDesarchivoNuri($id)
	{
		

		$model=$this->loadModel($id);
		$gestion=$model->gestion;

		// codigo para elilminar el registro de la tabla archivados_digitales
		$seguimientos=Seguimientos::model()->findByPk($model->fk_seguimiento);
		$seguimientos->fk_estado=2;
		$seguimientos->save();

		// codigo para cambiar el estado en la tabla seguimientos
		$model->activo=0;
		$model->save();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		
		$this->redirect(array('administracionArchivo','gestion'=>$gestion));
	}// fin function
}
