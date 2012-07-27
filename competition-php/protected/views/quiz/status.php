<h1>竞赛题目状态列表</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'quiz-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		array(
			'name'=>'题目标题',
			'type' => 'raw',
			'value' => 'CHtml::link($data->title,Yii::app()->createUrl("quiz/view", array("id"=>$data->qid)))'
		),
		'name',
		'result',
		'status',
		'lang',
		array(
			'name'=>'内存',
			'value'=>'512m',
		),
		array(
			'name'=>'运行时间',
			'value'=>'12500ms',
		),
		'code_length',
		'create_date',
	),
));


?>

