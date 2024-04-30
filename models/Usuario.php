<?php
class Usuario
{
    // DB stuff
    private $conn;
    private $table = 'usuario';
    // Usuario Properties
    public $usuario_id;
    public $usuario_nombre;
    public $contrasena;
    public $fecha_registro;
    public $correo_electronico;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Usuarios
    public function read()
    {

        $query = 'SELECT usuario_id, usuario_nombre, correo_electronico, fecha_registro
                     FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Usuario
    public function read_single()
    {

        $query = 'SELECT usuario_id, usuario_nombre, correo_electronico, fecha_registro
            FROM ' . $this->table . '
            WHERE usuario_id = ?
            LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->usuario_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->usuario_nombre = $row['usuario_nombre'];
        $this->fecha_registro = $row['fecha_registro'];
        $this->correo_electronico = $row['correo_electronico'];
    }

    // Create Usuario
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET usuario_nombre = :usuario_nombre, contrasena = :contrasena, fecha_registro = :fecha_registro, correo_electronico = :correo_electronico';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->usuario_nombre = htmlspecialchars(strip_tags($this->usuario_nombre));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->fecha_registro = htmlspecialchars(strip_tags($this->fecha_registro));
        $this->correo_electronico = htmlspecialchars(strip_tags($this->correo_electronico));

        // Bind data
        $stmt->bindParam(':usuario_nombre', $this->usuario_nombre);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':fecha_registro', $this->fecha_registro);
        $stmt->bindParam(':correo_electronico', $this->correo_electronico);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Usuario
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET usuario_nombre = :usuario_nombre, contrasena = :contrasena, fecha_registro = :fecha_registro, correo_electronico = :correo_electronico
                              WHERE usuario_id = :usuario_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->usuario_nombre = htmlspecialchars(strip_tags($this->usuario_nombre));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->fecha_registro = htmlspecialchars(strip_tags($this->fecha_registro));
        $this->correo_electronico = htmlspecialchars(strip_tags($this->correo_electronico));
        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));

        // Bind data
        $stmt->bindParam(':usuario_nombre', $this->usuario_nombre);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':fecha_registro', $this->fecha_registro);
        $stmt->bindParam(':correo_electronico', $this->correo_electronico);
        $stmt->bindParam(':usuario_id', $this->usuario_id);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE usuario_id = :usuario_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));

        // Bind data
        $stmt->bindParam(':usuario_id', $this->usuario_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
