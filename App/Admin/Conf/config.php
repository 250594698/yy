<?php
return array(
	//'配置项'=>'配置值'
		'URL_HTML_SUFFIX'=>'html',            //网址后缀
		'TITLE' => 'Prosperity Industrial',  //网站标题
		'SESSION_AUTO_START' => true,
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'yy', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => '', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'yy_', // 数据库表前缀
		
		//'SHOW_PAGE_TRACE' =>true,
		'LANG_SWITCH_ON' => true,
		'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
		'DEFAULT_LANG' => 'zh-cn', // 默认语言
		//'DEFAULT_LANG' => 'en-us', // 默认语言
		'LANG_LIST'        => 'en-us,zh-cn', // 允许切换的语言列表 用逗号分隔
		'LANG_ID'        => '1,2', // 允许切换的语言ID列表,语言识别id,非本作者勿改动,此id关联双语言栏目添加
		'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
		
		//管理员识别id
		'adminId' => 1,
		//后台栏目配置
		'NAV' =>
		array(
				'Menu' => array(
						'Index'=>'Index',
						'News'=>'News',
						'Products'=>'Products',
						'Aboutus'=>'Aboutus',
						'ProductionProblem'=>'ProductionProblem',
						'ProductsCategory'=>'ProductsCategory',
						'Producer'=>'Producer',
						'Contactus'=>'Contactus',
						'FaultCategory'=>'FaultCategory',
						'Fault'=>'Fault',
						'Category' => 'Category',
						'News' => 'News',
						'Products' => 'Products',
						'Banners' => 'Banners',
		
				),
				'Configuration' => array(
						'Configuration' => 'Configuration',
						'Users' => 'Users'
				)
		),
		
		//邮件配置
		'MAIL_ADDRESS'=>'huge250594698@qq.com', // 邮箱地址
		'MAIL_SMTP'=>'smtp.126.com', // 邮箱SMTP服务器
		'MAIL_LOGINNAME'=>'huge250594698@qq.com', // 邮箱登录帐号
		'MAIL_PASSWORD'=>'huge1989.....', // 邮箱密码
		
		'AUTH_CONFIG'=>array(
				'AUTH_ON' => true, //认证开关
				'AUTH_TYPE' => 2, // 认证方式，1为时时认证；2为登录认证。
				'AUTH_GROUP' => 'yy_auth_group', //用户组数据表名
				'AUTH_GROUP_ACCESS' => 'yy_auth_group_access', //用户组明细表
				'AUTH_RULE' => 'yy_auth_rule', //权限规则表
				'AUTH_USER' => 'yy_admin'//用户信息表
		)
);