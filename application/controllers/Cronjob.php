<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cronjob_model');
		$this->load->model('vps_model');
	}
	
	function calVpscharge($vpsid)
	{
		$date= date("Y-m-d h:i:s");
		$month= date("m");
		$year= date("Y");
		$price= $this->cronjob_model->getVpsprice($vpsid)['price'];
		$result= $this->cronjob_model->vpscharge($vpsid, $price, $date, $month, $year);
		if($result==0){
			die('failed');
		}
	}
	
	function autoinvoice()
	{
		$param_where= array('status' => 1);
		$vps_list= $this->vps_model->findVps($param_where, true);
		foreach($vps_list as $vps)
		{
			$this->calVpscharge($vps['id']);
		}
		$result= $this->cronjob_model->moneydecrease();
			if($result==false){
				echo "Failed";
			}
	}
	
	function resetservercharge()
	{
		$month= date("m");
		$year= date("Y");
		$date= date("Y-m-d");
		$result= $this->cronjob_model->noteservercharge($month, $year, $date);
		if($result==true){
			$date_time= date("Y-m-d h:i:s");
			$result_2= $this->cronjob_model->resetservercharge($month, $year, $date_time);
			if($result_2==false){
				echo "Failed";
			}
		}
	}
	
	
	
	
	
}

