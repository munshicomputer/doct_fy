<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $hSerialNumber = new HospitalSerialNumber($db);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Get raw posted data
    $data = json_decode(file_get_contents('php://input'),true);
  
    if (empty($data)) {
    } else {
        $hSerialNumber->doctor_id = $data['doctor_id'];
        $hSerialNumber->hospital_name = $data['hospital_name'];
        $hSerialNumber->serial_phone = $data['serial_phone'];
        $hSerialNumber->hospital_address = $data['hospital_address'];

      // Create Hospital Serial Number
        if($hSerialNumber->create()) {
          echo json_encode(array('message' => 'Hospital Serial Number Created'));
        } else {
          echo json_encode(array('message' => 'Hospital Serial Number Not Created'));
        }
    }
  }
?>