<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Crypt\Driver\Think;
class IndexController extends Controller {
    public function index(){
    	//$this->buildHtml('index','','');
    	$this->styles='nav_home';
    	$this->display();
    }
    
    //跳转到指向栏目页面
    public function cateJump(){
    	
    	//查找分类所属模型，和模板
    	$where['model_id']=I('request.model_id');
    	$cateid=intval(I('request.cateid'));
    	$year=intval(I('request.year'));
    	    	
    	switch ($cateid){
    		//最新消息
    		case 26:
    		//$year=2014;
    		//查询最新时间
     		$year=M('News')->field('max(news_adddate)')->find();
            $year=intval(date('Y',strtotime($year['max(news_adddate)'])));
    		
    		break;
    		//关于我们
    		case 48:
    		$cateid=48;
    		break;
    		
    		//产品介绍
    		case 27:
    		$cateid=51;
    		break;
    		
    		//产品介绍
    		case 54:
    		$cateid=54;
    	    break;
    		
    		//原料生产商
    		case 49:
    	    $cateid=49;
    	    break;
    	    
    	    //联系我们
    	    case 50:
    	    $cateid=50;
    	    break;
    	}
    	
    	$m=M('Model')->where($where)->find();
    	$template=$m['model_listTemplate'];
    	
    	//查出当前分类名
    	$catename=New Model();
    	$lang_id=L('lang_id');
    	$catename=$catename->table('yy_category c,yy_category_description cd')->where("c.categories_id=cd.categories_id and cd.language_id=$lang_id and c.categories_id=$cateid")->select();
    	$this->assign('catename',$catename);
        
    	//调用分类例表数据
    	$model=$m['model_name'];
    	
    	switch ($model){
    		
    		//新闻
    		case 'News':
    			$rs=New Model();
//     			//统计分页总数
    			$count=$rs->table('yy_news n,yy_news_manylanguage nm')->order('n.news_adddate desc')
    			->where("n.news_id=nm.news_id and nm.lang_id=$lang_id and n.news_year=$year")->count();
    			$Page=New \Think\Page($count,15);
    			$show=$Page->show();

    			$rs=$rs->table('yy_news n,yy_news_manylanguage nm')->where("n.news_id=nm.news_id and nm.lang_id=$lang_id and n.news_year=$year and n.news_status=1")
    			->order('n.news_adddate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    			$this->year=$year;
    			$this->cate_id=26;
    			
    			$this->styles='nav_news';
    			$this->assign('newsList',$rs);
    			$this->assign('page',$show);// 赋值分页输出
    			$this->display($template);
    			break;
    		//关于我们
    		case 'Aboutus':
    			$rs=New Model();
    			$lang_id=L('lang_id');
    			$rs=$rs->table('yy_news n,yy_news_manylanguage nm')->order('n.news_adddate desc')->where("n.news_id=nm.news_id and nm.lang_id=$lang_id and n.categories_id=$cateid")->select();
    			$this->assign('newsList',$rs);
    			$this->styles='Aboutus';
    			$this->display($template);
    			break;
    	   //产品　
    	  case 'Products':
    	       $rs=New Model();
    		   $lang_id=L('lang_id');
    		   //统计分页总数
    		   $count=$rs->table('yy_products p,yy_products_manylanguage pm')->order('p.products_adddate desc')
    		   ->where("p.products_id=pm.products_id and pm.lang_id=$lang_id and p.categories_id=$cateid and p.products_status=1")->count();
               //var_dump($count);
    		   $Page=New \Think\Page($count,9);
    		   $show=$Page->show();
    		   
    		   $rs=$rs->table('yy_products p,yy_products_manylanguage pm')->order('p.products_sort desc')->where("p.products_id=pm.products_id and pm.lang_id=$lang_id and p.categories_id=$cateid and p.products_status=1")
    		   ->limit($Page->firstRow.','.$Page->listRows)->select();
    		   $this->cateid=$cateid;
    		   
    		   //查出当前分类名
    		   $catename=New Model();
    		   $lang_id=L('lang_id');
    		   $catename=$catename->table('yy_category c,yy_category_description cd')->where("c.categories_id=cd.categories_id and cd.language_id=$lang_id and c.categories_id=$cateid")->select();
    		   $this->assign('catename',$catename);
    		   
    		   $this->assign('productsList',$rs);
    		   $this->assign('page',$show);// 赋值分页输出
    		   $this->styles='nav_product';
    		   $this->display($template);
    		   break;
    		   
         //原料生产商
         case 'Producer':
         	    $this->styles='nav_partner';
    		   	$this->display($template);
    		   	break;
    		   	
         //产品故障
         case 'Fault':
    		  $rs=New Model();
    		  $lang_id=L('lang_id');
    		  //统计分页总数
    		  $count=$rs->table('yy_fault f,yy_fault_manylanguage fm')->order('f.fault_adddate desc')
    		  ->where("f.fault_id=fm.fault_id and fm.lang_id=$lang_id and f.categories_id=$cateid and f.fault_status=1")->count();
    		  $Page=New \Think\Page($count,1000);
    		  $show=$Page->show();
    		  
    		  $rs=$rs->table('yy_fault f,yy_fault_manylanguage fm')->order('f.fault_sort asc')
    		  ->where("f.fault_id=fm.fault_id and fm.lang_id=$lang_id and f.categories_id=$cateid and f.fault_status=1")->limit($Page->firstRow.','.$Page->listRows)->select();
    		  $this->assign('faultList',$rs);
    		  $this->cateids=$cateid;
    		  $this->styles='nav_product';
    		  $this->assign('page',$show);// 赋值分页输出
    		  $this->display($template);
    		  break;
    		   		
    	  case 'Contactus':
    	  	   $this->styles='nav_contacts';
    		   $this->display($template);
    		    break;
    	}
    }
    
    //内容
    public function cateShow(){
    	
    	//查找分类所属模型，和模板
    	$cateid=I('request.cate_id');   //分类id
    	$news_id=I('request.news_id'); //文章id
    	
    	$products_id=I('request.products_id');  //产品id
    	$fault_id=I('request.fault_id');  //产品故障id
    	$m=M('Category')->where("categories_id=$cateid")->field('model_id')->find();
    	$model_id=$m['model_id'];
    	$t=M('Model')->where("model_id=$model_id")->find();
    	
     	$template=$t['model_showTemplate'];
     	
     	//查出当前分类名
     	$catename=New Model();
     	$lang_id=L('lang_id');
     	$catename=$catename->table('yy_category c,yy_category_description cd')->where("c.categories_id=cd.categories_id and cd.language_id=$lang_id and c.categories_id=$cateid")->select();
     	$this->assign('catename',$catename);
    	
    	//调用分类例表数据
    	$model=$t['model_name'];
    	//新闻
    	if($model=='News'){
    		$rs=New Model();
    		$lang_id=L('lang_id');
    		$rs=$rs->table('yy_news n,yy_news_manylanguage nm')->where("n.news_id=nm.news_id and nm.lang_id=$lang_id and nm.news_id=$news_id")->select();
    		$this->assign('newsShow',$rs);
    		$this->styles='nav_news';
    		$this->display($template);
    	}
    	
    	//产品
    	if($model=='Products'){
    		$rs=New Model();
    		$lang_id=L('lang_id');
    		$rs=$rs->table('yy_products p,yy_products_manylanguage pm')->where("p.products_id=pm.products_id and pm.lang_id=$lang_id and pm.products_id=$products_id")->select();
    		$this->assign('productsShow',$rs);
    		$this->styles='nav_product';
    		//var_dump($rs);
    		$this->display($template);
    	}
    	
    	//产品故障
    	if($model=='Fault'){
    		$rs=New Model();
    		$lang_id=L('lang_id');
    		$rs=$rs->table('yy_fault f,yy_fault_manylanguage fm')->where("f.fault_id=fm.fault_id and fm.lang_id=$lang_id and fm.fault_id=$fault_id")->select();
    		$this->assign('faultShow',$rs);
    		$this->styles='nav_product';
    		$this->display($template);
    	}
    }
    
    //接收用户信息,进行邮件发送!
    public function email(){
    	$email_address =$_POST["email"];
    	$pattern ="/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i";
    	if (preg_match( $pattern, $email_address ) )
    	{
    		$corp=I('request.corp','','htmlspecialchars');
    		$username=I('request.username','','htmlspecialchars');
    		$email=I('request.email','','htmlspecialchars');  //用户邮箱
    		$tell=I('request.tell','','htmlspecialchars');
    		$content=I('request.content','','htmlspecialchars');
    		$body='公司名称:'.$corp.'<br/>用户名:'.$username.'<br/>邮件地埴:'.$email.'<br/>电话:'.$tell.'<br/>内容:'.$content;
    		//var_dump($body);die;
    		vendor('phpMailer.class#phpmailer');
    		vendor('phpMailer.class#smtp');
    		$mail =New \PHPMailer();
    		$mail->IsSMTP();                                      // Set mailer to use SMTP
    		$mail->Host = 'smtp.126.com';  // Specify main and backup server  这里可以直接使用网易的，如smtp.163.com
    		$mail->SMTPAuth = true;                               // Enable SMTP authentication
    		$mail->Username = 'shundatestemail@126.com';                            // SMTP username 这里一般写全比较好，就是带上@的
    		$mail->Password = 'hwx250594698';                           // SMTP password
    		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted 可以不要
    			
    		$mail->From = 'shundatestemail@126.com';
    		$mail->FromName = 'Mailer';
    		$mail->AddAddress('250594698@qq.com', 'Josh Adams');  // Add a recipient  收件人地址和姓名，姓名可以省略
    		$mail->AddReplyTo('shundatestemail@126.com', 'Information');
    		$mail->AddCC('cc@example.com');
    		$mail->AddBCC('bcc@example.com');
    			
    		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    		$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
    		$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    		$mail->IsHTML(true);                                  // Set email format to HTML
    			
    		$mail->Subject ="'用户'.$username.'-提交上来的信息'";  //邮件标题
    		$mail->Body    =$body;    //邮件内容
    		$mail->AltBody = '';
    			
    		if(!$mail->Send()) {
    			echo 'Message could not be sent.';
    			echo 'Mailer Error: ' . $mail->ErrorInfo;
    			exit;
    		}
            echo "<script>alert('发送成功!');window.location.href='cateJump/model_id/6/cateid/50';</script>";
    	
    	}else{
    			
    		echo "<script>alert('您输入的电子邮件地址不合法');window.location.href='cateJump/model_id/6/cateid/50';</script>";
    	}
    	
    }
}