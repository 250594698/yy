<?php if (!defined('THINK_PATH')) exit(); if(is_array($menu2)): foreach($menu2 as $key=>$v): ?><li class="<?php if($v['categories_id'] == $cateid): ?>curr<?php endif; ?>">
     <a href="<?php echo U('Index/cateJump',array('model_id'=>$v['model_id'],'cateid'=>$v['categories_id']));?>"><i></i><?php echo ($v["categories_name"]); ?></a></li><?php endforeach; endif; ?>
<?php if(is_array($menu3)): foreach($menu3 as $key=>$v): ?><li class="<?php if($cateids == 54): ?>curr<?php endif; ?>">
     <a href="<?php echo U('Index/cateJump',array('model_id'=>$v['model_id'],'cateid'=>$v['categories_id']));?>"><i></i><?php echo ($v["categories_name"]); ?></a></li><?php endforeach; endif; ?>
     <!-- <li class="<?php if($cateids == 54): ?>curr<?php endif; ?>"><i></i>
    <a href="/yy/index.php/Home/Index/cateJump/model_id/7/cateid/54"><?php echo L('Injection Molding Trouble Shooting');?></a></li> -->