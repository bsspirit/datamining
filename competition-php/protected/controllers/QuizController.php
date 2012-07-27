<?php

class QuizController extends Controller
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
						'actions'=>array('index','status','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','download'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'users'=>array('admin'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}


	public function actionIndex(){
		$dataProvider=new CActiveDataProvider('VQuiz');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionStatus(){
		$dataProvider=new CActiveDataProvider('VQuizStatus');
		$this->render('status',array(
				'dataProvider'=>$dataProvider,
		));
	}



	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$quizData = QuizService::getQuizTrainSet($id);

		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'train'=>$quizData,
		));
	}

	public function actionCreate()
	{
		$model=new Quiz;
		$model->uid=2;

		$this->performAjaxValidation($model);

		if(isset($_POST['Quiz']))
		{
			$model->attributes=$_POST['Quiz'];
			if(isset($_POST['content']))
				$model->content=$_POST['content'];
				
			if($model->save()){
				if(isset($_FILES['train'])){
					$data=$_FILES['train'];
					$dir=QuizService::$PATH_LOCAL_DATA.$model->id."/";
					FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_TRAIN);
					
					$quizData=new QuizData;
					$quizData->qid=$model->id;
					$quizData->type=QuizService::$TYPE_TRAIN;
					$quizData->local=$dir.QuizService::$FILE_TRAIN;
					$quizData->file=QuizService::$PATH_REMOTE_DATA.$model->id."/".QuizService::$FILE_TRAIN;
					$quizData->save();
				}

				if(isset($_FILES['test'])){
					$data=$_FILES['test'];
					$dir=QuizService::$PATH_LOCAL_DATA.$model->id."/";
					FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_TEST);
					
					$quizData=new QuizData;
					$quizData->qid=$model->id;
					$quizData->type=QuizService::$TYPE_TEST;
					$quizData->local=$dir.QuizService::$FILE_TEST;
					$quizData->file=QuizService::$PATH_REMOTE_DATA.$model->id."/".QuizService::$FILE_TEST;
					$quizData->save();
				}

				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Quiz']))
		{
			$model->attributes=$_POST['Quiz'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Quiz('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Quiz']))
			$model->attributes=$_GET['Quiz'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Quiz::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='quiz-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
