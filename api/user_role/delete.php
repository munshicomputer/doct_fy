<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  // header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/UserRole.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $userRole = new UserRole($db);

  // // Get raw posted data
  // $data = json_decode(file_get_contents("php://input"));

  // // Set ID to update
  // $userRole->id = $data->id;
  // echo $userRole->id;

  //get id from url headers 
  $userRole->id = $_GET['id'];

  // Delete post
  if($userRole->delete()) {
    echo json_encode(
      array('message' => 'User Role Deleted')
    );
  } else {
    echo json_encode(array('message' => 'UserRole Not Deleted'));
  }
  ?>

