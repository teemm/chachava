<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if (!($this->session->userdata('id')) && $this->uri->segment(2) != 'login'){
			redirect('Manager/login');
		}
	}
	public function index(){
		$this->load->model('Manager_model');
		$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
		$this->load->model('calendars');
		$role=$this->session->userdata('role');
		if($role==2||$role==3)$this->chackbranch();
		elseif($role==1){
			$data['branches']=$this->calendars->branches();
			$this->chackbranchSuper();
		}
		$data['personals']=$this->calendars->personals();
		$data['userRole']=$this->calendars->personalRole();
		$this->load->view('calendar/index',$data);
	}
	public function services(){
		$this->db->select('id as key,firstname as label');
		if($this->session->userdata('role')==3)$this->db->where('id',$this->session->userdata('id'));
		else $this->db->where('role = 3');
		$row2=$this->db->get('personal')->result_array();
		echo json_encode($row2);
	}
	public function ChackbBoking(){
		$start_time=htmlentities($this->input->post('start_time',TRUE));
		$end_time=htmlentities($this->input->post('end_time',TRUE));
		$personal=htmlentities($this->input->post('personal',TRUE));
		if($start_time && $end_time && $personal){
			$this->db->where('start_date',$start_time);
			$this->db->where('end_date',$end_time);
			$this->db->where('personal',$personal);
			echo $this->db->count_all_results('events');
		}
		else echo FALSE;		
	}
	public function chackbranch(){
		if(!$this->session->userdata('branch')){
			$this->db->where('id',$this->session->userdata('id'));
			$row=$this->db->get('personal')->row_array();
			$this->session->set_userdata('branch',$row['branch']);
		}
		$branch=$this->session->userdata('branch');
		if($this->uri->segment(3)!=$this->session->userdata('id')&&$this->session->userdata('role')==3){
			redirect(base_url('office/1/'.$this->session->userdata('id')));
		}
		if(!$this->uri->segment(3)&&$this->session->userdata('role')==2){
			$this->db->where('role','3');
			$pers=$this->db->get('personal')->row_array();				
			redirect(base_url('office/1/'.$pers['id']));
		}
	}
	public function chackbranchSuper(){
		$this->db->where('company_id',$this->session->userdata('company'));
		$this->db->where('id',$this->uri->segment(2));
		$count=$this->db->count_all_results('branches');

		$this->db->where('role','3');
		$pers=$this->db->get('personal')->row_array();		
		if(!$count){
			$this->db->where('company_id',$this->session->userdata('company'));
			$row=$this->db->get('branches')->row_array();
			redirect(base_url('office/1/'.$pers['id']));		
		}
		if(!$this->uri->segment(3))redirect(base_url('office/1/'.$pers['id']));
	}
}