<?php
$this->breadcrumbs=array(
	'Quiz Submits',
);

$this->menu=array(
	array('label'=>'Create QuizSubmit', 'url'=>array('create')),
	array('label'=>'Manage QuizSubmit', 'url'=>array('admin')),
);
?>

<h1>Quiz Submits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
