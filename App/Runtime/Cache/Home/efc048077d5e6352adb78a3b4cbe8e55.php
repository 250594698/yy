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
		<div id="main" class="pd4 mb50">
			<div class="breadcrumbs">
				<a href="index.html"><?php echo L('Home');?></a>
				&gt;
				<a href="#"><?php echo L('Product');?></a>
				&gt;
			<?php if(is_array($catename)): foreach($catename as $key=>$a): ?><span><?php echo ($a["categories_name"]); ?></span><?php endforeach; endif; ?>	
			</div>

			<div class="main_left2">
				<h2 class="columnTitle columnTitle2"><?php echo L('Product');?></h2>

				<ul class="columnList1 columnList2">
				<?php echo W('Cate/menuProducts');?>
				</ul>

				<div class="columnbase1 columnbase2"></div>
			</div>
            <?php if(is_array($faultShow)): foreach($faultShow as $key=>$v): ?><div class="main_right2">
				<div class="productBigImg">
					<div class="productName productName2">
						<!-- <span><?php echo ($v["fault_num"]); ?></span> -->
						<span><?php echo mb_substr($v['fault_name'],0,8,'utf-8'); ?></span>	
					</div>
				</div>

				<div class="mb12">
				<?php $lang=L('lang_id'); ?>
					<?php if($v['fault_img'] != ''): if($lang != '1'): ?><img src="/yy/Public/Uploads/<?php echo ($v["fault_img"]); ?>" alt="" /><?php else: ?><img src="/yy/Public/Uploads/<?php echo ($v["fault_img_en"]); ?>" alt="" /><?php endif; endif; ?>
				</div>

				<p class="explain"><?php echo L('fault cause');?></p>

				<p class="text pd-r40 l-h mb20"><?php echo ($v["fault_cause"]); ?></p>

				<p class="explain"><?php echo L('Counter Measure');?></p>
				<p class="text pd-r40 l-h">
				<?php echo ($v["fault_countermeasure"]); ?>
				</p>

			</div><?php endforeach; endif; ?>
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