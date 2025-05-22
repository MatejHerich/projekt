<?php
class PropertyManager {
    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getAllProperties(){
        $sql = "SELECT * FROM nehnutelnosti";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>