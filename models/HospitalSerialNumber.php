<?php
    class HospitalSerialNumber{
        //DB Stuff
    private $conn;
    private $table = 'doctor_hp_serial_numbers';
    private $joinTable = 'doctor_table';

    // Hospital Serial Number Properties
    public $id;
    public $doctor_id;
    public $doctor_name;
    public $hospital_name;
    public $serial_phone;
    public $hospital_address;
    public $create_date;
    
    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get All UserRole
    public function read(){
        // Create Query
        // $query = 'SELECT u.id as u_id, u.*, ur.* FROM '. $this->table .' as u JOIN '.$this->joinTable.' as ur on ur.id = u.user_role_id';

        //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1

        $query = 'SELECT dr.id, dr.doctor_id, d.doctor_name, dr.hospital_name, dr.serial_phone, dr.hospital_address, dr.create_date FROM '.$this->table.' as dr JOIN '.$this->joinTable.' as d on d.id = dr.doctor_id';

        //Prepare Statement
        $statement = $this->conn->prepare($query);

        //Execute Query
        $statement->execute();

        return $statement;
    }

    public function read_by_doctor_id(){
      // Create Query
       $query = 'SELECT dr.id, dr.doctor_id, d.doctor_name, dr.hospital_name, dr.serial_phone, dr.hospital_address, dr.create_date FROM '.$this->table.' as dr JOIN '.$this->joinTable.' as d on d.id = dr.doctor_id Where dr.doctor_id = :doctor_id';

      //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1
      
      //Prepare Statement
      $statement = $this->conn->prepare($query);

      $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
      $statement->bindParam(':doctor_id', $this->doctor_id);

      //Execute Query
      $statement->execute();

      return $statement;
  }

    // Get Single UserRole Data
    public function read_single() {
        // Create query
        $query = 'SELECT dr.id, dr.doctor_id, d.doctor_name, dr.hospital_name, dr.serial_phone, dr.hospital_address, dr.create_date FROM '.$this->table.' as dr JOIN '.$this->joinTable.' as d on d.id = dr.doctor_id WHERE dr.id = ?';

        // Prepare statement
        $statement = $this->conn->prepare($query);

        // Bind ID
        $statement->bindParam(1, $this->id);

        // Execute query
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row > 0){
          // Set properties
          $this->id = $row['id'];
          $this->doctor_id = $row['doctor_id'];
          $this->doctor_name = $row['doctor_name'];
          $this->hospital_name = $row['hospital_name'];
          $this->serial_phone = $row['serial_phone'];
          $this->hospital_address = $row['hospital_address'];
          $this->create_date = $row['create_date'];
        }
  }

    // Create UserRole
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET doctor_id = :doctor_id, hospital_name = :hospital_name, serial_phone = :serial_phone, hospital_address = :hospital_address';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
        $this->hospital_name = htmlspecialchars(strip_tags($this->hospital_name));
        $this->serial_phone = htmlspecialchars(strip_tags($this->serial_phone));
        $this->hospital_address = htmlspecialchars(strip_tags($this->hospital_address));


        // Bind data
        $stmt->bindParam(':doctor_id', $this->doctor_id);
        $stmt->bindParam(':hospital_name', $this->hospital_name);
        $stmt->bindParam(':serial_phone', $this->serial_phone);
        $stmt->bindParam(':hospital_address', $this->hospital_address);

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
        $query = 'UPDATE ' . $this->table . ' SET doctor_id = :doctor_id, hospital_name = :hospital_name, serial_phone = :serial_phone, hospital_address = :hospital_address WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
        $this->hospital_name = htmlspecialchars(strip_tags($this->hospital_name));
        $this->serial_phone = htmlspecialchars(strip_tags($this->serial_phone));
        $this->hospital_address = htmlspecialchars(strip_tags($this->hospital_address));
        $this->id = htmlspecialchars(strip_tags($this->id));
        //Date for update not initialize.

        // Bind data
        $stmt->bindParam(':doctor_id', $this->doctor_id);
        $stmt->bindParam(':hospital_name', $this->hospital_name);
        $stmt->bindParam(':serial_phone', $this->serial_phone);
        $stmt->bindParam(':hospital_address', $this->hospital_address);
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

  public function deletebydoctorid() {
    // delete query
    $query = 'DELETE FROM ' . $this->table . ' WHERE doctor_id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->doctor_id));

    // Bind data
    $stmt->bindParam(':id', $this->doctor_id);

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