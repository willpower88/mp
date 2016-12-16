var manage = {
		urls:{
			userinfo:'/auth/adminUser/getAdminUser',
		},
		userId:0,
		branchLevel:0,
		userType:0,
		name:'',
		curUserType:0,
		login:function(){//登录
			var $loginForm = $('#loginForm');
			$loginForm.submit(function(event){
	            event.preventDefault();
				var form = this,
				usernameVal = form.username.value,
				passwordVal = form.password.value,
				U = util,
				errBox = $('#err-msg'); 		
				
				if(!U.reg.chinese(usernameVal)){
					errBox.html('请输入用户名').addClass('hint-important');
					return;	
				};
				if(!U.reg.chinese(passwordVal)){
					errBox.html('请输入密码').addClass('hint-important');
					return;	
				};
				
				$.ajax({
					type:form.method,
					url:form.action,
					data:$loginForm.serialize(),
					cache:false,
					dataType:'json',
					success:function(data){
						console.log(data);
						if(data.status == 'success'){
							//管理员首页
							location.href = '/auth/manage';
						}else{
							if(data.userdata.status == 0){
								errBox.html('该账号已被禁用').addClass('hint-important');
							}else{
								errBox.html('用户名或密码错误').addClass('hint-important');
							}
						}
					}
				});
			})		
		},
		
		getUserInfo : function() {
			$.ajax({
				url:this.urls.userinfo,
				dataType:'json',
				success:function(data){
					if(data.status == 'success'){
						$('#username').html(data.data.username);
					}
				}
			});
		}
		
		
};

