<?php
require "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'] ?? null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    $name = $_POST["name"];
    $job = $_POST["job"];
    $salary = $_POST["salary"];
    $hire = $_POST["hire_date"];
    $deptId = $_POST["dept_id"];
    $dept = $_POST["dept_name"];

    $stmt = $conn->prepare("
        UPDATE employees
        SET emp_name=?, job_name=?, salary=?, hire_date=?, department_id=?, department_name=?
        WHERE emp_id=?
    ");

    $stmt->bind_param("ssdsisi", $name, $job, $salary, $hire, $deptId, $dept, $id);

    if ($stmt->execute()) {
        $message = "Employee updated successfully!";
    } else {
        $message = "Update failed.";
    }

    $stmt->close();
}

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
<title>Update Employee</title>
</head>

<body class="demo-page">
<div class="demo-shell">
<div class="demo-card">

<h2 class="demo-title">Update Employee</h2>

<?php if ($message): ?>
<div class="demo-msg success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<form method="POST">

<input type="hidden" name="id" value="<?php echo htmlspecialchars($row['emp_id']); ?>">

<div class="demo-grid">

<div class="demo-field">
<label>Name</label>
<input class="demo-input" name="name" value="<?php echo htmlspecialchars($row['emp_name']); ?>" required>
</div>

<div class="demo-field">
<label>Job</label>
<input class="demo-input" name="job" value="<?php echo htmlspecialchars($row['job_name']); ?>" required>
</div>

<div class="demo-field">
<label>Salary</label>
<input class="demo-input" name="salary" value="<?php echo htmlspecialchars($row['salary']); ?>" required>
</div>

<div class="demo-field">
<label>Hire Date</label>
<input class="demo-input" type="date" name="hire_date" value="<?php echo htmlspecialchars($row['hire_date']); ?>" required>
</div>

<div class="demo-field">
<label>Department ID</label>
<input class="demo-input" name="dept_id" value="<?php echo htmlspecialchars($row['department_id']); ?>" required>
</div>

<div class="demo-field">
<label>Department Name</label>
<input class="demo-input" name="dept_name" value="<?php echo htmlspecialchars($row['department_name']); ?>" required>
</div>

</div>

<div class="demo-actions">
<button class="demo-btn">Update</button>
<a class="demo-link" href="read_employees.php">Back</a>
</div>

</form>

</div>
</div>
</body>
</html>

<?php $conn->close(); ?>