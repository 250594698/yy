<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class UsersController extends CommonController{
	
	//角色例表
	public function index(){
		$groupList=M('Auth_group')->select();
		$groupid=I('request.id');
		$this->groupid=$groupid;
		$this->assign('groupList',$groupList);
		$this->display();
	}
	
	//添加用户
	public function addUser(){
		$m=M('Auth_group')->select();
		$this->assign('groupList',$m);
		$this->display();
	}
	
	//添加用户处理
	public function addUserAction(){
		$data['userName']=htmlspecialchars(I('request.username'));
		$where['userName']=$data['userName'];
		$datap['userPwd']=htmlspecialchars(I('request.password'));
		$datap['comfirm_password']=htmlspecialchars(I('request.comfirm_password'));
		
		if($data['userName']){
			
		}
		$m=M('Admin');
		
		//查看要注册的名字是否存在!
		$judge=$m->where($where)->find($data);
		if(!$judge){
			if($datap['userPwd']!=$datap['comfirm_password']){
				$this->error('两次密码不一样!');
			}
			$data['userPwd']=md5($datap['comfirm_password']);
			$admin=$m->add($data);
		}else{
			$this->error('用户名已存在!');
		}
		
		
		if(!$admin){
			$this->error('添加失败!');
		}else{
			$datas['uid']=intval($admin);
			$datas['group_id']=htmlspecialchars(I('request.group_id'));
			$auth=M('Auth_group_access')->add($datas);
			if(!$auth){
				$this->error('添加失败2');
			}else{
				$this->success('添加成功!');
			}
		}
	}
	
	//删除用户
	public function deleteUser(){
		$uid=intval(I('request.id'));
		if($uid==1){
			$this->error('超级管理员,不能删除!');
		}
		
		$u=M('Admin')->delete($uid);
		if(!$u){
			$this->error('删除用户失败!');
		}
		
		$auth=M('Auth_group_access')->where("uid=$uid")->delete();
		if(!$auth){
			$this->error('删除失败!');
		}else{
			$this->success('删除成功!');
		}
	}
	
	//编辑用户
	public function editUser(){
		$where['uid']=I('request.id');   //用户id
		$u=M('Admin')->where($where)->find();   //查出当前用户名
		
		$us=M('Auth_group_access')->where($where)->find();
		//var_dump($us);
		$this->groupchecked=$us['group_id'];
		$m=M('Auth_group')->select();
		$this->assign('name',$u);
		$this->assign('groupList',$m);
		$this->display();
	}
	
	//编辑用户处理
	public function editUserAction(){
 		$data['uid']=intval(I('request.id'));
 		$dataa['group_id']=I('request.group_id');
		
		$datas['uid']=intval(I('request.id'));
		$datas['userName']=htmlspecialchars(I('request.username'));
        $uname=M('Admin');
        
        $us=$uname->find($datas['uid']);  //查询用户名字是否和提交上来的一样
        if($us['userName']!=$datas['userName']){
            $u=$uname->save($datas);    //修改用户名
            
            if(!$u){
            	$this->error('修改用户名失败!');
            }else{
            	$this->success('修改用户名成功!');
            }
        }
        
        $a=M('Auth_group_access');
        $as=$a->find($data['uid']);
        if($as['group_id']!=$dataa['group_id']){
        	
        	$m=$a->where($data)->save($dataa);  //修改用户组
        	if(!$m){
        		$this->error('修改用户组失败');
        	}else{
        		$this->success('修改用户组成功!');
        	}
        }
	}
	//查询角色用户数
	public function groupUsers(){
		$where['yy_auth_group.id']=intval(I('request.id'));
		$rs=M('Auth_group')->join('yy_auth_group_access on yy_auth_group.id=yy_auth_group_access.group_id')
		->join('yy_admin on yy_auth_group_access.uid=yy_admin.uid')->where($where)->select();
		//var_dump($rs);
		$this->assign('usersList',$rs);
		$this->display();
	}
	
	//权限配置
	public function editAccess(){
		//查询已经有的权限
		$where['id']=intval(I('request.id'));
		$title=M('Auth_group')->where($where)->find();
		$this->assign('title',$title);
		$arr=explode(',',$title['rules']);
		$this->arr=$arr;

		//查询原始权限
		$leve1=C('NAV');
		$this->assign('leve1',$leve1);
		$this->display();
	}
	
	//权限处理
	public function editAccessAction(){
		$data['id']=intval(I('request.id'));
		$data['rules']=implode(',',$_REQUEST['rule']);
		$rs=M('Auth_group')->save($data);
		if($rs===false){
			$this->error('修改失败');
		}
		$this->success('修改成功!');
	}
	
	//修改用户密码
	public function changePwd(){
		$id=intval(I('request.id'));
		$this->id=$id;
		$this->display();
	}
	
	//修改密码处理
	public function changePwdAction(){
		//var_dump($_REQUEST);
		$id=intval(I('request.id'));
		$where['uid']=$id;
		$comfirm_password=I('request.comfirm_password');//确认密码
		$adminPwd=M('Admin')->where($where)->find();
		
		if($_REQUEST['old_password']=='' or $_REQUEST['new_password']==''){
			$this->error('密码不能为空');
		}
		if($adminPwd['userPwd']!=md5($_REQUEST['old_password'])){
			$this->error('旧密码不正确，请从新输入!');
		}
		if(I('request.new_password')!=$comfirm_password){
			$this->error('密码输入不正确!');
		}
		
		$data['uid']=$id;
		$data['userPwd']=md5($comfirm_password);
		$rs=M('Admin')->save($data);
		if(!$rs){
			$this->error('修改失败');
		}else{
			$this->success('修改成功!','index');
		}
	}
	
	//开启-关闭栏目
	public function statsAction(){
		$id=intval(I('request.id'));
		$data['uid']=intval(I('request.uid'));
		$data['status']=intval(I('request.ac'));
		$c=M('Admin')->save($data);
		if(!$c){
			$this->error("操作失败!");
		}
		$this->redirect('Users/groupUsers',array('id'=>$id));
	}
}
?>