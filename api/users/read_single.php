<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate user role object
  $users = new Users($db);

  // Get ID
  $users->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get users$users
  $users->read_single();
  

  // Create array
  $users_arr = array(
    'u_id' => $users->id,
    'u_role_id' => $users->user_role_id,
    'role_type' => $users->role_type,
    'description' => $users->description,
    'u_role_create_date' => $users->u_role_create_date,
    'full_name' => $users->full_name,
    'email_address' => $users->email_address,
    'password' => $users->password,
    'mobile' => $users->mobile,
    'photo' => $users->photo,
    'update_date' => $users->update_date,
    'u_create_date' => $users->create_date
  );

  // Make JSON
  echo json_encode($users_arr);
  ?>