<?php
    class Doctors{
        //DB Stuff
    private $conn;
    private $table = 'doctor_table';
    private $joinUserTable = 'users_table';
    private $joinDepartmentTable = 'department_table';

    // Doctor Properties
    public $id;
    //Users Table Property
    public $user_id;
    public $user_full_name;
    public $user_photo;
    //Department table Property
    public $department_id;
    public $dept_name;
    //Doctors table Property
    public $doctor_name;
    public $isActive;
    public $designation;
    public $bmdc_reg;
    public $phone_personal;
    public $doctor_photo;
    public $v_card_photo;
    public $create_date;
    public $update_date;
    public $active_date;
    
    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get All UserRole
    public function read(){
        // Create Query
        // $query = 'SELECT u.id as u_id, u.*, ur.* FROM '. $this->table .' as u JOIN '.$this->joinTable.' as ur on ur.id = u.user_role_id';

        //SELECT dr.id as d_id, dr.user_id, u.full_name as user_full_name, u.photo as user_photo, dr.department_id, dept.dept_name, dr.doctor_name, dr.isActive, dr.designation, dr.bmdc_reg, dr.phone_personal, dr.doctor_photo, dr.v_card_photo, dr.create_date, dr.update_date, dr.active_date FROM doctor_table as dr JOIN users_table u on u.id = dr.user_id JOIN department_table dept on dept.id = dr.department_id
        $query = 'SELECT dr.id as d_id, dr.user_id, u.full_name as user_full_name, u.photo as user_photo, dr.department_id, dept.dept_name, dr.doctor_name, dr.isActive, dr.designation, dr.bmdc_reg, dr.phone_personal, dr.doctor_photo, dr.v_card_photo, dr.create_date, dr.update_date, dr.active_date FROM '.$this->table.' as dr JOIN '.$this->joinUserTable.' u on u.id = dr.user_id JOIN '.$this->joinDepartmentTable.' dept on dept.id = dr.department_id';

        //Prepare Statement
        $statement = $this->conn->prepare($query);

        //Execute Query
        $statement->execute();

        return $statement;
    }

    // public function check_exist(){
    //   // Create Query
    //    $query = 'SELECT * FROM '. $this->table .' where email_address = :email_address';

    //   //SELECT u.id as u_id, u.user_role_id as u_role_id, u.full_name, u.email_address, u.password,u.mobile,u.photo,u.create_date as u_create_date, u.update_date, ur.role_type, ur.description, ur.create_date as u_role_create_date FROM users_table as u JOIN user_role as ur on ur.id = u.user_role_id WHERE u.id = 1
      
    //   //Prepare Statement
    //   $statement = $this->conn->prepare($query);

    //   $this->email_address = htmlspecialchars(strip_tags($this->email_address));
    //   $statement->bindParam(':email_address', $this->email_address);

    //   //Execute Query
    //   $statement->execute();

    //   return $statement;
    // }

    // Get Single UserRole Data
    public function read_single() {
        // Create query
        $query = 'SELECT dr.id as d_id, dr.user_id, u.full_name as user_full_name, u.photo as user_photo, dr.department_id, dept.dept_name, dr.doctor_name, dr.isActive, dr.designation, dr.bmdc_reg, dr.phone_personal, dr.doctor_photo, dr.v_card_photo, dr.create_date, dr.update_date, dr.active_date FROM '.$this->table.' as dr JOIN '.$this->joinUserTable.' u on u.id = dr.user_id JOIN '.$this->joinDepartmentTable.' dept on dept.id = dr.department_id WHERE dr.id = ?';

        // Prepare statement
        $statement = $this->conn->prepare($query);

        // Bind ID
        $statement->bindParam(1, $this->id);

        // Execute query
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row>0){
          // Set properties
          $this->id = $row['d_id'];
          $this->user_id = $row['user_id'];
          $this->user_full_name = $row['user_full_name'];
          $this->user_photo = $row['user_photo'];
          $this->department_id = $row['department_id'];
          $this->dept_name = $row['dept_name'];
          $this->doctor_name = $row['doctor_name'];
          $this->isActive = $row['isActive'];
          $this->designation = $row['designation'];
          $this->bmdc_reg = $row['bmdc_reg'];
          $this->phone_personal = $row['phone_personal'];
          $this->doctor_photo = $row['doctor_photo'];
          $this->v_card_photo = $row['v_card_photo'];
          $this->update_date = $row['update_date'];
          $this->create_date = $row['create_date'];
          $this->active_date = $row['active_date'];
        } 
  }

  // Create UserRole
  public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET user_id = :user_id, department_id = :department_id, doctor_name = :doctor_name, designation = :designation, bmdc_reg = :bmdc_reg, phone_personal = :phone_personal, doctor_photo = :doctor_photo, v_card_photo = :v_card_photo';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->department_id = htmlspecialchars(strip_tags($this->department_id));
        $this->doctor_name = htmlspecialchars(strip_tags($this->doctor_name));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->bmdc_reg = htmlspecialchars(strip_tags($this->bmdc_reg));
        $this->phone_personal = htmlspecialchars(strip_tags($this->phone_personal));
        $this->doctor_photo = htmlspecialchars(strip_tags($this->doctor_photo));
        $this->v_card_photo = htmlspecialchars(strip_tags($this->v_card_photo));



        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':department_id', $this->department_id);
        $stmt->bindParam(':doctor_name', $this->doctor_name);
        $stmt->bindParam(':designation', $this->designation);
        $stmt->bindParam(':bmdc_reg',$this->bmdc_reg);
        $stmt->bindParam(':phone_personal', $this->phone_personal);
        $stmt->bindParam(':doctor_photo', $this->doctor_photo);
        $stmt->bindParam(':v_card_photo', $this->v_card_photo);



        // Execute query
        if($stmt->execute()) {
          // $result = $stmt->fetch(PDO::FETCH_ASSOC);
          // $this->id = $result['id'];

          // $this->conn->commit();
          $this->id = $this->conn->lastInsertId();

          // $temp = $stmt->fetch(PDO::FETCH_ASSOC);
          // $this->id = $temp["id"];

          return true;
    }
        $stmt->

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update USER_ROLE
  public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET user_id = :user_id, department_id = :department_id, doctor_name = :doctor_name, isActive = :isActive, designation = :designation, bmdc_reg = :bmdc_reg, phone_personal = :phone_personal, doctor_photo = :doctor_photo, v_card_photo = :v_card_photo, update_date = :update_date WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->department_id = htmlspecialchars(strip_tags($this->department_id));
        $this->doctor_name = htmlspecialchars(strip_tags($this->doctor_name));
        $this->isActive = htmlspecialchars(strip_tags($this->isActive));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->bmdc_reg = htmlspecialchars(strip_tags($this->bmdc_reg));
        $this->update_date = htmlspecialchars(strip_tags($this->update_date));
        $this->phone_personal = htmlspecialchars(strip_tags($this->phone_personal));
        $this->doctor_photo = htmlspecialchars(strip_tags($this->doctor_photo));
        $this->v_card_photo = htmlspecialchars(strip_tags($this->v_card_photo));
        $this->id = htmlspecialchars(strip_tags($this->id));
        //Date for update not initialize.

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':department_id', $this->department_id);
        $stmt->bindParam(':doctor_name', $this->doctor_name);
        $stmt->bindParam(':isActive', $this->isActive);
        $stmt->bindParam(':designation', $this->designation);
        $stmt->bindParam(':bmdc_reg', $this->bmdc_reg);
        $stmt->bindParam(':phone_personal', $this->phone_personal);
        $stmt->bindParam(':doctor_photo', $this->doctor_photo);
        $stmt->bindParam(':v_card_photo', $this->v_card_photo);
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