<?php
    //Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Rating.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Insantiate rating$rating Table Model
$rating = new Rating($db);

// Get all rating$rating info
$result = $rating->read();

//Get row Count
$num = $result->rowCount();

//Check if any rating$rating
if($num > 0){
    $rating_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        # code...
        extract($row);
        //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM rating_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1
        
        $rating_item = array(
            'id' => $id,
            'user_id' => $user_id,
            'user_full_name' => $full_name,
            'user_photo' => $user_photo,
            'doctor_id' => $doctor_id,
            'doctor_name' => $doctor_name,
            'isActive' => $isActive,
            'designation' => $designation,
            'bmdc_reg' => $bmdc_reg,
            'rating' => $rating,
            'rating_comment' => $rating_comment,
            'rating_like' => $rating_like,
            'rating_dislike' => $rating_dislike,
            'create_date' => $create_date,
            'reference_photo' => $reference_photo
        );

        json_encode($rating_item,JSON_FORCE_OBJECT);

        //Push to "data"
        array_push($rating_arr, $rating_item);
    }

    //Turn to Json & output
    echo json_encode($rating_arr);
}else{
    echo json_encode(
        array('message' => 'No Data Found')
    );
}

?>