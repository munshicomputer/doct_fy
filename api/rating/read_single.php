<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Rating.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate user role object
  $rating = new Rating($db);

  // Get ID
  $rating->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get rating$rating
  $rating->read_single();

  // Create array
  $rating_arr = array(
    'id' => $rating->id,
    'user_id' => $rating->user_id,
    'user_full_name' => $rating->user_full_name,
    'user_photo' => $rating->user_photo,
    'doctor_id' => $rating->doctor_id,
    'doctor_name' => $rating->doctor_name,
    'isActive' => $rating->isActive,
    'designation' => $rating->designation,
    'bmdc_reg' => $rating->bmdc_reg,
    'rating' => $rating->rating,
    'rating_comment' => $rating->rating_comment,
    'rating_like' => $rating->rating_like,
    'rating_dislike' => $rating->rating_dislike,
    'create_date' => $rating->create_date,
    'reference_photo' => $rating->reference_photo
  );

  // Make JSON
  echo json_encode($rating_arr);
  ?>