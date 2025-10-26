<div class="container">
<link rel="stylesheet" href="style.css">
<?php
include 'connectiondb.php';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $conn->query("UPDATE students SET name='$name' WHERE id=$id");
    header("Location: read.php");
}

$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>

<h2>Edit Student</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <input type="submit" value="Update">
</form>
</div>