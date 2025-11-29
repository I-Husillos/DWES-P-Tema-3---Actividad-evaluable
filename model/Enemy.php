<?php

class Enemy {
    private $id;
    private $name;
    private $description;
    private $isBoss;
    private $health;
    private $strength;
    private $defense;
    private $img;

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getIsBoss()
    {
        return $this->isBoss;
    }

    public function setIsBoss($isBoss)
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }


    public function loadById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM enemies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->isBoss = $data['isBoss'];
            $this->health = $data['health'];
            $this->strength = $data['strength'];
            $this->defense = $data['defense'];
            $this->img = $data['img'];
            return true;
        }
        return false;
    }


    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM enemies");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete()
    {
        if ($this->id) {
            $stmt = $this->db->prepare("DELETE FROM enemies WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        }
        return false;
    }



    function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare(
                "UPDATE enemies
                        SET name = :name,
                        description = :description,
                        isBoss = :isBoss,
                        health = :health,
                        strength = :strength,
                        defense = :defense,
                        img = :img
                        WHERE id = :id"
            );
            $stmt->bindParam(':id', $this->id);
        } else {
            $stmt = $this->db->prepare(
                "INSERT INTO enemies
                        (name, description, isBoss, health, strength, defense, img)
                VALUES (:name, :description, :isBoss, :health, :strength, :defense, :img)"
            );
        }
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':isBoss', $this->isBoss);
        $stmt->bindParam(':health', $this->health);
        $stmt->bindParam(':strength', $this->strength);
        $stmt->bindParam(':defense', $this->defense);
        $stmt->bindParam(':img', $this->img);

        return $stmt->execute();
    }

}