<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  // header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Doctors.php';
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $doctors = new Doctors($db);
  $hserialNumber = new HospitalSerialNumber($db);

  // // Get raw posted data
  // $data = json_decode(file_get_contents("php://input"));

  // // Set ID to update
  // $doctors->id = $data->id;
  // echo $doctors->id;

  //get id from url headers 
  $doctId = $_GET['id'];
  $doctors->id = $doctId;
  $hserialNumber->doctor_id = $doctId;
  //delete doctor hospital serial info
  if($hserialNumber->deletebydoctorid()){
    // Delete Doctor
    if($doctors->delete()) {
      echo json_encode(
        array('message' => 'Doctor Deleted')
      );
    } else {
      echo json_encode(array('message' => 'doctors Not Deleted'));
    }
  }
  ?>

