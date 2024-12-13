<?php

class Chapters extends BaseModel{
    public $table = 'chapters';
    public function updateViewChapter($id, $chap_id){
        $sql = "   UPDATE $this->table AS c_h
                    JOIN comics AS c ON c.comic_id = c_h.comic_id
                    SET c_h.view_count = c_h.view_count + 1
                    WHERE c.comic_id = :comic_id AND c_h.chap_number = :chapter_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":comic_id", $id);
        $stmt->bindParam(":chapter_id", $chap_id);
        return $stmt->execute();  
    }
    public function addChapter($comicId,$chapNumber,$title,$pageNumber,$uploadChapDir){
        $sql = "INSERT INTO chapters(comic_id, chap_number, title, page_number, img_content)
                VALUES (:comic_id,:chap_number,:title,:page_number,:img_content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":comic_id",$comicId);
        $stmt->bindParam(":chap_number",$chapNumber);
        $stmt->bindParam(":title",$title);
        $stmt->bindParam(":page_number",$pageNumber);
        $stmt->bindParam(":img_content",$uploadChapDir);
        return $stmt->execute();
    }
}