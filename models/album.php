<?php
class Album
{
    // DB stuff
    private $conn;
    private $table = 'album';

    // Album Properties
    public $album_id;
    public $album_nom;
    public $año_lanzamiento;
    public $id_autor;
    public $id_genero;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Albums
    public function read()
    {
        // Create query
        $query = 'SELECT album_id, album_nom, año_lanzamiento, id_autor, id_genero FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Album
    public function read_single()
    {
        // Create query
        $query = 'SELECT album_id, album_nom, año_lanzamiento, id_autor, id_genero FROM ' . $this->table . ' WHERE album_id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->album_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->album_nom = $row['album_nom'];
        $this->año_lanzamiento = $row['año_lanzamiento'];
        $this->id_autor = $row['id_autor'];
        $this->id_genero = $row['id_genero'];
    }

    // Create Album
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' (album_nom, año_lanzamiento, id_autor, id_genero) VALUES (:album_nom, :año_lanzamiento, :id_autor, :id_genero)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->album_nom = htmlspecialchars(strip_tags($this->album_nom));
        $this->año_lanzamiento = htmlspecialchars(strip_tags($this->año_lanzamiento));
        $this->id_autor = htmlspecialchars(strip_tags($this->id_autor));
        $this->id_genero = htmlspecialchars(strip_tags($this->id_genero));

        // Bind data
        $stmt->bindParam(':album_nom', $this->album_nom);
        $stmt->bindParam(':año_lanzamiento', $this->año_lanzamiento);
        $stmt->bindParam(':id_autor', $this->id_autor);
        $stmt->bindParam(':id_genero', $this->id_genero);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Album
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET album_nom = :album_nom, año_lanzamiento = :año_lanzamiento, id_autor = :id_autor, id_genero = :id_genero WHERE album_id = :album_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->album_nom = htmlspecialchars(strip_tags($this->album_nom));
        $this->año_lanzamiento = htmlspecialchars(strip_tags($this->año_lanzamiento));
        $this->id_autor = htmlspecialchars(strip_tags($this->id_autor));
        $this->id_genero = htmlspecialchars(strip_tags($this->id_genero));
        $this->album_id = htmlspecialchars(strip_tags($this->album_id));

        // Bind data
        $stmt->bindParam(':album_nom', $this->album_nom);
        $stmt->bindParam(':año_lanzamiento', $this->año_lanzamiento);
        $stmt->bindParam(':id_autor', $this->id_autor);
        $stmt->bindParam(':id_genero', $this->id_genero);
        $stmt->bindParam(':album_id', $this->album_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Album
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE album_id = :album_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->album_id = htmlspecialchars(strip_tags($this->album_id));

        // Bind data
        $stmt->bindParam(':album_id', $this->album_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
