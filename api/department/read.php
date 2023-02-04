<?php
    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Department.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Insantiate Department Table Model
$department = new Department($db);

// Get all Department info
$result = $department->read();

//Get row Count
$num = $result->rowCount();

//Check if any Department
if($num > 0){
    $department_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        # code...
        extract($row);
        $department_item = array(
            'id' => $id,
            'dept_name' => $dept_name,
            'create_date' => $create_date,
            'description' => $description

        );
        json_encode($department_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($department_arr, $department_item);
    }

    //Turn to Json & output
    echo json_encode($department_arr);
}else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}

?>