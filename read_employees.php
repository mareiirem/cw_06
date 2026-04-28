<?php
require "db.php";

$result = $conn->query("SELECT * FROM employees ORDER BY emp_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Employees</title>
</head>

<body class="demo-page">
<div class="demo-shell">
  <div class="demo-card">

    <h2 class="demo-title">Employee Records</h2>

    <table style="width:100%; border-collapse: collapse;">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Job</th>
        <th>Salary</th>
        <th>Hire Date</th>
        <th>Dept ID</th>
        <th>Dept Name</th>
      </tr>

      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row["emp_id"]) ?></td>
        <td><?= htmlspecialchars($row["emp_name"]) ?></td>
        <td><?= htmlspecialchars($row["job_name"]) ?></td>
        <td><?= htmlspecialchars($row["salary"]) ?></td>
        <td><?= htmlspecialchars($row["hire_date"]) ?></td>
        <td><?= htmlspecialchars($row["department_id"]) ?></td>
        <td><?= htmlspecialchars($row["department_name"]) ?></td>
      </tr>
      <?php endwhile; ?>

    </table>

  </div>
</div>
</body>
</html>

<?php
$conn->close();
?>