<?php
# 这些应用参数可以通过 GUI 维护
return array(
	# 显示页面头部,注意目前使用的是从数据库中取出的值
	'title'=>'MusicDream',
	# 管理员 Email,通常用于联系页面或错误页面,注意目前使用的是从数据库中取出的值
	'adminEmail'=>'webmaster@example.com',
	# 每页显示的文章数量,注意目前没有使用此属性
	'postsPerPage'=>10,
	# 显示在最新评论里的最大的评论数量,注意目前没有使用此属性
	'recentCommentCount'=>10,
	# 显示在标签云里的最大的标签数量,注意目前没有使用此属性
	'tagCloudCount'=>20,
	# 是否评论需要审核,注意目前没有使用此属性
	'commentNeedApproval'=>true,
	# 显示在页面底部的版权信息,注意目前没有使用此属性
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	# 站点的URL
	//'siteUrl'=>'http://localhost/musicdream/',
        #SMTP Section
        #smtp host
        'smtp_host'=>"smtp.gmail.com",
        #smtp port
        'smtp_port'=>465,
        #smtp Secure
        'smtp_secure'=>true,
        #smtp user
        'smtp_user'=>"dreamneverfall@gmail.com",
        #smtp password
        'smtp_password'=>"pass",

);