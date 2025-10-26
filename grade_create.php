<div class="container">
<link rel="stylesheet" href="style.css">
<?php
include 'connectiondb.php';

$students = $conn->query("SELECT * FROM students");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $conn->query("INSERT INTO grades (student_id, subject, grade) VALUES ($student_id, '$subject', $grade)");
    header("Location: read.php");
}
?>

<h2>Add Grade</h2>
<form method="post">
    Student:
    <select name="student_id" required>
        <?php while ($row = $students->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        } ?>
    </select><br><br>
    Subject: <input type="text" name="subject" required><br><br>
    Grade: <input type="number" step="0.01" name="grade" required><br><br>
    <input type="submit" value="Add Grade">
</form>
</div>