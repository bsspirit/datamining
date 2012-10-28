<?php

class SubmitController extends Controller
{

	public function actionView($id)
	{
		$model=new QuizSubmit;
		$model->qid=$id;
		$model->player_id=3;
		
		$this->performAjaxValidation($model);
		if(isset($_POST['QuizSubmit']))
		{
			$model->attributes=$_POST['QuizSubmit'];
			if($model->save()){
				$this->redirect(array('index'));
			}
		}

		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionIndex(){
		$player_id=3;
		$dataProvider=new CActiveDataProvider('VQuizStatus',array(
             	'criteria' => array(
                	'condition' => 'player_id='.$player_id
             	),
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionSource($id){
		$this->render('source',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='quiz-submit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function loadModel($id)
	{
		$model=QuizSubmit::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}