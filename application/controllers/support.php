<?php 
if ( ! defined ('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('support_model');
		$this->load->model('users_model');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	
	function index()
	{
		redirect('support/lists');
		
	}
	
	
	function lists()
	{
		$id= $this->session->userdata('user_id');
		$filterData= vst_filterData(
			array('filter_cid' ,'filter_title' ,'filter_content' ,'filter_username' ,'filter_status' ,'filter_name'),
			array(),
			array('cid'=>'c', 'title'=>'c', 'content'=>'m', 'username'=>'cu', 'status'=>'c', 'name'=>'ca')
			);
		
		$filterData['ca.uid']= array('value'=>$id,'condition'=>'where');
		
		$total= $this->support_model->totalTicket($filterData);
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
		
		$start= $this->input->get('page');
		$limit= $config['per_page'];
		
		$data['result']= $this->support_model->listTicket($filterData, $limit, $start);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		$data['type']= $this->support_model->findCategory(null, $is_list= true);
		$this->load->view('support/ticketlist_view', $data);
	}
	
	
	function ticket($insert_id)
	{
		$this->form_validation->set_rules('reply', 'Reply', 'required|max_length[1000]|trim');
		
		if ($this->form_validation->run() == false)
		{
			$param_where['cid']= $insert_id;
			$message['info']= $this->support_model->getConversation($param_where);
			$message['result']= $this->support_model->getMessage($insert_id);
			$this->load->view('support/ticketcontent_view', $message);	
		}
		if ($this->form_validation->run() == true)
		{
			$data['uid']= $this->session->userdata('user_id');
			$data['cid']= $insert_id;
			$data['content']= $this->input->post('reply');
			$data['date']= date('Y-m-d H:i:s');
			
			$data2['status']= 1;
			$param['cid']= $insert_id;
		
			$kq= $this->support_model->addMessage($data);
			$kq2= $this->support_model->reopen($data2, $param);
			if($kq > 0)
			{
				redirect(current_url());
			}
		}
		
		// $message['info']= $this->support_model->getConversationinfo($insert_id);
		// $message['result']= $this->support_model->getMessage($insert_id);
		// $this->load->view('support/ticketcontent_view', $message);	
	
	}
	
	
	function closeTicket($insert_id)
	{
		$data= array('status'=> 0);
		$param= array('cid' => $insert_id);
		$result= $this->support_model->closeTicket($data, $param);
		if ($result > 0)
		{
			redirect ('support/lists');
		}
	}
	
	function categories()
	{
		
		$filterData= vst_filterData(
					array('filter_id', 'filter_username', 'filter_name', 'filter_status'),
					array(),
					array('id'=>'ca', 'username'=>'u', 'name'=>'ca', 'status'=>'ca')
		);
		
		$this->load->library('pagination');
		$total= $this->support_model->totalUser($filterData);
		
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
		
		$start = $this->input->get('page');
		$limit= $config['per_page'];
		
		$data['result']= $this->support_model->listUser($filterData, $limit, $start);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		$data['type']= $this->support_model->findCategory(null, $is_list= true);
		$this->load->view('support/categories_view', $data);
	}
	
	function edit_cat($id)
	{
		$param_where= array('id' => $id);
		
		if($this->input->post('save'))
		{
			
			
			if($this->input->post('category')) { $data['name']= $this->input->post('category'); }
			if($this->input->post('uid')) { $data['uid']= $this->input->post('uid'); }
			if($this->input->post('status')) { $data['status']= $this->input->post('status'); }
			
			if(count($data) > 0)
			{
				$result= $this->support_model->saveCategory($data, $param_where);
				
				if ($result == TRUE)
				{
					message_flash('Updated successfully!');
					redirect('support/categories');
				}
				if($result == FALSE)
				{
					message_flash('Can not edit yet.','error');
					redirect('support/edit_cat/'.$id);
				}
				
			}
			
		}
		
		$data2['category']= $this->support_model->findCategory($param_where);
		$data2['users']= $this->users_model->findUser(null, true);
		$this->load->view('support/edit_view', $data2);
	}
	
	
	function add()
	{
		if($this->input->post('save'))
		{
			if($this->input->post('category') && $this->input->post('uid'))
			{
				
				$data['name']= $this->input->post('category');
				$data['uid']= $this->input->post('uid');
				$data['status']= $this->input->post('status');
				
				$result= $this->support_model->saveCategory($data);
				
				
				if ($result == TRUE)
				{
					message_flash('Updated successfully!');
					redirect('support/categories');
				}
				if($result == FALSE)
				{
					message_flash('Failed', 'error');
					redirect('support/add');
				}
			}
		}
		
		$data2['users']= $this->users_model->findUser(null, true);
		$this->load->view('support/add_view', $data2);
		
		
	}
	
	function delete($id)
	{
		$param= array('id' => $id);
		$success= $this->support_model->delete($param);
		if($success != 1)
		{
			message_flash("Can not delete yet.",'error');
		}
		else{
			message_flash('Deleted successfully!');
		}
		redirect('support/categories');
	}
	
	
	
}