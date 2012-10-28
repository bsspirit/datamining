<?php

class SiteController extends Controller
{
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

	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->homeUrl);

		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	// 	public function actionIndex()
	// 	{
	// 		$this->render('index');
	// 	}

	/**
	 * This is the action to handle external exceptions.
	 */


	/**
	 * Displays the contact page
	 */
	// 	public function actionContact()
	// 	{
	// 		$model=new ContactForm;
	// 		if(isset($_POST['ContactForm']))
	// 		{
	// 			$model->attributes=$_POST['ContactForm'];
	// 			if($model->validate())
	// 			{
	// 				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
	// 				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
	// 				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
	// 				$this->refresh();
	// 			}
	// 		}
	// 		$this->render('contact',array('model'=>$model));
	// 	}
}