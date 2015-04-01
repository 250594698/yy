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
  <script>
		function delImages()
		{
			  $("#image").html('');
			  $("input[name=del_iamge]").val("true");			  
		} 
  </script>
	</head>
  
	<body>
    
    <div id="body-wrapper" >	
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
		<div id="main-content"> <!-- Main Content Section with everything -->
        <div  id="header_logo"><?php echo C("TITLE");?></div>	 		
			
			<!-- Page Head -->
			<div style="float:left;">
			  <h2>Edit Trouble Category</h2>
			</div>

            
			<div class="clear"></div> <!-- End .clear -->
			         
                <!-- Insert -->
                <div class="content-box">				
                    <div class="content-box-header">                    
                        <ul class="content-box-tabs">						
                            <li><a href="#tab1" class="default-tab current" style="text-transform:capitalize">General</a></li>                     		
                        </ul>                   
                        <span class="insert" style=" float:right; line-height:40px; font-size:14px; font-weight:bold;"> <a href="<?php echo U('index');?>">List </a>&nbsp; &nbsp; </span>  
                      <div class="clear"></div>					
                    </div>
                    <form action="<?php echo U('FaultCategory/editAction');?>" method="POST" name="editForm" enctype="multipart/form-data">
                    <div class="content-box-content">			
                        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->	
                        		<div id="sub_tabs">                               
                               	  <ul>
                                    <?php if(is_array($lang)): $k = 0; $__LIST__ = $lang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li><a href="#tabs2-<?php echo ($vo["value"]); ?>"><img src="/prosperity/www/Public/imagesAdmin/<?php echo ($vo["value"]); ?>_icon.gif"> <?php echo ($vo["txt"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>   
                                 </ul>
                           
                               
                                <?php if(is_array($langList)): $k = 0; $__LIST__ = $langList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="tabs" id="tabs2-<?php echo ($vo); ?>">                                    
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="editContent">
                                      <tr>
                                        <td class="fieldText">Title:</td>
                                        <td><input class="text-input small-input" value="<?php echo ($titleArr[$k]); ?>" style="width:590px!important"  type="text" id="categories_name_<?php echo ($k); ?>" name="categories_name_<?php echo ($k); ?>" /></td>
                                      </tr>
                                    </table>    
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>   
                              </div>
                         </div>
     
                    </div>
                      <div style="padding:0 0 20px 20px">  
                      		 <input  type="hidden" value="<?php echo ($addId); ?>" name="categories_id" />
                      		 <input  type="hidden" value="<?php echo ($model_id); ?>" name="model_id" />
                      		 <input  type="hidden" value="0" name="pid" />
 							 <input class="button" style="text-transform:capitalize" type="button" name="BtnSave" onClick="document.editForm.submit()"  value="save" />&nbsp;&nbsp;
                             <input class="button" type="button" name="back" onClick="window.location.href='<?php echo U('index');?>'"  value="Back" />    
                      </div>  
                    </form> 
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
	
		<script>
    	$(function(){
					$('.content-box-content ul.tab-content').hide(); // 先隐藏DIV
					$('ul.content-box-tabs li a.default-tab').addClass('current'); // 给默认的选项卡加样式
					$('.content-box-content ul.default-tab').show(); //
					 
					$('ul.content-box-tabs li a').click( //
					function() {
						$(this).parent().siblings().find("a").removeClass('current'); //
						$(this).addClass('current'); //
						var currentTab = $(this).attr('href'); //
						$(currentTab).siblings().hide(); //
						$(currentTab).show(); //
						return false;
					}
			);
			 $( "#sub_tabs" ).tabs();  
		});
    
    </script>
	</body>
</html>