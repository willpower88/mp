<?php $this->load->view('/templates/header') ?>
    <style>
        body{
            margin-left:auto;
            margin-right:auto;
            margin-TOP:100PX;
            width:20em;
        }
    </style>
	<form id="loginForm" role="form" action="/user/login/login"> 
	<!--下面是用户名输入框-->
	<div class="input-group">
  		<span class="input-group-addon" id="basic-addon1">@</span>
  		<input id="username" name="username" type="text" class="form-control" placeholder="用户名" aria-describedby="basic-addon1">
	</div>
	<br>
	<!--下面是密码输入框-->
	<div class="input-group">
  		<span class="input-group-addon" id="basic-addon1">@</span>
  		<input id="password" name="password" type="password" class="form-control" placeholder="密码" aria-describedby="basic-addon1">
	</div>
	<br>
	<!--下面是登陆按钮,包括颜色控制-->
	<button type="submit" style="width:280px;" class="btn btn-default">登 录</button>
		<span id="err-msg" ></span>
	</form>
	<script type="text/javascript">
		$("document").ready(function(){
			manage.login();
		});
		
		
	</script>

<?php $this->load->view('/templates/footer') ?>