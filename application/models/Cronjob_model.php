<?php
if (!defined ('BASEPATH')) exit ('No direct script access allowed');

class Cronjob_model extends MY_Model
{
	private $billing_history= 'billing_history';
	private $settings= 'settings';
	private $vps_lifetime= 'vps_lifetime';
	private $vps= 'vps';
	private $plans= 'plans';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
	
	
	
	
	

	function getVpsprice($id){
		$this->db->select('v.id, p.price');
		$this->db->from("$this->vps as v");
		$this->db->join("$this->plans as p", 'v.pid=p.id');
		$this->db->where('v.id', $id);
		$result= $this->db->get();
		return $result->row_array();
	}
	
	function vpscharge($vpsid, $price, $date, $month, $year){
		// $sql= "UPDATE vps_lifetime as vl
				// INNER JOIN vps as v ON vl.vps_id = v.id
				// INNER JOIN plans as p ON p.id = v.pid
				// SET vl.amount= vl.amount + p.price/720, vl.end_date= ?";
				
		$sql= "UPDATE vps_lifetime
				SET amount= amount + ?/720 , end_date= ?
				WHERE vps_id= ? AND month= ? AND year= ?";
		
		$this->db->query($sql, array($price, $date, $vpsid, $month, $year));
		$result= $this->db->affected_rows();
		return $result;
	}
	
	function moneydecrease(){
		$sql= "UPDATE balance as b
				INNER JOIN (SELECT cid, SUM(p.price)/720 as total 
							FROM vps as v 
							INNER JOIN plans as p ON v.pid= p.id
							WHERE v.status= 1
							GROUP BY cid) as t
				ON b.cid = t.cid
				SET b.amount = b.amount - t.total ";
		
		$result= $this->db->query($sql);
		return $result;
	}
	
	function noteservercharge($month, $year, $date){
		$sql= "INSERT INTO billing_history (cid, description, created_date, amount, balance, type, ref_id)
				SELECT vl.cid, concat('Invoice#', i.invoiceid), ? as 'created_date', sum(vl.amount), b.amount, '0' as 'type', i.id
				FROM vps_lifetime as vl
				INNER JOIN balance as b ON b.cid = vl.cid
				INNER JOIN invoices as i ON i.cid = vl.cid
				WHERE i.month= ?
				  AND i.year= ?
				GROUP BY vl.cid";
				
		$result= $this->db->query($sql, array($date, $month, $year));
		return $result;
	}
	
	function resetservercharge($month, $year, $date_time){
		$sql= "INSERT INTO vps_lifetime 
				SELECT cid, id, ? as 'month', ? as 'year', ? as 'start_date', ? as 'end_date', '0' as 'amount'
				FROM vps";
				
		$result= $this->db->query($sql, array($month, $year, $date_time, $date_time));
		return $result;
	}
	
}