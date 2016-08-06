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
		$this->db->select('c.cid, c.type, c.title, cu.username, c.status, m.content');
		$this->db->from('conversation as c');
		$this->db->join('customers as cu', 'c.uid = cu.id');
		$this->db->join('message as m', 'c.cid = m.cid');
		$this->db->join('message as m2', 'm.cid = m2.cid AND m.mid < m2.mid', 'left');
		$this->db->where('m2.mid', NULL);
		vst_buildFilter($filterData);
		$this->db->order_by('m.date', 'DESC');
		$this->db->limit($limit, $start);
		
		$result= $this->db->get();
				
		return $result->result();
	}
	
	function totalTicket($filterData, $param)
	{
		$this->db->select('c.cid, c.type, c.title, cu.username, c.status, m.content');
		$this->db->from('conversation as c');
		$this->db->join('customers as cu', 'c.uid = cu.id');
		$this->db->join('message as m', 'c.cid = m.cid');
		$this->db->join('message as m2', 'm.cid = m2.cid AND m.mid < m2.mid', 'left');
		$this->db->where('m2.mid', NULL);
		vst_buildFilter($filterData);
		$this->db->order_by('m.date', 'DESC');
		
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
		// $this->db->select('u.username, u.role, m.date, m.content');
		// $this->db->from("$this->table_users as u, $this->table_mess as m");
		// $this->db->where('u.id = m.uid');
		// $this->db->where('cid', $insert_id);
		// $this->db->order_by('m.date', 'DESC');
		
		$sql="select * from(select u.username, m.date, m.content, u.role
				from users as u, message as m
				where u.id = m.uid
				  and cid = ?
				UNION
				select cu.username, m.date, m.content, null
				from customers as cu, message as m
				where cu.id = m.uid
				  and cid = ?) as uniontable
				order by date DESC";

		$result= $this->db->query($sql, array($insert_id, $insert_id));
		// $this->db->order_by('date', 'DESC');
		
		// $result= $this->db->get();
		return $result->result();
	}
	
	function conv_info($insert_id)
	{
		$this->db->where('cid', $insert_id);
		$result= $this->db->get($this->table_conv);
		return $result->row();
		
	}
	
	function close_ticket($data)
	{
		$this->db->where($data);
		$this->db->update("$this->table_conv", array('status'=> 'closed'));
		
		return $this->db->affected_rows();
	}
	
	
	
	
	
	
}