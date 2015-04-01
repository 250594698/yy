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
		<div id="main" class="pd4">
			<div class="breadcrumbs">
				<a href="index.html"><?php echo L('Home');?></a>
				&gt;
				<span><?php echo L('Partnership');?></span>
			</div>

			<div class="mainInner">
				<h2 class="mian_title3 orange_bg"><?php echo L('Partnership');?></h2>
				<div class="aboutInfo partnerInfo">
					<div class="parItme">
						<div class="parImg">
							<a href="http://www.akchem.com/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer4.jpg" alt="" />
							</a>
						</div>
						<div class="parImg">
							<a href="http://www.plasticsportalasia.net/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer7.jpg" alt="" />
							</a>
						</div>
						<div class="parImg last">
							<a href="http://www.plastics.bayer.com/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer6.jpg" alt="" />
							</a>
						</div>
					</div>

					<div class="parItme">

						<div class="parImg">
							<a href="http://www.chimeicorp.com/zh-tw/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer11.jpg" alt="" />
							</a>
						</div>

						<div class="parImg">
							<a href="http://www.dupont.com/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer3.jpg" alt="" />
							</a>
						</div>

						<div class="parImg last">
							<a href="http://www.emsgrivory.com/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer8.jpg" alt="" />
							</a>
						</div>
						

						
					</div>

					<div class="parItme">

						<div class="parImg">
							<a href="http://www.m-ep.co.jp/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer10.jpg" alt="" />
							</a>
						</div>
						<div class="parImg">
							<a href="http://www.npc.com.tw/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer2.jpg" alt="" />
							</a>
						</div>

						<div class="parImg last">
							<a href="http://www.polyplastics.com/" target="_blank">
								<img src="/yy/Public/imagesHome/producer1.jpg" alt="" />
							</a>
						</div>

						
					</div>

					<div class="parItme">
					<div class="parImg">
							<a href="http://www.sabic-ip.com/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer12.jpg" alt="" />
							</a>
						</div>
					
						

						<div class="parImg">
							<a href="http://www.teijin.co.jp/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer5.jpg" alt="" />
							</a>
						</div>
						

						<div class="parImg last">
							<a href="http://www.toray.com/"  target="_blank">
								<img src="/yy/Public/imagesHome/producer9.jpg" alt="" />
							</a>
						</div>
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
	<script src="js/jquery-2.0.2.js"></script>
</body>
</html>