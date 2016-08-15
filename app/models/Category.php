<?php

class Category extends Database
{
    private $name;

    function __construct($name = '')
    {
        parent::__construct();
        $this->name = $name;
    }

    function index()
    {
        return $this->connection->query("SELECT * FROM categories");
    }

    function show($id)
    {
        return $this->connection->query("SELECT * FROM categories WHERE id = " . $id);
    }

    function create()
    {
        return $this->connection->query("INSERT INTO categories (name) VALUES ('" . $this->name . "')");
    }

    function update($id)
    {
        return $this->connection->query("UPDATE categories SET NAME = '" . $this->name .  "' WHERE id = " . $id);
    }

    function delete($id)
    {
        return $this->connection->query("DELETE FROM categories WHERE id = " . $id);
    }
}
