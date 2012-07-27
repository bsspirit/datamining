<h1>竞赛题目列表</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'quiz-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		array(
			'name'=>'题目标题',
			'type' => 'raw',
			'value' => 'CHtml::link($data->title,Yii::app()->createUrl("quiz/view", array("id"=>$data->id)))'
		),
		array(
			'name'=>'正确/提交',
			'value'=>'($data->count!=0?($data->correct/$data->count*100):0)."%(".($data->correct)."/".($data->count).")"',
		),
		'create_date',
		array(
			'name'=>'结束时间',
			'value'=>'empty($data->end_date)?"无期限":$data->end_date',
		),
		array(
            'name'=>'发布者',
            'value'=>'$data->name',
        ),
	),
));


?>

