<?php
$this->breadcrumbs=array(
	'Quiz Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuizData', 'url'=>array('index')),
	array('label'=>'Create QuizData', 'url'=>array('create')),
	array('label'=>'View QuizData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuizData', 'url'=>array('admin')),
);
?>

<h1>Update QuizData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>