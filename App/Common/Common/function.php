<?php
//栏目递归
function digui($data,$html='&nbsp;&nbsp;&nbsp;&nbsp;',$pid=0,$level=0){
	$arr=array();
	foreach($data as $value){
		if($value['parent_id']==$pid){
			$value['level']=$level+1;
			$value['html']=str_repeat($html, $level);
			$arr[]=$value;
			$arr=array_merge($arr,digui($data,$html,$value['categories_id'],$level+1));
		}
	}
	return $arr;
}

//节点弟归
function node_merge($node,$access=null,$pid=0){
	$arr=array();
	foreach ($node as $v){
		if(is_array($access)){		
		   $v['access']=in_array($v['id'],$access)?1:0;
		}
		if($v['pid']==$pid){
		   $v['child']=node_merge($node,$access,$v['id']);
		   $arr[]=$v;		   
		}
	}
	
	return $arr;
}

//回复递归
function reply($rs,$pid=0){
	$arr=array();
	foreach ($rs as $v){
		
		if($v['parent_id']==$pid){
			$v['child']=reply($rs,$v['comment_id']);
			$arr[]=$v;
		}
	}
	return $arr;
}

/**
 * 根据不同的字段，查询sql快速度排序按钮
 * @param  [string] $field
 * @return [string]
 */
function createUpDownLink($field,$index = 'index')
{
	$upIcon =__ROOT__.'/Public/imagesAdmin/16x16/up_16.png';
	$downIcon = __ROOT__.'/Public/imagesAdmin/16x16/down_16.png';
	if((isset($_GET['sort'] ) && !empty($_GET['sort'])) && (isset($_GET['updown'] ) && !empty($_GET['updown'])))
	{
		if($field === $_GET['sort'])
		{
			if($_GET['updown'] === 'asc')
				//$upIcon = '__PUBLIC__/imagesAdmin/icons/16x16/up_red_16.png';
			    $upIcon =__ROOT__.'/Public/imagesAdmin/16x16/up_red_16.png';
			else if ($_GET['updown'] === 'desc')
				//$downIcon ='__PUBLIC__/imagesAdmin/icons/16x16/down_red_16.png';
			    $downIcon = __ROOT__.'/Public/imagesAdmin/16x16/down_red_16.png';

		}
	}
	$upLink = U($index,'sort='.$field.'&updown=desc&'.get_all_get_params(array('sort','updown')));
	$downLink = U($index, 'sort='.$field.'&updown=asc&'.get_all_get_params(array('sort','updown')));
	$upDownLink = '<span style="margin-left: 10px; vertical-align: top"><a href="'.$upLink.'"><img src="' . $upIcon . '" ></a>&nbsp;<a href="'.$downLink.'"><img src="' . $downIcon . '"/></a></span>';

	return $upDownLink;
}

/**
 * 获取当前url所有参数
 * @param  string $exclude_array
 * @return [string]
 */
function get_all_get_params($exclude_array = '') {

	if (!is_array($exclude_array)) $exclude_array = array();

	$get_url = '';
	if (is_array($_GET) && (sizeof($_GET) > 0)) {
		reset($_GET);
		while (list($key, $value) = each($_GET)) {
			if ( is_string($value) && (strlen($value) > 0) && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
				$get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
			}
		}
	}

	return $get_url;
}
?>