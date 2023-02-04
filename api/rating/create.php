<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Rating.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $rating = new Rating($db);

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Get raw posted data
    $data = json_decode(file_get_contents('php://input'),true);
  
    if (empty($data)) {
    } else {
        $rating->user_id = $data['user_id'];
        $rating->doctor_id = $data['doctor_id'];
        $rating->rating = $data['rating'];
        $rating->rating_comment = $data['rating_comment'];
        $rating->reference_photo = $data['reference_photo'];

      // Create User Role
        if($rating->create()) {
           echo json_encode(array('message' => 'Rating Created'));
        } else {
          echo json_encode(array('message' => 'Rating Not Created'));
        }
    }
  }
?>