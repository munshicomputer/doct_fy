<?php
    class Rating{
        //DB Stuff
    private $conn;
    private $table = 'rating_table';
    private $joinUserTable = 'users_table';
    private $joinDoctorTable = 'doctor_table';

    // Rating Properties
    public $id;
    //Users Table Property
    public $user_id;
    public $user_full_name;
    public $user_photo;
    //Doctor table Property
    public $doctor_id;
    public $doctor_name;
    public $isActive;
    public $designation;
    public $bmdc_reg;
    //Rating Table
    public $rating;
    public $rating_comment;
    public $rating_like;
    public $rating_dislike;
    public $reference_photo;
    public $create_date;
  


    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get All UserRole
    public function read(){
        // Create Query
        // $query = 'SELECT u.id as u_id, u.*, ur.* FROM '. $this->table .' as u JOIN '.$this->joinTable.' as ur on ur.id = u.user_role_id';

        //SELECT dr.id as d_id, dr.user_id, u.full_name as user_full_name, u.photo as user_photo, dr.department_id, dept.dept_name, dr.doctor_name, dr.isActive, dr.designation, dr.bmdc_reg, dr.phone_personal, dr.doctor_photo, dr.v_card_photo, dr.create_date, dr.update_date, dr.active_date FROM doctor_table as dr JOIN users_table u on u.id = dr.user_id JOIN department_table dept on dept.id = dr.department_id
        $query = 'SELECT ra.id as id, ra.user_id, u.full_name, u.photo as user_photo, ra.doctor_id, dr.doctor_name, dr.isActive, dr.designation, dr.bmdc_reg, ra.rating, ra.rating_comment, ra.rating_like, ra.rating_dislike, ra.reference_photo, ra.create_date FROM '.$this->table.' as ra JOIN '.$this->joinUserTable.' u on u.id = ra.user_id JOIN '.$this->joinDoctorTable.' dr on dr.id = ra.doctor_id';

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
        $query = 'SELECT ra.id as id, ra.user_id, u.full_name, u.photo as user_photo, ra.doctor_id, dr.doctor_name, dr.isActive, dr.designation, dr.bmdc_reg, ra.rating, ra.rating_comment, ra.rating_like, ra.rating_dislike, ra.reference_photo, ra.create_date FROM '.$this->table.' as ra JOIN '.$this->joinUserTable.' u on u.id = ra.user_id JOIN '.$this->joinDoctorTable.' dr on dr.id = ra.doctor_id WHERE ra.id = ?';

        // Prepare statement
        $statement = $this->conn->prepare($query);

        // Bind ID
        $statement->bindParam(1, $this->id);

        // Execute query
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row>0){
          // Set properties
          $this->id = $row['id'];
          $this->user_id = $row['user_id'];
          $this->user_full_name = $row['full_name'];
          $this->user_photo = $row['user_photo'];
          $this->doctor_id = $row['doctor_id'];
          $this->doctor_name = $row['doctor_name'];
          $this->isActive = $row['isActive'];
          $this->designation = $row['designation'];
          $this->bmdc_reg = $row['bmdc_reg'];
          $this->rating = $row['rating'];
          $this->rating_comment = $row['rating_comment'];
          $this->rating_like = $row['rating_like'];
          $this->rating_dislike = $row['rating_dislike'];
          $this->create_date = $row['create_date'];
          $this->reference_photo = $row['reference_photo'];
        } 
  }

  // Create UserRole
  public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET user_id = :user_id, doctor_id = :doctor_id, rating = :rating, rating_comment = :rating_comment, reference_photo = :reference_photo';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->rating_comment = htmlspecialchars(strip_tags($this->rating_comment));
        $this->reference_photo = htmlspecialchars(strip_tags($this->reference_photo));



        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':doctor_id', $this->doctor_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':rating_comment', $this->rating_comment);
        $stmt->bindParam(':reference_photo',$this->reference_photo);



        // Execute query
        if($stmt->execute()) {
          return true;
        }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  public function updatelikeDislike()
  {
    // Create query
    $query = 'UPDATE ' . $this->table . ' SET rating_like = :rating_like, rating_dislike = :rating_dislike WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->rating_like = htmlspecialchars(strip_tags($this->rating_like));
    $this->rating_dislike = htmlspecialchars(strip_tags($this->rating_dislike));
    $this->id = htmlspecialchars(strip_tags($this->id));
    //Date for update not initialize.

    // Bind data
    $stmt->bindParam(':rating_dislike', $this->rating_dislike);
    $stmt->bindParam(':rating_like', $this->rating_like);
    $stmt->bindParam(':id', $this->id);

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
        $query = 'UPDATE ' . $this->table . ' SET user_id = :user_id, doctor_id = :doctor_id, rating = :rating, rating_comment = :rating_comment, reference_photo = :reference_photo WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->rating_comment = htmlspecialchars(strip_tags($this->rating_comment));
        $this->reference_photo = htmlspecialchars(strip_tags($this->reference_photo));
        $this->id = htmlspecialchars(strip_tags($this->id));
        //Date for update not initialize.

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':doctor_id', $this->doctor_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':rating_comment', $this->rating_comment);
        $stmt->bindParam(':reference_photo',$this->reference_photo);
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