<h1>提交程序</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quiz-form',
	'enableAjaxValidation'=>true,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		题目编号：
		<?php echo $form->textField($model,'qid'); ?>
	</div>

	<div class="row">
		编程语言：
		<select size="1" name="language" accesskey="l">
			<option value="1" selected>R</option>
		</select>
	</div>

	<div class="row">
		源代码：<br/>
		<?php echo $form->textArea($model,'code',array('rows'=>20, 'cols'=>70)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton("提交"); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
