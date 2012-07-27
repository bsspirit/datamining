<h1>我的竞赛题目状态列表</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'quiz-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'运行ID',
			'value'=>'$data->id',
		),
		array(
			'name'=>'题目标题',
			'type' => 'raw',
			'value' => 'CHtml::link($data->title,Yii::app()->createUrl("quiz/view", array("id"=>$data->qid)))'
		),
		array(
			'name'=>'结果',
			'value'=>'$data->result',
		),
		array(
			'name'=>'状态',
			'value'=>'$data->status',
		),
		'create_date',
	),
));


?>

