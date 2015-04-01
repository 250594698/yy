<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C("SITE_INFO.name");?></title>
<link rel="stylesheet" href="/prosperity/www/Public/cssAdmin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/prosperity/www/Public/cssAdmin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/prosperity/www/Public/cssAdmin/invalid.css" type="text/css" media="screen" />	

<script type="text/javascript" src="/prosperity/www/Public/jsAdmin/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/prosperity/www/Public/jsAdmin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/prosperity/www/Public/jsAdmin/jquery.wysiwyg.js"></script>   
<link rel="stylesheet" href="/prosperity/www/Public/jsAdmin/ui/redmond/jquery-ui-1.8.6.css">        
      <script type="text/javascript" src="/prosperity/www/Public/jsAdmin/ui/jquery-ui-1.8.6.min.js"></script>

      <script src="/prosperity/www/Public/jsAdmin/scripts/utils.js" type="text/javascript"></script>
        
    <!-- ckeditor  -->        
     <link rel="stylesheet" href="/prosperity/www/Public/kindeditor/themes/default/default.css" />
     <script charset="utf-8" src="/prosperity/www/Public/kindeditor/kindeditor.js"></script>
        
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
       
      <script type="text/javascript" src="/prosperity/www/Public/jsAdmin/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
      <script type="text/javascript" src="/prosperity/www/Public/jsAdmin/fancybox/jquery.fancybox-1.3.4.pack.js"></script>      
      <link rel="stylesheet" type="text/css" href="/prosperity/www/Public/jsAdmin/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
      <script>
	  $(function(){
		 $("a.fancyBox").fancybox(); 
	  })	 
	  </script>        
	<style>
    	
    </style>
	</head>
  
	<body>
    <div id="body-wrapper" > <!-- Wrapper for the radial gradient background -->		

        <!--left start-->
		
        <div id="sidebar"   >
 <div id="sidebar-wrapper" style="position:relative; height:100%"> 		  
    <!-- Sidebar Profile links -->
    <div id="profile-links" style="margin-top:110px; font-size:12px;">
        Hello,<a href="#" onclick="return false;" title="Edit your profile"><?php echo $_SESSION['admin']; ?></a>			
        <br />
        <br />
        <a href="/prosperity/www/index.php" target="_blank" title="View the Site">View the Site</a> | 
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
			  <h2>Users</h2></div>
            
			<div class="clear"></div> <!-- End .clear -->
               <div class="content-box"><!-- Start Content Box -->                  
                  <div class="content-box-header">  
                      <!--<span class="insert" style=" float:right; line-height:40px; font-size:14px; font-weight:bold;"> <a href="<?php echo U('group','action=detail');?>">+ Insert Group</a>&nbsp; &nbsp; </span>-->
                    <div class="clear"></div>                      
                  </div> <!-- End .content-box-header -->
                  
                  <div class="content-box-content">
                      <div class="tab-content default-tab" id="tab1">                       
                      <!-- This is the target div. id must match the href of this div's tab -->	
                      
                          
                          <table>
                            <thead>
                              <tr>								   
                                 <!-- <th>ID</th>-->
                                  <th width="50%">Title</th>                          	                                                                                                        
                                  <th  width="150" style="text-align:center"></th>									   						 
                              </tr>								
                            </thead> 
                            <tbody>                           
                               <?php if(is_array($groupList)): $i = 0; $__LIST__ = $groupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>class="alt-row"<?php endif; ?>>	
                                        <td style="font-size:14px"><a href="/prosperity/www/index.php/Admin/Users/groupUsers/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>                                           
                                        <td style="text-align:center;">   
                                            <a href="/prosperity/www/index.php/Admin/Users/editAccess/id/<?php echo ($vo["id"]); ?>" title="Delete">Edit</a> &nbsp; &nbsp;                             
                                        </td>          
                                     </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                          </table>
                          <div class="pagination"><?php echo ($page); ?><div style=" clear:both;"></div></div>						
                      </div> <!-- End #tab1 -->	
                                       
                      
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
<script>
$(function() {
	$( "#accordion" ).accordion();
});
</script>