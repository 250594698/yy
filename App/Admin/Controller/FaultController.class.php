<?php
//配置控制器
namespace Admin\Controller;
use Think\Controller;

class FaultController extends CommonController{

	public function index(){
		
		//搜索
		$search=trim(I('request.keyword'));
		//排序
		$sort=trim(I('request.sort','yy_fault.fault_sort','htmlspecialchars'));
		$updown=trim(I('request.updown','asc','htmlspecialchars'));
		
		if(isset($search) && $search!=''){
		
			$where['yy_fault_manylanguage.fault_name']=array('like',"%$search%");
		}
		
		//$where['categories_id']=I('request.cateid','','intval');
		$where['lang_id']=1;
		$count=M('Fault')->join('yy_fault_manylanguage on yy_fault.fault_id=yy_fault_manylanguage.fault_id')->where($where)->count();
		$Page=new \Think\Page($count,10);   //分页
		$show=$Page->show();
		
		$newsList=M('Fault')->join('yy_fault_manylanguage on yy_fault.fault_id=yy_fault_manylanguage.fault_id')
		->where($where)->order("$sort $updown")->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->cateid=$where['categories_id'];
		$this->assign('faultList',$newsList);
		//var_dump($newsList);
		$this->assign('page',$show);
		$this->display();
	}
	
