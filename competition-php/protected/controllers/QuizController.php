<?php

class QuizController extends Controller
{
	public $layout='//layouts/column2';
	
	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
					'actions'=>array('index','view'),//浏览列表，查看详细
					'users'=>array('*'),
			),
			array('allow',
					'actions'=>array('download','status'),//下载测试数据，查看题目状态
					'users'=>array('@'),
			),
			array('allow',
					"actions"=>array('submit','player','source'),//提交代码，我已完成的题目,源代码
					'roles'=>array('player'),
			),
			array('allow',
					"actions"=>array('create','update','owner'),//创建新题，我已发布的题目
					'roles'=>array('owner'),
			),
			array('allow',
					'actions'=>array('delete'),//删除题目
					'roles'=>array('admin'),
			),
			array('deny',
					'users'=>array('*'),
			),
		);
	}

	//所有人===============================================================
	public function actionIndex(){
		$dataProvider=new CActiveDataProvider('VQuiz');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionView($id){
		$quizData = QuizService::getQuizTrainSet($id);
		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'train'=>$quizData,
		));
	}
	
	//登陆用户===============================================================
	public function actionStatus(){
		$dataProvider=new CActiveDataProvider('VQuizStatus');
		$this->render('status',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionDownload(){
		
	}

	//player===============================================================
	public function actionPlayer(){
		$dataProvider=new CActiveDataProvider('VQuizStatus',array(
				'criteria' => array(
						'condition' => 'player_id='.Yii::app()->user->id
				),
				'pagination'=>array(
						'pageSize'=>50,
				),
		));
		
		$this->render('player',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionSubmit(){
		$submit=new QuizSubmit;
		$submit->qid=empty($_REQUEST["qid"])?'':$_REQUEST["qid"];
		$submit->player_id=Yii::app()->user->id;
		
		$this->performAjaxValidation($submit);
		if(isset($_POST['QuizSubmit']))
		{
			$submit->attributes=$_POST['QuizSubmit'];
			if($submit->save()){
				$this->redirect('/quiz/player');
			}
		}
		
		$this->render('submit',array(
				'model'=>$submit,
		));
	}
	
	public function actionSource($id){
		$submit=QuizSubmit::model()->findByPk($id);
		if($submit===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$this->render('source',array(
				'model'=>$submit,
		));
	}

	//owner===============================================================
	public function actionOwner(){
		$dataProvider=new CActiveDataProvider('VQuiz',array(
				'criteria' => array(
						'condition' => 'owner_id='.Yii::app()->user->id
				),
				'pagination'=>array(
						'pageSize'=>50,
				),
				'sort'=>array(
						'defaultOrder'=>'id DESC',
				),
				
		));
		
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionCreate(){
		$quiz=new Quiz;
		$quiz->owner_id=Yii::app()->user->id;

// 		$this->performAjaxValidation($quiz);

		if(isset($_POST['Quiz'])) {
			$quiz->attributes=$_POST['Quiz'];
			if(isset($_POST['content']))
				$quiz->content=$_POST['content'];
			
			if($quiz->save()){
				$qid=$quiz->id;
				if(isset($_POST['train'])){
					$quizData=new QuizData;
					$quizData->qid=$qid;
					$quizData->type=QuizService::$TYPE_TRAIN;
					$quizData->data=$_POST['train'];
					$quizData->save();
				}
				
				if(isset($_POST['test'])){
					$quizData=new QuizData;
					$quizData->qid=$qid;
					$quizData->type=QuizService::$TYPE_TEST;
					$quizData->data=$_POST['test'];
					$quizData->save();
				}
				
				if(isset($_POST['result'])){
					$quizData=new QuizData;
					$quizData->qid=$qid;
					$quizData->type=QuizService::$TYPE_RESULT;
					$quizData->data=$_POST['result'];
					$quizData->save();
				}
				
				$this->redirect(array('view','id'=>$qid));
			}
		}	
		
		$this->render('create',array(
				'model'=>$quiz,
		));
// 			if($model->save()){
// 				if(isset($_FILES['train'])){
// 					$data=$_FILES['train'];
// 					$dir=QuizService::$PATH_LOCAL_DATA.$model->id."/";
// 					FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_TRAIN);
					
// 					$quizData=new QuizData;
// 					$quizData->qid=$model->id;
// 					$quizData->type=QuizService::$TYPE_TRAIN;
// 					$quizData->local=$dir.QuizService::$FILE_TRAIN;
// 					$quizData->file=QuizService::$PATH_REMOTE_DATA.$model->id."/".QuizService::$FILE_TRAIN;
// 					$quizData->save();
// 				}

// 				if(isset($_FILES['test'])){
// 					$data=$_FILES['test'];
// 					$dir=QuizService::$PATH_LOCAL_DATA.$model->id."/";
// 					FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_TEST);
					
// 					$quizData=new QuizData;
// 					$quizData->qid=$model->id;
// 					$quizData->type=QuizService::$TYPE_TEST;
// 					$quizData->local=$dir.QuizService::$FILE_TEST;
// 					$quizData->file=QuizService::$PATH_REMOTE_DATA.$model->id."/".QuizService::$FILE_TEST;
// 					$quizData->save();
// 				}

// 				$this->redirect(array('view','id'=>$model->id));
// 			}

		
	}
	
	public function actionUpdate($id)	{
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);
		if(isset($_POST['Quiz']))		{
			$model->attributes=$_POST['Quiz'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	
	//admin===============================================================
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


	//util===============================================================
	public function loadModel($id){
		$model=Quiz::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='quiz-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}
