<?php
session_start();
require_once('assets/classes/Database.php');

$db = new Database();
$pdo = $db->getConnection();

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM qna WHERE id = :id");
$stmt->execute([':id' => $id]);
$question = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'subject' => $_POST['subject'],
        'question' => $_POST['question'],
        'status' => $_POST['status']
    ];
    $db->updateQuestion($id, $data);
    header("Location: admin.php");
    exit;
}

include('assets/_inc/header.php');
?>

<style>
  .form-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background-color: #007bff;
    border-radius: 8px;
    color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  h2 {
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
  }

  .form-container .form-group label {
    color: #fff;
  }

  .form-container input,
  .form-container textarea,
  .form-container select {
    background-color: #0056b3;
    border: 1px solid #004085;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    width: 100%;
    margin-bottom: 15px;
  }

  .form-container button {
    background-color: #28a745;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
  }

  .form-container button:hover {
    background-color: #218838;
  }
</style>

<h2>Edit Question</h2>

<div class="form-container">
  <form method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" value="<?= $question['name'] ?>">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" value="<?= $question['email'] ?>">
    </div>

    <div class="form-group">
      <label for="subject">Subject:</label>
      <input type="text" name="subject" value="<?= $question['subject'] ?>">
    </div>

    <div class="form-group">
      <label for="question">Question:</label>
      <textarea name="question" rows="5"><?=$question['question'] ?></textarea>
    </div>

    <div class="form-group">
      <label for="status">Status:</label>
      <select name="status">
        <option value="new" <?= $question['status'] == 'new' ? 'selected' : '' ?>>New</option>
        <option value="answered" <?= $question['status'] == 'answered' ? 'selected' : '' ?>>Answered</option>
      </select>
    </div>

    <button type="submit">Save</button>
  </form>
</div>

<?php
include('assets/_inc/footer.php');
?>
