<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  // header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Rating.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $rating = new Rating($db);

  //get id from url headers 
  $rating->id = $_GET['id'];

  // Delete post
  if($rating->delete()) {
    echo json_encode(
      array('message' => 'Rating Deleted')
    );
  } else {
    echo json_encode(array('message' => 'Rating Not Deleted'));
  }
  ?>

