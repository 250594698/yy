<?php
//产品控制器
namespace Admin\Controller;
use Think\Controller;
class ConfiguRationController extends CommonController{

	public function index(){
		$config=M('Conf')->select();
		$this->assign('site',$config);
		$this->display();
	}
	
	
    //保存配置
	public function saveConfiguRation() {
		$arr=$_REQUEST;
        $arrs=array();
		foreach ($arr as $key=>$value){
			
		     $k=substr($key,0,1); //截以conf_id
		     $arrs[$k]=$value;
		     $data['conf_id']=intval($k);
		     $data['conf_value']=$value;
		     $where['conf_id']=$data['conf_id'];
		     $rs=M('Conf')->save($data);
		     if($rs===false){
		     	$this->error('修改失败!');
		     }
		}
		
		//$this->redirect('index');
		$this->success('修改成功!');
	}
}
?>