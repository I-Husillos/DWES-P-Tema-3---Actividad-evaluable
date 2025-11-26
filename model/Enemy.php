<?php

class Enemy {
    private $id;
    private $name;
    private $description;
    private $isBoss;
    private $health;
    private $strength;
    private $defense;
    private $image;

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsBoss()
    {
        return $this->isBoss;
    }

    public function setIsBoss($isBoss): self
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function setDefense($defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db): self
    {
        $this->db = $db;

        return $this;
    }

    public function create_enemy()
    {
        $stmt = $this->db->prepare(
            "INSERT INTO enemies (name, description, isBoss, health, strength, defense, image) 
            VALUES (:name, :description, :isBoss, :health, :strength, :defense, :image)"
        );
        $stmt->bindParam(':name', $this->getName());
        $stmt->bindParam(':description', $this->getDescription());
        $stmt->bindParam(':isBoss', $this->getIsBoss());
        $stmt->bindParam(':health', $this->getHealth());
        $stmt->bindParam(':strength', $this->getHealth());
        $stmt->bindParam(':defense', $this->getHealth());
        $stmt->bindParam(':image', $this->getImage());
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM enemies");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare(
                "UPDATE enemies
                        SET name = :name,
                        isBoss = :isBoss,
                        health = :health,
                        strength = :strength,
                        defense = :defense,
                        image = :image
                        WHERE id = :id"
            );
            $stmt->bindParam(':id', $this->id);
        } else {
            $stmt = $this->db->prepare(
                "INSERT INTO enemies
                        (name, isBoss, health, strength, defense, image)
                VALUES (:name, :isBoss, :health, :strength, :defense, :image)"
            );
        }
        
        $stmt->bindParam(':name', $this->getName());
        $stmt->bindParam(':isBoss', $this->getIsBoss());
        $stmt->bindParam(':health', $this->getHealth());
        $stmt->bindParam(':strength', $this->getStrength());
        $stmt->bindParam(':defense', $this->getDefense());
        $stmt->bindParam(':image', $this->getImage());
        return $stmt->execute();
    }

    public function delete()
    {
        if(!$this->id) {
            $stmt = $this->db->prepare("DELETE FROM enemies WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        }
        return false;
    }

}