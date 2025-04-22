<?php
class Database{
  private $host = "localhost";
  private $db = "kancelaria";
  private $user = "root";
  private $pass = "";
  private $charset = "utf8";
  private $pdo;

  public function __construct(){
    $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
    try{
        $this->pdo = new PDO($dsn,$this->user,$this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        die('Connection failed: '.$e->getMessage());}}

  public function __destruct(){
    $this->pdo = null;}

  public function getConnection(){
    return $this->pdo;}

  public function insertQuestion($name, $email, $subject, $question) {
    $sql = "INSERT INTO qna (name, email, subject, question) VALUES (:name, :email, :subject, :question)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':question' => $question]);}
  
  public function checkAdminLogin($username, $password) {
    $sql = "SELECT * FROM pouzivatelia WHERE id = 1 AND username = :username AND password = :password";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
    ':username' => $username,
    ':password' => md5($password)]);
    return $stmt->fetch(PDO::FETCH_ASSOC);}
}
?>