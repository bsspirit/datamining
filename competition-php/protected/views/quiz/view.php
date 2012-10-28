<h1><?php echo $model->id . ':' .$model->title?></h1>
<div class="view">
	<?php echo $model->content;?>
</div>

<?php if(!empty($train)){?>
<div class="view">
	样本数据集:<br/>
	<?php echo $train[0]["data"];?>
</div>
<?php }?>

<div class="view">
	<a href="/quiz/submit?qid=<?php echo $model->id?>" target="_blank">我要做题</a>
</div>
