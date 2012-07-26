<?php
$this->breadcrumbs=array(
	'Quiz Submits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuizSubmit', 'url'=>array('index')),
	array('label'=>'Manage QuizSubmit', 'url'=>array('admin')),
);
?>

<h1>Create QuizSubmit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>