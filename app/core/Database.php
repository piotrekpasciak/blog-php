<?php

class Database
{
    private $server = 'mysql.hostinger.pl';
    private $user = 'u135470951_pp';
    private $password = 'zaq1@WSX';
    private $dbName = 'u135470951_pp';

    protected $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->server, $this->user, $this->password, $this->dbName);

        if ($this->connection->connect_errno)
        {
            $this->connection = false;
        }
    }
}
