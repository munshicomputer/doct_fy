<?php
    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/HospitalSerialNumber.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Insantiate hSerialNumber$hSerialNumber Table Model
$hSerialNumber = new HospitalSerialNumber($db);

// Get all hSerialNumber$hSerialNumber info
$result = $hSerialNumber->read();

//Get row Count
$num = $result->rowCount();

//Check if any hSerialNumber$hSerialNumber
if($num > 0){
    $hSerialNumber_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        # code...
        extract($row);
        //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM hSerialNumber_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1
        
        $hSerialNumber_item = array(
            'id' => $id,
            'doctor_id' => $doctor_id,
            'doctor_name' => $doctor_name,
            'hospital_name' => $hospital_name,
            'serial_phone' => $serial_phone,
            'hospital_address' => $hospital_address,
            'create_date' => $create_date
        );

        json_encode($hSerialNumber_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($hSerialNumber_arr, $hSerialNumber_item);
    }

    //Turn to Json & output
    echo json_encode($hSerialNumber_arr);
}else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}

?>