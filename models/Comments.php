<?php

    class Comments extends BaseModel{
        public $table = 'comments';
        public function getByComicId($id){
            $sql = "SELECT comments.*, users.avatar,users.username,comics.comic_id FROM comments
                    JOIN users ON users.user_id = comments.user_id
                    JOIN comics ON comics.comic_id = comments.comic_id
                    WHERE comics.comic_id = $id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function insert($user_id,$id,$content){
            $sql = "INSERT INTO comments(user_id, comic_id,content) VALUES (:user_id,:comic_id,:content)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":comic_id",$id);
            $stmt->bindParam(":content",$content);
            return $stmt->execute();
        }
    }