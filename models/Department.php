<?php
    class Department{
        //DB Stuff
    private $conn;
    private $table = 'department_table';

    // Department Properties
    public $id;
    public $dept_name;
    public $create_date;
    public $description;

    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get All Department
    public function read(){
        // Create Query
        $query = 'SELECT * FROM '. $this->table;

        //Prepare Statement
        $statement = $this->conn->prepare($query);

        //Execute Query
        $statement->execute();

        return $statement;
    }

    
    // Get Single Post
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
          $this->create_date = $row['create_date'];
          $this->id = $row['id'];
          $this->dept_name = $row['dept_name'];
          $this->description = $row['description']; 
        }
  }

  // Create Post
  public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET dept_name = :dept_name, description = :description';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->dept_name = htmlspecialchars(strip_tags($this->dept_name));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Bind data
        $stmt->bindParam(':dept_name', $this->dept_name);
        $stmt->bindParam(':description', $this->description);

        // Execute query
        if($stmt->execute()) {
          return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update Post
  public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET dept_name = :dept_name, description = :description WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

       // Clean data
       $this->dept_name = htmlspecialchars(strip_tags($this->dept_name));
       $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

       // Bind data
       $stmt->bindParam(':dept_name', $this->dept_name);
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

  // Delete Post
  public function delete() {
        // Create query
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