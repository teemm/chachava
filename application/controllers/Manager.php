<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Manager_model');
		if (!($this->session->userdata('id')) && $this->uri->segment(2) != 'login'){
			redirect('Manager/login');
		}
	}
	public function index(){
		redirect('manager/login');
	}
  public function person(){
  	$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
  	if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3)redirect('schedule');
    else if($this->session->userdata('role') == 4)redirect('manager/donors');
	  else if($this->session->userdata('role') == 5)redirect('manager/surogats');
  	$this->load->view('manager/header', $data);
  	$data['selectCompany'] = $this->Manager_model->selectCompany();
  	$this->load->view('manager/person',$data);
  	$this->load->view('manager/footer');
  }
  // &#4321;&#4313;&#4320;&#4312;&#4318;&#4322;&#4312; &#4306;&#4312;&#4309;&#4316;&#4307;&#4304; &#4312;&#4315; &#4328;&#4308;&#4315;&#4311;&#4334;&#4309;&#4308;&#4309;&#4304;&#4328; &#4311;&#4323; &#4306;&#4304;&#4315;&#4317;&#4309;&#4327;&#4308;&#4316;&#4308;&#4305;&#4311; &#4324;&#4312;&#4314;&#4312;&#4304;&#4314;&#4308;&#4305;&#4310;&#4308; &#4315;&#4312;&#4305;&#4315;&#4304;&#4321; &#4321;&#4308;&#4314;&#4308;&#4325;&#4322;&#4312;&#4321; &#4306;&#4304;&#4320;&#4308;&#4328;&#4308;
 //  public function get_branches(){
 //  	$arg = $this->input->post('arg');
	// echo (json_encode($this->Manager_model->keyup($arg)));
 //  }
  // &#4321;&#4313;&#4320;&#4312;&#4318;&#4322;&#4312; &#4306;&#4312;&#4309;&#4316;&#4307;&#4304; &#4312;&#4315; &#4328;&#4308;&#4315;&#4311;&#4334;&#4309;&#4308;&#4309;&#4304;&#4328; &#4311;&#4323; &#4306;&#4304;&#4315;&#4317;&#4309;&#4327;&#4308;&#4316;&#4308;&#4305;&#4311; &#4324;&#4312;&#4314;&#4312;&#4304;&#4314;&#4308;&#4305;&#4310;&#4308; &#4315;&#4312;&#4305;&#4315;&#4304;&#4321; &#4321;&#4308;&#4314;&#4308;&#4325;&#4322;&#4312;&#4321; &#4306;&#4304;&#4320;&#4308;&#4328;&#4308;

  // parolis shecvla
   public function changePass(){
   	$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
   	$this->load->view('manager/header' ,$data);
   	$data['username'] = $this->Manager_model->user_for_changepass();
    $this->load->view('manager/changePass', $data);
  	$this->load->view('manager/footer');
  }
  public function change_donor_pas(){
    $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
    $this->load->view('manager/header' ,$data);
    $data['username'] = $this->Manager_model->DonorPass();
    $this->load->view('manager/changePass', $data);
    $this->load->view('manager/footer');
  }
  public function change_surogat_pas(){
    $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
    $this->load->view('manager/header' ,$data);
    $data['username'] = $this->Manager_model->SurogatPass();
    $this->load->view('manager/changePass', $data);
    $this->load->view('manager/footer');
  }
  // parolis shecvla
	public function edit_person($id){
		$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
	  	if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3)redirect('schedule');
    else if($this->session->userdata('role') == 4)redirect('manager/donors');
		else if($this->session->userdata('role') == 5)redirect('manager/surogats');
		$this->load->view('manager/header', $data);
		$data['item'] = $this->Manager_model->find('personal', $id);
		$data['selectCompany'] = $this->Manager_model->selectCompany();
	  	$this->load->view('manager/edit_personal', $data);
	  	$this->load->view('manager/footer');
	}
  public function add_donors(){
  	$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
		if ( $this->session->userdata('role') != 1 ){
			redirect('schedule');
		}
	$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
  	$this->load->view('manager/header',$data);
  	$this->load->view('manager/add_donors');
  	$this->load->view('manager/footer');
  }
    public function add_surogats(){
    $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
    if ( $this->session->userdata('role') != 1 ){
      redirect('schedule');
    }
  $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
    $this->load->view('manager/header',$data);
    $this->load->view('manager/add_surogats');
    $this->load->view('manager/footer');
  }
  public function edit_donor($id){
        if(empty($id))redirect('manager/donors');
  	if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3)redirect('schedule');
  else if($this->session->userdata('role') == 4)redirect('manager/donors');
	else if($this->session->userdata('role') == 5)redirect('manager/surogats');
