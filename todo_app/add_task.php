<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $reminder = $_POST['reminder'];

    $stmt = $pdo->prepare("INSERT INTO tasks (task, reminder) VALUES (:task, :reminder)");
    $stmt->execute(['task' => $task, 'reminder' => $reminder]);
}

header("Location: index.php");
exit();
?>