<?php 
if ( ! defined ('BASEPATH')) exit ('No direct script access allowed');

class Support_model extends My_Model
{
	private $message= 'message';
	private $conversation= 'conversation';
	private $users= 'users';
	private $categories= 'categories';
	
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	function listTicket($filterData, $limit, $start, $param)
	{
		$this->db->select('c.cid, ca.name, c.title, cu.username, c.status, m.content');
		$this->db->from('conversation as c');
		$this->db->join('customers as cu', 'c.uid = cu.id');
		$this->db->join('categories as ca', 'ca.id = c.caid');
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
		$this->db->select('c.cid, ca.name, c.title, cu.username, c.status, m.content');
		$this->db->from('conversation as c');
		$this->db->join('customers as cu', 'c.uid = cu.id');
		$this->db->join('categories as ca', 'ca.id = c.caid');
		$this->db->join('message as m', 'c.cid = m.cid');
		$this->db->join('message as m2', 'm.cid = m2.cid AND m.mid < m2.mid', 'left');
		$this->db->where('m2.mid', NULL);
		vst_buildFilter($filterData);
		$this->db->order_by('m.date', 'DESC');
		
		$result= $this->db->get();
		return $result->num_rows();
	}

	function addMessage($data)
	{
		return $this->_save(array(
						'table'=> $this->message,
						'data'=> $data
		));
	}
	
	function reopen($data, $param)
	{
		return $this->_save(array(
						'table'=> $this->conversation,
						'data'=> $data,
						'param_where'=> $param
		));
	}
	
	function getMessage($insert_id)
	{
		// $this->db->select('u.username, u.role, m.date, m.content');
		// $this->db->from("$this->users as u, $this->message as m");
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
	
	
	function getConversation($params_where,$is_list=false){
		 return  $this->_getwhere(array(
						'table'        => $this->conversation,
						'param_where'  => $params_where,
						'list'         => $is_list
				));
	  }
	
	
	
	function closeTicket($data, $params_where){
          return $this->_save(array(
                                        'table'        => $this->conversation,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
	}
	
	
	function findUser($param)
	{
		$this->db->select('*');
		$this->db->from("$this->categories as ca");
		$this->db->join("$this->users as u", "ca.uid = u.id");
		$this->db->where($param);
		return $this->db->get()->result();
	}
	
	function supportteam($filterData, $limit, $start)
	{
		$this->db->select('ca.id, ca.name, u.username, ca.status');
		$this->db->from("$this->categories as ca");
		$this->db->join("$this->users as u", "ca.uid = u.id");
		vst_buildFilter($filterData);
		$this->db->limit($limit, $start);
		return $this->db->get()->result();
	}
	
	function totalUser($filterData)
	{
		$this->db->select('ca.id, ca.name, u.username, ca.status');
		$this->db->from("$this->categories as ca");
		$this->db->join("$this->users as u", "ca.uid = u.id");
		vst_buildFilter($filterData);
		return $this->db->get()->num_rows();
	}
	
	function delete($param)
	{
		return $this->_del(array(
				'table'			=>	$this->categories,
				'param_where'	=>	$param
		));
	}
	
	function insertCategory($data)
	{
		return $this->_save(array(
				'table'			=>	$this->categories,
				'data'	=>	$data
		));
	}
}