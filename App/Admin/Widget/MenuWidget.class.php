<?php
namespace Admin\Widget;
use Think\Controller;
class MenuWidget extends Controller{
	
	//后台目录一级
	public function menuOne(){
		$auth=New \Think\Auth();
		$rules=$auth->getGroups(session('uid'));
		$rules=explode(',', $rules[0]['rules']);
		$this->idtop='Configuration';	
		$this->assign('rules',$rules);
		$this->display('Menu/menuOne');
	}
	
	
	//后台目录left1
	public function menu(){
        $auth=New \Think\Auth();
        $rules=$auth->getGroups(session('uid'));
        $rules=explode(',', $rules[0]['rules']);
        $this->id1='News';
        $this->id2='Category';
        $this->id33='ProductsCategory';
        $this->id3='Products';
        $this->id44='FaultCategory';
        $this->id4='Fault';
        $this->id5='Banners';
        
        $this->assign('rules',$rules);
		$this->display('Menu/menu');
	}
	
	
	//后台目录left1
	public function menu2(){
		
		$auth=New \Think\Auth();
		$rules=$auth->getGroups(session('uid'));
		$rules=explode(',', $rules[0]['rules']);
	
		$menu=C('NAV');
		$arr=array();
		$arrs=array();
		foreach ($menu as $k=>$v){
			$arr[$k]=$v;
		}
		foreach ($arr['Configuration'] as $vs){
			$arrs[]=$vs;
		}
		$this->assign('rules',$rules);
		$this->assign('menu',$arrs);
		$this->display('Menu/menu2');
	}
	
}
?>