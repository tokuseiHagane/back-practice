<?php

class Mus
{
    private $connect;
    private $table_name = "mus";

    public $id;
    public $name;
    public $autors;
    public $time;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    function read()
    {
        $query = "SELECT id, name, autors, time FROM " . $this->table_name;

        $stmt = $this->connect->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, autors=:autors, time=:time";

        $stmt = $this->connect->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->autors = htmlspecialchars(strip_tags($this->autors));
        $this->time = htmlspecialchars(strip_tags($this->time));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":autors", $this->autors);
        $stmt->bindParam(":time", $this->time);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $sql = "SELECT name, description FROM " . $this->table_name . " WHERE id = " . $this->id;
        if (empty($this->connect->query($sql)->fetch(PDO::FETCH_ASSOC))) {
            return false;
        }
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->autors = htmlspecialchars(strip_tags($this->autors));
        $this->time = htmlspecialchars(strip_tags($this->time));


        if (!empty($this->name) && !empty($this->autors) && !empty($this->time)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, autors = :autors, time = :time WHERE id = :id";
        } elseif (!empty($this->name) && !empty($this->autors)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, autors = :autors, time = time WHERE id = :id";
        } elseif (!empty($this->name)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, autors = autors, time = time WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET name = name, autors = autors, time = time WHERE id = :id";
        }

        $stmt = $this->connect->prepare($query);
        if (!empty($this->name)) {
            $stmt->bindParam(":name", $this->name);
        }
        if (!empty($this->autors)) {
            $stmt->bindParam(":autors", $this->autors);
        }
        if (!empty($this->time)) {
            $stmt->bindParam(":time", $this->time);
        }
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $sql = "SELECT id, name, autors, time FROM " . $this->table_name . " WHERE id = ?";

        if ($sql == false)
            return false;
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}