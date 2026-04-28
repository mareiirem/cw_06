<?php
require "db.php";

$message = "";
$class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //input
    $name   = trim($_POST["name"]);
    $job    = trim($_POST["job"]);
    $salary = trim($_POST["salary"]);
    $hire   = trim($_POST["hire_date"]);
    $deptId = trim($_POST["dept_id"]);
    $dept   = trim($_POST["dept_name"]);

    // Validation
    if (!$name || !$job || !$salary || !$hire || !$deptId || !$dept) {
        $message = "All fields are required.";
        $class = "error";
    } else {

        // Prepared statement 
        $stmt = $conn->prepare(
            "INSERT INTO employees
            (emp_name, job_name, salary, hire_date, department_id, department_name)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("ssdsid", $name, $job, $salary, $hire, $deptId, $dept);

        if ($stmt->execute()) {
            $message = "Success! Inserted ID: " . $stmt->insert_id;
            $class = "success";
        } else {
            $message = "Insert failed.";
            $class = "error";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Employee Demo</title>
</head>

<body class="demo-page">
<div class="demo-shell">
  <div class="demo-card">

    <h2 class="demo-title">Add Employee</h2>

    <form method="POST">
      <div class="demo-grid">

        <div class="demo-field">
          <label>Name</label>
          <input class="demo-input" name="name" required>
        </div>

        <div class="demo-field">
          <label>Job</label>
          <input class="demo-input" name="job" required>
        </div>

        <div class="demo-field">
          <label>Salary</label>
          <input class="demo-input" type="number" step="0.01" name="salary" required>
        </div>

        <div class="demo-field">
          <label>Hire Date</label>
          <input class="demo-input" type="date" name="hire_date" required>
        </div>

        <div class="demo-field">
          <label>Department ID</label>
          <input class="demo-input" type="number" name="dept_id" required>
        </div>

        <div class="demo-field">
          <label>Department Name</label>
          <input class="demo-input" name="dept_name" required>
        </div>

      </div>

      <div class="demo-actions">
        <button class="demo-btn">Submit</button>
        <a class="demo-link" href="read_employees.php">View Records</a>
      </div>
    </form>

    <?php if ($message): ?>
      <div class="demo-msg <?php echo $class; ?>">
        <?php echo htmlspecialchars($message); ?>
      </div>
    <?php endif; ?>

  </div>
</div>
</body>
</html>