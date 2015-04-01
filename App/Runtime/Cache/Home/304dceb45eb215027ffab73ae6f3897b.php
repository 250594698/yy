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
				<span><?php echo L('ContactUs');?></span>
			</div>

			<div class="mainInner">
				<h2 class="mian_title3 blue_bg"><?php echo L('ContactUs');?></h2>
				<div class="aboutInfo contactsInfo">
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.4198668475146!2d114.11051375414208!3d22.37552380846825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f8f030db788b%3A0x398c4b4376190b8!2z6aaZ5riv6I2D54GjIENhc3RsZSBQZWFrIFJvYWQgKFRzdWVuIFdhbiksIDQ1OeiZn-iPr-WKm-W3pealreS4reW_gw!5e0!3m2!1szh-CN!2scn!4v1411454537782" width="510" height="302" frameborder="0" style="border:0"></iframe>
					</div>
					<div class="mapInfo">
						<h3 class="smallTitle1 blue nobor"><?php echo L('Hong Kong');?></h3>
						<p class="text mapText">永裕工业物料（香港）有限公司</p>
						<p class="text mapText">Prosperity Industrial (H.K.) Co., Ltd </p>
						<p class="text mapText" style="width:415px; line-height:25px;"><?php echo L('address');?>：<?php echo L('addressEN');?></p>
						<p class="text mapText"><?php echo L('Tell');?>：（852）24928640 </p>
						<p class="text mapText"><?php echo L('Fax');?>：（852）24151167 </p>
					</div>

					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1842.4552479515196!2d114.12292369573494!3d22.545025344468744!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f595d62b3ef9%3A0x44f3042ceba18ce0!2z5riv5Liw5aSn5Y6m!5e0!3m2!1szh-CN!2scn!4v1411456396600" width="510" height="302" frameborder="0" style="border:0"></iframe>
					</div>
					<div class="mapInfo">
						<h3 class="smallTitle1 blue nobor"><?php echo L('China');?></h3>
						<p class="text mapText">永裕塑料（深圳）有限公司  </p>
						<p class="text mapText">Prosperity Plastics (Shenzhen) Co., Ltd</p>
						<p class="text mapText"><?php echo L('address');?>：深圳市罗湖区深南东路2118号港丰大厦33B-07室</p>
						<p class="text mapText"><?php echo L('Tell');?>：（86）0755-83206589</p>
						<p class="text mapText"><?php echo L('Fax');?>：（86）0755-23609581 </p>
					</div>
						
					<form action="/yy/index.php/Home/Index/email" class="queryFrom" method="post">
						<p><label for=""><?php echo L('company name');?> : </label>
						<input type="text" class="textSty" name="corp" /></p>
						<p><label for=""><?php echo L('name');?> : </label>
						<input type="text" class="textSty" name="username" /></p>
						<p><label for=""><?php echo L('E-mail');?> : </label>
						<input type="text" class="textSty" name="email" /></p>
						<p><label for=""><?php echo L('Tell');?> : </label>
						<input type="text" class="textSty" name="tell" /></p>
						<p><label for=""><?php echo L('Enquiry');?> : </label>
						<textarea class="textSty textarea" name="content" id="" cols="30" rows="10"></textarea>

						<input type="reset" class="sub ml124" value="<?php echo L('reset');?>"/>
						<input type="submit" class="sub" value="<?php echo L('send');?>" />
					</form>

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