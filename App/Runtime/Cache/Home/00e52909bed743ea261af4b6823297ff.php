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

		<!-- START OF BANNER -->
		<div id="banner">
			<div class="bannerImg">
				<img src="/yy/Public/imagesHome/banner.png" alt="" />
			</div>
		</div>
		<!-- END OF BANNER -->

		<!-- START OF MAIN -->
		<div id="main" class="mb50">
			<div class="main_left1">
				<div class="item">
					<div class="main_title1">
						<h2><?php echo L('Catalogues');?></h2>
						<a href="<?php echo U('Index/cateJump',array('model_id'=>2,'cateid'=>52));?>" class="more"><?php echo L('More');?></a>
					</div>
					<div class="productTable">
					<?php echo W('Cate/menusindexCatalogues');?>
					</div>
				</div>

				<div class="item">
					<div class="main_title1">
						<h2><?php echo L('Products');?></h2>
						<!--  <a href="<?php echo U('Index/cateJump',array('model_id'=>2,'cateid'=>27));?>" class="more"><?php echo L('More');?></a>-->
					</div>

					<div class="productList">
						<?php echo W('Cate/menuProductsindex');?>
					</div>
				</div>

				<div class="item">
					<div class="main_title1">
						<h2><?php echo L('Partnership');?></h2>
						<a href="<?php echo U('Index/cateJump',array('model_id'=>5,'cateid'=>49));?>" class="more"><?php echo L('More');?></a>
					</div>

					<div class="partnerList">
						<a href="http://www.polyplastics.com/" target="_blank"><img src="/yy/Public/imagesHome/partner1.png" alt="" /></a>
						<a href="http://www.chimeicorp.com/zh-tw/" target="_blank"><img src="/yy/Public/imagesHome/partner2.png" alt="" /></a>
						<a href="http://www.dupont.com/" target="_blank"><img src="/yy/Public/imagesHome/partner3.png" alt="" /></a>
						<a href="http://www.npc.com.tw/" target="_blank"><img src="/yy/Public/imagesHome/partner4.png" alt="" /></a>
						<a href="http://www.teijin.co.jp/" target="_blank"><img src="/yy/Public/imagesHome/partner5.png" alt="" /></a>
						<a href="http://www.akchem.com/" target="_blank"><img src="/yy/Public/imagesHome/partner6.png" alt="" /></a>
						<a href="http://www.m-ep.co.jp/" target="_blank"><img src="/yy/Public/imagesHome/partner7.png" alt="" /></a>
						<a href="http://www.plastics.bayer.com/" target="_blank"><img src="/yy/Public/imagesHome/partner8.png" alt="" /></a>
					</div>
				</div>
			</div>

			<div class="main_right1">
				<div class="sideBarTitle">
					<a href="<?php echo U('Index/cateJump',array('model_id'=>7,'cateid'=>54));?>"><img src="<?php if(L('lang_id') == 1): ?>/yy/Public/imagesHome/sideBarTitle_en.png<?php else: ?>/yy/Public/imagesHome/sideBarTitle.png<?php endif; ?>" alt="" /></a>
				</div>

				<div class="contact">
					<a href="index.php/Home/Index/cateJump/model_id/6/cateid/50"><div class="conTitle">
					   <?php echo L('ContactUs');?>
					</div></a>

					<p><?php echo L('addressshow');?></p>

					<div class="phone">
						<i></i>
						852-24928640
					</div>
				</div>

				<div class="item w290">
					<div class="main_title1" style="width:290px;">
						<h2><?php echo L('News');?></h2>
						<a href="<?php echo U('Index/cateJump',array('model_id'=>1,'cateid'=>26));?>" class="more"><?php echo L('More');?></a>
					</div>

					<div class="newList">
						<?php echo W('Cate/menuindex');?>
					</div>				
				</div>
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
	<script src="/yy/Public/jsHome/jquery-2.0.2.js"></script>
</body>
</html>