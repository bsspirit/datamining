<h1>用户角色管理</h1>
<script type="text/javascript">
	function role(obj){
		var uid = $(obj).attr('uid');
		var op = $(obj).attr('op');
		var type = $(obj).attr('type');
		var path='/admin/'+op+'?uid='+uid+'&type='+type;
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

function roles($roles,$uid){
	preg_match('/player/',$roles,$p);
	preg_match('/owner/',$roles,$o);
	
	$v='';
	if(sizeof($p)>0){ 
		$v = '<a href="javascript:void(0)" onclick="role(this)" uid="'.$uid.'" op="revoke" type="player">player</a>';
	}else{
		$v = '<a href="javascript:void(0)" onclick="role(this)" uid="'.$uid.'" op="assign" type="player">player</a>';
	}
	$v.='  |  ';
	if(sizeof($o)>0){ 
		$v .= '<a href="javascript:void(0)" onclick="role(this)" uid="'.$uid.'" op="revoke" type="owner">owner</a>';
	}else{
		$v .= '<a href="javascript:void(0)" onclick="role(this)" uid="'.$uid.'" op="assign" type="owner">owner</a>';
	}
	return $v;
}


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-role-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'name',
		'email',
		'role',
		'create_date',
		array(
			'name'=>'授权/取消',
			'type'=>'raw',
			'value'=>'roles($data->role,$data->id)'
		),
	),
));
?>

