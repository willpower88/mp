<?php $this->load->view('/templates/header') ?>
	<nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                <span id="userinfo"></span>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="/static/img/logo.jpg" height="100%" />
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="example-navbar-collapse">
                    <ul class="nav navbar-nav">
                         <li><a class="active icon-bar" href="/auth/manage">首页</a>
                        </li>
                        <li><a href="#">代理商管理</a>
                        </li>
                        <li><a href="#">销售线索管理</a>
                        </li>
                        <li><a href="#">用户管理</a>
                        </li>
                         <li><a href="#">任务管理</a>
                        </li>
                         <li><a href="#">财务管理</a>
                        </li>
                        <li><a href="/auth/manage/authManage">权限管理</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a>欢迎您,<span id='username'></span></a>
                        </li>
                        <li><a href="#">安全退出</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
           
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="active">
                        	<h2>优雅的 CodeIgniter</h2>
                        	CodeIgniter 是一个小巧但功能强大的 PHP 框架，作为一个简单而“优雅”的工具包，它可以为开发者们建立功能完善的 Web 应用程序。
                        </li>
                        </li>
                    </ol>

            </div>
        </div>
<script type="text/javascript">
	manage.getUserInfo();
</script>
<?php $this->load->view('/templates/footer') ?>