<h1>我的竞赛题目状态列表</h1>

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
		array(
			'name'=>'源代码',
			'type' => 'raw',
			'value' => 'CHtml::link("查看",Yii::app()->createUrl("submit/source", array("id"=>$data->id)))'
		),
		'result',
		'status',
		'lang',
		array(
			'name'=>'内存',
			'value'=>'',
		),
		array(
			'name'=>'运行时间',
			'value'=>'',
		),
		'code_length',
		'create_date',
	),
));


?>

