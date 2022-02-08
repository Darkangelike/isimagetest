<?php

namespace Models;

class Velo extends AbstractModel implements \JsonSerializable
{
    protected string $tableName = "velos";
    private string $name;
    private string $description;
    private string $image;
    private int $price;
    private int $user_id;

    public function getId(): int
    {
        return $this->id;
    }

    // property name gs
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // property description gs
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    // property image gs
    public function getImage(): string
    {
        return $this->image;
    }
    
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    // property price gs
    public function getPrice(): int
    {
        return $this->price;
    }
    
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    // property user gs
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {

    }

    public function getAuthor(): User
    {
        $modelUser = new \Models\User();
        return $modelUser->findById($this->user_id);
    }

    public function jsonSerialize()
    {
        $modelUser = new \Models\User();
        return [
            "name" => $this->name,
            "id" => $this->id,
            "price" => $this->price,
            "description" => $this->description,
            "user" => $modelUser->findById($this->user_id),
            "avis" => $this->getAvis(),
            "image" => $this->image
        ];
    }

    // METHODS
    
    /**
     * 
     * Insert a new BIKE object in the database
     * 
     * @return void
     */
    public function save(Velo $velo):void
    {

        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, description, image, price, user_id)
        VALUES (:name, :description, :image, :price, :user_id)");
        $sql->execute([
            "name" => $velo->name,
            "description" => $velo->description,
            "image" => $velo->image,
            "price" => $velo->price,
            "user_id" => $velo->user_id
        ]);
    }

    /**
     * Fetch all the avis associated with the velo's id
     *
     * @return array|bool
     */
    public function getAvis()
    {
        $modelAvis = new \Models\Avis();
        return $modelAvis->findAllById($this->getId());
    }

}


?>