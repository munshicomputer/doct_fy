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
  include_once '../../models/HospitalSerialNumber.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $hSerialNumber = new HospitalSerialNumber($db);
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

  $data = json_decode(file_get_contents('php://input'),true);
  
  if (empty($data)) {
  } else {
      $hSerialNumber->id = $data['id'];
      $hSerialNumber->doctor_id = $data['doctor_id'];
      $hSerialNumber->hospital_name = $data['hospital_name'];
      $hSerialNumber->serial_phone = $data['serial_phone'];
      $hSerialNumber->hospital_address = $data['hospital_address'];

      // update User
      if($hSerialNumber->update()) {
        echo json_encode(array('message' => 'hSerialNumber Updated'));
      } else {
        echo json_encode(array('message' => 'hSerialNumber Not Updated'));
      }
    }
  }
?>
