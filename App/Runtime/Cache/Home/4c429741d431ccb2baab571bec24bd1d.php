<?php if (!defined('THINK_PATH')) exit(); if(is_array($menuindex)): foreach($menuindex as $key=>$v): ?><div class="newsItem">
							<span class="newTime"><?php echo (date('Y/m/d',strtotime($v["news_adddate"]))); ?></span>
							<a href="<?php echo U('Index/cateShow',array('cate_id'=>26,'news_id'=>$v['news_id']));?>"><span class="newSlogan">
							  <?php echo mb_substr($v['news_title'],0,28,'utf-8'); ?>
							</span></a>
						</div><?php endforeach; endif; ?>