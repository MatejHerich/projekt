<?php
session_start();
require_once('assets/classes/Database.php');

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;}

$db = new Database();
$pdo = $db->getConnection();

if (isset($_GET['done'])) {
  $id = intval($_GET['done']);
  $stmt = $pdo->prepare("UPDATE qna SET status = 'answered' WHERE id = :id");
  $stmt->execute([':id' => $id]);
  header("Location: admin.php");
  exit;}

if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $db->deleteQuestion($id);
  header("Location: admin.php");
  exit;}


$stmt = $pdo->query("SELECT * FROM qna ORDER BY id DESC");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

include("assets/_inc/header.php");
?>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 2rem;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  th, td {
    padding: 1rem;
    border: 1px solid #ddd;
    text-align: left;
    vertical-align: top;
  }

  th {
    background-color: #007bff;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .btn {
    background-color: #28a745;
    color: white;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.9rem;
  }

  .btn:hover {
    background-color: #218838;
  }

  .status-answered {
    color: green;
    font-weight: bold;
  }

  .status-new {
    color: orange;
    font-weight: bold;
  }

  h1 {
    text-align: center;
    margin-top: 2rem;
  }
</style>

<h1>Admin – Contact Form Submissions</h1>

<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Question</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php foreach ($questions as $q): ?>
  <tr>
    <td><?= $q['name'] ?></td>
    <td><a href="mailto:<?= $q['email'] ?>"><?= $q['email'] ?></a></td>
    <td><?= $q['subject'] ?></td>
    <td><?= $q['question'] ?></td>
    <td class="status-<?= $q['status'] ?>"><?= $q['status'] ?></td>
    <td>
      <?php if ($q['status'] === 'new'): ?>
        <a href="?done=<?= $q['id'] ?>" class="btn">Done</a>
      <?php else: ?>
        ✔️
      <?php endif; ?>
      <a href="edit.php?id=<?= $q['id'] ?>" class="btn btn-update">Update</a>
      <a href="?delete=<?= $q['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?');">Delete</a>
    </td>
  </tr>
<?php endforeach; ?>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include("assets/_inc/footer.php"); ?>
