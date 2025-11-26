<?php

class Item {
    private $id;
    private $name;
    private $description;
    private $type;
    private $effect;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getEffect()
    {
        return $this->effect;
    }

    public function setEffect($effect): self
    {
        $this->effect = $effect;
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

    function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare(
                "UPDATE items
                        SET name = :name,
                        description = :description,
                        type = :type,
                        effect = :effect,
                        image = :image
                        WHERE id = :id"
            );
            $stmt->bindParam(':id', $this->id);
        } else {
            $stmt = $this->db->prepare(
                "INSERT INTO items
                        (name, description, type, effect, image)
                VALUES (:name, :description, :type, :effect, :image)"
            );
        }

        $stmt->bindParam(':name', $this->getName());
        $stmt->bindParam(':description', $this->getDescription());
        $stmt->bindParam(':type', $this->getType());
        $stmt->bindParam(':effect', $this->getEffect());
        $stmt->bindParam(':image', $this->getImage());
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM items");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete()
    {
        if(!$this->id) {
            $stmt = $this->db->prepare("DELETE FROM items WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        }
        return false;
    }

    public function loadById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data){
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->type = $data['type'];
            $this->effect = $data['effect'];
            $this->image = $data['image'];
            return true;
        }
        return false;
        }
        
}
