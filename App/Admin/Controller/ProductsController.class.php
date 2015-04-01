<?php
//配置控制器
namespace Admin\Controller;
use Think\Controller;
use Think\Model;

class ProductsController extends CommonController{
	public function index(){		
		$cm=New Model();
		$cate=$cm->table('yy_category c,yy_category_description cd')->where('c.categories_id=cd.categories_id and c.parent_id=27 and cd.language_id=1')
	    ->select();
		$this->assign('cateList',$cate);
				
		//搜索
		$categroys_id=I('request.categories_id');
				
		$products_status=I('request.products_status','');
		$search=trim(I('request.keyword'));
		
		if(isset($search) && $search!=''){
			$where['yy_products_manylanguage.products_name_en']=array('like',"%$search%");
		}
		//分类id
		if($categroys_id!=''){

			$where['yy_products.categories_id']=$categroys_id;
			$this->cateid=$categroys_id;
		}
		//是否开启搜索
		if($products_status!=''){
			$where['yy_products.products_status']=$products_status;
		}
		
		//排序
		$sort=trim(I('request.sort','yy_products.products_sort','htmlspecialchars'));
		$updown=trim(I('request.updown','desc','htmlspecialchars'));
		
		$where['lang_id']=1;
		$count=M('Products')->join('yy_products_manylanguage on yy_products.products_id=yy_products_manylanguage.products_id')->where($where)->count();
		$Page=new \Think\Page($count,10);   //分页
		$show=$Page->show();
		
		$newsList=M('Products')->join('yy_products_manylanguage on yy_products.products_id=yy_products_manylanguage.products_id')
		->where($where)->order("$sort $updown")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		//状态
		$status=array(
				array('name'=>'All Status','value'=>''),
				array('name'=>'On','value'=>1),
				array('name'=>'Off','value'=>2),
		);
		
		$this->assign('statusList',$status);
		$this->products_status=$products_status;
		
		$this->assign('productsList',$newsList);
		//var_dump($newsList);
		$this->assign('page',$show);
		$this->display();
	}
	
	//添加文章
	public function addProducts(){
	
		$rs=M('Category')->join('yy_category_description on yy_category.categories_id=yy_category_description.categories_id')
		->where('parent_id=27 and yy_category_description.language_id=1')->select();
		//判断语言
		$langList = explode(",", C('LANG_LIST'));
		$lang = array();
		foreach($langList as $item)
		{
			$langTxt = '';
			//if ($item == 'tchinese') $langTxt = '繁體';
			if ($item == 'zh-cn') $langTxt = '简体';
			if ($item == 'en-us')  $langTxt = 'English';
			$lang[] = array("value" => $item, 'txt'=> $langTxt );
		}
	    $this->assign('cateList',$rs);
		$this->lang = $lang;
		$this->langList = $langList;
	
		$this->display();
	}
	
	//添加处理
	public function addProductsAction(){
		$data['categories_id'] =intval(I('request.cateid'));		
		if($_FILES['products_img']['name'][0]!='' or $_FILES['products_img']['name'][1]!=''){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath  =      './ProductsImages/'; // 设置附件上传目录
			// 上传文件
			$info=$upload->upload();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error($upload->getError());
			}
			$imgDir_img=$info[0]['savepath'].$info[0]['savename'];
			$imgDir_IndexImg=$info[1]['savepath'].$info[1]['savename'];
		
			$data['products_img'] =str_replace('./','/', $imgDir_img);
			$data['products_IndexImg'] =str_replace('./','/', $imgDir_IndexImg);
		}
		
		//图片路径,存入数据库
		$data['categories_id'] =intval(I('request.cateid'));
		$data['products_sort'] =I('request.sort_order','','intval');
		$data['products_sort_index'] =I('request.sort_order_index','','intval');
		$data['products_adddate'] =date('Y-m-d H:i:s',time());
		$data['products_status'] = I('request.products_status',0,'intval');
			
		$c=M('Products')->add($data);
		
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
		
				$dataCd['products_id'] =intval($c);
				$dataCd['lang_id'] =$v;
				$dataCd['products_name'] =I("request.products_name_$v",'','htmlspecialchars');
				$dataCd['products_name_en'] =I("request.products_name_en_$v",'','htmlspecialchars');
				
// 				$dataCd['products_description'] =I("request.products_description_$v",'','htmlspecialchars');
// 				$dataCd['products_feature'] =I("request.products_feature_$v",'','htmlspecialchars');
// 				$dataCd['products_use'] =I("request.products_use_$v",'','htmlspecialchars');

