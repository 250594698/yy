<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Crypt\Driver\Think;
class ContactusController extends CommonController{
	
	//联系我们
	public function index(){
		$this->success('封面栏目，无数据!');
	}
}
?>