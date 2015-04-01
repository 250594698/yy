<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\String;
class NewsController extends CommonController{
	//news list
	public function Index(){
		//搜索
		$news_status=I('request.news_status');
		if($news_status==1 or $news_status==2){
		   $where['news_status']=$news_status;
		}		
		$search=trim(I('request.keyword'));
		//排序
		$sort=trim(I('request.sort','yy_news.news_adddate','htmlspecialchars'));
		$updown=trim(I('request.updown','desc','htmlspecialchars'));
		
		if(isset($search) && $search!=''){
			
			$where['news_title']=array('like',"%$search%");
		}

		$where['lang_id']=1;
		
		$count=M('News')->join('yy_news_manylanguage on yy_news.news_id=yy_news_manylanguage.news_id')->where($where)->count();
		$Page=new \Think\Page($count,10);   //分页
		$show=$Page->show();
		$newsList=M('News')->join('yy_news_manylanguage on yy_news.news_id=yy_news_manylanguage.news_id')
		->where($where)->order("$sort $updown")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		//状态
		$status=array(
				array('name'=>'All Status','value'=>''),
				array('name'=>'On','value'=>1),
				array('name'=>'Off','value'=>2),
		);
		
		$this->assign('statusList',$status);
		$this->news_status=$news_status;
		$this->cateid=$where['categories_id'];
		$this->assign('newsList',$newsList);
		$this->assign('page',$show);
		$this->display();
	}
	
	//add news
	public function addNews(){
		$cateid=intval(I('request.cate_id'));
		if(isset($cateid) && $cateid!=''){
		  $this->cateid=$cateid;
		}
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
		$this->news_adddate=date('Y-m-d H:i:s',time());
		
		$this->display();
	}
	
	//add news action
	public function addNewsAction(){		
		$data['news_adddate'] =I('request.news_added');
		$times=strtotime(I('request.news_added'));
		$data['news_year'] =date('Y',$times);
		$data['news_sort'] =I('request.sort_order','','intval');
			
		$c=M('News')->add($data);
			
		if($c){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
		
				$dataCd['news_id'] =intval($c);
				$dataCd['lang_id'] =$v;
				$dataCd['news_title'] =I("request.news_title_$v",'','htmlspecialchars');
				$dataCd['news_content'] =$_REQUEST["news_content_$v"];
				$cd=M('News_manylanguage')->add($dataCd);
				if(!$cd){
					echo "添加失败2".mysql_error();
				}
		
			}
			$this->redirect('News/index');
		}else{
			echo "添加失败".mysql_error();
		}
		
	}
	
	//编辑新闻
	public function editNews(){
		$news_id=intval(I('request.news_id'));
		
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
		$where['yy_news.news_id']=$news_id;
		//$where['yy_news_manylanguage.lang_id']=1;
		$c=M('News')
		->join('left join yy_news_manylanguage on yy_news.news_id=yy_news_manylanguage.news_id')
		->where($where)->select();
		
		//合并中英文数据
		foreach ($c as $k=>$value){
			$titleArr[$value['lang_id']]=$value['news_title'];
			$descContent[$value['lang_id']]=$value['news_content'];
			$news_adddate=$value['news_adddate'];
			$categories_status=$value['news_status'];
			$news_sort=$value['news_sort'];
		}
		$this->titleArr = $titleArr;
		$this->descContent = $descContent;
		$this->news_adddate=$news_adddate;
		$this->news_sort=$news_sort;
		$this->news_id=$news_id;
		$this->cate_id=intval(I('request.cate_id'));		
		$this->lang = $lang;
		$this->langList = $langList;
		$this->display();
		
	}
	
	//编辑新闻处理
	public function editNewsAction(){
		$where['news_id'] =intval(I('request.news_id'));  //修改时间
		$data['news_adddate'] =I('request.news_added');  //修改时间
		$times=strtotime(I('request.news_added'));
		$data['news_year'] =date('Y',$times);
		$data['news_sort'] =I('request.sort_order','0','intval');
		$id=intval(I('request.cate_id'));
		$c=M('News')->where($where)->save($data);
		
		if($c!==false){
			$langId = explode(",", C('LANG_ID'));
			foreach ($langId as $v){
				$where['news_id']=$where['news_id'];
				$where['lang_id']=$v;
				$dataCd['news_title'] =I("request.news_title_$v",'','htmlspecialchars');
				//$dataCd['news_content'] =I("request.news_content_$v",'','htmlspecialchars');
				$dataCd['news_content'] =$_REQUEST["news_content_$v"];
				$cd=M('News_manylanguage')->where($where)->save($dataCd);
		
				if($cd===false){
					echo "修改失败2".mysql_error();
				}
			}
			
			$this->redirect('News/index',array('cateid'=>$id));
		}else{
			echo "修改失败".mysql_error();
		}
	}
	
	//删除新闻
	public function deleteNews(){
		$id=intval(I('request.cate_id'));
		$where['news_id']=I('request.news_id','','intval');
		$c=M('News')->where($where)->delete();
		
		if(!$c){
			$this->error("删除失败");
		}
		
		$cd=M('News_manylanguage')->where($where)->delete();
		if(!$cd){
			$this->error('删除数据2失败');
		}
		$this->redirect('News/index',array('cateid'=>$id));
	}
	//批量删除新闻
	public function deleteNewsAll(){
		
	}
	
	//开启-关闭栏目
	public function statsAction(){
		$id=intval(I('request.cateid'));
		$data['news_id']=I('request.id','','intval');
		$data['news_status']=intval(I('request.ac'));
		$c=M('News')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('News/index',array('cateid'=>$id));
	
	}
}
?>