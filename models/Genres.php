<?php

class Genres extends BaseModel{
    public $table = 'genres';
    public function getAll(){
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById($id){
        $sql = "SELECT * FROM $this->table WHERE genre_id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getByName($genre){
        $sql = "SELECT * FROM $this->table WHERE name=:name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name',$genre);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function store($genre, $description){
        $sql = "INSERT INTO $this->table(name,description) VALUES (:name,:description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name',$genre);
        $stmt->bindParam(':description',$description);
        return $stmt->execute();
    }
    public function update($genre, $description,$id){
        $sql = "UPDATE $this->table SET name =:name , description = :description WHERE genre_id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name',$genre);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }
    public function checkGenresByGenreId($id){
        $sql = "SELECT g.genre_id FROM $this->table AS g
                JOIN comic_genres AS c_g ON g.genre_id = c_g.genre_id
                WHERE g.genre_id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE genre_id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }
    public function getComicByGenreId($id){
        $sql = "SELECT comics.*,comics.comic_name FROM comics
                JOIN comic_genres ON comics.comic_id = comic_genres.comic_id
                JOIN genres ON comic_genres.genre_id = genres.genre_id
                WHERE genres.genre_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function addComicGenre($genres, $comic_id) {
        $sql = "INSERT INTO comic_genres (comic_id, genre_id) VALUES (:comic_id, :genre_id)";
        $stmt = $this->pdo->prepare($sql);
    
        foreach ($genres as $genre_id) {
            // Bind and execute for each genre
            $stmt->bindValue(":comic_id", $comic_id);
            $stmt->bindValue(":genre_id", $genre_id);
            $stmt->execute();
        }
    
        return true; // Return true if no exceptions occurred
    }
}