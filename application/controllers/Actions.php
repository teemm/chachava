<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Actions extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('Manager_model');
  }
  public function login(){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
      if ( $this->Manager_model->login() != false ){
        redirect('manager/superManager');
      }else{
        $_SESSION['err_message'] = 'გთხოვთ გადაამოწმოთ ნიკი ან პაროლი';
        $this->session->mark_as_flash('err_message');
        redirect('manager/login');
        die('მონაცემები არასწორია');
      }
    }
  }

  public function add_surogats(){
    $this->Manager_model->add_surogats();
    redirect('manager/surogats');
  }
  public function file_upload(){
		if (empty($_FILES) || $_FILES["file"]["error"]) {
    	die('{"OK": 0,"error":'.json_encode($_FILES["file"]["error"]).'}');
		}
    $fileInfo = pathinfo($_FILES["file"]["name"]);
    $fileName = uniqid() . '.' . $fileInfo['extension'];
    move_uploaded_file($_FILES["file"]["tmp_name"],
    "uploads/" . $fileName);
		// $fileName = $_FILES["file"]["name"];
		// move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/$fileName");

		die('{"OK": 1,"html":'.json_encode($fileName).'}');
	}
  public function add_person(){
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('personFname', 'სახელი', 'trim|min_length[2]|required',
            array(
              'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
          $this->form_validation->set_rules('personLname', 'გვარი', 'trim|min_length[2]|required',
            array(
              'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
          $this->form_validation->set_rules('personUsername', 'ნიკი', 'trim|min_length[4]|max_length[12]|required|is_unique[personal.username]',
            array(
      				'required' => '%s ველის შევსება აუცილებელია',
      				'min_length' => '%s ზომა უნდა იყოს 5 სიმბოლოზე მეტი',
      				'max_length' => '%s ზომა უნდა იყოს მაქსიმუმ 12 სიმბოლო',
      				'is_unique' => 'მსგავსი %s უკვე არსებობს სისტემაში'
    				)
          );
          $this->form_validation->set_rules('personPhoneNumber', 'მობილური', 'trim|required|numeric|exact_length[9]',
            array(
              'required' => '%s ველის შევსება აუცილებელია',
              'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ციფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
              'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
            )
          );
          $this->form_validation->set_rules('personSpec', 'სპეციალიზაცია', 'trim|required',
            array(
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
          $this->form_validation->set_rules('category', 'კატეგორია', 'trim|required',
            array(
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
          if ($this->form_validation->run() === FALSE) {
            $error = array();
      			$error['message'] = '';
      			foreach ( $this->form_validation->error_array() as $k => $v){
      				$error['name'][$k] = $v;
      				// $error['message'] .= '<p>'.$v.'</p>';
      			}
      			echo '{"status":0,"error":'.json_encode($error).'}';
          }else{
              if (isset($_POST['filename']) ){
                $this->Manager_model->createAddPersons($_POST['filename']);
                echo '{"status":1}';
              }else{
                $error['message'] = '';
                $error['name']['filename'] = 'სურათის ატვირთვა აუცილებელია';
                echo '{"status":0,"error":'.json_encode($error).'}';
              }

          }
      }
  }
  public function update_person($id){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('personFname', 'სახელი', 'trim|min_length[2]|required',
        array(
          'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('personLname', 'გვარი', 'trim|min_length[2]|required',
        array(
          'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('personPhoneNumber', 'მობილური', 'trim|required|numeric|exact_length[9]',
        array(
          'required' => '%s ველის შევსება აუცილებელია',
          'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ციფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
          'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
        )
      );
      $this->form_validation->set_rules('personSpec', 'სპეციალიზაცია', 'trim|required',
        array(
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('category', 'კატეგორია', 'trim|required',
        array(
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      if ($this->form_validation->run() === FALSE) {
        $error = array();
        $error['message'] = '';
        foreach ( $this->form_validation->error_array() as $k => $v){
          $error['name'][$k] = $v;
          // $error['message'] .= '<p>'.$v.'</p>';
        }
        echo '{"status":0,"error":'.json_encode($error).'}';
      }else{
          $this->Manager_model->updatePersons($id, @$_POST['filename']);
          echo '{"status":1}';
      }
    }
  }
  //service
  public function add_donors(){
    $this->Manager_model->add_donors();
    redirect('manager/donors');
  }
  public function update_donor($id){
     if(empty($id))redirect('manager/donors');
     $this->Manager_model->updateDonor($id);
     echo '{"status":1}';
  }
  public function update_surogat($id){
     if(empty($id))redirect('manager/surogats');
     $this->Manager_model->updateSurogat($id);
      echo '{"status":1}';
  }

// parolis shecvla
  public function changePass(){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
    $this->load->library('form_validation');

      $this->form_validation->set_rules('oldpass', 'ძველი პაროლის', 'required|callback_old_pass',
        array(
          // 'callback_old_pass' => '%s მითითებული პაროლი არ ემთხვევა ძველს',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('newPass', 'პაროლის', 'trim|min_length[2]|required',
            array(
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
      $this->form_validation->set_rules('comfimPass', 'პაროლი', 'matches[newPass]|required',
            array(
              'matches' => '%s არ ემთხვევა მითითებულს',
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
        if ($this->form_validation->run() === FALSE) {
        $_SESSION['err_message'] = $this->form_validation->error_array();
        $this->session->mark_as_flash('err_message');
        redirect('manager/changePass');
      }else{
        $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
        $this->Manager_model->updata_pass();
        $this->load->view('manager/header');
        $data['succ']='პაროლი წარმატებით დარედაქტირდა';
        $data['username'] = $this->Manager_model->user_for_changepass();
        $this->load->view('manager/changePass', $data);
        $this->load->view('manager/footer');
      }
    }
  }
   public function change_donor_pas(){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
    $this->load->library('form_validation');
      $this->form_validation->set_rules('newPass', 'პაროლის', 'trim|min_length[2]|required',
            array(
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
      $this->form_validation->set_rules('comfimPass', 'პაროლი', 'matches[newPass]|required',
            array(
              'matches' => '%s არ ემთხვევა მითითებულს',
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
        if ($this->form_validation->run() === FALSE) {
        $_SESSION['err_message'] = $this->form_validation->error_array();
        $this->session->mark_as_flash('err_message');
        redirect('manager/change_donor_pas');
      }else{
        // $this->Manager_model->updata_pass();
        $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
        $data['succ']='პაროლი წარმატებით დარედაქტირდა';
        $data['username'] = $this->Manager_model->updata_pass_for_donors();
        $this->load->view('manager/header', $data);
        $this->load->view('manager/changePass');
        $this->load->view('manager/footer');
      }
    }
  }
   public function change_surogat_pas(){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
    $this->load->library('form_validation');
      $this->form_validation->set_rules('newPass', 'პაროლის', 'trim|min_length[2]|required',
            array(
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
      $this->form_validation->set_rules('comfimPass', 'პაროლი', 'matches[newPass]|required',
            array(
              'matches' => '%s არ ემთხვევა მითითებულს',
              'required' => '%s ველის შევსება აუცილებელია'
            )
          );
        if ($this->form_validation->run() === FALSE) {
        $_SESSION['err_message'] = $this->form_validation->error_array();
        $this->session->mark_as_flash('err_message');
        redirect('manager/change_surogat_pas');
      }else{
        // $this->Manager_model->updata_pass
        $data['finduser'] = $this->Manager_model->find('personal', $this->session->userdata('id'));
        $data['succ']='პაროლი წარმატებით დარედაქტირდა';
        $data['username'] = $this->Manager_model->updata_pass_for_surogats();
        $this->load->view('manager/header', $data);
        $this->load->view('manager/changePass');
        $this->load->view('manager/footer');
      }
    }
  }
 public function old_pass($oldpass){
   $this->db->where('id', $this->session->userdata('id'));
   $this->db->where('password', sha1($oldpass));
   $row=$this->db->get('personal')->row_array();
   if($row)return TRUE;
    $this->form_validation->set_message('oldpass', 'მითითებული პაროლი არ ემთხვევა ძველს');
   return FALSE;
  } 
// parolis shecvla



  public function add_branch(){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('title', 'სათაური', 'trim|min_length[2]|required',
        array(
          'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('address', 'მისამართი', 'trim|min_length[2]|required',
        array(
          'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('phone', 'ტელეფონის ნომერი', 'trim|required|numeric',
        array(
          'required' => '%s ველის შევსება აუცილებელია',
          'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ციფრებს ყოვლგვარი გამოტოვების და "-" გარეშე '        )
      );
      $this->form_validation->set_rules('description', 'მოკლე აღწერა', 'trim|required',
        array(
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      if ($this->form_validation->run() === FALSE) {
        $error = array();
        $error['message'] = '';
        foreach ( $this->form_validation->error_array() as $k => $v){
          $error['name'][$k] = $v;
          // $error['message'] .= '<p>'.$v.'</p>';
        }
        echo '{"status":0,"error":'.json_encode($error).'}';
      }else{
          if (isset($_POST['filename']) ){
            $this->Manager_model->createBranch($_POST['filename']);
            echo '{"status":1}';
          }else{
            $error['message'] = '';
            $error['name']['filename'] = 'სურათის ატვირთვა აუცილებელია';
            echo '{"status":0,"error":'.json_encode($error).'}';
          }

      }
    }
  }
  public function edit_branch($id){
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) ){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('title', 'სათაური', 'trim|min_length[2]|required',
        array(
          'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('address', 'მისამართი', 'trim|min_length[2]|required',
        array(
          'min_length' => '%s უნდა იყოს 1 სიმბოლოზე მეტი',
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      $this->form_validation->set_rules('phone', 'ტელეფონის ნომერი', 'trim|required|numeric',
        array(
          'required' => '%s ველის შევსება აუცილებელია',
          'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ციფრებს ყოვლგვარი გამოტოვების და "-" გარეშე '        )
      );
      $this->form_validation->set_rules('description', 'მოკლე აღწერა', 'trim|required',
        array(
          'required' => '%s ველის შევსება აუცილებელია'
        )
      );
      if ($this->form_validation->run() === FALSE) {
        $error = array();
        $error['message'] = '';
        foreach ( $this->form_validation->error_array() as $k => $v){
          $error['name'][$k] = $v;
          // $error['message'] .= '<p>'.$v.'</p>';
        }
        echo '{"status":0,"error":'.json_encode($error).'}';
      }else{
          $this->Manager_model->updateBranch($id, @$_POST['filename']);
          echo '{"status":1}';
      }
    }
  }
  public function delete_obj($id, $table){
    $this->db->where('id', $id)
      ->delete($table);
    if($table=='personal'){
      $this->db->where('personal', $id)
        ->delete('events');      
    }
    if ( $this->db->affected_rows() > 0 ){
      $_SESSION['message'] = 'ჩანაწერი წაშლილია';
      $this->session->mark_as_flash('message');
    }else{
      $_SESSION['err_message'] = 'ჩანაწერი არ წაიშალა';
      $this->session->mark_as_flash('err_message');
    }
    redirect('Manager/superManager');
  }
}