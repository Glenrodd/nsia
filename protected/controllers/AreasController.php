<?php

class AreasController extends Controller
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
				'actions'=>array('create','update','adminPendientesAreas','pendientesAreaEXCEL','pendientesGeneralEXCEL','viewUserArea'),
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
		$model=new Areas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Areas']))
		{
			$model->attributes=$_POST['Areas'];
			$model->attributes = array_map('strtoupper',$model->attributes);



			//#############################################################
			//codigo para obtener el cite automaticamente
			if ($model->dependencia!=0) {
				$cite=Areas::getCite($model->dependencia);
				$model->cite=$cite."/".$model->sigla;
			}
			else{
				$model->cite=$model->sigla;	
				$model->dependencia=0;
			}
			//#############################################################

			if($model->save()){

				// codigo para generar los correlativos despues de crear el area
				Areas::generarCorrelativo($model->id_area, $model->fk_regional);

				$this->redirect(array('view','id'=>$model->id_area));
			}
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

		if(isset($_POST['Areas']))
		{
			$model->attributes=$_POST['Areas'];
			$model->attributes = array_map('strtoupper',$model->attributes);

			//#############################################################
			//codigo para obtener el cite y generarlo automaticamente
			// en la tabla correlativos
			if ($model->dependencia!=0) {
				$cite=Areas::getCite($model->dependencia);
				$model->cite=$cite."/".$model->sigla;
			}
			else{
				$model->cite=$model->sigla;
				$model->dependencia=0;	
			}
			//#############################################################

			if($model->save()){
				$this->redirect(array('view','id'=>$model->id_area));
			}
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

		$model=$this->loadModel($id);
		$model->activo=0;
		$model->save();


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Areas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Areas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Areas']))
			$model->attributes=$_GET['Areas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminPendientesAreas()
	{
		$model=new Areas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Areas']))
			$model->attributes=$_GET['Areas'];

		$this->render('adminPendientesAreas',array(
			'model'=>$model,
		));
	}

	public function actionPendientesAreaEXCEL($id_area)
	{
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition: attachment;Filename=Pendientes Area.xls");

		$model=$this->loadModel($id_area);
		$this->renderPartial('pendientesAreaEXCEL',array(
			'model'=>$model,
		));
	}

	public function actionPendientesGeneralEXCEL()
	{
		header("Content-type: application/vnd.ms-excel");
 		header("Content-Disposition: attachment;Filename=Pendientes Nacional.xls");

		//$model=$this->loadModel($id_area);
		$this->renderPartial('pendientesGeneralEXCEL');
	}


	public function actionViewUserArea($id_area)
	{
		//$documentos=Documentos::model()->findByPk($user['fk_documento']);

		if (Yii::app()->request->isAjaxRequest)
	    {
	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('viewUserArea', 
	            array(
	               
	               //'documentos'=>$this->loadModel($id),
	               'id_area'=>$id_area,

	               //'model'=>$this->loadModel($id),

	             ),false,true);
	        //js-code to open the dialog    
	          if (!empty($_GET['asDialog'])) 
	            echo CHtml::script('$("#dlg-address-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else{
	    	
		        $this->render('viewUserArea', array(
		           'id_area'=>$id_area,
		         ));
	    }
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Areas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Areas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Areas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='areas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
