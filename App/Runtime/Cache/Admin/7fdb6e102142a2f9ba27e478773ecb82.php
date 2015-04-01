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

	</head>
  
	<body>
    
    

    

    
    <div id="body-wrapper" > <!-- Wrapper for the radial gradient background -->		

        <!--left start-->
		
        <div id="sidebar"   >
 <div id="sidebar-wrapper" style="position:relative; height:100%"> 		  
    <!-- Sidebar Profile links -->
    <div id="profile-links" style="margin-top:110px; font-size:12px;">
        Hello, <a href="#" onclick="return false;" title="Edit your profile"><?php echo $_SESSION['admin']; ?></a>			
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
	    <a href="#" class="nav-top-item <?php if(in_array(MODULE_NAME,$value)) echo 'current'; ?>">Configuration</a>
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
			  <h2>Edit User  </h2></div>
			<div class="clear"></div> <!-- End .clear -->         
                <!-- Insert -->
                <div class="content-box">				
                    <div class="content-box-header">                    
                        <ul class="content-box-tabs">			
                        			
                            <li><a href="#tab1" id="menu1" class="default-tab current" style="text-transform:capitalize">Add/Edit</a></li>	      
                                                  		
                        </ul>	    
                         <span class="insert" style=" float:right; line-height:40px; font-size:14px; font-weight:bold;"><a href="<?php echo U('index');?>">List </a>&nbsp; &nbsp; </span>                        	
                      <div class="clear"></div>					
                    </div>
                    <div class="content-box-content">			
                        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
                          <form action="<?php echo U('editUserAction');?>" name="editForm" method="post" enctype="multipart/form-data" >
                          
                             <input type="hidden" name="id" value="<?php echo ($name["uid"]); ?>" >
                             <p>
                              <label>Username:</label>                                
                             <input class="text-input small-input"  type="text" name="username"  value="<?php echo ($name["userName"]); ?>" />               
                            <?php if($_SESSION['loginGroupId'] == 1): ?><label>Group:</label>
                            <select name="group_id">
                                <?php if(is_array($groupList)): foreach($groupList as $key=>$v): ?><option  value="<?php echo ($v["id"]); ?>" <?php if(($v["id"]) == $groupchecked): ?>selected="selected"<?php endif; ?> ><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
                             
							</select><?php endif; ?>
                           	</p>
                            <br>
                            <input class="button" style="text-transform:capitalize" type="button" name="BtnSave" onClick="document.editForm.submit()"  value="Save" />&nbsp;&nbsp;
                            <input class="button" type="button" name="back" onClick="window.location.href='<?php echo U('user',array('gid'=> (int)$_GET['gid']));?>'"  value="Back" />      
                            </form>                    	
                        </div> <!-- End #tab1 --> 
                    </div>
                </div> 
                <!--End Insert -->
			
			
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