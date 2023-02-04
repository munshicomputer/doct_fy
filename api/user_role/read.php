<?php
    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/UserRole.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Insantiate userRole Table Model
$userRole = new UserRole($db);

// Get all userRole info
$result = $userRole->read();

//Get row Count
$num = $result->rowCount();

//Check if any userRole
if($num > 0){
    $userRole_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        # code...
        extract($row);
        $userRole_item = array(
            'id' => $id,
            'role_type' => $role_type,
            'create_date' => $create_date,
            'description' => $description

        );
        json_encode($userRole_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($userRole_arr, $userRole_item);
    }

    //Turn to Json & output
    echo json_encode($userRole_arr);
}else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}

?>