<?php
$this->breadcrumbs=array(
	'Quiz Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuizData', 'url'=>array('index')),
	array('label'=>'Manage QuizData', 'url'=>array('admin')),
);
?>

<h1>Create QuizData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>