<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Doctors.php';
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $doctors = new Doctors($db);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Get raw posted data
    $data = json_decode(file_get_contents('php://input'),true);
  
    if (empty($data)) {
    } else {
      $doctors->user_id = $data['user_id'];
      $doctors->department_id = $data['department_id'];
      $doctors->doctor_name = $data['doctor_name'];
      $doctors->designation = $data['designation'];
      $doctors->bmdc_reg = $data['bmdc_reg'];
      $doctors->phone_personal = $data['phone_personal'];
      $doctors->doctor_photo = $data['doctor_photo'];
      $doctors->v_card_photo = $data['v_card_photo']; 

      // Create User Role
      if(empty($doctors->user_id)){
      
      }else{
        if($doctors->create()) {
          $hospital_serial_numbers = $data['hospital_serial_numbers'];

          $count = count($hospital_serial_numbers);
          $num = 0;
          while ($num < $count) {
            $hSerialNumber = new HospitalSerialNumber($db);
            $hSerialNumber->doctor_id = $doctors->id;
            $row = $hospital_serial_numbers[$num];
            extract($row);
            $hSerialNumber->hospital_name = $row['hospital_name'];
            $hSerialNumber->hospital_address = $row['hospital_address'];
            $hSerialNumber->serial_phone = $row['serial_phone'];

            if($hSerialNumber->create()){
              //echo json_encode(array('message' => 'Hospital Number Created'));
            }else{
              //echo json_encode(array('message' => 'Hospital Number Not Created'));
            }
            $num = $num + 1;
          }

          echo json_encode(array('message' => 'Doctor Created'));
        } else {
          echo json_encode(array('message' => 'Doctor Not Created'));
        }
      }
    }
  }
?>