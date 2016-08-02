<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	function __construct(){
		parent::__construct();
		vkt_checkAuth();
	}

	public function index()
	{
		$this->load->view('sales/list');

	}


	public function lists(){
		$this->load->view('sales/list');
	}
	

}

?>