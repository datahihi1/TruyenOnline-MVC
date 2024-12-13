<?php

class ComicBought extends BaseModel
{
    public $table = 'comic_bought';
    public function getAll() {
        $sql = "SELECT * FROM $this->table
                JOIN users ON users.user_id=$this->table.user_id
                JOIN comics ON comics.comic_id=$this->table.comic_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function checkBuyComic($user_id, $id){
        $sql = "SELECT * FROM $this->table WHERE user_id=:user_id AND comic_id=:comic_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":comic_id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function buyComic($user_id, $comic_id, $price, $now)
    {

        $sql = "INSERT INTO $this->table(user_id,comic_id,price,time_bought) VALUES (:user_id,:comic_id,:price,:time_bought)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":comic_id", $comic_id);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":time_bought", $now);
        return $stmt->execute();
    }
}
