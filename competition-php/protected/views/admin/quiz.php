<h1>题目管理</h1>

<?php include_once dirname(__FILE__).'/../common/_category.php';?>
<?php include_once dirname(__FILE__).'/../common/_status.php';?>

<script type="text/javascript">
	function quiz(obj){
		var qid = $(obj).attr('qid');
		var op = $(obj).attr('op');
		var path='/admin/'+op+'?qid='+qid
		$.ajax({
			  url: path,
			  success: function(obj){
				  if(obj==1){
					  location.reload();
				  } else {
					  alert("修改失败");
				  }
			  }
		});
	}
</script>
<?php

function quizs($status,$qid){
	$v ='<a href="javascript:void(0)" onclick="quiz(this)" qid="'.$qid.'" op="pass">通过</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
	$v .='<a href="javascript:void(0)" onclick="quiz(this)" qid="'.$qid.'" op="reject">拒绝  </a>&nbsp;&nbsp;|&nbsp;&nbsp;';
	$v .='<a href="javascript:void(0)" onclick="quiz(this)" qid="'.$qid.'" op="delete">删除</a>&nbsp;&nbsp;';
	return $v;
}

$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'quiz-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'id',
			array(
					'name'=>'Title',
					'type' => 'raw',
					'value' => 'CHtml::link($data->title,Yii::app()->createUrl("quiz/view", array("id"=>$data->id)))'
			),
			array(
					'name'=>'Category',
					'value' => 'Quiz::mappingCategory($data->category)',
			),
			'create_date',
			'owner_name',
			'status',
			array(
					'name'=>'操作',
					'type'=>'raw',
					'value'=>'quizs($data->status,$data->id)',
			),
		),
));

?>

