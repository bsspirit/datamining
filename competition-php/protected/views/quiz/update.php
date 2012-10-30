<h1>创建一个竞赛题目</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quiz-form',
	'enableAjaxValidation'=>true,
	'stateful'=>true,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>32)); ?>
	</div>
	
	<div class="row">
		<span class="label">Category</span><br/>
		<?php echo Quiz::dropDownCategory($model->category)?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<textarea name="content" style="width:auto;height:300px;visibility:hidden;"><?php echo $model->content?></textarea>
	</div>

	<div class="box">
		<span style="color:blue;font-size:1.5em;">上传数据，csv格式文件,以逗号分隔</span>
	</div>
	
	<div class="row">
		<span class="label">Training Set</span><br/>
		<input type="file" name="train"/><br/>
		<?php if(!empty($train)){?>
		<span style="color:red">已上传:<a href="<?php echo $train["remote"]?>">train.csv</a></span><br/>
		<?php }?>
	</div>
	
	<div class="row">
		<span class="label">Testing Set</span><br/>
		<input type="file" name="test"/><br/>
		<?php if(!empty($test)){?>
		<span style="color:red">已上传:<a href="<?php echo $test["remote"]?>">test.csv</a></span><br/>
		<?php }?>
	</div>
	
	<div class="row">
		<span class="label">Result Set</span><br/>
		<input type="file" name="result"/><br/>
		<?php if(!empty($result)){?>
		<span style="color:red">已上传:<a href="<?php echo $result["remote"]?>">result.csv</a></span>
		<?php }?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<script src="/js/lib/kindeditor/kindeditor-min.js"></script>
<script src="/js/lib/kindeditor/zh_CN.js"></script>
<script type="text/javascript">
var editor_content;
var editor_desc;
KindEditor.ready(function(K) {
	editor_content = K.create('textarea[name="content"]', {
		//uploadJson : '/blog/upload',
		//fileManagerJson : 'manager',
		//allowFileManager : false
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', 'link']
	});
});
</script>