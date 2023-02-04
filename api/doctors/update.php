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
  include_once '../../models/Doctors.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $doctors = new Doctors($db);
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

  $data = json_decode(file_get_contents('php://input'),true);
  
  if (empty($data)) {
  } else {
      $doctors->id = $data['id'];
      $doctors->user_id = $data['user_id'];;
      $doctors->department_id = $data['department_id'];
      $doctors->doctor_name = $data['doctor_name'];
      $doctors->isActive = $data['isActive'];
      $doctors->designation = $data['designation'];
      $doctors->bmdc_reg = $data['bmdc_reg'];
      $doctors->phone_personal = $data['phone_personal'];
      $doctors->doctor_photo = $data['doctor_photo'];
      $doctors->v_card_photo = $data['v_card_photo'];
      $doctors->update_date = date("Y-m-d H:i:s");

      // Create post
      if($doctors->update()) {
        echo json_encode(array('message' => 'doctors Updated'));
      } else {
        echo json_encode(array('message' => 'doctors Not Updated'));
      }
    }
  }
?>
