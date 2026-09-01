<?php
include 'connect.php';
session_start();
$title = htmlspecialchars($_POST['title']);
$body = htmlspecialchars($_POST['body']);
$userId = $_SESSION['user']['id'];
$today = date("Y-m-d");

$sql = "INSERT INTO posts (title, body, posted, author) VALUES (:title, :body, :posted, :author);";

try {
    $query = $conn->prepare($sql);
    $query->execute([
        'title' => $title, 'body' =>$body, 'posted' =>$today, 'author' => $userId
    ]);
    header('Location: home.php');
} catch (PDOException $e) {
    die('Virhe: ' . $e->getMessage());
}


?>