<?php

class Database extends PDO
{
    public function __construct(string $dbname, string $host = "localhost", string $username = "root", string $password = "")
    {
        try {
            parent::__construct("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->setAttribute(parent::ATTR_ERRMODE, parent::ERRMODE_EXCEPTION);
            echo "<script>console.log('Connected to ${dbname} database!')</script>";
        } catch (PDOException $e) {
            die("Error Connection " . $e->getMessage() . "<br>On line " . $e->getLine());
        }
    }
}

?>
