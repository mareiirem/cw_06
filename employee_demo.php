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


