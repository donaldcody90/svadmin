<?php 
if ( ! defined ('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('support_model');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	
	function index()
	{
		redirect('support/lists');
		
	}
	
	
	function lists()
	{
		$id= $this->session->userdata('user_id');
		$param['c.uid']= $id;
		$filterData= vst_filterData(
			array('filter_cid' ,'filter_title' ,'filter_content' ,'filter_username' ,'filter_status' ,'filter_type'),
			array(),
			array('cid'=>'c', 'title'=>'c', 'content'=>'m', 'username'=>'cu', 'status'=>'c', 'type'=>'c')
			);
		
		$this->load->library('pagination');
		
		$total= $this->support_model->totalTicket($filterData, $param);
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
		
		$start= $this->input->get('page');
		$limit= $config['per_page'];
		
		$data['result']= $this->support_model->listTicket($filterData, $limit, $start, $param);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		
		$this->load->view('support/ticketlist_view', $data);
	}
	
	
	function ticket($insert_id)
	{
		$this->form_validation->set_rules('reply', 'Reply', 'required|max_length[1000]|trim');
		
		if ($this->form_validation->run() == true)
		{
			$data['uid']= $this->session->userdata('user_id');
			$data['cid']= $insert_id;
			$data['content']= $this->input->post('reply');
			$data['date']= date('Y-m-d H:i:s');
			
			$data2['status']= 'opening';
			$param['cid']= $insert_id;
		
			$kq= $this->support_model->addnew_message($data);
			$kq2= $this->support_model->reopen($data2, $param);
			if($kq > 0)
			{
				redirect(current_url());
			}
		}
		
		$message['info']= $this->support_model->conv_info($insert_id);
		$message['result']= $this->support_model->get_message($insert_id);
		$this->load->view('support/ticketcontent_view', $message);	
	
	}
	
	
	function close_ticket($insert_id)
	{
		$data= array('cid' => $insert_id);
		$result= $this->support_model->close_ticket($data);
		if ($result > 0)
		{
			redirect ('support/lists');
		}
	}
	
	
}