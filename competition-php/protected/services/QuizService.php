<?php 
class QuizService{
	
	public static function getQuizTrainSet($id){
		$sql = " SELECT id,qid,type,file";
		$sql .= " FROM t_quiz_data";
		$sql .= " WHERE type=0 AND qid=".$id;
		
		$conn=Yii::app()->db;
		$command = $conn->createCommand($sql);
		$rows=$command->queryAll();
	
		return $rows;
	}
}

?>