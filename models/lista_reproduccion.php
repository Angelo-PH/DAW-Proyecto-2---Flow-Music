<?php
class ListaReproduccion
{
    // DB stuff
    private $conn;
    private $table = 'lista_reproduccion';

    // ListaReproduccion Properties
    public $lista_id;
    public $lista_nombre;
    public $usuario_id;
    public $fecha_creacion;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get ListasReproduccion
    public function read()
    {
        $query = 'SELECT lista_id, lista_nombre, usuario_id, fecha_creacion
                     FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single ListaReproduccion
    public function read_single()
    {
        $query = 'SELECT lista_id, lista_nombre, usuario_id, fecha_creacion
            FROM ' . $this->table . '
            WHERE lista_id = ?
            LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->lista_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->lista_nombre = $row['lista_nombre'];
        $this->usuario_id = $row['usuario_id'];
        $this->fecha_creacion = $row['fecha_creacion'];
    }

    // Create ListaReproduccion
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' (lista_nombre, usuario_id, fecha_creacion)
                  VALUES (:lista_nombre, :usuario_id, :fecha_creacion)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->lista_nombre = htmlspecialchars(strip_tags($this->lista_nombre));
        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));
        $this->fecha_creacion = htmlspecialchars(strip_tags($this->fecha_creacion));

        // Bind data
        $stmt->bindParam(':lista_nombre', $this->lista_nombre);
        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update ListaReproduccion
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                  SET lista_nombre = :lista_nombre, usuario_id = :usuario_id, fecha_creacion = :fecha_creacion
                  WHERE lista_id = :lista_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->lista_nombre = htmlspecialchars(strip_tags($this->lista_nombre));
        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));
        $this->fecha_creacion = htmlspecialchars(strip_tags($this->fecha_creacion));
        $this->lista_id = htmlspecialchars(strip_tags($this->lista_id));

        // Bind data
        $stmt->bindParam(':lista_nombre', $this->lista_nombre);
        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion);
        $stmt->bindParam(':lista_id', $this->lista_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete ListaReproduccion
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE lista_id = :lista_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->lista_id = htmlspecialchars(strip_tags($this->lista_id));

        // Bind data
        $stmt->bindParam(':lista_id', $this->lista_id);

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