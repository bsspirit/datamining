<?php 
class QuizService{

// 	public static $PATH_LOCAL_DATA="/home/conan/app/DataMining/competition-php/metadata/data/";
	public static $PATH_LOCAL_DATA="D:/workspace/datamining/competition-php/metadata/data/";
	public static $PATH_REMOTE_DATA="http://download.freemined.com/";

	public static $TYPE_TRAIN=0;
	public static $TYPE_TEST=1;
	public static $TYPE_RESULT=2;

	public static $FILE_TRAIN="train.csv";
	public static $FILE_TEST="test.csv";
	public static $FILE_RESULT="result.csv";

	/**
	 * 得到TrainSet
	 */
	public static function getQuizTrainSet($id){
		$sql = " SELECT id,qid,type,file,remote";
		$sql .= " FROM t_quiz_data";
		$sql .= " WHERE type=0 AND qid=".$id;

		$conn=Yii::app()->db;
		$command = $conn->createCommand($sql);
		$row=$command->queryRow();
		
		return $row;
	}

	/**
	 * 题目列表，通过DB视图解决
	 */
	public static function getQuizList($limit=0,$offset=0,$uid=null){
		$sql = " SELECT q.id,q.title,q.create_date,q.end_date,q.uid,u.name,if(sum(s.result),sum(s.result),0) as correct,count(s.id) as count";
		$sql .= " FROM t_quiz q";
		$sql .= " LEFT JOIN t_user u ON q.uid=u.id";
		$sql .= " LEFT JOIN t_quiz_submit s ON s.qid=q.id";
		if(!empty($uid)){
			$sql .= " WHERE q.uid=".$uid;
		}
		$sql .= " ORDER BY q.id ASC";

		$conn=Yii::app()->db;
		$command = $conn->createCommand($sql);
		$rows=$command->queryAll();

		return $rows;
	}

	/**
	 * 参赛者的做题列表，通过DB视图解决
	 */
	public static function getPlayerQuizList($uid){
		$sql = " SELECT s.id,s.qid,q.title,s.create_date,s.status,s.result";
		$sql .=" FROM t_quiz_submit s";
		$sql .=" LEFT JOIN t_quiz q ON s.qid=q.id";
		if(!empty($uid)){
			$sql .=" WHERE s.uid=".$uid;
		}
		$sql .= 'ORDER BY s.create_date DESC';

		$conn=Yii::app()->db;
		$command = $conn->createCommand($sql);
		$rows=$command->queryAll();

		return $rows;
	}
	
	public static function getSourceSelf($uid,$qid){
		$sql = " SELECT s.id,s.qid,q.title,s.lang,s.code,s.create_date,s.player_id,s.status,s.result";
		$sql .=" FROM t_quiz_submit s,t_quiz q";
		$sql .=" WHERE";
		$sql .=" s.player_id=".$uid;
		$sql .=" AND q.id=".$qid;
		$sql .=" AND s.qid=q.id";
		$sql .=" ORDER BY s.id DESC";
		
		$conn=Yii::app()->db;
		$command = $conn->createCommand($sql);
		$rows=$command->queryAll();
		return $rows;
	}
	
	public static function getDataSet($qid,$type){
		$sql = " select qid,type,file,remote";
		$sql .= " from t_quiz_data";
		$sql .= " where type=".$type." and qid=".$qid;
		
		$conn=Yii::app()->db;
		$command = $conn->createCommand($sql);
		$row=$command->queryRow();
		return $row;
	}
	
	public static function uploadDataSet($qid){
		if(isset($_FILES['train']) && !empty($_FILES['train']['name'])){
			$data=$_FILES['train'];
			$dir=QuizService::$PATH_LOCAL_DATA.$qid."/";
			FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_TRAIN);
		
			$quizData=new QuizData;
			$quizData->qid=$qid;
			$quizData->type=QuizService::$TYPE_TRAIN;
			$quizData->deleteAll('qid='.$quizData->qid.' AND type='.$quizData->type);
			
			$quizData->file=$dir.QuizService::$FILE_TRAIN;
			$quizData->remote=QuizService::$PATH_REMOTE_DATA.$qid."/".QuizService::$FILE_TRAIN;
			$quizData->save();
		}
		
		if(isset($_FILES['test']) && !empty($_FILES['test']['name'])){
			$data=$_FILES['test'];
			$dir=QuizService::$PATH_LOCAL_DATA.$qid."/";
			FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_TEST);
		
			$quizData=new QuizData;
			$quizData->qid=$qid;
			$quizData->type=QuizService::$TYPE_TEST;
			$quizData->deleteAll('qid='.$quizData->qid.' AND type='.$quizData->type);
			
			$quizData->file=$dir.QuizService::$FILE_TEST;
			$quizData->remote=QuizService::$PATH_REMOTE_DATA.$qid."/".QuizService::$FILE_TEST;
			$quizData->save();
		}
			
		if(isset($_FILES['result']) && !empty($_FILES['result']['name'])){
			$data=$_FILES['result'];
			$dir=QuizService::$PATH_LOCAL_DATA.$qid."/";
			FileService::upload($data['tmp_name'],$dir,QuizService::$FILE_RESULT);
				
			$quizData=new QuizData;
			$quizData->qid=$qid;
			$quizData->type=QuizService::$TYPE_RESULT;
			$quizData->deleteAll('qid='.$quizData->qid.' AND type='.$quizData->type);
			
			$quizData->file=$dir.QuizService::$FILE_RESULT;
			$quizData->remote=QuizService::$PATH_REMOTE_DATA.$qid."/".QuizService::$FILE_RESULT;
			$quizData->save();
		}
	}
}

?>