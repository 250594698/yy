<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{	
	//初始化
	public function _initialize(){
		if(empty($_SESSION['admin'])){
			$this->redirect('Admin/Login/login');
			exit();
		}
		$auth=New \Think\Auth();
		$rules=$auth->getGroups(session('uid'));
		$rules=explode(',', $rules[0]['rules']);
		if(!in_array(CONTROLLER_NAME, $rules)){
			$this->error('你没有权限');
		}
		$this->assign('rules',$rules);
	}
}
?>