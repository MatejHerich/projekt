<?php
class UserManager {
    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function checkAdminLogin($username, $password) {
        $sql = "SELECT * FROM pouzivatelia WHERE id = 1 AND username = :username AND password = :password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':password' => md5($password) 
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>