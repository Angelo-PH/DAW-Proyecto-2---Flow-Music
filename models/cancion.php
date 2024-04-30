<?php
class Cancion
{
    // DB stuff
    private $conn;
    private $table = 'cancion';

    // Cancion Properties
    public $cancion_id;
    public $cancion_nombre;
    public $src;
    public $id_album;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Canciones
    public function read()
    {
        $query = 'SELECT cancion_id, cancion_nombre, src, id_album
                  FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Cancion
    public function read_single()
    {
        $query = 'SELECT cancion_id, cancion_nombre, src, id_album
                  FROM ' . $this->table . '
                  WHERE cancion_id = ?
                  LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->cancion_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->cancion_nombre = $row['cancion_nombre'];
        $this->src = $row['src'];
        $this->id_album = $row['id_album'];
    }

    // Create Cancion
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' (cancion_nombre, src, id_album)
                  VALUES (:cancion_nombre, :src, :id_album)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->cancion_nombre = htmlspecialchars(strip_tags($this->cancion_nombre));
        $this->src = htmlspecialchars(strip_tags($this->src));
        $this->id_album = htmlspecialchars(strip_tags($this->id_album));

        // Bind data
        $stmt->bindParam(':cancion_nombre', $this->cancion_nombre);
        $stmt->bindParam(':src', $this->src);
        $stmt->bindParam(':id_album', $this->id_album);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Cancion
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                  SET cancion_nombre = :cancion_nombre, src = :src, id_album = :id_album
                  WHERE cancion_id = :cancion_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->cancion_nombre = htmlspecialchars(strip_tags($this->cancion_nombre));
        $this->src = htmlspecialchars(strip_tags($this->src));
        $this->id_album = htmlspecialchars(strip_tags($this->id_album));
        $this->cancion_id = htmlspecialchars(strip_tags($this->cancion_id));

        // Bind data
        $stmt->bindParam(':cancion_nombre', $this->cancion_nombre);
        $stmt->bindParam(':src', $this->src);
        $stmt->bindParam(':id_album', $this->id_album);
        $stmt->bindParam(':cancion_id', $this->cancion_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Cancion
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE cancion_id = :cancion_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->cancion_id = htmlspecialchars(strip_tags($this->cancion_id));

        // Bind data
        $stmt->bindParam(':cancion_id', $this->cancion_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
