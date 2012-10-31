<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/my.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php include_once("nav.php");?>
	</div>
	<?php echo $content; ?>
	<div class="clear"></div>
	
	<div id="footer">
		<p><strong>友情链接:</strong> 
			<a href="http://dataguru.cn" target="_blank">炼数成金</a> &middot;
			<a href="http://cos.name" target="_blank">统计之都</a> &middot;
			<a href="http://weibo.com" target="_blank">新浪微博</a> &middot;  
			<a href="http://tongji.baidu.com/web/welcome/ico?s=3b87449b95360edaf1385792b8fdc9b2" target="_blank">百度统计</a> &middot;
		</p>
		<p>Copyright © bsspirit@gmail.com |
		   由 <a target="_blank" href="http://weibo.com/dotabook">@Conan_Z</a> 开发及运营 | 
		   作者的其他应用：<a href="http://www.fens.me" target="_blank">晒粉丝</a> &middot;
		   <!-- 
		   <a title="官方微博" target="_blank" href="http://weibo.com/fensme">官方微博 @fensme</a> |
		   <a href="javascript:void(0);" onclick="followus()">关注我们</a>
		    -->
		</p>
		<p>R语言数据建模竞赛平台，揭露数据分析的核心价值。</p>
	</div><!-- footer -->
</div><!-- page -->
	<div class="h">
		<script type="text/javascript" src="/js/baidu.js"></script>
	</div>
</body>
</html>
