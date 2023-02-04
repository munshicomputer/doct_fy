<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Doctors.php';
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate user role object
  $doctors = new Doctors($db);
  $hSerialNumbers = new HospitalSerialNumber($db);

  // Get ID
  $doctors->id = isset($_GET['id']) ? $_GET['id'] : die();

  $hSerialNumbers->doctor_id = isset($_GET['id']) ? $_GET['id'] : die();
  $resForDoctorSerial = $hSerialNumbers->read_by_doctor_id();
  $hsnNum = $resForDoctorSerial->rowCount();
  $hospital_serial_array = array();
  if($hsnNum>0){
    while ($rows = $resForDoctorSerial->fetch(PDO::FETCH_ASSOC)) {
        extract($rows);
        $hospital_item = array(
            'id' => $id,
            'doctor_id' => $doctor_id,
            'doctor_name' => $doctor_name,
            'hospital_name' => $hospital_name,
            'serial_phone' => $serial_phone,
            'hospital_address' => $hospital_address,
            'create_date' => $create_date
        );

        json_encode($hospital_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($hospital_serial_array, $hospital_item);
    }
}

  // Get doctors$doctors
  $doctors->read_single();
  

  // Create array
  $doctors_arr = array(
    'd_id' => $doctors->id,
    'user_id' => $doctors->user_id,
    'user_full_name' => $doctors->user_full_name,
    'user_photo' => $doctors->user_photo,
    'department_id' => $doctors->department_id,
    'dept_name' => $doctors->dept_name,
    'doctor_name' => $doctors->doctor_name,
    'isActive' => $doctors->isActive,
    'designation' => $doctors->designation,
    'bmdc_reg' => $doctors->bmdc_reg,
    'phone_personal' => $doctors->phone_personal,
    'doctor_photo' => $doctors->doctor_photo,
    'v_card_photo' => $doctors->v_card_photo,
    'update_date' => $doctors->update_date,
    'create_date' => $doctors->create_date,
    'active_date' => $doctors->active_date,
    'phone_for_serial' => $hospital_serial_array
  );

  // Make JSON
  echo json_encode($doctors_arr);
  ?>