<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $reminder = $_POST['reminder'];

    $stmt = $pdo->prepare("UPDATE tasks SET task = :task, reminder = :reminder WHERE id = :id");
    $stmt->execute(['task' => $task, 'reminder' => $reminder, 'id' => $id]);
}

header("Location: index.php");
exit();
?>