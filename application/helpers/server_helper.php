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
			case 0:
				$roleText="Admin";
				break;
			case 1:
				$roleText="Staff";
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

if(!function_exists ('getStatusConversation'))
{
	function getStatusConversation($status)
	{
		$statusText="";
		switch($status)
		{
			case 0:
				$statusText= 'closed';
				break;
			case 1:
				$statusText= 'opening';
				break;
			default:
				//code
		}
		return $statusText;
	}
}

if(!function_exists ('getStatusCategories'))
{
	function getStatusCategories($status)
	{
		$statusText="";
		switch($status)
		{
			case 0:
				$statusText= 'Disable';
				break;
			case 1:
				$statusText= 'Enable';
				break;
			default:
				//code
		}
		return $statusText;
	}
}

if(! function_exists('getStatusRole'))
{
	function getStatusRole($status)
	{
		$statusText='';
		switch($status)
		{
			case 0:
				$statusText='Administrator';
				break;
			default:
				//code
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
	function vst_Pagination($total){
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; ';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = ' &raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
        $config['per_page'] =9;
        $config['page_query_string'] =true;
        $config['query_string_segment'] ="page";
		$config['base_url'] =vst_currentUrl();
		$config['total_rows']= $total;
		return $config;
	}
}

/*if(!function_exists('vst_currentUrl')){
	function vst_currentUrl($withoutPage=true)
	{
		$CI =& get_instance();
		$url = $CI->config->site_url($CI->uri->uri_string());
		$params=$CI->input->get();
		if(isset($params) and $params != '')
		{
			if(isset($params['page']) && $withoutPage)
			{	unset($params['page']);		}
		}
		else{
			$params= array(
				'filter_' => '',
				'page' => ''
			);
		}
		$http_query=http_build_query($params, '', "&");
		return $http_query ? $url.'?'.$http_query : $url;
	}
} */

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
	function vst_filterData($likeFields=array(),$whereFieldsDate=array(),$tablealias=array())
	{
		$CI =& get_instance();
		$params= $CI->input->get();
		unset($params['page']);
		$filterData= array();
		if($params){
			foreach($params as $key=>$value){
				if($value!=''){
					$table_alias="";
					if(isset($tablealias[str_replace('filter_','',$key)]))
					{
						$table_alias= $tablealias[str_replace('filter_','',$key)];
					}
					if(in_array($key,$likeFields))
					{	
						$filterData[str_replace('filter_','',$key)]= array('value'=>trim($value),'condition'=>'like','tbalias'=>$table_alias);
					}
					elseif(in_array($key,$whereFieldsDate))
					{
						$filterData[str_replace('filter_','',$key)]= array('value'=>trim($value),'condition'=>'date','tbalias'=>$table_alias);
					}
					else
					{
						$filterData[str_replace('filter_','',$key)]= array('value'=>trim($value),'condition'=>'where','tbalias'=>$table_alias);
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
				if(!empty($value['tbalias']))
					{
						$key=$value['tbalias'].".".$key;
					}
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

if(!function_exists('RandomString'))
{
	function RandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		$stringlength= $length;
		for ($i = 0; $i < $stringlength; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

if(!function_exists('get_setting_meta')){
	function get_setting_meta($meta_key,$return_row=false)
	{
	$CI =& get_instance();
	$setting_table="settings";
	$CI->db->select("*");
	$CI->db->from($setting_table);
	$CI->db->where(array('meta_key'=>$meta_key));
	$query=$CI->db->get();
	$row=$query->row_array();
	if($row){
	if($return_row)
    return $row;
	return $row['meta_value'];
	}else{
		return false;
		}
	}
}

if(!function_exists('APIcreatevps_post'))
{
	function APIcreatevps_post($rootpass, $space, $ram)
	{
		$post = array();
		$post['serid'] = 0;
		$post['virt'] = 'kvm';
		$post['user_email'] = 'test@test.com';
		$post['user_pass'] = 'test123';
		$post['plid'] = 0;
		$post['osid'] = 88;
		$post['iso'] = 0;
		$post['hostname'] = 'test12345.com';
		$post['rootpass'] = $rootpass;
		$post['num_ips'] = 1;
		$post['stid'] = 1;
		$post['space'] = $space;
		$post['ram'] = $ram;
		$post['swapram'] = 1024;
		$post['bandwidth'] = 0;
		$post['network_speed'] = 0;
		$post['cpu'] = 1000;
		$post['cores'] = 4;
		$post['cpu_percent'] = 100.00;
		$post['vnc'] = 1;
		$post['vncpass'] = 'test123';
		$post['sec_iso'] = 0;
		$post['kvm_cache'] = 0;
		$post['io_mode'] = 0;
		$post['vnc_keymap'] = 'en-us';
		$post['nic_type'] = 'default';
		$post['osreinstall_limit'] = 0; 
		$post['admin_managed'] = 0;
		$post['addvps'] = 1;

		return $post;
	}
}




































	



















