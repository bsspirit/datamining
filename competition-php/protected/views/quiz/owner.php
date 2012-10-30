<h1>竞赛题目列表</h1>

<?php include_once dirname(__FILE__).'/../common/_category.php';?>
<?php include_once dirname(__FILE__).'/../common/_status.php';?>

<?php 
function currectTotal($correct,$count){
	$label='0%(0/0)';
	if($count!=0){
		$label  =$correct/$count.'%';
		$label .='('.$correct.'/'.$count.')';
	}
	return $label;
}

function edit($qid,$status){
	$v = 'Edit';
	if($status!='PASS'){
		$v = '<a href="/quiz/update/'.$qid.'">Edit</a>';
	}
	return $v;
}

$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'quiz-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'id',
			array(
					'name'=>'Title',
					'type' => 'raw',
					'value' => 'CHtml::link($data->title,Yii::app()->createUrl("quiz/view", array("id"=>$data->id)))'
			),
			array(
					'name'=>'Category',
					'value' => 'Quiz::mappingCategory($data->category)',
			),
			'create_date',
// 			'owner_name',
			'status',
			array(
					'name'=>'Operation',
					'type' => 'raw',
					'value' => 'edit($data->id,$data->status)',
			),
		),
));


?>

