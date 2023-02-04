<?php 
//   // Headers
//   header('Access-Control-Allow-Origin: *');
//   header('Content-Type: application/json');
//   header('Access-Control-Allow-Methods: PUT');
//   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

//   include_once '../../config/Database.php';
// include_once '../../models/Department.php';

//   // Instantiate DB & connect
//   $database = new Database();
//   $db = $database->connect();

//   // Instantiate blog post object
//   $department = new Department($db);

//   if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
      
//       echo "put method is called";
//     $data = json_decode(file_get_contents('php://input'), true);
//     $department->id = $data['id'];
//   $department->dept_name = $data['dept_name'];
//   $department->description = $data['description'];
   
//   if(empty($department->id)){
       
//   }else{
       
//   // Update post
//   if($department->update()) {
//     echo json_encode(
//       array('message' => 'Department Updated')
//     );
//   } else {
//     echo json_encode(
//       array('message' => 'Department Not Updated')
//     );
//   }
//   }
   
// }

//   // Get raw posted data
// //   $data = json_decode(file_get_contents("php://input"));

//   // Set ID to update
// //    $department->id = $data->id;
// //    $department->dept_name = $data->dept_name;
// //    $department->description = $data->body;

   

// //   //get id from url headers 
// //   $department->id = $_PUT['id'];
// //   $department->dept_name = $_PUT["dept_name"];
// //   $department->description = $_PUT["description"];


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

  $data = json_decode(file_get_contents('php://input'),true);
  
  if (empty($data)) {
  } else {
      $rating->id = $data['id'];
      $rating->user_id = $data['user_id'];
      $rating->doctor_id = $data['doctor_id'];
      $rating->rating = $data['rating'];
      $rating->rating_comment = $data['rating_comment'];
      $rating->reference_photo = $data['reference_photo'];

      // update User
      if($rating->update()) {
        echo json_encode(array('message' => 'rating Updated'));
      } else {
        echo json_encode(array('message' => 'rating Not Updated'));
      }
    }
  }
?>
