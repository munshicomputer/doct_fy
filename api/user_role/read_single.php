<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/UserRole.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate user role object
  $userRole = new UserRole($db);

  // Get ID
  $userRole->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get userRole
  $userRole->read_single();
  

  // Create array
  $userRole_arr = array(
    'id' => $userRole->id,
    'role_type' => $userRole->role_type,
    'create_date' => $userRole->create_date,
    'description' => $userRole->description
  );

  // Make JSON
  echo json_encode($userRole_arr);
  ?>