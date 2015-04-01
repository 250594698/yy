<?php if (!defined('THINK_PATH')) exit();?>	<li>
		<a href="<?php echo U('Index/cateJump',array('model_id'=>1,'cateid'=>26));?>" class="<?php if($styles == 'nav_news'): ?>nav_news curr<?php else: ?>nav_news<?php endif; ?>"><?php echo L('News');?></a>
	</li>
	<li>
		<a href="<?php echo U('Index/cateJump',array('model_id'=>3,'cateid'=>48));?>" class="<?php if($styles == 'Aboutus'): ?>nav_about curr<?php else: ?>nav_about<?php endif; ?>"><?php echo L('Aboutus');?></a>
	</li>
	<li>
		<a href="<?php echo U('Index/cateJump',array('model_id'=>2,'cateid'=>27));?>" class="<?php if($styles == 'nav_product'): ?>nav_product curr<?php else: ?>nav_product<?php endif; ?>"><?php echo L('Product');?></a>
	</li>
	<li>
		<a href="<?php echo U('Index/cateJump',array('model_id'=>5,'cateid'=>49));?>" class="<?php if($styles == 'nav_partner'): ?>nav_partner curr<?php else: ?>nav_partner<?php endif; ?>"><?php echo L('Partnership');?></a>
	</li>
	<li>
		<a href="<?php echo U('Index/cateJump',array('model_id'=>6,'cateid'=>50));?>" class="<?php if($styles == 'nav_contacts'): ?>nav_contacts curr<?php else: ?>nav_contacts<?php endif; ?>"><?php echo L('ContactUs');?></a>
	</li>
	<li>
		<a href="#" class="nav_last"></a>
	</li>