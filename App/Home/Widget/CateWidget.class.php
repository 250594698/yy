<?php
namespace Home\Widget;
use Think\Controller;
class CateWidget extends Controller{
	
	public function menu(){
		$lang_id=L('lang_id');
		$m=M('Model');
		$data=$m->join('left join yy_category on yy_model.model_id=yy_category.model_id')->join('left join yy_category_description on yy_category_description.categories_id=yy_category.categories_id')
		->where("yy_category_description.language_id=$lang_id")->order('sort_order asc,yy_category.sort_order')->select();
		$rs=digui($data);
		
		//输出一级分类
		$arr=array();
		foreach ($rs as $v){
			if($v['level']==1){
			  $arr[]=$v;	
			}
		}
		
		//$this->assign('menu',$arr);
		$this->display('Cate/menu');	 
	}
	
	//最新消息二级分类
	public function menu2(){
		$haha='->where("yy_news_manylanguage.lang_id=$lang_id")';
		$lang_id=L('lang_id');
        $m=M('News')->field('news_year')->group('news_year')->order('news_year desc')->select();
		$this->assign('menu2',$m);
		//var_dump($m);
		$this->display('Cate/menu2');
		
	}
	
	//产品介绍二级分类
	public function menuProducts(){
		$lang_id=L('lang_id');
		$m=M('Model');
		$data=$m->join('left join yy_category on yy_model.model_id=yy_category.model_id')->join('left join yy_category_description on yy_category_description.categories_id=yy_category.categories_id')
		->where("yy_category_description.language_id=$lang_id and yy_category.categories_status=1")->order('yy_category.sort_order')->select();
		$rs=digui($data);
	
		//输出二级分类
		$arr=array();
		foreach ($rs as $v){
			if($v['parent_id']==27){
				$arr[]=$v;
			}
		}
		$arrs=array();
		foreach($rs as $v){
			if($v['categories_id']==54){
				$arrs[]=$v;
			}
		}
	
		$this->assign('menu2',$arr);
		$this->assign('menu3',$arrs);
		$this->display('Cate/menuProducts');
	
	}
	
	//产品介绍二级分类首页调用
	public function menuProductsindex(){
		$lang_id=L('lang_id');
		$m=M('Model');
		$data=$m->join('left join yy_category on yy_model.model_id=yy_category.model_id')->join('left join yy_category_description on yy_category_description.categories_id=yy_category.categories_id')
		->where("yy_category_description.language_id=$lang_id")->order('yy_category.sort_order')->select();
		$rs=digui($data);
	
		//输出二级分类
		$arr=array();
		foreach ($rs as $v){
			if($v['parent_id']==27 and $v['model_id']==2){
				$arr[]=$v;
			}
		}
		//限制3条
	    $arrs=array();
		for($i=0;$i<3;$i++){
			$arrs[]=$arr[$i];
		}
		$this->assign('menu2index',$arrs);
		//var_dump($arrs);
		$this->display('Cate/menuProductsindex');
	
	}
	
	//首页最新消息调用
	public function menuindex(){
			$lang_id=L('lang_id');
			$rs=M('News');
			$rs=$rs->join('left join yy_news_manylanguage on yy_news.news_id=yy_news_manylanguage.news_id')
			->where("yy_news_manylanguage.lang_id=$lang_id and yy_news.news_status=1")->order('yy_news.news_adddate desc')->limit(3)->select();
		$this->assign('menuindex',$rs);
		$this->display('Cate/menuindex');
	
	}
	
	//产品物性表调用
	public function menusindexCatalogues(){
		$lang_id=L('lang_id');
		$rs=M('Products');
		$rs=$rs->join('left join yy_products_manylanguage on yy_products.products_id=yy_products_manylanguage.products_id')
		->where("yy_products_manylanguage.lang_id=$lang_id and yy_products.categories_id=52 and yy_products.products_status=1")->order('yy_products.products_sort_index asc')->limit(4)->select();
		$this->assign('Catalogues',$rs);
		$this->display('Cate/menusindexCatalogues');
	
	}
	
	//产品介绍
	public function Product(){
		$lang_id=L('lang_id');
		$rs=M('Products');
		$rs=$rs->join('left join yy_products_manylanguage on yy_products.products_id=yy_products_manylanguage.products_id')
		->where("yy_products_manylanguage.lang_id=$lang_id and yy_products.products_status=1")->order('yy_products.products_adddate desc')->limit(3)->select();
		$this->assign('Product',$rs);
		$this->display('Cate/Product');
	
	}
}
?>