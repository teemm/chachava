<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager_model extends CI_Model{
  /**
   * მთლიანი მონაცემების წამოყება მასივში
   * @param  string $table      table სახელი
   * @param  string $fields     default all,ველები რომელიც მინდა წამოიღოს
   * @param  int    $limit      ლიმიტის რიცხვი
   * @param  int    $offset     საიდან უნდა დაიწყოს ლიმიტი
   * @param  string $sort_by    რომელი სვეტით დაალაგოს
   * @param  string $sort_order სორტირება როგორც desc||asc
   * @return array              მთლიანი ელემენტების მასივი
   */
  public function selectAll($table, $fields = '*', $limit=null, $offset=null, $sort_by=null, $sort_order=null){
    $query = $this->db->select($fields)
      ->where('company_id', @$this->session->userdata('company'))
      ->order_by($sort_by, $sort_order)
      ->get($table, $limit, $offset);
      if ( $query->num_rows() > 0 ){
        foreach ($query->result_array()  as $row) {
          $result[] = $row;
          // print_r($row);
        }
        return $result;
      }
      return false;
  }

  //   public function user (){
  //   $query = $this->db->select($fields)
  //     ->where('company_id', @$this->session->userdata('company'))
  //     ->
  //     if ( $query->num_rows() > 0 ){
  //       foreach ($query->result_array()  as $row) {
  //         $result[] = $row;
  //         print_r($row);
  //       }
  //       return $result;
  //     }
  //     return false;
  // }
  /**
   * ბაზაში სვეტის მოძებნა ინდიკატორის მიხედვით
   * @param  string $table  table სახელი
   * @param  int    $id     საძიებო ინდიკატორი
   * @param  string $fields default all,ველები რომელიც მინდა წამოიღოს
   * @return array         სვეტის მსაივი მოთხოვნილ ინდიკატორზე
   */
  public function find($table, $id, $fields = '*'){
    $query = $this->db->select($fields)
      ->get_where($table, array('id' => $id,'company_id' => $this->session->userdata('company')));
      if ( $query->num_rows() > 0 ){
        $result = $query->row_array();
        return $result;
      }
      return false;
  }
  /**
   * ბაზაში სვეტის მოძებნა ინდიკატორის მიხედვით
   * @param  string $table  table სახელი
   * @param  int    $id     საძიებო ინდიკატორი
   * @param  string $fields default all,ველები რომელიც მინდა წამოიღოს
   * @return array         სვეტის მსაივი მოთხოვნილ ინდიკატორზე
   */
  public function findArray($table, $where=array(), $fields = '*'){
    $query = $this->db->select($fields)
      ->get_where($table, $where);
      if ( $query->num_rows() > 0 ){
        foreach ( $query->result_array() as $row ){
          $result[] = $row;
          print_r($row);
        }
        return $result;
      }
      return false;
  }
  public function selectUsers (){
    $query = $this->db->select('firstname,
     personal.id, roles.id as role_id, lastname,
     personal.role, personal.company_id, username,
     password, mobile, spec, roles.name, branch, avatar')
      ->join('roles', 'roles.id = personal.role')
      ->where('roles.id !=', '1')
      ->where('personal.company_id', $this->session->userdata('company'))
      ->get('personal');
      if ( $query->num_rows() > 0 ){
        foreach ( $query->result_array() as $row ){
          $result[] = $row;
        }
        return $result;
      }
      return false;
  }
  public function login(){
    $username = htmlspecialchars($this->input->post('username'));
    $password = sha1(htmlspecialchars($this->input->post('password')));
    $query = $this->db->select('id,role,username,company_id')
      ->where('username', $username)
      ->where('password', $password)
      ->get('personal');
      if ( $query->num_rows() > 0 ){
        $this->session->set_userdata(array(
          'id' => $query->row()->id,
          'role' => $query->row()->role,
          'username' => $query->row()->username,
          'company' => $query->row()->company_id
        ));
        return true;
      }
      return false;
  }
  public function createAddPersons($image){
      $data = array(
        'firstname' => htmlspecialchars($this->input->post('personFname', TRUE)),
        'lastname' => htmlspecialchars($this->input->post('personLname', TRUE)),
        'username' => htmlspecialchars($this->input->post('personUsername', TRUE)),
        'password' => sha1(htmlspecialchars($this->input->post('personPassword', TRUE))),
        'mobile' => htmlspecialchars($this->input->post('personPhoneNumber', TRUE)),
        'spec' => htmlspecialchars($this->input->post('personSpec', TRUE)),
        'branch' => 1,
        'company_id' => $this->session->userdata('company'),
        'role' =>  htmlspecialchars($this->input->post('category', TRUE))
        
      );
       if (empty($image) ){
        $data['avatar'] = 'photo.jpg';
      }
      else $data['avatar'] = htmlspecialchars($this->input->post('filename', TRUE));
      $this->db->insert('personal', $data);
      if ( $this->db->affected_rows() > 0 ){
        $_SESSION['sucsessMessage'] = 'ჩანაწერი დამატებულია';
        $this->session->mark_as_flash('sucsessMessage');
      }else{
        $_SESSION['err_message'] = 'ჩანაწერი არ დაემატა';
        $this->session->mark_as_flash('err_message');
      }
  }
  public function updatePersons($id ,$image){
      $data = array(
        'firstname' => htmlspecialchars($this->input->post('personFname', TRUE)),
        'lastname' => htmlspecialchars($this->input->post('personLname', TRUE)),
        'mobile' => htmlspecialchars($this->input->post('personPhoneNumber', TRUE)),
        'spec' => htmlspecialchars($this->input->post('personSpec', TRUE)),
        'company_id' => $this->session->userdata('company'),
        'role' =>  htmlspecialchars($this->input->post('category', TRUE))
      );
      if ( isset($_POST['personPassword']) && !empty($_POST['personPassword'])){
        $data['password'] = sha1(htmlspecialchars($this->input->post('personPassword', TRUE)));
      }
      if (empty($image) ){
        $data['avatar'] = 'photo.jpg';
      }
      else $data['avatar'] = htmlspecialchars($this->input->post('filename', TRUE));
      $this->db->where('id', $id);
      $this->db->update('personal', $data);
      if ( $this->db->affected_rows() > 0 ){
        $_SESSION['sucsessMessage'] = 'ჩანაწერი დარედაქტირებულია';
        $this->session->mark_as_flash('sucsessMessage');
      }else{
        $_SESSION['err_message'] = 'ჩანაწერი არ დარედაქტირდა';
        $this->session->mark_as_flash('err_message');
      }
  }
  //service
  public function createService($image = ''){
    $data = array(
      'title' => htmlspecialchars($this->input->post('title', TRUE)),
      'description' => $this->input->post('description', TRUE),
      'price' => htmlspecialchars($this->input->post('price', TRUE)),
      'hours' => htmlspecialchars($this->input->post('workingHours', TRUE)),
      'company_id' => $this->session->userdata('company')
    );
    if (empty($image) ){
      $data['image'] = $image;
    }
    $this->db->insert('service', $data);
    if ( $this->db->affected_rows() > 0 ){
      $_SESSION['sucsessMessage'] = 'ჩანაწერი დამატებულია';
      $this->session->mark_as_flash('sucsessMessage');
    }else{
      $_SESSION['err_message'] = 'ჩანაწერი არ დაემატა';
      $this->session->mark_as_flash('err_message');
    }
  }
  public function updateService($id){
    $data = array(
      'title' => htmlspecialchars($this->input->post('title', TRUE)),
      'description' => $this->input->post('description', TRUE),
      'price' => htmlspecialchars($this->input->post('price', TRUE)),
      'hours' => htmlspecialchars($this->input->post('workingHours', TRUE)),
      'company_id' => $this->session->userdata('company')
    );
    $this->db->where('id', $id);
    $this->db->update('service', $data);
    if ( $this->db->affected_rows() > 0 ){
      $_SESSION['sucsessMessage'] = 'ჩანაწერი დარედაქტირებულია';
      $this->session->mark_as_flash('sucsessMessage');
    }else{
      $_SESSION['err_message'] = 'ჩანაწერი არ დარედაქტირდა';
      $this->session->mark_as_flash('err_message');
    }
  }
  //branch
  public function createBranch($image){
    $data = array(
      'name' => htmlspecialchars($this->input->post('title', TRUE)),
      'address' => $this->input->post('address', TRUE),
      'description' => htmlspecialchars($this->input->post('description', TRUE)),
      'phone' => htmlspecialchars($this->input->post('phone', TRUE)),
      'company_id' => $this->session->userdata('company')
    );
    if (empty($image) ){
      $data['image'] = 'photo.jpg';
    }
    $this->db->insert('branches', $data);
    if ( $this->db->affected_rows() > 0 ){
      $_SESSION['sucsessMessage'] = 'ჩანაწერი დამატებულია';
      $this->session->mark_as_flash('sucsessMessage');
    }else{
      $_SESSION['err_message'] = 'ჩანაწერი არ დაემატა';
      $this->session->mark_as_flash('err_message');
    }
  }
  public function updateBranch($id, $image = ''){
    $data = array(
      'name' => htmlspecialchars($this->input->post('title', TRUE)),
      'address' => $this->input->post('address', TRUE),
      'phone' => htmlspecialchars($this->input->post('phone', TRUE)),
      'description' => htmlspecialchars($this->input->post('description', TRUE)),
      'phone' => htmlspecialchars($this->input->post('description', TRUE)),
      'company_id' => $this->session->userdata('company')
    );
    if ( !empty($image) ){
      $data['image'] = $image;
    }
    $this->db->where('id', $id);
    $this->db->update('branches', $data);
    if ( $this->db->affected_rows() > 0 ){
      $_SESSION['sucsessMessage'] = 'ჩანაწერი დარედაქტირებულია';
      $this->session->mark_as_flash('sucsessMessage');
    }else{
      $_SESSION['err_message'] = 'ჩანაწერი არ დარედაქტირდა';
      $this->session->mark_as_flash('err_message');
    }
  }
  // სკრიპტი გივნდა იმ შემთხვევაშ თუ გამოვყენებთ ფილიალებზე მიბმას სელექტის გარეშე 
  // public function keyup($arg){
  //   $this->db->select('*');
  //   $this->db->like('name', $arg);
  //   return  $row = $this->db->get('branches')->result_array();
  //   }
  // სკრიპტი გივნდა იმ შემთხვევაშ თუ გამოვყენებთ ფილიალებზე მიბმას სელექტის გარეშე 
  public function selectCompany(){
    $this->db->select('*');
    // $this->db->join('company', 'company.id = branches.company_id ')
    $this->db->where('company_id', @$this->session->userdata('company'));
   return  $row = $this->db->get('branches')->result_array();
    }
    public function updata_pass(){
      $data = array(
      'password' => htmlspecialchars(sha1($this->input->post('newPass', TRUE))),
    );
    $this->db->where('id',@$this->session->userdata('id'));
    $this->db->update('personal', $data);
    }
    public function updata_pass_for_surogats(){
      $data = array(
      'password' => htmlspecialchars(sha1($this->input->post('newPass', TRUE))),
    );
    $this->db->where('id', '60');
    $this->db->update('personal', $data);
    }
    public function updata_pass_for_donors(){
      $data = array(
      'password' => htmlspecialchars(sha1($this->input->post('newPass', TRUE))),
    );
    $this->db->where('id', '61');
    $this->db->update('personal', $data);
    }
    public function user_for_changepass(){
      $this->db->select('id, username');
      $this->db->where('id', @$this->session->userdata('id'));
      return $query = $this->db->get('personal')->row_array();
    }
    public function SurogatPass(){
      $this->db->select('id, username');
      $this->db->where('id', '60');
      return $query = $this->db->get('personal')->row_array();
    }
    public function DonorPass(){
      $this->db->select('id, username');
      $this->db->where('id', '61');
      return $query = $this->db->get('personal')->row_array();
    }
    public function add_donors(){
//upload image start

    $j = 0; //Variable for indexing uploaded image 
    $uploadimg=false;
    $listsimgs=array();
    $delfiles=explode('-',$_POST['delfile']);
    array_shift($delfiles);
	
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array
$target_path = "uploads/"; //Declaring Path for uploaded images
        if(in_array(($i+1), $delfiles)) continue;
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $file_name=md5(uniqid()).'.'.$ext[count($ext) - 1];       
	$target_path2 = $target_path . $file_name;//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
        
	  if (($_FILES["file"]["size"][$i] < 10000000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            $uploadimg=true;
        
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path2)) {//if file moved to uploads folder
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
$listsimgs[]=$file_name;
            } else {//if file was not moved.
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
print_r($listsimgs);

//upload image end



      $data = array(
        "fname"=>htmlspecialchars($this->input->post('donfname', TRUE)),
        "lname"=>htmlspecialchars($this->input->post('donlname', TRUE)),
        "age"=>htmlspecialchars($this->input->post('age', TRUE)),
        "nationality"=>htmlspecialchars($this->input->post('nationality', TRUE)),
        "full_view"=>htmlspecialchars($this->input->post('full_view', TRUE))
      );
      if($uploadimg==false){
        $data['avatar'] = 'photo.jpg';
      }
      else{
        $data['avatar'] = $listsimgs[0];
      }
      $this->db->insert('donor', $data);
      if($uploadimg!=false){
         $this->db->select('id');
         $this->db->order_by('id','DESC');
         $lastdonor=$this->db->get('donor')->row_array();
         for($j=0;$j<count($listsimgs);$j++){
           $data= array(
              'donor_id'=>$lastdonor['id'],
              'img_name'=>$listsimgs[$j]
           );
           $this->db->insert('donor_images', $data);
         }
       }
    }
    public function updateDonor($id){
     $data = array(
        "fname"=>htmlspecialchars($this->input->post('personFname', TRUE)),
        "lname"=>htmlspecialchars($this->input->post('personLname', TRUE)),
        "age"=>htmlspecialchars($this->input->post('personage', TRUE)),
        "nationality"=>htmlspecialchars($this->input->post('nationality', TRUE)),
        "full_view"=>htmlspecialchars($this->input->post('full_view', TRUE))     
     );
      if(!empty($this->input->post('filename')) ){
        $data['avatar'] = htmlspecialchars($this->input->post('filename', TRUE));
      }
     $this->db->where('id',$id);
     $this->db->update('donor', $data);
    }
    public function updateSurogat($id){
     $data = array(
        "surogatFname"=>htmlspecialchars($this->input->post('personFname', TRUE)),
        "surogatLname"=>htmlspecialchars($this->input->post('personLname', TRUE)),
        "surogatAge"=>htmlspecialchars($this->input->post('personage', TRUE)),
        "surogatFullViev"=>htmlspecialchars($this->input->post('full_view', TRUE))     
     );
      if(!empty($this->input->post('filename')) ){
        $data['surogatAvatar'] = htmlspecialchars($this->input->post('filename', TRUE));
      }
     $this->db->where('id',$id);
     $this->db->update('surogat', $data);
    }
    public function donors(){
      return $this->db->get('donor')->result_array();
    }
    public function donor_single($id){
        $this->db->where('id',$id);
      return $this->db->get('donor')->row_array();
    }
     public function add_surogats(){
//upload image start

    $j = 0; //Variable for indexing uploaded image 
    $uploadimg=false;
    $listsimgs=array();
    $delfiles=explode('-',$_POST['delfile']);
    array_shift($delfiles);
	
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array
$target_path = "uploads/"; //Declaring Path for uploaded images
        if(in_array(($i+1), $delfiles)) continue;
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $file_name=md5(uniqid()).'.'.$ext[count($ext) - 1];       
	$target_path2 = $target_path . $file_name;//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
        
	  if (($_FILES["file"]["size"][$i] < 10000000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            $uploadimg=true;
        
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path2)) {//if file moved to uploads folder
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
$listsimgs[]=$file_name;
            } else {//if file was not moved.
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
print_r($listsimgs);

//upload image end





      $data = array(
        "surogatFname"=>htmlspecialchars($this->input->post('surogatFname', TRUE)),
        "surogatLname"=>htmlspecialchars($this->input->post('surogatLname', TRUE)),
        "surogatAge"=>htmlspecialchars($this->input->post('surogatAge', TRUE)),
        "surogatFullViev"=>htmlspecialchars($this->input->post('surogatFullViev', TRUE))
      );

      if($uploadimg==false){
        $data['surogatAvatar'] = 'photo.jpg';
      }
      else{
        $data['surogatAvatar'] = $listsimgs[0];
      }
      $this->db->insert('surogat', $data);

      if($uploadimg!=false){
         $this->db->select('id');
         $this->db->order_by('id','DESC');
         $lastdonor=$this->db->get('surogat')->row_array();
         for($j=0;$j<count($listsimgs);$j++){
           $data= array(
              'surogat_id'=>$lastdonor['id'],
              'img'=>$listsimgs[$j]
           );
           $this->db->insert('surogat_images', $data);
         }
       }

    }
     public function surogats(){
      return $this->db->get('surogat')->result_array();
    }
     public function surogat_single($id){
        $this->db->where('id',$id);
      return $this->db->get('surogat')->row_array();
    }
    public function donor_images($id){
      $this->db->where('donor_id',$id);
      return $this->db->get('donor_images')->result_array();
    }
    public function surogat_images($id){
      $this->db->where('surogat_id',$id);
      return $this->db->get('surogat_images')->result_array();
    }
}