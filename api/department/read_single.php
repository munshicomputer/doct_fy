<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Department.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $department = new Department($db);

  // Get ID
  $department->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Department
  $department->read_single();
  

  // Create array
  $department_arr = array(
    'id' => $department->id,
    'dept_name' => $department->dept_name,
    'create_date' => $department->create_date,
    'description' => $department->description
  );

  // Make JSON
  echo json_encode($department_arr);
  ?>