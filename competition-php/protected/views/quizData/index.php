<?php
$this->breadcrumbs=array(
	'Quiz Datas',
);

$this->menu=array(
	array('label'=>'Create QuizData', 'url'=>array('create')),
	array('label'=>'Manage QuizData', 'url'=>array('admin')),
);
?>

<h1>Quiz Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
