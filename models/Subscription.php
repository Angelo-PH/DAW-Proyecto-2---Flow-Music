<?php
class Subscription
{
    // DB stuff
    private $conn;
    private $table = 'subscription';
    // subscription Properties
    public $subscription_id;
    public $user_id;
    public $subscription_type;
    public $start_date;
    public $end_date;
    public $status;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get subscription
    public function read()
    {
        $query = 'SELECT *
                     FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single subscription
    public function read_single()
    {
        $query = 'SELECT *
            FROM ' . $this->table . '
            WHERE user_id = ?
            LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->user_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->subscription_id = $row['subscription_id'];
        $this->user_id = $row['user_id'];
        $this->subscription_type = $row['subscription_type'];
        $this->start_date = $row['start_date'];
        $this->end_date = $row['end_date'];
        $this->status = $row['status'];
    }

    // Create Usuario
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET user_id  = :user_id , subscription_type = :subscription_type, start_date = :start_date, end_date = :end_date, status = :status';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->subscription_type = htmlspecialchars(strip_tags($this->subscription_type));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':subscription_type', $this->subscription_type);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':status', $this->status);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Subscription
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET subscription_type = :subscription_type, start_date = :start_date, end_date = :end_date, status = :status
                              WHERE user_id  = :user_id ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->subscription_type = htmlspecialchars(strip_tags($this->subscription_type));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':subscription_type', $this->subscription_type);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':status', $this->status);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Usuario
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE subscription_id = :subscription_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->subscription_id  = htmlspecialchars(strip_tags($this->subscription_id));

        // Bind data
        $stmt->bindParam(':subscription_id', $this->subscription_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
