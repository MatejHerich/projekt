<?php
session_start();
require_once ('assets/classes/Database.php');

$db = new Database();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $admin = $db->checkAdminLogin($username, $password);

  if ($admin) {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
    exit;
  } else {
    $error = "Nesprávne meno alebo heslo.";
  }
}
include("assets/_inc/header.php");
?>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-form {
      background-color: #ffffff;
      padding: 2rem 2.5rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .login-form label {
      display: block;
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }

    .login-form input {
      width: 100%;
      padding: 0.6rem;
      margin-top: 0.3rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-form button {
      width: 100%;
      padding: 0.7rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 1rem;
      cursor: pointer;
      font-size: 1rem;
    }

    .login-form button:hover {
      background-color: #0056b3;
    }

    .login-form p {
      margin-top: 1rem;
      text-align: center;
      color: red;
    }

  </style>
<main>
  <form method="post" class="login-form">
    <h2>Admin Login</h2>
    <label>Name:
      <input type="text" name="username" required>
    </label>
    <label>Password:
      <input type="password" name="password" required>
    </label>
    <button type="submit">Log in</button>
    <p><?= $error ?></p>
  </form>
</main>
<?php
include("assets/_inc/footer.php");
?>