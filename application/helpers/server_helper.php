<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('is_logged_in'))
{
	function is_logged_in() {
	
	    $CI =& get_instance();
	    $user = $CI->session->userdata('logged_in');
		if($user){
			return true;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('vkt_checkAuth'))
{
	function vkt_checkAuth() {
	    $CI =& get_instance();
	    $user = $CI->session->userdata('logged_in');
		if(!$user){
			$CI->load->helper('url');
			redirect('auth/login');
		}/*else{
			$cController=vst_getController();
			$configs=$CI->config->item('site');
			if(!in_array($cController,$configs['role_auth'][$user['role']]))
			{
				die("Access denied");
			}
		} */
	}
}

if ( ! function_exists('vst_getCurrentUser'))
{
	function vst_getCurrentUser() {
	    $CI =& get_instance();
	    $user = $CI->session->userdata('username');
		return $user;
	}
}
if ( ! function_exists('getRoleText'))
{
	function getRoleText($role)
	{
		$roleText="NA";
		switch($role)
		{
			case 1:
				$roleText="Admin";
				break;
			case 2:
				$roleText="Quản lý";
				break;
			case 3:
				$roleText="Tư vấn";
				break;
			case 4:
				$roleText="Mua hàng";
				break;
			case 5:
				$roleText="Kho TQ";
				break;
			case 5:
				$roleText="Kho VN";
				break;
			default:
				$roleText="NA";
		}
		return $roleText;
	}
}


if ( ! function_exists('getStatusOrder'))
{
	function getStatusOrder($status)
	{
		$statusText="<span class='chuaduyet'>Chưa duyệt</span>";
		switch($status)
		{
			case -1:
				$statusText="<span class='dahuy'>Đã hủy</span>";
				break;
			case 0:
				$statusText="<span class='chuaduyet'>Chưa duyệt</span>";
				break;
			case 1:
				$statusText="<span class='daduyet'>Đã duyệt</span>";
				break;
			case 2:
				$statusText="<span class='dathanhtoan'>Đã thanh toán - chờ mua hàng</span>";
				break;
			case 3:
				$statusText="<span class='damuahang'>Đã mua hàng</span>";
				break;
			case 4:
				$statusText="<span class='hangdave'>Hàng đã về - chờ giao hàng</span>";
				break;
			case 5:
				$statusText="<span class='daketthuc'>Đã kết thúc</span>";
				break;
			default:
				$statusText="<span class='chuaduyet'>Chưa duyệt</span>";
		}
		return $statusText;
	}
}

if ( ! function_exists('getStoreText'))
{
	function getStoreText($store)
	{
		if($store =='1'){
			return "<span class='bold black'>Kho SG</span>";
		}else if($store =="0"){
			return "<span class='bold green'>Kho HN</span>";
		}else{
			return "<span class='bold red'>N/A</span";
		}
	}
}

if ( ! function_exists('getStorecnShipsText'))
{
	function getStorecnShipsText($store)
	{
		if($store =='0'){
			return "<span class='red'>Chưa gửi</span>";
		}else if($store =="1"){
			return "<span class='green'>Đã gửi</span>";
		}
	}
}

if ( ! function_exists('getStorevnShipsText'))
{
	function getStorevnShipsText($store)
	{
		if($store =='0'){
			return "<span class='red'>Chưa nhận</span>";
		}else if($store =="1"){
			return "<span class='orange'>Đã nhận</span>";
		}
	}
}

if ( ! function_exists('vst_currentDate'))
{
	function vst_currentDate($time=true) {
		if($time){
			$dateTime=date("d/m/Y H:i:s");
		}else{
			$dateTime=date("d/m/Y");
		}
		return $dateTime;
	}
}

if ( ! function_exists('starts_with'))
{
	function starts_with($haystack, $needle)
	{
		return substr($haystack, 0, strlen($needle))===$needle;
	}
}

if ( ! function_exists('vst_getIPAddress'))
{
	function vst_getIPAddress() {
		return $_SERVER['REMOTE_ADDR'];;
	}
}


if(!function_exists('message_flash')){
	function message_flash($message = '', $type = 'success'){
		$CI =& get_instance();
		$CI->session->set_flashdata('message_flashdata', array(
			'type' => $type,
			'message' => $message
		));
	}
}

if(!function_exists('vst_password')){
	function vst_password($msg){
		return hash('sha512', $msg);
	}
}

if(!function_exists('vst_pagination')){
	function vst_Pagination(){
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; ';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = ' &raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Trang sau &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Trang trước';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
        $config['per_page'] =9;
        $config['page_query_string'] =true;
        $config['query_string_segment'] ="page";
		$config['base_url'] =vst_currentUrl();
		return $config;
	}
}
if(!function_exists('vst_currentUrl')){
	function vst_currentUrl($withoutPage=true)
	{
		$CI =& get_instance();
		$url = $CI->config->site_url($CI->uri->uri_string());
		$params=$CI->input->get();
		if(isset($params['page']) && $withoutPage)
			unset($params['page']);
		$http_query=http_build_query($params, '', "&");
		return $http_query ? $url.'?'.$http_query : $url;
	}
}

if(!function_exists('vst_filterData')){
	function vst_filterData($likeFields=array(),$whereFieldsDate=array())
	{
		$CI =& get_instance();
		$params=$CI->input->get();
		unset($params['page']);
		$filterData=array();
		if($params){
			foreach($params as $key=>$value){
				if($value!=''){
					if(in_array($key,$likeFields))
					{
						$filterData[str_replace("filter_","",$key)]=array('value'=>trim($value),'condition'=>'like');
					}elseif(in_array($key,$whereFieldsDate)){
						$filterData[str_replace("filter_","",$key)]=array('value'=>trim($value),'condition'=>'date');
					}else{
						$filterData[str_replace("filter_","",$key)]=array('value'=>trim($value),'condition'=>'where');
					}
				}
			}
		}
		return $filterData;
		
	}
}

if(!function_exists('vst_getData')){
	function vst_postData()
	{
		$CI =& get_instance();
		$params=$CI->input->post();
		$filterData=array();
		if($params){
			foreach($params as $key=>$value){
				if( $key!='save' && $value!='' && $key!='password'){
					$filterData[$key]  = $value;
				}
				if( $key=='password' ){
					$filterData[$key]  = vst_password($value);
				}
			}
		}
		return $filterData;
	}
}

if(!function_exists('vst_buildFilter')){
	function vst_buildFilter($filter)
	{
		$CI =& get_instance();
		if($filter){
			foreach ($filter as $key => $value) {
                switch ($value['condition']) {
                   case 'like':
                        $query = $CI->db->like(array($key=>$value['value']));
                        break;
                   case 'where':
                       $query = $CI->db->where(array($key=>$value['value']));
                       break;
                   case 'date':
                   		if (strpos($key, 'startdate_') !== false) {
                   			$key=str_replace("startdate_","",$key);
                   			$query = $CI->db->where( $key.' >=',$value['value'] );
                   		}else if (strpos($key, 'enddate_') !== false) {
						  	$key=str_replace("enddate_","",$key);
							$query = $CI->db->where( $key.' <=',$value['value'] );
						}else{
							$query = $CI->db->where( $key.' ==',$value['value'] );
						}
                      
                   	   break;
                   default:
                       # code...
                     break;
               }
            }
		}
	}
}


if(!function_exists('vst_getController')){
	function vst_getController()
	{
		$CI =& get_instance();
		return $CI->router->class;
	}
}

if(!function_exists('vst_getMethod')){
	function vst_getMethod()
	{
		$CI =& get_instance();
		return $CI->router->method;
	}
}

if(!function_exists('vst_getBodyClass')){
	function vst_getBodyClass()
	{
		$CI =& get_instance();
		$class="page_".$CI->router->class;
		if($CI->router->method)
			$class .=" view_".$CI->router->method;
		return $class;
	}
}

if(!function_exists('vst_authAjaxPost')){
	function vst_authAjaxPost()
	{
	  $CI =& get_instance();
	  if($CI->input->post('postAjax') == null || !$CI->input->post('postAjax'))
	  {	
			
		  	$CI->load->helper('url');
			redirect(site_url('404'));
	  }
	}
}
if(!function_exists('vst_showPrice')){
	function vst_showPrice($price)
	{
	  return number_format($price);
	}
}