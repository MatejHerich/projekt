<?php
session_start();
require_once('assets/classes/DatabaseConnection.php');
require_once('assets/classes/ContactManager.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getConnection();

$contactManager = new ContactManager($pdo);

if (isset($_GET['done'])) {
    $id = intval($_GET['done']);
    $contactManager->markAsAnswered($id);
    header("Location: admin.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $contactManager->deleteQuestion($id);
    header("Location: admin.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$questions = $contactManager->getAllQuestions();

include("assets/_inc/header.php");
?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .page-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
        padding: 2rem;
    }

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
        margin-right: 5px;
    }

    .btn:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-update {
        background-color: #ffc107;
        color: black;
    }

    .btn-update:hover {
        background-color: #e0a800;
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

<div class="page-wrapper">
    <div class="content">
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
            <?php if (!empty($questions)): ?>
                <?php foreach ($questions as $q): ?>
                    <tr>
                        <td><?= htmlspecialchars($q['name']) ?></td>
                        <td><a href="mailto:<?= htmlspecialchars($q['email']) ?>"><?= htmlspecialchars($q['email']) ?></a></td>
                        <td><?= htmlspecialchars($q['subject']) ?></td>
                        <td><?= htmlspecialchars($q['question']) ?></td>
                        <td class="status-<?= $q['status'] ?>"><?= $q['status'] ?></td>
                        <td>
                            <?php if ($q['status'] === 'new'): ?>
                                <a href="?done=<?= $q['id'] ?>" class="btn">Done</a>
                            <?php endif; ?>
                            <a href="edit.php?id=<?= $q['id'] ?>" class="btn btn-update">Update</a>
                            <a href="?delete=<?= $q['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No contact form submissions found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <?php include("assets/_inc/footer.php"); ?>
</div>

