<?php

class User extends Database
{
    private $username;
    private $email;
    private $password;

    private $server = 'localhost';
    private $user = 'root';
    private $dbName = 'engineer';

    function __construct($username, $password, $email = '')
    {
        parent::__construct();

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function create() {
        return $this->connection->query("INSERT INTO users (username, email, password, role_id) VALUES
        ('" . $this->username . "','" . $this->email . "','" . $this->password . "',
        (SELECT ID FROM roles WHERE NAME = 'User'))");
    }

    public function login() {
        return $this->connection->query("SELECT users.ID, users.USERNAME, users.PASSWORD, users.EMAIL, roles.NAME AS ROLE FROM users INNER JOIN roles ON users.ROLE_ID = roles.ID WHERE username='" . $this->username .  "' AND password='" . $this->password . "'");
    }

    public function account_blocked() {
        return $this->connection->query("SELECT fail_login_count, fail_login_date FROM users WHERE username = " . $this->username . " AND fail_login_date = CURDATE() AND fail_login_count >= 10");
    }

    public function failure_login() {
        return $this->connection->query("UPDATE users SET fail_login_count = CASE WHEN fail_login_date = CURDATE() THEN fail_login_count + 1 ELSE fail_login_count = 1 END, fail_login_date = CURDATE() WHERE username = " . $this->username);
    }

    public function index() {
        return $this->connection->query("SELECT * FROM users");
    }
}



