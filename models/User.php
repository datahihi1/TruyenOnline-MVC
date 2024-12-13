<?php

class User extends BaseModel
{
    public $table = 'users';

    public function getAll(){
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById($id){
        $sql = "SELECT * FROM $this->table WHERE user_id =:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function delById($id){
        $sql = "DELETE FROM $this->table WHERE user_id =:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function checkLogin($user_login){
        $sql = "SELECT * FROM $this->table WHERE username=:username  LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username',$user_login);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function checkSignup($user_signup){
        $sql = "SELECT * FROM $this->table WHERE username=:username  LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username',$user_signup);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function newUser($user_signup,$email_signup,$pass_signup,$file_name){
        $sql = "INSERT INTO users(username,email,password,avatar) VALUES (:username,:email,:password,:avatar)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":username", $user_signup);
        $stmt->bindParam(":email", $email_signup);
        $stmt->bindParam(":password", $pass_signup);
        $stmt->bindParam(":avatar", $file_name);
        return $stmt->execute();
    }
    public function getCoinById($user_id){
        $sql = "SELECT coin FROM $this->table WHERE user_id=:user_id  LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function boughtComic($user_id, $price){
        $sql = "UPDATE users 
                JOIN comic_bought ON comic_bought.user_id = users.user_id
                SET users.coin = users.coin - :price
                WHERE users.user_id=:user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":price",$price);
        return $stmt->execute();
    }
  
}