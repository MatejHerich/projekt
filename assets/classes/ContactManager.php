<?php
class ContactManager {
    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function insertQuestion($name, $email, $subject, $question) {
        $sql = "INSERT INTO qna (name, email, subject, question) VALUES (:name, :email, :subject, :question)";
        $stmt = $this->pdo->prepare($sql);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':question' => $question
        ]);
    }

    public function updateQuestion($id, $data) {
        $sql = "UPDATE qna SET name = :name, email = :email, subject = :subject, question = :question, status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':subject' => $data['subject'],
            ':question' => $data['question'],
            ':status' => $data['status'],
            ':id' => $id
        ]);
    }

    public function deleteQuestion($id) {
        $sql = "DELETE FROM qna WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public function getAllQuestions() {
        $sql = "SELECT * FROM qna";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuestionById($id) {
        $sql = "SELECT * FROM qna WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function markAsAnswered($id) {
        $sql = "UPDATE qna SET status = 'answered' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
}

?>