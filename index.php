<div class="container">
<link rel="stylesheet" href="style.css">
<?php
include 'connectiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $conn->query("INSERT INTO students (name) VALUES ('$name')");
    header("Location: read.php");
}
?>

<h2>Add Student</h2>
<form method="post">
    Name: <input type="text" name="name" required>
    <input type="submit" value="Add">
</form>
</div>