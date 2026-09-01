<?php

include 'connect.php';
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$sql = "SELECT * FROM users WHERE username = :username";

try {
    $query = $conn->prepare($sql);
    $query->execute([
    'username' => $username
]);
    $user = $query->fetch();
}
catch (PDOException $e) {
    $conn = null;
    $query = null;
    die("Virhe: " . $e->getMessage());
}

if ($user && password_verify($password, $user["password"])) {
    $sql = "SELECT * FROM users;";
    try {
        $query = $conn->prepare($sql);
        $query->execute();
    }
    catch (PDOException $e) {
        $conn = null;
        $query = null;
        die("Virhe: " . $e->getMessage());
    }
    $users = $query->fetchAll();
    $conn = null;
    $query = null;
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['users'] = $users;
    session_regenerate_id(True);
    header('Location: home.php');
    // exit;
} else {
    header('Location: index.php');
}
?>