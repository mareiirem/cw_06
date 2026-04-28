<?php
require "db.php";

$message = "";
$class = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $salary = trim($_POST["salary"]);

    // validate
    if (empty($name) || empty($email) || empty($salary)) {
        $message = "All fields are required.";
        $class = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
        $class = "error";
    } else {
        // prepare statement
        $stmt = $conn->prepare("INSERT INTO employees (name, email, salary) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $email, $salary);

        if ($stmt->execute()) {
            $message = "Employee added successfully!";
            $class = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $class = "error";
        }

        $stmt->close();
    }
}
?>



<!DOCTYPE html>
<html>
<head>
  <title>Employee Demo</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="demo-page">
<div class="demo-shell">
  <div class="demo-card">

    <h2 class="demo-title">Employee Form</h2>
    <p class="demo-subtitle">Add a new employee</p>

    <form method="POST">
      <div class="demo-grid">

        <div class="demo-field">
          <label>Name</label>
          <input class="demo-input" type="text" name="name" required>
        </div>

        <div class="demo-field">
          <label>Email</label>
          <input class="demo-input" type="email" name="email" required>
        </div>

        <div class="demo-field">
          <label>Salary</label>
          <input class="demo-input" type="number" step="0.01" name="salary" required>
        </div>

      </div>

      <div class="demo-actions">
        <button class="demo-btn" type="submit">Add Employee</button>
        <a class="demo-link" href="read_employees.php">View Employees</a>
      </div>
    </form>

    <?php if ($message): ?>
      <div class="demo-msg <?php echo $class; ?>">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>

  </div>
</div>
</body>
</html>