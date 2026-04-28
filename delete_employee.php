<?php
require "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'] ?? null;
$message = "";

if ($id) {
    $stmt = $conn->prepare("DELETE FROM employees WHERE emp_id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Employee deleted successfully!";
    } else {
        $message = "Delete failed.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
<title>Delete Employee</title>
</head>

<body class="demo-page">
<div class="demo-shell">
<div class="demo-card">

<h2 class="demo-title">Delete Employee</h2>

<?php if ($message): ?>
<div class="demo-msg success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if (!$message): ?>
<p class="demo-subtitle">Are you sure you want to delete this employee?</p>

<div class="demo-actions">
<a class="demo-btn" href="?id=<?php echo htmlspecialchars($id); ?>">Confirm Delete</a>
<a class="demo-link" href="read_employees.php">Cancel</a>
</div>
<?php else: ?>
<div class="demo-actions">
<a class="demo-link" href="read_employees.php">Back to Records</a>
</div>
<?php endif; ?>

</div>
</div>
</body>
</html>