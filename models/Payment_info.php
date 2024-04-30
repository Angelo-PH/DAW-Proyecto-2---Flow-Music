<?php
class Payment_info
{
    // DB stuff
    private $conn;
    private $table = 'payment_info';
    // Payment_info Properties
    public $payment_id;
    public $user_id;
    public $cardholder_name;
    public $card_number;
    public $expiry_month;
    public $expiry_year;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Payment_infos
    public function read()
    {
        $query = 'SELECT payment_id, user_id, cardholder_name, card_number, expiry_month, expiry_year, created_at
                     FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Payment_info
    public function read_single()
    {
        $query = 'SELECT payment_id, user_id, cardholder_name, card_number, expiry_month, expiry_year, created_at
            FROM ' . $this->table . '
            WHERE payment_id = ?
            LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->payment_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->user_id = $row['user_id'];
        $this->cardholder_name = $row['cardholder_name'];
        $this->card_number = $row['card_number'];
        $this->expiry_month = $row['expiry_month'];
        $this->expiry_year = $row['expiry_year'];
        $this->created_at = $row['created_at'];
    }

    // Create Payment_info
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET user_id = :user_id, cardholder_name = :cardholder_name, card_number = :card_number, expiry_month = :expiry_month, expiry_year = :expiry_year';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->cardholder_name = htmlspecialchars(strip_tags($this->cardholder_name));
        $this->card_number = htmlspecialchars(strip_tags($this->card_number));
        $this->expiry_month = htmlspecialchars(strip_tags($this->expiry_month));
        $this->expiry_year = htmlspecialchars(strip_tags($this->expiry_year));

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':cardholder_name', $this->cardholder_name);
        $stmt->bindParam(':card_number', $this->card_number);
        $stmt->bindParam(':expiry_month', $this->expiry_month);
        $stmt->bindParam(':expiry_year', $this->expiry_year);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Payment_info
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET user_id = :user_id, cardholder_name = :cardholder_name, card_number = :card_number, expiry_month = :expiry_month, expiry_year = :expiry_year
                              WHERE payment_id = :payment_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->cardholder_name = htmlspecialchars(strip_tags($this->cardholder_name));
        $this->card_number = htmlspecialchars(strip_tags($this->card_number));
        $this->expiry_month = htmlspecialchars(strip_tags($this->expiry_month));
        $this->expiry_year = htmlspecialchars(strip_tags($this->expiry_year));
        $this->payment_id = htmlspecialchars(strip_tags($this->payment_id));

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':cardholder_name', $this->cardholder_name);
        $stmt->bindParam(':card_number', $this->card_number);
        $stmt->bindParam(':expiry_month', $this->expiry_month);
        $stmt->bindParam(':expiry_year', $this->expiry_year);
        $stmt->bindParam(':payment_id', $this->payment_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Payment_info
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE payment_id = :payment_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->payment_id = htmlspecialchars(strip_tags($this->payment_id));

        // Bind data
        $stmt->bindParam(':payment_id', $this->payment_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>