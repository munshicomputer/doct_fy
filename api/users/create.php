<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $users = new Users($db);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Get raw posted data
    $data = json_decode(file_get_contents('php://input'),true);
  
    if (empty($data)) {
    } else {
        $users->user_role_id = $data['user_role_id'];
        $users->full_name = $data['full_name'];
        $users->email_address = $data['email_address'];
        $users->password = $data['password'];
        $users->mobile = $data['mobile'];
        $users->photo = $data['photo'];

      // Create User Role
      if(empty($users->email_address)){
      
      }else{

        // Get all users$users info
        $result = $users->check_exist();

        //Get row Count
        $num = $result->rowCount();

        if($num > 0){
          echo json_encode(array('message' => 'Error User already Exist with this email'));
        }else{
          if($users->create()) {
            echo json_encode(array('message' => 'User Role Created'));
          } else {
            echo json_encode(array('message' => 'User Role Not Created'));
          }
        }
      }
    }
  }
?>