<?php

class Hero
{
    private $connect;
    private $table_name = "hero";

    public $id;
    public $name;
    public $info;
    public $dmg;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    function read()
    {
        $query = "SELECT id, name, info, dmg FROM " . $this->table_name;

        $stmt = $this->connect->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, info=:info, dmg=:dmg";

        $stmt = $this->connect->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->info = htmlspecialchars(strip_tags($this->info));
        $this->dmg = htmlspecialchars(strip_tags($this->dmg));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":info", $this->info);
        $stmt->bindParam(":dmg", $this->dmg);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $sql = "SELECT name, info, dmg FROM " . $this->table_name . " WHERE id = " . $this->id;
        if (empty($this->connect->query($sql)->fetch(PDO::FETCH_ASSOC))) {
            return false;
        }
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->info = htmlspecialchars(strip_tags($this->info));
        $this->dmg = htmlspecialchars(strip_tags($this->dmg));


        if (!empty($this->name) && !empty($this->info) && !empty($this->dmg)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, info = :info, dmg = :dmg WHERE id = :id";
        } elseif (!empty($this->name) && !empty($this->info)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, info = :info, dmg = dmg WHERE id = :id";
        } elseif (!empty($this->name)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, info = info, dmg = dmg WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET name = name, info = info, dmg = dmg WHERE id = :id";
        }

        $stmt = $this->connect->prepare($query);
        if (!empty($this->name)) {
            $stmt->bindParam(":name", $this->name);
        }
        if (!empty($this->info)) {
            $stmt->bindParam(":info", $this->info);
        }
        if (!empty($this->dmg)) {
            $stmt->bindParam(":dmg", $this->dmg);
        }
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $sql = "SELECT id, name, info, dmg FROM " . $this->table_name . " WHERE id = ?";

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