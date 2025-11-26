<?php
class Character
{
    private $id;
    private $name;
    private $description;
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

    public function setId($id)
    {
        $this->id = $id;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare(
                "UPDATE characters 
                        SET name = :name, 
                        description = :description, 
                        health = :health, 
                        strength = :strength, 
                        defense = :defense, 
                        image = :image 
                        WHERE id = :id"
            );
            $stmt->bindParam(':id', $this->id);
        } else {
            $stmt = $this->db->prepare(
                "INSERT INTO characters 
                        (name, description, health, strength, defense, image) 
                VALUES (:name, :description, :health, :strength, :defense, :image)"
            );
        }
        $stmt->bindParam(':name', $this->getName());
        $stmt->bindParam(':description', $this->getDescription());
        $stmt->bindParam(':health', $this->getHealth());
        $stmt->bindParam(':strength', $this->getStrength());
        $stmt->bindParam(':defense', $this->getDefense());
        $stmt->bindParam(':image', $this->getImage());
        return $stmt->execute();
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
    
    public function loadById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM characters WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->health = $data['health'];
            $this->strength = $data['strength'];
            $this->defense = $data['defense'];
            $this->image = $data['image'];
            return true;
        }
        return false;
    }
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM characters");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
