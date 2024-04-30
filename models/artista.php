<?php
class Artista
{
    // DB stuff
    private $conn;
    private $table = 'artista';

    // Artista Properties
    public $artista_id;
    public $artista_nombre;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Artistas
    public function read()
    {
        $query = 'SELECT artista_id, artista_nombre FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Artista
    public function read_single()
    {
        $query = 'SELECT artista_id, artista_nombre FROM ' . $this->table . ' WHERE artista_id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->artista_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->artista_nombre = $row['artista_nombre'];
    }

    // Create Artista
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (artista_nombre) VALUES (:artista_nombre)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->artista_nombre = htmlspecialchars(strip_tags($this->artista_nombre));

        // Bind data
        $stmt->bindParam(':artista_nombre', $this->artista_nombre);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Artista
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET artista_nombre = :artista_nombre WHERE artista_id = :artista_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->artista_nombre = htmlspecialchars(strip_tags($this->artista_nombre));
        $this->artista_id = htmlspecialchars(strip_tags($this->artista_id));

        // Bind data
        $stmt->bindParam(':artista_nombre', $this->artista_nombre);
        $stmt->bindParam(':artista_id', $this->artista_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Artista
    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE artista_id = :artista_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->artista_id = htmlspecialchars(strip_tags($this->artista_id));

        // Bind data
        $stmt->bindParam(':artista_id', $this->artista_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
