<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Toggle completion status
    $stmt = $pdo->prepare("UPDATE tasks SET is_completed = NOT is_completed WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header("Location: index.php");
exit();
?>