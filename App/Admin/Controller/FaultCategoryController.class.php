<?php
namespace  Admin\Controller;
use Think\Controller;
class FaultCategoryController extends CommonController{
	
	public function index(){
		
		$m=M('Category');	
		$data=$m->join('left join yy_category_description on yy_category_description.categories_id=yy_category.categories_id')
		->where('yy_category_description.language_id=1 and yy_category.categories_id=54')->order('sort_order asc,yy_category.sort_order')->select();
		
		$this->assign('list',$data);
		//var_dump($data);
		$this->display();
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
		 
		 
		$this->listing = $listing;
		$this->sort_order=$sort_order;
		$this->titleArr = $titleArr;
		$this->descArr = $descArr;
		 
		$this->ids=$parent_id;
		$cateList=$m->cateList();
	
		//当前分类模型id
		$this->model_id=$model_id;
		$this->addId=$addId;
		$this->assign('cateList',$cateList);
		$this->status=$categories_status;
		$this->lang = $lang;
		$this->langList = $langList;
		$this->display();
	}
	 
	//编辑处理
	public function editAction(){
			
		$data['parent_id'] =I('request.pid',0,'intval');
		$data['sort_order'] =I('request.sort_order','','intval');
		$data['date_added'] =date('Y-m-d H:i:s',time());
		$data['categories_status'] =1;
		$data['model_id'] =intval(I('request.model_id'));
		$where['categories_id']=intval(I('request.categories_id'));
		 
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
			$this->redirect('FaultCategory/index');
		}else{
			echo "修改失败".mysql_error();
		}
		 
	}
	
	
	//开启-关闭栏目
	public function statsAction(){
		$data['categories_id']=I('request.id','','intval');
		$data['categories_status']=intval(I('request.ac'));
		$c=M('Category')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('FaultCategory/index');
		 
	}
}
?>