<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		if( !is_logged_in() ){
			redirect('auth');
		}
	}
	public function index()
	{
		$this->load->view('home/dashboard.php');
	}

}
