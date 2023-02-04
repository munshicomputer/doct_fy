<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  // header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $hSerialNumber = new HospitalSerialNumber($db);

  // // Get raw posted data
  // $data = json_decode(file_get_contents("php://input"));

  // // Set ID to update
  // $hSerialNumber->id = $data->id;
  // echo $hSerialNumber->id;

  //get id from url headers 
  $hSerialNumber->id = $_GET['id'];

  // Delete post
  if($hSerialNumber->delete()) {
    echo json_encode(
      array('message' => 'Hospital Serial Number Deleted')
    );
  } else {
    echo json_encode(array('message' => 'Hospital Serial Number Not Deleted'));
  }
  ?>

