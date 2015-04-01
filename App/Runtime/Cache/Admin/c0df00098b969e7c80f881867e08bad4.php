<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C("SITE_INFO.name");?></title>
<link rel="stylesheet" href="/yy/Public/cssAdmin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/yy/Public/cssAdmin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/yy/Public/cssAdmin/invalid.css" type="text/css" media="screen" />	

<script type="text/javascript" src="/yy/Public/jsAdmin/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/yy/Public/jsAdmin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/yy/Public/jsAdmin/jquery.wysiwyg.js"></script>   
<link rel="stylesheet" href="/yy/Public/jsAdmin/ui/redmond/jquery-ui-1.8.6.css">        
      <script type="text/javascript" src="/yy/Public/jsAdmin/ui/jquery-ui-1.8.6.min.js"></script>

      <script src="/yy/Public/jsAdmin/scripts/utils.js" type="text/javascript"></script>
        
    <!-- ckeditor  -->        
     <link rel="stylesheet" href="/yy/Public/kindeditor/themes/default/default.css" />
     <script charset="utf-8" src="/yy/Public/kindeditor/kindeditor.js"></script>
        
	  <script>
          KindEditor.ready(function(K) {
              var editor = K.create('textarea.HTMLeditor', {
                          allowFileManager : true,
                          width : 800,
                          height : 400,
						  afterBlur: function(){this.sync();}
				}); 
          });	
      </script>
       
      <script type="text/javascript" src="/yy/Public/jsAdmin/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
      <script type="text/javascript" src="/yy/Public/jsAdmin/fancybox/jquery.fancybox-1.3.4.pack.js"></script>      
      <link rel="stylesheet" type="text/css" href="/yy/Public/jsAdmin/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
      <script>
	  $(function(){
		 $("a.fancyBox").fancybox(); 
	  })	 
	  </script>     
     <script>
        $(function() {
		  $('#list tbody tr:odd').removeClass('alt-row');
		  $(".status .light").click(function(){		
			   var id = $(this).parent().parent().attr("id");
			   $.get("<?php echo U('changeStatus');?>", { id: id },
				function(data){
					 $("#"+id).find("span").removeClass("current");
				 	 if (data == 1)
					 {
						 $("#"+id).find("span").eq(0).addClass("current");
					 }
					 else
					 {
						 $("#"+id).find("span").eq(1).addClass("current");
					 }
				}); 
		  })  		
	})
      
		
	</script>
    <style>
    .stats{ color:#F00;}
    </style>
	</head>
  
	<body >
    
    <div id="body-wrapper" > <!-- Wrapper for the radial gradient background -->		

        <!--left start-->
		
        <div id="sidebar"   >
 <div id="sidebar-wrapper" style="position:relative; height:100%"> 		  
    <!-- Sidebar Profile links -->
    <div id="profile-links" style="margin-top:110px; font-size:12px;">
        Hello,<a href="#" onclick="return false;" title="Edit your profile"><?php echo $_SESSION['admin']; ?></a>			
        <br />
        <br />
        <a href="/yy/index.php" target="_blank" title="View the Site">View the Site</a> | 
        <a href="<?php echo U('Login/LoginOut');?>" title="Sign Out">Sign Out</a>
     </div>	
<ul id="main-nav">
<li id="li_Menu_<?php echo ($i); ?>">    
	    <a href="#" class="nav-top-item <?php if(in_array(MODULE_NAME,$value)) echo 'current'; ?>">Menu</a>
    	<ul>
    	<?php echo W('Menu/menu');?>        
		</ul> 
</li>
<li id="li_Menu_<?php echo ($i); ?>"> 
    	<?php echo W('Menu/menuOne');?>
    	<ul>
    	<?php echo W('Menu/menu2');?>	        
		</ul> 
</li>
</ul> 				
  </div>
</div> 
        <!--left end-->
        
        
        <!-- End #sidebar -->			
		<div id="main-content"> <!-- Main Content Section with everything -->
        <div  id="header_logo"><?php echo C("TITLE");?></div>	 		
			
			<!-- Page Head -->
			<div style="float:left; width:380px;">
			  <h2>Products Category</h2></div>

            
			<div class="clear"></div> <!-- End .clear -->
               <div class="content-box"><!-- Start Content Box -->                  
                  <div class="content-box-header">  
                      <!--  <span class="insert" style=" float:right; line-height:40px; font-size:14px; font-weight:bold;"> 
                      
                      <?php if($_SESSION['loginGroupId'] == 1): ?><a href="<?php echo U('ProductsCategory/add');?>">+ insert</a>&nbsp; &nbsp;<?php endif; ?></span>-->
                      
                      <span class="insert" style=" float:right; line-height:40px; font-size:14px; font-weight:bold;"> 
                      
                      <a href="<?php echo U('ProductsCategory/add');?>">+ insert</a>&nbsp; &nbsp;</span>
                    <div class="clear"></div>                      
                  </div> <!-- End .content-box-header -->
                  
                  <div class="content-box-content">
                      <div class="tab-content default-tab" id="tab1">                   
                          <table id="list">
                            <thead>
                              <tr >		   
                                  <th>ID</th>
                                  <th width="50%">Name</th>                                 
                                  <th>Status</th> 
                                  <th>Sort Order</th>      	                                                                                                        
                                  <th  width="200" style="text-align:center"></th>									   						 
                              </tr>								
                            </thead> 
                            <tbody>
                            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="alt-row">
                                  <td><?php echo ($vo["categories_id"]); ?><td><a><?php echo ($vo["html"]); echo ($vo["categories_name"]); ?></a></td> 
                                  <td>
                                  <?php if($vo["categories_status"] == 1): ?><a href="/yy/index.php/Admin/ProductsCategory/statsAction/ac/0/id/<?php echo ($vo["categories_id"]); ?>">On</a><?php else: ?>
                                  <a href="/yy/index.php/Admin/ProductsCategory/statsAction/ac/1/id/<?php echo ($vo["categories_id"]); ?>" class="stats">Off</a><?php endif; ?></td>
                                  <td><?php echo ($vo["sort_order"]); ?></td>
                                  <td><a href="/yy/index.php/Admin/ProductsCategory/edit/model_id/<?php echo ($vo["model_id"]); ?>/id/<?php echo ($vo["categories_id"]); ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <!--<?php if($_SESSION['loginGroupId'] == 1): ?><a href="/yy/index.php/Admin/ProductsCategory/deleteP/id/<?php echo ($vo["categories_id"]); ?>"  onclick="return confirm('Delete this categories?')">Delete</a><?php endif; ?>-->
                                  <a href="/yy/index.php/Admin/ProductsCategory/deleteP/id/<?php echo ($vo["categories_id"]); ?>"  onclick="return confirm('Delete this categories?')">Delete</a></td>
                               </tr><?php endforeach; endif; ?>
                            </tbody>
                          </table>
                          <div class="pagination"><?php echo ($page); ?><div style=" clear:both;"></div></div>						
                      </div>
                                       
                      
                  </div> <!-- End .content-box-content -->
                  
              </div> <!-- End .content-box -->
             
			
			
			<div class="clear"></div>
			
			
			<!-- Start Notifications -->
			
			

			
			<!-- End Notifications -->
			
            <div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2013
				</small>
			</div>
			
			
			
			<!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div>
	
	
	</body>
<!-- Download From www.exet.tk-->
</html>