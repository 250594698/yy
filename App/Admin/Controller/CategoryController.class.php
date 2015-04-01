<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class CategoryController extends CommonController{
	//分类主页
	public function index(){		
        $m=M('Model');
        //总数
        $count=$m->join('left join yy_category on yy_model.model_id=yy_category.model_id')
        ->join('left join yy_category_description on yy_category_description.categories_id=yy_category.categories_id')
        ->where('yy_category_description.language_id=1 and yy_category.categories_status=1')->count();
        
        $Page= new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        
        $show= $Page->show();// 分页显示输出
        $data=$m->join('left join yy_category on yy_model.model_id=yy_category.model_id')->join('left join yy_category_description on yy_category_description.categories_id=yy_category.categories_id')
        ->where('yy_category_description.language_id=1')->order('sort_order asc,yy_category.sort_order')->limit($Page->firstRow.','.$Page->listRows)->select();
        $rs=digui($data);
        //var_dump($rs);
        $this->assign('list',$rs);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
	}
	
	//添加栏目
	public function add(){
		
		//获取上级栏目id
		$addId=I('request.id',0,'intval');
		
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
		//获取栏目例表
		$m=D('Category');
		$cateList=$m->cateList();
		$modelDatas=$m->getModel();
		$this->assign('modelDatas',$modelDatas);
		$this->lang = $lang;
		$this->langList = $langList;
		$this->assign('cateList',$cateList);
		$this->display();
	}
	
	//添加栏目处理
	public function addAction(){
		if($_FILES['categories_image']['name']!=''){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath  =      './CategoryImages/'; // 设置附件上传目录
			// 上传文件
			$info=$upload->upload();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error($upload->getError());
			  }
			  $imgDir=$info['categories_image']['savepath'].$info['categories_image']['savename'];
			   
			  $data['categories_image'] =str_replace('./','/', $imgDir);
		}
		
	    //图片路径,存入数据库
 		$data['parent_id'] =I('request.pid',0,'intval');
 		$data['sort_order'] =I('request.sort_order','','intval');
 		$data['date_added'] =date('Y-m-d H:i:s',time());
 		$data['categories_status'] = I('request.categories_status',0,'intval');
 		$data['model_id'] = I('request.model_id','','intval');
 		
 		$c=M('Category')->add($data);
 		
 	    if($c){
 	    	$langId = explode(",", C('LANG_ID'));
 	    	foreach ($langId as $v){
 	    		
 	    		$dataCd['categories_id'] =intval($c);
 	    		$dataCd['language_id'] =$v;
 	    		$dataCd['categories_name'] =I("request.categories_name_$v",'','htmlspecialchars');
 	    		$dataCd['categories_description'] =I("request.categories_description_$v",'','htmlspecialchars');
 	    		$cd=M('Category_description')->add($dataCd);
 	    		if(!$cd){
 	    			echo "添加失败2".mysql_error();
 	    		}
 	    		
 	    	}
 	    	$this->redirect('Category/index');
 		  }else{
 			  echo "添加失败".mysql_error();
 		}
	}
	
	//编辑栏目
	public function edit(){
		
		//获取上级栏目id
		$addId=I('request.id',0,'intval');		
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
		
		//获取栏目例表
		$m=D('Category');
		$modelDatas=$m->getModel();		
		//查询要修改的数据
		$editData=$m->editData($addId);
		foreach ($editData as $k=>$value){
			$titleArr[$value['language_id']]=$value['categories_name'];
			$descArr[$value['language_id']]=$value['categories_description'];
			$parent_id=$value['parent_id'];
			$categories_image=$value['categories_image'];
			$categories_status=$value['categories_status'];
			$model_id=$value['model_id'];
			$sort_order=$value['sort_order'];
		}
		
		//获取栏目图片路径
		if ( isset($categories_image) && $categories_image != '')
		{
			$imageShow = '<input type="hidden"  name="del_iamge" value="flase" />
								  <div id="image">
								  <a  href="'.__ROOT__.'/Public/Uploads'.$categories_image.'" class="fancyBox"><img src="'.__ROOT__.'/Public/Uploads'.$categories_image.'" width="200"></a><br /><a  href="#" onclick="delImages();return false;"  class="del">Delete</a></div>';
		}
		//var_dump($editData);
		
		$this->listing = $listing;
		$this->sort_order=$sort_order;
		$this->titleArr = $titleArr;
		$this->descArr = $descArr;
		
		$this->ids=$parent_id;
		$cateList=$m->cateList();
		$this->imageShow=$imageShow;
		//把图片路径传入变量,以便上传新图片，删除老图片
		$img=$categories_image;
		//栏目没有图片,变量不给值
		if($img!=''){
			$this->imageDir=__PUBLIC__.'/Uploads'.$img;
		}
		//当前分类模型id
		$this->model_id=$model_id;
		//模型例表
		$this->assign('modelDatas',$modelDatas);
		$this->addId=$addId;
		$this->assign('cateList',$cateList);
		$this->status=$categories_status;
		$this->lang = $lang;
		$this->langList = $langList;
		$this->display();
	}
	
	//编辑处理
	public function editAction(){
				
		if($_FILES['categories_image']['name']!=''){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath  =      './CategoryImages/'; // 设置附件上传目录
			// 上传文件
			$info=$upload->upload();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error($upload->getError());
			}
		}
		//图片路径,存入数据库
		 
		$imgDir=$info['categories_image']['savepath'].$info['categories_image']['savename'];
		$data['categories_image'] =str_replace('./','/', $imgDir);
		
		$data['parent_id'] =I('request.pid',0,'intval');
		$data['sort_order'] =I('request.sort_order','','intval');
		$data['date_added'] =date('Y-m-d H:i:s',time());
		$data['categories_status'] = I('request.categories_status',0,'intval');
		$data['model_id'] =intval(I('request.model_id'));
		$where['categories_id']=intval(I('request.categories_id'));
		//要删除的旧图片
		$oldImage=trim(I('request.oldImage'));
			
		$c=M('Category')->where($where)->save($data);

		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
				$where['categories_id']=$where['categories_id'];
				$where['language_id']=$v;
				$dataCd['categories_name'] =I("request.categories_name_$v",'','htmlspecialchars');
				$dataCd['categories_description'] =I("request.categories_description_$v",'','htmlspecialchars');
				$cd=M('Category_description')->where($where)->save($dataCd);
				
				if($cd===false){
					echo "修改失败2".mysql_error();
				}
			}
			
			if(isset($oldImage) && $oldImage!=''){
				
				if(!unlink($oldImage)){
					die('删除图片失败!');
				}	
			}
			$this->redirect('Category/index');
		}else{
			echo "修改失败".mysql_error();
		}
		
	}
	
	//删除栏目
	public function delete(){
		$where['categories_id']=I('request.id','','intval');
		$categories_id=$where['categories_id'];
		//查询栏目下有没有文章，有就不能删除栏目
		$article=New Model();
		
		$article=$article->table('yy_category c,yy_model m')->where("c.model_id=m.model_id and c.categories_id=$categories_id")->find();
		$model=$article['model_name'];
		$m=M("$model")->find();
		
		if(!$m){
			echo "<script>alert('封面栏目，不能删除');history.go(-1); </script>";
			die;
		}
		$rs=M("$model")->where($where)->find();
		if($rs){
			echo "<script>alert('栏目下有文章，不能删除');history.go(-1); </script>";
			die;
		}
		
		$c=M('Category')->where($where)->delete();
		
		if(!$c){
			$this->error("删除失败");
		}
		
		$cd=M('Category_description')->where($where)->delete();
		if(!$cd){
			$this->error('删除数据2失败');
		}
	    $this->redirect('Category/index');
	}
	
	//开启-关闭栏目
	public function statsAction(){
		$data['categories_id']=I('request.id','','intval');
		$data['categories_status']=intval(I('request.ac'));
		$c=M('Category')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('Category/index');
		
	}
}