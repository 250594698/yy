<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="/yy/Public/cssHome/layout.css" />
	<link rel="stylesheet" href="/yy/Public/cssHome/style.css" />

	<link rel="stylesheet" href="/yy/Public/cssHome/base.css" />
	<script type="text/javascript" src="/yy/Public/jsHome/jquery-2.0.2.js"></script>  
</head>
<body>
	<!-- START OF CONTAINER -->
	<div id="container">
		<!-- START OF HEADER -->
		<div id="header">
			<div class="logo">
				<a href="index.html">
					<img src="/yy/Public/imagesHome/logo.png" alt="" />
				</a>
			</div>
			<div class="lang">
				<a href="?l=en-us" <?php if(L('lang_id') == 1): ?>style="color:#F00;"<?php endif; ?> >English</a>
				<a href="?l=zh-cn" <?php if(L('lang_id') == 2): ?>style="color:#F00;"<?php endif; ?>>中文</a>
			</div>
            <script>
            $(".lang a").click(function(){
				$(this).addClass();
			   //alert('你好');	
			});
            </script>			
		</div>
		<!-- END OF HEADER -->

		<!-- START OF NAV -->
		<div id="nav">
			<ul class="navList">
				<li>
					<a href="<?php echo U('Index/index');?>" class="<?php if($styles == 'nav_home'): ?>nav_home curr<?php else: ?>nav_home<?php endif; ?>"><?php echo L('Home');?></a>
				</li>
				<?php echo W('Cate/menu');?>
			</ul>
</script>
		</div>
		<!-- END OF NAV -->

		<!-- START OF MAIN -->
		<div id="main" class="mb460 pd4">
			<div class="breadcrumbs">
				<a href="index.html"><?php echo L('Home');?></a>
				&gt;
				<span><?php echo L('News');?>></span>
				<span><?php echo ($year); ?></span>
			</div>	

			<div class="main_left2">
				<h2 class="columnTitle">
					<?php echo L('News');?>
				</h2>
				<ul class="columnList1">
					<?php echo W('Cate/menu2');?>
				</ul>
				<div class="columnbase1"></div>
			</div>

			<div class="main_right2">
			<?php if(is_array($catename)): foreach($catename as $key=>$a): ?><h2 class="main_title2"><?php echo ($a["categories_name"]); ?></h2><?php endforeach; endif; ?>
				<ul class="infoList">
				<?php if(is_array($newsList)): foreach($newsList as $key=>$v): if(L('lang_id') == 1): ?><li><span class="infoTime"><?php echo (date('d M Y',strtotime($v["news_adddate"]))); ?></span>
					<?php else: ?><li><span class="infoTime"><?php echo (date('Y年m月d日',strtotime($v["news_adddate"]))); ?></span><?php endif; ?>
					<a href="<?php echo U('Index/cateShow',array('cate_id'=>$cate_id,'news_id'=>$v['news_id']));?>"><?php echo mb_substr($v['news_title'],0,46,'utf-8'); ?></a></li><?php endforeach; endif; ?>
				</ul>
				<div class="page"><?php echo ($page); ?></div>
			</div>
		</div>
		<!-- END OF MAIN -->
	</div>
	<!-- END OF CONTAINER -->
	
	<!-- START OF FOOTER -->
	<div id="footer">
		<div class="footerText">
			<p>Copyright &copy;2014 Prosperity Industrial (H.K.) Co., Ltd</p>
		</div>
	</div>
	<!-- END OF FOOTER -->
	<script src="js/jquery-2.0.2.js"></script>
</body>
</html>