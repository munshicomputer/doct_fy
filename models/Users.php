<?php
    class Users{
        //DB Stuff
    private $conn;
    private $table = 'users_table';
    private $joinTable = 'user_role';

    // Department Properties
    public $id;
    public $user_role_id;
    public $role_type;
    public $description;
    public $u_role_create_date;
    public $full_name;
    public $email_address;
    public $password;
    public $mobile;
    public $photo;
    public $create_date;
    public $update_date;
    
    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get All UserRole
    public function read(){
        // Create Query
        // $query = 'SELECT u.id as u_id, u.*, ur.* FROM '. $this->table .' as u JOIN '.$this->joinTable.' as ur on ur.id = u.user_role_id';

        //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1

        $query = 'SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id';

        //Prepare Statement
        $statement = $this->conn->prepare($query);

        //Execute Query
        $statement->execute();

        return $statement;
    }

    public function check_exist(){
      // Create Query
       $query = 'SELECT * FROM '. $this->table .' where email_address = :email_address';

      //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1
      
      //Prepare Statement
      $statement = $this->conn->prepare($query);

      $this->email_address = htmlspecialchars(strip_tags($this->email_address));
      $statement->bindParam(':email_address', $this->email_address);

      //Execute Query
      $statement->execute();

      return $statement;
  }

    // Get Single UserRole Data
    public function read_single() {
        // Create query
        $query = 'SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = ?';

        // Prepare statement
        $statement = $this->conn->prepare($query);

        // Bind ID
        $statement->bindParam(1, $this->id);

        // Execute query
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row > 0){
          // Set properties
          $this->id = $row['u_id'];
          $this->user_role_id = $row['u_role_id'];
          $this->role_type = $row['role_type'];
          $this->description = $row['description'];
          $this->u_role_create_date = $row['u_role_create_date'];
          $this->full_name = $row['full_name'];
          $this->email_address = $row['email_address'];
          $this->password = $row['password'];
          $this->mobile = $row['mobile'];
          $this->photo = $row['photo'];
          $this->update_date = $row['update_date'];
          $this->create_date = $row['u_create_date'];
        }
        
  }

  public function login_check() {
    // Create query
    $query = 'SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.email_address = :email_address AND u.password = :password';

    // Prepare statement
    $statement = $this->conn->prepare($query);

    // Bind ID
    $this->email_address = htmlspecialchars(strip_tags($this->email_address));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $statement->bindParam(':email_address', $this->email_address);
    $statement->bindParam(':password', $this->password);

    // Execute query
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if($row > 0){
      // Set properties
      $this->id = $row['u_id'];
      $this->user_role_id = $row['u_role_id'];
      $this->role_type = $row['role_type'];
      $this->description = $row['description'];
      $this->u_role_create_date = $row['u_role_create_date'];
      $this->full_name = $row['full_name'];
      $this->email_address = $row['email_address'];
      $this->password = $row['password'];
      $this->mobile = $row['mobile'];
      $this->photo = $row['photo'];
      $this->update_date = $row['update_date'];
      $this->create_date = $row['u_create_date'];
    }
    
}

  // Create UserRole
  public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET user_role_id = :user_role_id, full_name = :full_name, email_address = :email_address, password = :password, mobile = :mobile, photo = :photo';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_role_id = htmlspecialchars(strip_tags($this->user_role_id));
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email_address = htmlspecialchars(strip_tags($this->email_address));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->photo = htmlspecialchars(strip_tags($this->photo));


        // Bind data
        $stmt->bindParam(':user_role_id', $this->user_role_id);
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email_address', $this->email_address);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':mobile', $this->mobile);
        $stmt->bindParam(':photo', $this->photo);

        // Execute query
        if($stmt->execute()) {
          return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update USER_ROLE
  public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET user_role_id = :user_role_id, full_name = :full_name, password = :password, mobile = :mobile, photo = :photo, update_date = :update_date WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_role_id = htmlspecialchars(strip_tags($this->user_role_id));
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->photo = htmlspecialchars(strip_tags($this->photo));
        $this->id = htmlspecialchars(strip_tags($this->id));
        //Date for update not initialize.

        // Bind data
        $stmt->bindParam(':user_role_id', $this->user_role_id);
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':mobile', $this->mobile);
        $stmt->bindParam(':photo', $this->photo);
        $stmt->bindParam(':update_date', $this->update_date);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

  // Delete USER ROLE
  public function delete() {
        // delete query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }
}
  
?>