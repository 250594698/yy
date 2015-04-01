<?php
return array(
	//'配置项'=>'配置值'
		'LANG_SWITCH_ON' => true,   // 开启语言包功能
		'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
		'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
		'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
		//'SHOW_PAGE_TRACE' =>true,
		'URL_HTML_SUFFIX'=>'html',            //网址后缀
		//'URL_ROUTER_ON'   => true,   //开启路由
		//'URL_MODEL' => '2',
		
		
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'yy', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => '', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'yy_', // 数据库表前缀
);