<?php
    class UserRole{
        //DB Stuff
    private $conn;
    private $table = 'user_role';

    // Department Properties
    public $id;
    public $role_type;
    public $create_date;
    public $description;

    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get All UserRole
    public function read(){
        // Create Query
        $query = 'SELECT * FROM '. $this->table;

        //Prepare Statement
        $statement = $this->conn->prepare($query);

        //Execute Query
        $statement->execute();

        return $statement;
    }

    
    // Get Single UserRole Data
    public function read_single() {
        // Create query
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ?';

        // Prepare statement
        $statement = $this->conn->prepare($query);

        // Bind ID
        $statement->bindParam(1, $this->id);

        // Execute query
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row > 0) {
          // Set properties
          $this->id = $row['id'];
          $this->role_type = $row['role_type'];
          $this->create_date = $row['create_date'];
          $this->description = $row['description'];
        }
      }

  // Create UserRole
  public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET role_type = :role_type, description = :description';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->role_type = htmlspecialchars(strip_tags($this->role_type));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Bind data
        $stmt->bindParam(':role_type', $this->role_type);
        $stmt->bindParam(':description', $this->description);

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
        $query = 'UPDATE ' . $this->table . ' SET role_type = :role_type, description = :description WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

       // Clean data
       $this->role_type = htmlspecialchars(strip_tags($this->role_type));
       $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

       // Bind data
       $stmt->bindParam(':role_type', $this->role_type);
       $stmt->bindParam(':description', $this->description);
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