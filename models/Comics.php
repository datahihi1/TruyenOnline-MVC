<?php
    
    class Comics extends BaseModel{
        public $table = "comics";

        public function getAll(){
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getComicById($id){
            $sql = "SELECT * FROM $this->table WHERE comic_id=$id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function getComicByName($name){
            $sql = "SELECT * FROM $this->table WHERE comic_name=:name";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":name",$name);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function getGenresByComicId($id){
            $sql = "SELECT comics.comic_name AS name, GROUP_CONCAT(genres.name SEPARATOR ', ') AS genres 
                    FROM comics 
                    JOIN comic_genres ON comics.comic_id = comic_genres.comic_id 
                    JOIN genres ON comic_genres.genre_id = genres.genre_id 
                    WHERE comics.comic_id=$id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function getChapterByComicId($id){
            $sql = "SELECT chapters.*,chapters.view_count,comics.comic_name AS name FROM chapters
                    JOIN comics ON chapters.comic_id = comics.comic_id
                    WHERE comics.comic_id=$id
                    ORDER BY chapters.chap_number ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getDirChapter($id,$chap_id){
            $sql = "SELECT c_h.img_content FROM chapters AS c_h 
                    JOIN comics AS c ON c.comic_id=c_h.comic_id 
                    WHERE c.comic_id=:comic_id AND c_h.chap_number=:chapter_id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":comic_id", $id);
            $stmt->bindParam(":chapter_id", $chap_id);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function getPriceById($comic_id){
            $sql = "SELECT coin_price FROM comics WHERE comic_id=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$comic_id);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function newComic($comic_name,$artist,$description,$comic_dir,$title_img,$coin_price){
            $sql = "INSERT INTO $this->table(comic_name, artist,description, comic_dir, title_img, coin_price)
                    VALUES (:comic_name,:artist,:description,:comic_dir,:title_img,:coin_price)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":comic_name",$comic_name);
            $stmt->bindParam(":artist",$artist);
            $stmt->bindParam(":description",$description);
            $stmt->bindParam(":comic_dir",$comic_dir);
            $stmt->bindParam(":title_img",$title_img);
            $stmt->bindParam(":coin_price",$coin_price);
            return $stmt->execute();
        }
        public function updateViewComic($id){
            $sql = "UPDATE comics AS c SET view_count = view_count + 1 WHERE comic_id = :comic_id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":comic_id", $id);
            return $stmt->execute();
        }

    }