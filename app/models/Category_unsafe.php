<?php

class Category extends Database
{
    private $name;

    function __construct($name = '') {
        parent::__construct();

        $this->name = $name;
    }

    function index() {

    }

    function show($id) {
        return $this->mysqli->query("SELECT * FROM CATEGORIES WHERE id = '" + $id + "'");
    }

    function create() {
        return $this->mysqli->query("INSERT INTO CATEGORIES (name) VALUES ('" + $this->name + "')");
    }

    function update($id) {
        return $this->mysqli->query("UPDATE CATEGORIES SET NAME = '" + $this->name + "' WHERE id = '" + $id + "'");
    }

    function delete($id) {
        return $this->mysqli->query("DELETE FROM CATEGORIES WHERE id = '" + $id + "'");
    }
}