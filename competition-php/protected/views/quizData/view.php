<?php
$this->breadcrumbs=array(
	'Quiz Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QuizData', 'url'=>array('index')),
	array('label'=>'Create QuizData', 'url'=>array('create')),
	array('label'=>'Update QuizData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuizData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuizData', 'url'=>array('admin')),
);
?>

<h1>View QuizData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'qid',
		'type',
		'data',
		'create_date',
	),
)); ?>
