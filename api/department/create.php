<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Department.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $department = new Department($db);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Get raw posted data
    $data = json_decode(file_get_contents('php://input'),true);
  
    if (empty($data)) {
    } else {
      $department->dept_name = $data['dept_name'];;
      $department->description = $data['description'];

      // Create department
      if(empty($department->dept_name)){
      
      }else{
        if($department->create()) {
          echo json_encode(array('message' => 'Department Created'));
        } else {
          echo json_encode(array('message' => 'Department Not Created'));
        }
      }
    }
  }
?>