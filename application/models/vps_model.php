<?php 
if(!defined ('BASEPATH')) exit('No direct script access allowed');

class Vps_model extends MY_Model
{
	private $vps= 'vps';
	private $customers= 'customers';
	private $datacenters= 'datacenters';
	
	function __construct()
	{
		parent:: __construct();
		
	}
	
	function get_list($filter, $limit, $start)
	{
		$this->db->select('v.id, cu.username, v.svid, v.vps_label, v.vps_ip, v.create_date, v.space, v.ram');
		$this->db->from("$this->vps as v");
		$this->db->join("$this->customers as cu", 'v.cuid = cu.id');
		vst_buildFilter($filter);
		$this->db->limit($limit, $start);
		return $this->db->get()->result();
		
	}
	
	function total($filter)
	{
		$this->db->select('*');
		$this->db->from("$this->vps as v");
		$this->db->join("$this->customers as cu", 'v.cuid = cu.id');
		vst_buildFilter($filter);
		$result= $this->db->get();
		return $result->num_rows();
	}
	
	function getUsername()
	{
		$this->db->select('username');
		$this->db->from($this->customers);
		return $this->db->get()->result();
	}
	
	function getDatacenters()
	{
		$this->db->select('ip');
		$this->db->from($this->datacenters);
		return $this->db->get()->result();
	}
	
	function getIDcustomers($username)
	{
		$this->db->where('username', $username);
		$result= $this->db->get($this->customers);
		return $result->row();
	}
	
	function getInfodatacenters($ip)
	{
		$this->db->where('ip', $ip);
		$result= $this->db->get($this->datacenters);
		return $result->row();
	}
	
	function addVps($data)
	{
		$this->db->insert($this->vps, $data);
		return $this->db->affected_rows();
	}
	
	
	
}