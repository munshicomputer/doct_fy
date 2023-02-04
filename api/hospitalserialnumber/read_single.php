<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate user role object
  $hSerialNumber = new HospitalSerialNumber($db);

  // Get ID
  $hSerialNumber->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get hSerialNumber$hSerialNumber
  $hSerialNumber->read_single();
  

  // Create array
  $hSerialNumber_arr = array(
    'id' => $hSerialNumber->id,
    'doctor_id' => $hSerialNumber->doctor_id,
    'doctor_name' => $hSerialNumber->doctor_name,
    'hospital_name' => $hSerialNumber->hospital_name,
    'serial_phone' => $hSerialNumber->serial_phone,
    'hospital_address' => $hSerialNumber->hospital_address,
    'create_date' => $hSerialNumber->create_date
  );

  // Make JSON
  echo json_encode($hSerialNumber_arr);
  ?>