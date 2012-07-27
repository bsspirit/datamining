<h1><?php echo $model->id . ':' .$model->title?></h1>
<div class="view">
	<?php echo $model->content;?>
</div>

<?php if(!empty($train)){?>
<div class="view">
	下载：<a href="<?php echo $train[0]["file"];?>">样本数据集</a>
</div>
<?php }?>

<div class="view">
	<a href="/submit/<?php echo $model->id?>" target="_blank">提交程序</a>
</div>
