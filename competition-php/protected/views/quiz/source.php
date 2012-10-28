<h1>查看源代码</h1>

<div class="form">

	<div class="row">
		题目编号：<?php echo $model->qid?>
	</div>

	<div class="row">
		编程语言：<?php echo $model->lang?>
	</div>

	<div class="row">
		源代码：<br/>
		<div class="code-r">
		<textarea rows="20" cols="70" name="code">
			<?php echo ($model->code)?>
		</textarea>
		</div>
	</div>
	
</div>
