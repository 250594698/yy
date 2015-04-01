<?php if (!defined('THINK_PATH')) exit();?>        <li>
           <?php if(in_array(($id1), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("News/index");?>" class="current">News</a><?php endif; ?>
       </li>
       <li>           
           <?php if(in_array(($id2), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("Category/index");?>" class="current">Category</a><?php endif; ?>
       </li>
       <li>
           <?php if(in_array(($id33), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("ProductsCategory/index");?>" class="current">Products Category</a><?php endif; ?>
       </li>
       <li>
           <?php if(in_array(($id3), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("Products/index");?>" class="current">Products</a><?php endif; ?>
       </li>
       <li>
           <?php if(in_array(($id44), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("FaultCategory/index");?>" class="current">Trouble Category</a><?php endif; ?>
       </li>
       <li>
           <?php if(in_array(($id4), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("Fault/index");?>" class="current">Trouble</a><?php endif; ?>
       </li>
        <li>
           <?php if(in_array(($id5), is_array($rules)?$rules:explode(',',$rules))): ?><a href="<?php echo U("Banners/index");?>" class="current">Banners</a><?php endif; ?>
       </li>