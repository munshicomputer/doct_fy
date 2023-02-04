<?php
    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Insantiate users$users Table Model
$users = new Users($db);

// Get all users$users info
$result = $users->read();

//Get row Count
$num = $result->rowCount();

//Check if any users$users
if($num > 0){
    $users_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        # code...
        extract($row);
        //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1
        
        $users_item = array(
            'u_id' => $u_id,
            'u_role_id' => $u_role_id,
            'role_type' => $role_type,
            'description' => $description,
            'u_role_create_date' => $u_role_create_date,
            'full_name' => $full_name,
            'email_address' => $email_address,
            'password' => $password,
            'mobile' => $mobile,
            'photo' => $photo,
            'update_date' => $update_date,
            'u_create_date' => $u_create_date
        );

        json_encode($users_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($users_arr, $users_item);
    }

    //Turn to Json & output
    echo json_encode($users_arr);
}else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}

?>