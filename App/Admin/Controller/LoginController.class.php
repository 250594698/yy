<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
	
	public function _initialize()
	{
		$this->assign('loginErr','display:none;');
	}
	//登入页
	public function login(){
				
		if ($_POST['txtUserName'])
		{
			$user_name = trim($_POST['txtUserName']);
			$password = trim($_POST['txtUserPwd']);
			$user =M('Admin');
			$where['userName'] = $user_name;
			$where['userPwd'] = md5($password);
			$where['status'] = 1;
			$result =$user->where($where)->find();
			if ($result)
			{
				$group = M('Auth_group_access')->where(array('uid' => $result['uid']))->find();
				session('loginGroupId', $group['group_id']);
				session('adminId', $result['uid']);
				session('uid', $result['uid']);
				session('admin', $user_name);
				$this->redirect("News/index");
			}
			else
			{
				$this->assign('loginErr','display:block;');
			}
		}
		
		$this->display();
	}
	
	
	//退出登入
	public function LoginOut(){
		session('adminId', null);
		session('admin', null);
		session('loginGroupId', null);
		$this->redirect("Login/login");
	}
}
?>