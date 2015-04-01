<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C("SITE_INFO.name");?></title>
<link rel="stylesheet" href="/yy/Public/cssAdmin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/yy/Public/cssAdmin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/yy/Public/cssAdmin/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="/yy/Public/scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/yy/Public/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/yy/Public/scripts/jquery.wysiwyg.js"></script>   
<link rel="stylesheet" href="/yy/Public/scripts/ui/redmond/jquery-ui-1.8.6.css">        
      <script type="text/javascript" src="/yy/Public/scripts/ui/jquery-ui-1.8.6.min.js"></script>

      <script src="/yy/Public/scripts/utils.js" type="text/javascript"></script>
        
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
       
      <script type="text/javascript" src="/yy/Public/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
      <script type="text/javascript" src="/yy/Public/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>      
      <link rel="stylesheet" type="text/css" href="/yy/Public/scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
      <script>
	  $(function(){
		 $("a.fancyBox").fancybox(); 
	  })	 
	  </script>
<script language="javascript" type="text/javascript">
	    function ValidatePage() {
	      if ($.trim($("#txtUserName").val()) == "") {
	            alert("Please enter a Username");
	            $("#txtUserName").focus();
	            return false;
            }	
			 if ($.trim($("#txtUserPwd").val()) == "") {
	            alert("Please enter a Password");
	            $("#txtUserPwd").focus();
	            return false;
            }		
		frm.submit();
	}
	</script>
		
	</head>
  
	<body id="login">
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
				<h1>Internal Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="/yy/Public/imagesAdmin/logo.png" alt="Internal Admin logo" />
			</div> <!-- End #logn-top -->
			<div style="text-align:center; margin:10px; margin-top:-10px; font-size:14px; color:#F00;  <?php echo ($loginErr); ?>  ">ERROR: Wrong username or password !</div>
			<div id="login-content">
				<div class="clear"></div>
				<form id="frm" name="form1" method="post" action="<?php echo U('Login/Login');?>" enctype="multipart/form-data">
					<p>
						<label>Username</label>
						<input class="text-input" id="txtUserName" name="txtUserName" type="text" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" id="txtUserPwd" name="txtUserPwd" type="password" />
					</p>
					<div class="clear"></div>
					<!--<p id="remember-password">
						<input type="checkbox" id="chkRme" name="chkRme"/>Remember me
					</p>-->
					<p>
						<input class="button"  type="submit" onClick="javascript:return ValidatePage();" value="Sign In" />
            			<input type="hidden" name="btnSave" value="" />
					</p>
				</form>		
  </body>
  </html>