$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
	$data['item'] = $this->Manager_model->find('donor', $id);
  	$this->load->view('manager/header',$data);
  	$this->load->view('manager/edit_donor', $data);
  	$this->load->view('manager/footer');
  }
  public function edit_surogat($id){
    if(empty($id))redirect('manager/surogats');
  	if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3)redirect('schedule');
    else if($this->session->userdata('role') == 4)redirect('manager/surogats');
	else if($this->session->userdata('role') == 5)redirect('manager/surogats');
    $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
	$data['item'] = $this->Manager_model->find('surogat', $id);
  	$this->load->view('manager/header',$data);
  	$this->load->view('manager/edit_surogat', $data);
  	$this->load->view('manager/footer');
  }
  public function subject(){
		if ( $this->session->userdata('role') != 1 ){
			redirect('schedule');
		}
  	$this->load->view('manager/header');
  	$this->load->view('manager/subject');
  	$this->load->view('manager/footer');
  }
	public function edit_subject($id){
		if ( $this->session->userdata('role') != 1 ){
			redirect('schedule');
		}
		$this->load->view('manager/header');
		$data['item'] = $this->Manager_model->find('branches', $id);
  	$this->load->view('manager/edit_subject', $data);
  	$this->load->view('manager/footer');
	}
  public function login(){
		if ($this->session->userdata('id')){
			redirect('manager/superManager');
		}
    $this->load->view('manager/header_for_login');
    $this->load->view('manager/login');
    $this->load->view('manager/footer');
  }
	public function logout(){
		$this->session->sess_destroy();
		redirect('manager');
	}
  public function superManager(){
  		$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
		if ( $this->session->userdata('role') == 2 ){
			redirect('office/'.$this->session->userdata('company'));
		}
		else if( $this->session->userdata('role') == 3 ){
			redirect('office/'.$this->session->userdata('company'));
		}
    else if($this->session->userdata('role') == 4)redirect('manager/donors');
		else if($this->session->userdata('role') == 5)redirect('manager/surogats');
    $this->load->view('manager/header', $data);
		$data['branch'] = $this->Manager_model->selectAll('branches');
		// $data['roles'] = $this->Manager_model->selectRole();
		$data['personal'] = $this->Manager_model->selectusers();
    $this->load->view('manager/suppermanager' ,$data);
    $this->load->view('manager/footer');
  }
    public function surogats(){
    $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
    $data['surogats']=$this->Manager_model->surogats();
    $this->load->view('manager/header', $data);
    $this->load->view('manager/surogats');
    $this->load->view('manager/footer');
  }
  public function surogat($id){
    if(empty($id))redirect('manager/surogats');
    $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
    $data['surogat_single']=$this->Manager_model->surogat_single($id);
    $data['surogat_images']=$this->Manager_model->surogat_images($id);
    $this->load->view('manager/header', $data);
    $this->load->view('manager/surogat');
    $this->load->view('manager/footer');    
  }
  public function donors(){
	$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
	$data['donors']=$this->Manager_model->donors();
  	$this->load->view('manager/header', $data);
    $this->load->view('manager/donors');
    $this->load->view('manager/footer');
  }
  public function donor($id){
      if(empty($id))redirect('manager/donors');
  	$data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
  	$data['donor_single']=$this->Manager_model->donor_single($id);
        $data['donor_images']=$this->Manager_model->donor_images($id);
  	$this->load->view('manager/header', $data);
    $this->load->view('manager/donor');
    $this->load->view('manager/footer');  	
  }
}