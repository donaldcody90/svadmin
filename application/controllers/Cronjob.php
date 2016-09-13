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
		$price= $this->cronjob_model->getVpsprice($vpsid)['price']/720;
		$result= $this->cronjob_model->vpscharge($vpsid, $price, $date, $month, $year);
		if($result==1){
			echo 'Updated VPS#'.$vpsid.'--> Month: '.$month.'-'.$year.'   End date: '.$date.'   Amount: $'.$price."<br>";
		}
		else{
			echo 'Failed';
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
		$last_month= date('m',strtotime("-1 days"));
		$last_year= date('Y',strtotime("-1 days"));
		$key= str_replace('-', '', $date);
		$create_invoiceid= $this->cronjob_model->createInvoiceID($key, $last_month, $last_year);
		if($create_invoiceid == true)
		{
			$result= $this->cronjob_model->noteservercharge($last_month, $last_year, $date);
			if($result==true){
				$date_time= date("Y-m-d h:i:s");
				$result_2= $this->cronjob_model->resetservercharge($month, $year, $date_time);
				if($result_2==false){
					echo "Failed";
				}
			}
		}
	}
	
	
	
	
	
}

