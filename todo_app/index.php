<?php
include 'db.php';

// Fetch tasks
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>To-Do List</h1>
    <form action="add_task.php" method="POST">
        <input type="text" name="task" required placeholder="Add a new task">
        <input type="datetime-local" name="reminder" required>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <form action="edit_task.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <input type="text" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
                    <input type="datetime-local" name="reminder" value="<?= $task['reminder'] ? date('Y-m-d\TH:i', strtotime($task['reminder'])) : '' ?>" required>
                    <button type="submit">Edit</button>
                </form>
                <form action="delete_task.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
                <form action="mark_complete.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit"><?= $task['is_completed'] ? 'Unmark' : 'Complete' ?></button>
                </form>
                <span style="color: <?= $task['is_completed'] ? 'green' : 'red' ?>;">
                    <?= $task['is_completed'] ? 'Completed' : 'Pending' ?>
                </span>
                <span>
                    Reminder: <?= $task['reminder'] ? date ('Y-m-d H:i', strtotime($task['reminder'])) : 'None' ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tasks = <?= json_encode($tasks) ?>;
            const now = new Date();

            tasks.forEach(task => {
                if (task.reminder) {
                    const reminderTime = new Date(task.reminder);
                    if (reminderTime <= now && !task.is_completed) {
                        alert(`Reminder: The task "${task.task}" is due!`);
                    }
                }
            });
        });
    </script>
</body>
</html>