<?php 
if(!defined ('BASEPATH')) exit('No direct script access allowed');

class Vps_model extends MY_Model
{
	private $vps= 'vps';
	private $customers= 'customers';
	private $servers= 'servers';
	
	function __construct()
	{
		parent:: __construct();
		
	}
	
	function findVps($param_where)
	{
		return $this->_getwhere(array(
				'table' 		=> $this->vps,
				'param_where'	=>	$param_where
		));
	}
	
	function getList($filter, $limit, $start)
	{
		$this->db->select('v.id, cu.username, v.svid, v.vps_label, v.vps_ip, v.create_date, v.space, v.ram');
		$this->db->from("$this->vps as v");
		$this->db->join("$this->customers as cu", 'v.cid = cu.id');
		vst_buildFilter($filter);
		$this->db->limit($limit, $start);
		return $this->db->get()->result();
		
	}
	
	function total($filter)
	{
		$this->db->select('*');
		$this->db->from("$this->vps as v");
		$this->db->join("$this->customers as cu", 'v.cid = cu.id');
		vst_buildFilter($filter);
		$result= $this->db->get();
		return $result->num_rows();
	}
	
	function editVps($data, $param_where)
	{
		return $this->_save(array(
				'table'			=>	$this->vps,
				'data'			=>	$data,
				'param_where'	=>	$param_where
		));
	}
	
	function addVps($data){
          return $this->_save(array(
               'table' => $this->vps,
               'data' => $data
          ));
    }
	
	function deleteVps($param_where){
		return $this->_del(array(
				'table'	=> $this->vps,
				'param_where'	=> $param_where
		));
	}
	
	
	// function getServers()
	// {
		// $this->db->select('*');
		// $this->db->from($this->servers);
		// return $this->db->get()->result();
	// }
	
	// function getInfoservers($ip)
	// {
		// $this->db->where('ip', $ip);
		// $result= $this->db->get($this->servers);
		// return $result->row();
	// }
	
	// function getServers($params_where= null,$is_list=true){
		 // return  $this->_getwhere(array(
                    // 'table'        => $this->servers,
                    // 'param_where'  => $params_where,
                    // 'list'         => $is_list
        // ));
	// }
	
	// function getUsername()
	// {
		// $this->db->select('username');
		// $this->db->from($this->customers);
		// return $this->db->get()->result();
	// }

	
	// function getCustomers($params_where= null, $is_list= true)
	// {
		// return $this->_getwhere(array(
					// 'table'			=> $this->customers,
					// 'param_where' 	=> $params_where,
					// 'list' 			=> $is_list
		// ));
	// }
	
	// function getIDcustomers($username)
	// {
		// $this->db->where('username', $username);
		// $result= $this->db->get($this->customers);
		// return $result->row();
	// }
	
	// function addVps($data)
	// {
		// $this->db->insert($this->vps, $data);
		// return $this->db->affected_rows();
	// }
	
	
	
	
	
}