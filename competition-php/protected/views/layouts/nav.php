<ul id="yw2">
<li><a href="/quiz">Quiz</a></li>
<?php 
if(Yii::app()->user->isGuest){//游客
?>	
<li><a href="/site/login">Login</a></li>
<li><a href="/site/register">Register</a></li>
<?php 
} else {
	$auth=Yii::app()->authManager;
	$assignments=$auth->getAuthAssignments(Yii::app()->user->id);
	
	foreach($assignments as $assign){
		if($assign->getItemName() == 'player'){
?>
<li><a href="/quiz/status">Status</a></li>
<li><a href="/quiz/player">MyStatus</a></li>
<li><a href="/quiz/submit">Submit</a></li>
<?php
		}
		
		if($assign->getItemName() == 'owner'){
?>
<li><a href="/quiz/owner">MyProblems</a></li>
<li><a href="/quiz/create">Upload</a></li>
<?php 				
		}
		
		if($assign->getItemName() == 'admin'){
?>
<li><a href="/quiz/admin">题库</a></li>
<li><a href="/admin">管理后台</a></li>
<?php 
		}
	}
?>
<li><a href="/site/logout">Logout(<?php echo Yii::app()->user->name?>)</a></li>
<?php } ?>

<li><a href="/site/aboutus">AboutUs</a></li>
</ul>
