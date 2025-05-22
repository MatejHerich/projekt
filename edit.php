<?php
session_start();

require_once('assets/classes/DatabaseConnection.php');
require_once('assets/classes/ContactManager.php');

$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getConnection();

$contactManager = new ContactManager($pdo);

$id = intval($_GET['id']);
$question = $contactManager->getQuestionById($id);

if (!$question) {
    die("Question not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => htmlspecialchars($_POST['name']),
        'email' => htmlspecialchars($_POST['email']),
        'subject' => htmlspecialchars($_POST['subject']),
        'question' => htmlspecialchars($_POST['question']),
        'status' => htmlspecialchars($_POST['status'])
    ];

    $contactManager->updateQuestion($id, $data);
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
      <input type="text" name="name" value="<?= htmlspecialchars($question['name']) ?>" required>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($question['email']) ?>" required>
    </div>

    <div class="form-group">
      <label for="subject">Subject:</label>
      <input type="text" name="subject" value="<?= htmlspecialchars($question['subject']) ?>">
    </div>

    <div class="form-group">
      <label for="question">Question:</label>
      <textarea name="question" rows="5"><?= htmlspecialchars($question['question']) ?></textarea>
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