	//添加文章
	public function addFault(){
	
// 		$cateid=intval(I('request.cate_id'));
// 		if(isset($cateid) && $cateid!=''){
// 			$this->cateid=$cateid;
// 		}
		$this->cateid=54;
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
	
	//添加处理
	public function addFaultAction(){
		
		$data['categories_id'] =intval(I('request.categories_id'));
		$id=$data['categories_id'];
		
		if($_FILES['fault_img']['name']!='' or $_FILES['fault_img_en']['name']!=''){
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
			$imgDir=$info['fault_img']['savepath'].$info['fault_img']['savename'];
			$imgDir2=$info['fault_img_en']['savepath'].$info['fault_img_en']['savename'];
		
			$data['fault_img'] =str_replace('./','/', $imgDir);
			$data['fault_img_en'] =str_replace('./','/', $imgDir2);
		}
		
		//图片路径,存入数据库
		$data['categories_id'] =I('request.categories_id',0,'intval');
		$data['fault_sort'] =I('request.fault_sort','1','intval');
		$data['fault_adddate'] =date('Y-m-d H:i:s',time());
		$data['fault_status'] = I('request.fault_status',0,'intval');
			
		$c=M('Fault')->add($data);
		
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
		
				$dataCd['fault_id'] =intval($c);
				$dataCd['lang_id'] =$v;
				$dataCd['fault_num'] =I("request.fault_num_$v",'','htmlspecialchars');
				$dataCd['fault_name'] =I("request.fault_name_$v",'','htmlspecialchars');

				$dataCd['fault_cause'] =$_REQUEST["fault_cause_$v"];
				$dataCd['fault_countermeasure'] =$_REQUEST["fault_countermeasure_$v"];
				
				$cd=M('fault_manylanguage')->add($dataCd);
				if(!$cd){
					echo "添加失败2".mysql_error();
				}
		
			}
			$this->redirect('Fault/index',array('cateid'=>$id));
			$this->show('添加');
		}else{
			echo "添加失败".mysql_error();
		}
	}
	
	//编辑文章
	public function editFault(){
		$faultid=intval(I('request.fault_id'));
		
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
		
		$where['yy_fault.fault_id']=$faultid;
		//$where['yy_news_manylanguage.lang_id']=1;
		$c=M('Fault')
		->join('left join yy_fault_manylanguage on yy_fault.fault_id=yy_fault_manylanguage.fault_id')
		->where($where)->select();
		//var_dump($c);
		
		//合并中英文数据
		foreach ($c as $k=>$value){
			
			$fault_num[$value['lang_id']]=$value['fault_num'];
			$fault_name[$value['lang_id']]=$value['fault_name'];
			$fault_cause[$value['lang_id']]=$value['fault_cause'];
			$fault_countermeasure[$value['lang_id']]=$value['fault_countermeasure'];
			
			$fault_img=$value['fault_img'];
			$fault_img2=$value['fault_img_en'];
			$categories_status=$value['fault_status'];
			$fault_sort=$value['fault_sort'];
		}
		
		//获取栏目图片路径
		if ( isset($fault_img) && $fault_img != '')
		{
			$imageShow = '<input type="hidden"  name="del_iamge" value="flase" />
								  <div id="image">
								  <a  href="'.__ROOT__.'/Public/Uploads'.$fault_img.'" class="fancyBox"><img src="'.__ROOT__.'/Public/Uploads'.$fault_img.'" width="200"></a><br /><a  href="#" onclick="delImages();return false;"  class="del">Delete</a></div>';
		}
		if ( isset($fault_img2) && $fault_img2 != '')
		{
			$imageShow2 = '<input type="hidden"  name="del_iamge2" value="flase" />
								  <div id="image2">
								  <a  href="'.__ROOT__.'/Public/Uploads'.$fault_img2.'" class="fancyBox"><img src="'.__ROOT__.'/Public/Uploads'.$fault_img2.'" width="200"></a><br /><a  href="#" onclick="delImages2();return false;"  class="del">Delete</a></div>';

		}
		
		//把图片路径传入变量,以便上传新图片，删除老图片
		$img=$fault_img;
		$img2=$fault_img2;
		
		//栏目没有图片,变量不给值
		if($img!=''){
			$this->imageDir=__PUBLIC__.'/Uploads'.$img;
		}
		
		if($img2!=''){
			$this->imageDir2=__PUBLIC__.'/Uploads'.$img2;
		}
		//输出图片到修改页面
		$this->imageShow=$imageShow;
		$this->imageShow2=$imageShow2;
		
		$this->fault_num=$fault_num;
		$this->fault_name=$fault_name;
		$this->fault_cause=$fault_cause;
		$this->fault_countermeasure = $fault_countermeasure;
		
		$this->fault_sort=$fault_sort;
		$this->fault_id=$faultid;
		$this->cate_id=intval(I('request.cate_id'));
		
		$this->lang = $lang;
		$this->langList = $langList;
	    $this->display();
	}
	
	//编辑处理
	public function editFaultAction(){
		//var_dump($_REQUEST);DIE;
		//var_dump($_FILES);die;		
		if($_FILES['fault_img']['name']!='' or $_FILES['fault_img_en']['name']!=''){
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
			if($info['fault_img']['savename']!=''){

				$imgDir=$info['fault_img']['savepath'].$info['fault_img']['savename'];
				$data['fault_img']=str_replace('./','/', $imgDir);
				//要删除的旧图片
				$oldImage=trim(I('request.oldImage'));
			}
			
			if($info['fault_img_en']['savename']){

				$imgDir2=$info['fault_img_en']['savepath'].$info['fault_img_en']['savename'];
				$data['fault_img_en']=str_replace('./','/', $imgDir2);
				$oldImage2=trim(I('request.oldImage2'));
			}
		}
		
		//delete原来图片，设置为空白
		if($_REQUEST['del_iamge']=='true' and $_FILES['fault_img']['name']==''){
			$data['fault_img'] ='';
		}
		
		if($_REQUEST['del_iamge2']=='true' and $_FILES['fault_img_en']['name']==''){
			$data['fault_img_en']='';
		}
		
        $where['fault_id'] =intval(I('request.fault_id'));
		$data['fault_editdate'] =date('Y-m-d H:i:s',time());  //修改时间
		$data['fault_sort'] =I('request.fault_sort','0','intval');
		$id=intval(I('request.cate_id'));
			
		$c=M('Fault')->where($where)->save($data);
		
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
				$where['fault_id']=$where['fault_id'];
				$where['lang_id']=$v;
				$dataCd['fault_num'] =I("request.fault_num_$v",'','htmlspecialchars');
				$dataCd['fault_name'] =I("request.fault_name_$v",'','htmlspecialchars');
				
				$dataCd['fault_cause'] =$_REQUEST["fault_cause_$v"];
				$dataCd['fault_countermeasure'] =$_REQUEST["fault_countermeasure_$v"];
				
				
				$cd=M('Fault_manylanguage')->where($where)->save($dataCd);
		
				if($cd===false){
					echo "修改失败2".mysql_error();
				}
			}
				
			if(isset($oldImage) && $oldImage!=''){
		
				if(!unlink($oldImage)){
					die('删除图片失败!');
				}
			}
			
			if(isset($oldImage2) && $oldImage2!=''){
			
				if(!unlink($oldImage2)){
					die('删除图片失败!');
				}
			}
			$this->redirect('Fault/index',array('cateid'=>$id));
		}else{
			echo "修改失败".mysql_error();
		}
	
	}
	
	//是否开启，关闭
	public function statsAction(){
		$id=intval(I('request.cateid'));
		$data['fault_id']=I('request.id','','intval');
		$data['fault_status']=intval(I('request.ac'));
		$c=M('Fault')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('Fault/index',array('cateid'=>$id));
	
	}
	
	//删除文章
	public function deleteFault(){
	  
		$id=intval(I('request.cate_id'));
		$where['fault_id']=I('request.fault_id','','intval');
		$c=M('Fault')->where($where)->delete();
		
		if(!$c){
			$this->error("删除失败");
		}
		
		$cd=M('fault_manylanguage')->where($where)->delete();
		if(!$cd){
			$this->error('删除数据2失败');
		}
		$this->redirect('Fault/index',array('cateid'=>$id));
	}
}
?>