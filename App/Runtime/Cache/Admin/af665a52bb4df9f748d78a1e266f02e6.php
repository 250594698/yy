<?php if (!defined('THINK_PATH')) exit(); if(is_array($menu)): foreach($menu as $key=>$v): ?><li>           
           <?php if(in_array(($v), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("$v/index");?>" class="current"><?php echo ($v); ?></a><?php endif; ?>
       </li><?php endforeach; endif; ?>