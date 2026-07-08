<?php

class User
{
    private $conn;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Register User
    public function register($username, $email, $password, $phone, $age, $profile_pic)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users
                (username, email, password, phone, age, profile_pic)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $password, $phone, $age, $profile_pic);

        return mysqli_stmt_execute($stmt);
    }

    // Login User
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }


}
