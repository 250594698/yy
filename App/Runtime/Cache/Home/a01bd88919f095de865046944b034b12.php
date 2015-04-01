<?php if (!defined('THINK_PATH')) exit();?><!--  
<?php if(is_array($menu2index)): foreach($menu2index as $key=>$v): ?><a href="/yy/index.php/Home/Index/cateJump/model_id/<?php echo ($v["model_id"]); ?>/cateid/<?php echo ($v["categories_id"]); ?>">
							<div class="product">
								<div class="productImg">
									<span class="rectText" <?php if(L('lang_id') == 1): ?>style="font-size:12px;"<?php endif; ?>>
										<?php echo ($v["categories_name"]); ?>
										<i></i>
									</span>
									<img src="/yy/Public/imagesHome/product.jpg" alt="" />
								</div>
								<div class="productText"><?php echo (html_entity_decode($v["categories_description"])); ?></div>
							</div>
	 </a><?php endforeach; endif; ?>-->
<a href="/yy/index.php/Home/Index/cateJump/model_id/3/cateid/48">
							<div class="product">
								<div class="productImg">
									<span class="rectText" <?php if(L('lang_id') == 1): ?>style="font-size:12px;"<?php endif; ?>>
										<?php echo L('Company');?>
										<i></i>
									</span>
									<img src="/yy/Public/imagesHome/product.jpg" alt="" />
								</div>
								<div class="productText"><?php echo L('Company');?></div>
							</div>
</a>

<a href="/yy/index.php/Home/Index/cateJump/model_id/2/cateid/51">
							<div class="product">
								<div class="productImg">
									<span class="rectText" <?php if(L('lang_id') == 1): ?>style="font-size:12px;"<?php endif; ?>>
										<?php echo L('Introduction');?>
										<i></i>
									</span>
									<img src="/yy/Public/imagesHome/product.jpg" alt="" />
								</div>
								<div class="productText"><?php echo L('Introduction');?></div>
							</div>
</a>

<a href="/yy/index.php/Home/Index/cateJump/model_id/2/cateid/53">
							<div class="product">
								<div class="productImg">
									<span class="rectText" <?php if(L('lang_id') == 1): ?>style="font-size:12px;"<?php endif; ?>>
										<?php echo L('Standard Molding Conditions');?>
										<i></i>
									</span>
									<img src="/yy/Public/imagesHome/product.jpg" alt="" />
								</div>
								<div class="productText"><?php echo L('Standard Molding Conditions');?></div>
							</div>
</a>