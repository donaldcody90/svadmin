<?php 
if ( ! defined ('BASEPATH')) exit ('No direct script access allowed');

class Support_model extends My_Model
{
	private $table_mess= 'message';
	private $table_conv= 'conversation';
	private $table_users= 'users';
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	function listTicket($filterData, $limit, $start, $param)
	{
		$this->db->select('c.c_id, c.c_title, cu.username, c.c_status, m.m_content');
		$this->db->from('conversation as c');
		$this->db->join('customers as cu', 'c.u_id = cu.id');
		$this->db->join('message as m', 'c.c_id = m.c_id');
		$this->db->join('message as m2', 'm.c_id = m2.c_id AND m.m_id < m2.m_id', 'left');
		$this->db->where('m2.m_id', NULL);
		$this->db->order_by('m.m_date', 'DESC');
		
		$result= $this->db->get();
				
		return $result->result();
	}
	
	function totalTicket($filterData, $param)
	{
		$this->db->select('c.c_id, c.c_title, u.username, c.c_status');
		$this->db->from("$this->table_mess as m");
		$this->db->join("$this->table_conv as c", 'c.c_id = m.c_id', 'inner');
		$this->db->join("$this->table_users as u", 'm.u_id = u.id', 'inner');
		// $this->db->join("$this->table_mess as m2", "m.c_id = m2.c_id && m.m_id < m2.m_id", 'left');
		// $this->db->where('m2.m_id', NULL);
		vst_buildFilter($filterData);
		
		$result= $this->db->get();
		return $result->num_rows();
	}
	
	function addnew_ticket($data)
	{
		$lists = $this->_save(array(
					'table'=>$this->table_conv,
					'data' =>$data
		));
		$insert_id = $this->db->insert_id();
		$result =  array('lists'=>$lists, 'insert_id'=>$insert_id);
		return $result;
	}
	
	
	function get_adminmail($type)
	{
		$this->db->select('email');
		$this->db->from($this->table_users);
		$this->db->where('responsibility', $type);
		$this->db->or_where('responsibility', 'All');
		$result= $this->db->get();
		
		return $result->result();
	}
	
	
	function addnew_message($data)
	{
		return $this->_save(array(
						'table'=> $this->table_mess,
						'data'=> $data
		));
	}
	
	function reopen($data, $param)
	{
		return $this->_save(array(
						'table'=> $this->table_conv,
						'data'=> $data,
						'param_where'=> $param
		));
	}
	
	function get_message($insert_id)
	{
		// $this->db->select('u.username, u.role, m.m_date, m.m_content');
		// $this->db->from("$this->table_users as u, $this->table_mess as m");
		// $this->db->where('u.id = m.u_id');
		// $this->db->where('c_id', $insert_id);
		// $this->db->order_by('m.m_date', 'DESC');
		
		$sql="select * from(select u.username, m.m_date, m.m_content, u.role
				from users as u, message as m
				where u.id = m.u_id
				  and c_id = ?
				UNION
				select cu.username, m.m_date, m.m_content, cu.role
				from customers as cu, message as m
				where cu.id = m.u_id
				  and c_id = ?) as uniontable
				order by m_date DESC";

		$result= $this->db->query($sql, array($insert_id, $insert_id));
		// $this->db->order_by('m_date', 'DESC');
		
		// $result= $this->db->get();
		return $result->result();
	}
	
	function conv_info($insert_id)
	{
		$this->db->where('c_id', $insert_id);
		$result= $this->db->get($this->table_conv);
		return $result->result();
		
	}
	
	function close_ticket($data)
	{
		$this->db->where($data);
		$this->db->update("$this->table_conv", array('c_status'=> 'closed'));
		
		return $this->db->affected_rows();
	}
	
	
	
	
	
	
}