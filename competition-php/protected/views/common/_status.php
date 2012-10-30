<?php if(Yii::app()->user->checkaccess("admin") || Yii::app()->user->checkaccess("owner")){?>
<div class="row">
Status&nbsp;&nbsp;:&nbsp;&nbsp;
<a href="?status=PASS">PASS</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="?status=REJECT">REJECT</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="?status=WAIT">WAIT</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="?#">ALL</a>
</div>
<?php }?>