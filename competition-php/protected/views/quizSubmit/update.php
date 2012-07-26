<?php
$this->breadcrumbs=array(
	'Quiz Submits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuizSubmit', 'url'=>array('index')),
	array('label'=>'Create QuizSubmit', 'url'=>array('create')),
	array('label'=>'View QuizSubmit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuizSubmit', 'url'=>array('admin')),
);
?>

<h1>Update QuizSubmit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>