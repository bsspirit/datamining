<h1>竞赛题目状态列表</h1>

<?php include_once dirname(__FILE__).'/../common/_category.php';?>

<?php 


function colorResult($result){
	$color = 'red';
	switch($result){
		case 'COMPILE':
		case 'INIT':
		case 'ERROR':
			$color = 'red';
			break;
		case 'CORRECT':
			$color = 'green';
			break;
		default:
			$color = 'blue';
			break;
	}
	$html = '<span style="color:'.$color.'">'.$result.'</span>';
	return $html;
}

function colorStatus($status){
	$color = 'red';
	switch($status){
		case 'INIT':
			$color = 'red';
			break;
		case 'RUNNING':
			$color = 'blue';
			break;
		case 'FINISH':
			$color = 'green';
			break;
	}
	$html = '<span style="color:'.$color.'">'.$status.'</span>';
	return $html;
}


$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'quiz-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
				'id',
				'qid',
				array(
						'name'=>'Title',
						'type' => 'raw',
						'value' => 'CHtml::link($data->title,Yii::app()->createUrl("quiz/view", array("id"=>$data->qid)))'
				),
				array(
						'name'=>'Result',
						'type' => 'raw',
						'value' => 'colorResult($data->result)',
				),
				array(
						'name'=>'Status',
						'type' => 'raw',
						'value' => 'colorStatus($data->status)',
				),
				array(
						'name'=>'Source',
						'type' => 'raw',
						'value' => 'CHtml::link("view",Yii::app()->createUrl("quiz/source", array("id"=>$data->id)))'
				),
				array(
						'name'=>'Category',
						'value' => 'Quiz::mappingCategory($data->category)',
				),
				'lang',
			// 		array(
			// 			'name'=>'Memory',
			// 			'value'=>'',
			// 		),
				array(
						'name'=>'Runtime',
						'value'=>'',
				),
				'code_length',
				'player_name',
				'create_date',
		),
));


?>

