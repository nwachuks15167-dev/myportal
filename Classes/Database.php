<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "product_portal";

    private $conn;

    public function connect()
    {
        if ($this->conn === null) {

            $this->conn = mysqli_connect(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname
            );

            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }

        return $this->conn;
    }
}
?>