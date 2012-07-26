<?php
$this->breadcrumbs=array(
	'Quiz Submits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QuizSubmit', 'url'=>array('index')),
	array('label'=>'Create QuizSubmit', 'url'=>array('create')),
	array('label'=>'Update QuizSubmit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuizSubmit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuizSubmit', 'url'=>array('admin')),
);
?>

<h1>View QuizSubmit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'qid',
		'lang',
		'code',
		'create_date',
		'uid',
		'status',
		'result',
	),
)); ?>
