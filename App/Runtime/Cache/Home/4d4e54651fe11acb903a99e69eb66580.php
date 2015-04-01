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
				<span><?php echo L('Aboutus');?></span>
			</div>

			<div class="mainInner">
				<h2 class="mian_title3"><?php echo L('Aboutus');?></h2>
				<div class="aboutInfo">
					<div class="mb20">
						<h3 class="smallTitle1"><?php echo L('Company');?></h3>
						<p class="text">團結和美國彼此，開發我們將努力開拓新的領域給對方，員工提高生產力服務確認該公司給對方，員工的公益性質，試圖通過產品來服務社會健康注意到健康對方，員工會派出一隻健康的生活樂趣</p>

						<p class="text">
							长时间和较宽的温度范围内，能保持拉伸强度、拉伸率及冲击强度等各种机械特性的平衡。<br />
							在较宽的温度范围内和长时间的载荷条件下，仍具有优良的耐蠕变特性。<br />
							具有非常优良的耐疲劳特性，即使在重复应力和连继振动的条件下，仍能持续保持稳定的特性。<br />
							具有高刚性及优良的弹性恢复性能，再加上良好的耐疲劳和耐蠕变性，是理想的弹簧材料。<br />
							耐磨耗特为热塑性塑料之最，同时它还具有良好的润滑性。此外，它还具有自润滑特性，适用于无油润滑机械零部件。<br />
							不仅熔点、热变形温度等短期热性能十分优良，而且在高温空气及高温热水中长期使用时的耐久性亦呈现出良好的性能。<br />
							没有因吸水而发生尺寸变化现象，实际应用中基本没有问题。<br />
							除强酸、强氧化剂的化学药品外，对于其它的无机化学药品及油类具有超群的耐久性。<br />
							具有良好的成型流动性和表面美观、光泽特性，是成型性能非常优良的树脂。<br />
							适用于嵌件模塑，金属嵌件上注塑及切削加工，熔接，印刷等二次加工。<br />
						</p>
					</div>

					<div class="mb20">
						<h3 class="smallTitle1"><?php echo L('Goals and Gu Jing');?></h3>
						<p class="text">團結和美國彼此，開發我們將努力開拓新的領域給對方，員工提高生產力服務確認該公司給對方，員工的公益性質，試圖通過產品來服務社會健康注意到健康對方，員工會派出一隻健康的生活樂趣</p>

						<p class="text">
							长时间和较宽的温度范围内，能保持拉伸强度、拉伸率及冲击强度等各种机械特性的平衡。<br />
							在较宽的温度范围内和长时间的载荷条件下，仍具有优良的耐蠕变特性。<br />
							具有非常优良的耐疲劳特性，即使在重复应力和连继振动的条件下，仍能持续保持稳定的特性。<br />
							具有高刚性及优良的弹性恢复性能，再加上良好的耐疲劳和耐蠕变性，是理想的弹簧材料。<br />
							耐磨耗特为热塑性塑料之最，同时它还具有良好的润滑性。此外，它还具有自润滑特性，适用于无油润滑机械零部件。<br />
							不仅熔点、热变形温度等短期热性能十分优良，而且在高温空气及高温热水中长期使用时的耐久性亦呈现出良好的性能。<br />
							没有因吸水而发生尺寸变化现象，实际应用中基本没有问题。<br />
							除强酸、强氧化剂的化学药品外，对于其它的无机化学药品及油类具有超群的耐久性。<br />
							具有良好的成型流动性和表面美观、光泽特性，是成型性能非常优良的树脂。<br />
							适用于嵌件模塑，金属嵌件上注塑及切削加工，熔接，印刷等二次加工。<br />
						</p>
					</div>

					<div class="mb20">
						<h3 class="smallTitle1"><?php echo L('serve');?></h3>
						<p class="text">團結和美國彼此，開發我們將努力開拓新的領域給對方，員工提高生產力服務確認該公司給對方，員工的公益性質，試圖通過產品來服務社會健康注意到健康對方，員工會派出一隻健康的生活樂趣</p>

						<p class="text">
							长时间和较宽的温度范围内，能保持拉伸强度、拉伸率及冲击强度等各种机械特性的平衡。<br />
							在较宽的温度范围内和长时间的载荷条件下，仍具有优良的耐蠕变特性。<br />
							具有非常优良的耐疲劳特性，即使在重复应力和连继振动的条件下，仍能持续保持稳定的特性。<br />
							具有高刚性及优良的弹性恢复性能，再加上良好的耐疲劳和耐蠕变性，是理想的弹簧材料。<br />
							耐磨耗特为热塑性塑料之最，同时它还具有良好的润滑性。此外，它还具有自润滑特性，适用于无油润滑机械零部件。<br />
							不仅熔点、热变形温度等短期热性能十分优良，而且在高温空气及高温热水中长期使用时的耐久性亦呈现出良好的性能。<br />
							没有因吸水而发生尺寸变化现象，实际应用中基本没有问题。<br />
							除强酸、强氧化剂的化学药品外，对于其它的无机化学药品及油类具有超群的耐久性。<br />
							具有良好的成型流动性和表面美观、光泽特性，是成型性能非常优良的树脂。<br />
							适用于嵌件模塑，金属嵌件上注塑及切削加工，熔接，印刷等二次加工。<br />
						</p>
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