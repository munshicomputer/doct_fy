<?php
    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Doctors.php';
include_once '../../models/HospitalSerialNumber.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Insantiate doctors Table Model
$doctors = new Doctors($db);
$hSerialNumbers = new HospitalSerialNumber($db);

// Get all doctors info
$result = $doctors->read();

//Get row Count
$num = $result->rowCount();

// $phone_for_serial = json_encode(array(
//     "" => ""
// ));
//Check if any doctors
if($num > 0){
    $doctors_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        # code...
        extract($row);

        $hSerialNumbers->doctor_id = $d_id;
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

        $doctors_item = array(
            'd_id' => $d_id,
            'user_id' => $user_id,
            'user_full_name' => $user_full_name,
            'user_photo' => $user_photo,
            'department_id' => $department_id,
            'dept_name' => $dept_name,
            'doctor_name' => $doctor_name,
            'isActive' => $isActive,
            'designation' => $designation,
            'bmdc_reg' => $bmdc_reg,
            'phone_personal' => $phone_personal,
            'doctor_photo' => $doctor_photo,
            'v_card_photo' => $v_card_photo,
            'update_date' => $update_date,
            'create_date' => $create_date,
            'active_date' => $active_date,
            'phone_for_serial' => $hospital_serial_array
        );
        json_encode($doctors_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($doctors_arr, $doctors_item);
    }

    //Turn to Json & output
    echo json_encode($doctors_arr);
}else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}

?>