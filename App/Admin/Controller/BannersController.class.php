<?php
//广告控制器
namespace Admin\Controller;
use Think\Controller;
class BannersController extends CommonController{
	//广告例表
	public function index(){
		
		//搜索
		$search=trim(I('request.keyword'));
		//排序
		$sort=trim(I('request.sort','yy_banners.banner_id','htmlspecialchars'));
		$updown=trim(I('request.updown','asc','htmlspecialchars'));
		
		if(isset($search) && $search!=''){
		
			$where['yy_banners_manylanguage.banner_title']=array('like',"%$search%");
		}
		
		$where['yy_banners_manylanguage.lang_id']=1;
		$count=M('Banners')->join('yy_banners_manylanguage on yy_banners.banner_id=yy_banners_manylanguage.banner_id')
		->where($where)->count();
		$Page=new \Think\Page($count,5);   //分页
		$show=$Page->show();
		
		$newsList=M('Banners')->join('yy_banners_manylanguage on yy_banners.banner_id=yy_banners_manylanguage.banner_id')
		->where($where)->order("$sort $updown")->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->cateid=$where['categories_id'];
		$this->assign('bannerList',$newsList);
		$this->assign('page',$show);
		$this->display();
	}
	
	//添加广告
	public function addBanner(){
		
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
		
		$this->lang = $lang;
		$this->langList = $langList;
		$this->display();
	}
	
	//添加广告处理
	public function addBannerAction(){
			
		if($_FILES['banner_image']['name']!=''){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath  =      './BannersImages/'; // 设置附件上传目录
			// 上传文件
			$info=$upload->upload();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error($upload->getError());
			}
			$imgDir=$info['banner_image']['savepath'].$info['banner_image']['savename'];
		
			$data['banner_image'] =str_replace('./','/', $imgDir);
		}
		
		//图片路径,存入数据库
		$data['banner_added'] =date('Y-m-d H:i:s',time());
		$data['banner_status'] = I('request.fault_status',0,'intval');
		$data['sort_order'] =I('request.sort_order','','intval');
			
		$c=M('Banners')->add($data);
		
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
		
				$dataCd['banner_id'] =intval($c);
				$dataCd['lang_id'] =$v;
				$dataCd['banner_title'] =I("request.banner_title_$v",'','htmlspecialchars');
		
				$dataCd['banner_url'] =$_REQUEST["banner_url_$v"];
		
				$cd=M('Banners_manylanguage')->add($dataCd);
				if(!$cd){
					echo "添加失败2".mysql_error();
				}
		
			}
			$this->redirect('Banners/index');
			$this->show('添加');
		}else{
			echo "添加失败".mysql_error();
		}
	}
	
	//编辑广告
	public function editBanner(){
		$banner_id=intval(I('request.banner_id'));
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
		
		$where['yy_banners.banner_id']=$banner_id;
		$c=M('Banners')
		->join('left join yy_banners_manylanguage on yy_banners.banner_id=yy_banners_manylanguage.banner_id')
		->where($where)->select();
		
		//合并中英文数据
		foreach ($c as $k=>$value){
				
			$banner_title[$value['lang_id']]=$value['banner_title'];
			$banner_url[$value['lang_id']]=$value['banner_url'];
				
			$banner_image=$value['banner_image'];
			$banner_status=$value['banner_status'];
			$sort_order=$value['sort_order'];
		}
		
		//获取栏目图片路径
		if ( isset($banner_image) && $banner_image != '')
		{
			$imageShow = '<input type="hidden"  name="del_iamge" value="flase" />
								  <div id="image">
								  <a  href="'.__ROOT__.'/Public/Uploads'.$banner_image.'" class="fancyBox"><img src="'.__ROOT__.'/Public/Uploads'.$banner_image.'" width="200"></a><br /><a  href="#" onclick="delImages();return false;"  class="del">Delete</a></div>';
		}
		
		//把图片路径传入变量,以便上传新图片，删除老图片
		$img=$banner_image;
		//栏目没有图片,变量不给值
		if($img!=''){
			$this->imageDir=__PUBLIC__.'/Uploads'.$img;
		}
		//输出图片到修改页面
		$this->imageShow=$imageShow;
		
		$this->banner_title=$banner_title;
		$this->banner_url=$banner_url;
		$this->banner_status=$banner_status;
		$this->sort_order =$sort_order;
		
		$this->banner_id=$banner_id;
		
		$this->lang = $lang;
		$this->langList = $langList;
		$this->display();
	}
	
	//编辑广告处理
	public function editBannerAction(){
// 		var_dump($_REQUEST);
// 		var_dump($_FILES);DIE;
		if($_FILES['banner_image']['name']!=''){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath  =      './BannersImages/'; // 设置附件上传目录
			// 上传文件
			$info=$upload->upload();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error($upload->getError());
			}
				
			//图片路径,存入数据库
			$imgDir=$info['banner_image']['savepath'].$info['banner_image']['savename'];
			$data['banner_image']=str_replace('./','/', $imgDir);
				
			//要删除的旧图片
			$oldImage=trim(I('request.oldImage'));
		}
		$where['banner_id'] =intval(I('request.banner_id'));
		$data['banner_modification'] =date('Y-m-d H:i:s',time());  //修改时间
		$data['banner_status'] =I('request.banner_status','1','intval');
		$data['sort_order'] =I('request.sort_order','','intval');
			
		$c=M('Banners')->where($where)->save($data);
		
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
				$where['banner_id']=$where['banner_id'];
				$where['lang_id']=$v;
				
				$dataCd['banner_title'] =I("request.banner_title_$v",'','htmlspecialchars');
				$dataCd['banner_url'] =I("request.banner_url_$v",'','htmlspecialchars');		
		
				$cd=M('Banners_manylanguage')->where($where)->save($dataCd);
		
				if($cd===false){
					echo "修改失败2".mysql_error();
				}
			}
		
			if(isset($oldImage) && $oldImage!=''){
		
				if(!unlink($oldImage)){
					die('删除图片失败!');
				}
			}
			$this->redirect('Banners/index');
		}else{
			echo "修改失败".mysql_error();
		}
	}
	
	//删除广告
	public function deleteBanner(){
		//var_dump($_REQUEST);
		
		$banner_id=intval(I('request.banner_id'));
		
		$b=M('Banners')->delete($banner_id);
		if(!$b){
			$this->error('删除广告失败!');
		}
		
		$bm=M('Banners_manylanguage')->where("banner_id=$banner_id")->delete();
		if(!$bm){
			$this->error('删除失败!');
		}else{
			$this->redirect('index');
		}
	}
	
	//开启-关闭栏目
	public function statsAction(){
		$data['banner_id']=intval(I('request.id'));
		$data['banner_status']=intval(I('request.ac'));
		$c=M('Banners')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('Banners/index');
	}
}
?>