<div class="container">
<link rel="stylesheet" href="style.css">
<?php
include 'connectiondb.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM grades WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];

    $conn->query("UPDATE grades SET subject='$subject', grade=$grade WHERE id=$id");
    header("Location: read.php");
}
?>

<h2>Edit Grade</h2>
<form method="post">
    Subject: <input type="text" name="subject" value="<?php echo $row['subject']; ?>" required><br><br>
    Grade: <input type="number" step="0.01" name="grade" value="<?php echo $row['grade']; ?>" required><br><br>
    <input type="submit" value="Update Grade">
</form>
</div>