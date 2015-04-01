<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model{
	
	//获取栏目例表
	public function cateList(){
		$m=new Model();
		$data=$m->query("select * from yy_category as c left join yy_category_description as cd on c.categories_id=cd.categories_id where cd.language_id=1");
		$data=digui($data);
		return $data;
	}
	
	//栏目编辑获取要修改的数据
	public function editData($id){
		$m=M('Category');
		$datas['c.categories_id']=$id;
		$data=$m->table('yy_category c,yy_category_description cd')->where('c.categories_id=cd.categories_id')->where($datas)->select();
		return $data;
	}
	
	//获取内容模型数据
	public function getModel(){
		$modelDatas=M('Model')->select();
		return $modelDatas;
	}
}