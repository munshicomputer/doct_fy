<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/UserRole.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $userRole = new UserRole($db);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Get raw posted data
    $data = json_decode(file_get_contents('php://input'),true);
  
    if (empty($data)) {
    } else {
      $userRole->role_type = $data['role_type'];;
      $userRole->description = $data['description'];

      // Create User Role
      if(empty($userRole->role_type)){
      
      }else{
        if($userRole->create()) {
          echo json_encode(array('message' => 'User Role Created'));
        } else {
          echo json_encode(array('message' => 'User Role Not Created'));
        }
      }
    }
  }
?>