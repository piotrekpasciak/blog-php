<?php

class Database
{
    private $dsn = 'mysql:host=mysql.hostinger.pl;dbname=u135470951_pp';
    private $user = 'u135470951_pp';
    private $password = 'zaq1@WSX';
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO($this->dsn, $this->user, $this->password, $this->options);
    }
}
