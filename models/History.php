<?php
    class History extends BaseModel{
        public $table = 'reading_history';
        public function getByUserId($id){
            $sql = "SELECT h.*,c.*,ch.* FROM $this->table AS h
                JOIN comics AS c ON c.comic_id=h.comic_id
                JOIN chapters AS ch ON ch.chapter_id =h.chapter_id
                WHERE h.user_id = $id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        }

    }