				$dataCd['products_description'] =$_REQUEST["products_description_$v"];
// 				$dataCd['products_feature'] =$_REQUEST["products_feature_$v"];
// 				$dataCd['products_use'] =$_REQUEST["products_use_$v"];
				
				$cd=M('Products_manylanguage')->add($dataCd);
				if(!$cd){
					echo "添加失败2".mysql_error();
				}
		
			}
			$this->redirect('Products/index');
			$this->show('添加');
		}else{
			echo "添加失败".mysql_error();
		}
	}
	
	//编辑文章
	public function editProducts(){
		
		$cateList=M('Category')->join('yy_category_description on yy_category.categories_id=yy_category_description.categories_id')
		->where('parent_id=27 and yy_category_description.language_id=1')->select();
		$productsid=intval(I('request.products_id'));
		
		//判断语言
		$langList = explode(",", C('LANG_LIST'));
		$lang = array();
		foreach($langList as $item)
		{
			$langTxt = '';
			//if ($item == 'tchinese') $langTxt = '繁體';
			if ($item == 'zh-cn') $langTxt = '简体';
			if ($item == 'en-us')  $langTxt = 'English';
			$lang[] = array("value" => $item, 'txt'=> $langTxt );
		}
		
		$where['yy_products.products_id']=$productsid;
		$cateid=M('Products')->where("products_id=$productsid")->find();
		$this->cateid=$cateid['categories_id'];
		
		$c=M('Products')
		->join('left join yy_products_manylanguage on yy_products.products_id=yy_products_manylanguage.products_id')
		->where($where)->select();
		//var_dump($c);
		
		//合并中英文数据
		foreach ($c as $k=>$value){
			$nameArr[$value['lang_id']]=$value['products_name'];
			$name_enArr[$value['lang_id']]=$value['products_name_en'];
			
			$products_description[$value['lang_id']]=$value['products_description'];
			$products_feature[$value['lang_id']]=$value['products_feature'];
			$products_use[$value['lang_id']]=$value['products_use'];
			
			$products_img=$value['products_img'];
			$products_imgs=$value['products_IndexImg'];
			$categories_status=$value['products_status'];
			$news_sort=$value['products_sort'];
			$news_sort_index=$value['products_sort_index'];
		}
		
		//获取栏目图片路径
		if ( isset($products_img) && $products_img != '')
		{
			$imageShow = '<input type="hidden"  name="del_iamge" value="flase" />
								  <div id="image">
								  <a  href="'.__ROOT__.'/Public/Uploads'.$products_img.'" class="fancyBox"><img src="'.__ROOT__.'/Public/Uploads'.$products_img.'" width="200"></a><br /><a  href="#" onclick="delImages();return false;"  class="del">Delete</a></div>';
		}
		
		//获取首页栏目图片路径
		if ( isset($products_imgs) && $products_imgs != '')
		{
			$imageShows = '<input type="hidden"  name="del_iamges" value="flase" />
								  <div id="image2">
								  <a  href="'.__ROOT__.'/Public/Uploads'.$products_imgs.'" class="fancyBox"><img src="'.__ROOT__.'/Public/Uploads'.$products_imgs.'" width="200"></a><br /><a  href="#" onclick="delImages2();return false;"  class="del">Delete</a></div>';
		}
		
		//把图片路径传入变量,以便上传新图片，删除老图片
		$img=$products_img;
		$imgs=$products_imgs;
		//栏目没有图片,变量不给值
		if($img!=''){
			$this->imageDir=__PUBLIC__.'/Uploads'.$img;
		}
		
		if($imgs!=''){
			$this->imageDirs=__PUBLIC__.'/Uploads'.$imgs;
		}
		
		//输出图片到修改页面
		$this->imageShow=$imageShow;
		$this->imageShows=$imageShows;
		
		$this->nameArr=$nameArr;
		$this->name_enArr=$name_enArr;
		$this->products_description = $products_description;
		$this->products_feature = $products_feature;
		$this->products_use =$products_use;
		
		$this->products_sort=$news_sort;
		$this->products_sort_index=$news_sort_index;
		$this->products_id=$productsid;
		$this->cate_id=intval(I('request.cate_id'));
		$this->assign('cateList',$cateList);
		
		$this->lang = $lang;
		$this->langList = $langList;
	    $this->display();
	}
	
	//编辑文章处理
	public function editProductsAction(){
		//var_dump($_FILES['products_img']['name']);
// 		var_dump($_FILES['products_img']);
// 		die;
				
		if($_FILES['products_img']['name'][0]!='' or $_FILES['products_img']['name'][1]!=''){
			//die("进来了");
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath  =      './ProductsImages/'; // 设置附件上传目录
			// 上传文件
			$info=$upload->upload();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error($upload->getError());
			}
			
			//图片路径,存入数据库			
			$imgDir_img=$info[0]['savepath'].$info[0]['savename'];
			$imgDir_IndexImg=$info[1]['savepath'].$info[1]['savename'];
			
			
			if(!empty($info[0]['savepath'])){
				
				$data['products_img'] =str_replace('./','/', $imgDir_img);
			}
			
			if(!empty($info[1]['savepath'])){

				$data['products_IndexImg'] =str_replace('./','/', $imgDir_IndexImg);
			}
			
			//有新图片上传,赋值要删除的旧图片
			if($_FILES['products_img']['name'][0]!=''){
				$oldImage=trim(I('request.oldImage'));
			}
			
			if($_FILES['products_img']['name'][1]!=''){
				$oldImages=trim(I('request.oldImages'));
			}	
		}
		
		//delete原来图片，设置为空白
		if($_REQUEST['del_iamge']=='true' and $_FILES['products_img']['name'][0]==''){
			$data['products_img'] ='';
		}
		
		if($_REQUEST['del_iamges']=='true' and $_FILES['products_img']['name'][1]==''){
			$data['products_IndexImg']='';
		}
		
        $where['products_id'] =intval(I('request.products_id'));
        $data['products_editdate'] =date('Y-m-d H:i:s',time());  //修改时间
		$data['categories_id'] =intval(I('request.cateid'));  //修改时间
		$data['products_sort'] =I('request.sort_order','0','intval');
		$data['products_sort_index'] =I('request.sort_order_index','0','intval');
			
		$c=M('Products')->where($where)->save($data);
		
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
				$where['products_id']=$where['products_id'];
				$where['lang_id']=$v;
				$dataCd['products_name'] =I("request.products_name_$v",'','htmlspecialchars');
				$dataCd['products_name_en'] =I("request.products_name_en_$v",'','htmlspecialchars');
				//$dataCd['news_content'] =I("request.news_content_$v",'','htmlspecialchars');
				$dataCd['products_description'] =$_REQUEST["products_description_$v"];
				$dataCd['products_feature'] =$_REQUEST["products_feature_$v"];
				$dataCd['products_use'] =$_REQUEST["products_use_$v"];
				
				
				$cd=M('Products_manylanguage')->where($where)->save($dataCd);
		
				if($cd===false){
					echo "修改失败2".mysql_error();
				}
			}
				
			if(isset($oldImage) && $oldImage!=''){
		
				if(!unlink($oldImage)){
					die('删除图片失败!');
				}
			}
			
			if(isset($oldImages) && $oldImages!=''){
			
				if(!unlink($oldImages)){
					die('删除图片失败!');
				}
			}
			$this->redirect('Products/index');
		}else{
			echo "修改失败".mysql_error();
		}
	
	}
	
	//是否开启，关闭
	public function statsAction(){
		//var_dump($_REQUEST);die;
		$id=intval(I('request.cateid'));
		$data['products_id']=I('request.id','','intval');
		$data['products_status']=intval(I('request.ac'));
		$c=M('Products')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('Products/index',array('cateid'=>$id));
	
	}
	
	//删除文章
	public function deleteProducts(){
	  
		$id=intval(I('request.cate_id'));
		$where['products_id']=I('request.products_id','','intval');
		$c=M('Products')->where($where)->delete();
		
		if(!$c){
			$this->error("删除失败");
		}
		
		$cd=M('Products_manylanguage')->where($where)->delete();
		if(!$cd){
			$this->error('删除数据2失败');
		}
		$this->redirect('Products/index',array('cateid'=>$id));
	}
}
?>