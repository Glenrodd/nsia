<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model=new Seguimientos;
		if(isset($_POST['Seguimientos']))
		{
			$model->attributes=$_POST['Seguimientos'];
			$nuri=$_POST['Seguimientos']['codigo'];
			//echo "-----> ".$nuri;

			exit();

			/*if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}*/
		}

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionMenuParametros()
	{
		$this->render('menuParametros');
	}

	public function actionMenuDocumentos()
	{
		$this->render('menuDocumentos');
	}

	public function actionMenuDerivaciones()
	{
		$this->render('menuDerivaciones');
	}
	public function actionMenuAdministracion()
	{
		$this->render('menuAdministracion');
	}

	public function actionMenuBusqueda()
	{
		$this->render('menuBusqueda');
	}

	public function actionMenuGestionDocumental()
	{
		$this->render('menuGestionDocumental');
	}

	public function actionMenuVentanillaRecepcion()
	{
		$this->render('menuVentanillaRecepcion');
	}


	public function actionBloqueoSistema()
	{
		// se pone renderPartial porque solo muestra una parte del view
		// entonces lo utilizamos para  para crear un menu dentro del archivo 
		// bloqueoSistema.php y que muestre sin enlaces	sin opciones
		$this->renderPartial('bloqueoSistema');
	}

	public function actionBloqueoSeguimiento($nuri)
	{
		// se pone renderPartial porque solo muestra una parte del view
		// entonces lo utilizamos para  para crear un menu dentro del archivo 
		// bloqueoSistema.php y que muestre sin enlaces	sin opciones
		$this->renderPartial('bloqueoSeguimiento', array('nuri'=>$nuri));
	}

	public function actionVideoTutor($nombre,$mensaje)
	{
		$this->render('videoTutor', array('nombre'=>$nombre,'mensaje'=>$mensaje));
	}

	
	public function actionReproducirVideo(){

		//$this->render('admin',array('model'=>$model,));
	     $this->render('video');

	     /*$this->renderPartial('video', 
	            array(
	               
	               'regional'=>$regional,
	               //'model'=>$this->loadModel($id),

	             ),false,true);*/

	}
}