<div class="container">
<link rel="stylesheet" href="style.css">
<?php
include 'connectiondb.php';

// Step 1: Fetch students with their average grade
$sql = "
    SELECT s.id, s.name, AVG(g.grade) AS average_grade
    FROM students s
    LEFT JOIN grades g ON s.id = g.student_id
    GROUP BY s.id
    ORDER BY average_grade DESC
";
$result = $conn->query($sql);

// Step 2: Display rankings
echo "<h2>📊 Student Rankings with Subjects</h2>";

echo "
<div class='top-actions'>
    <a href='create.php' class='btn-add'>Add Student</a>
    <a href='grade_create.php' class='btn-add'>Add Grade</a>
</div>
";

$rank = 1;

echo "<table>";
echo "<tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Subjects & Grades</th>
        <th>Average Grade</th>
        <th>Actions</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    $student_id = $row['id'];
    $student_name = htmlspecialchars($row['name']);
    $average = is_null($row['average_grade']) ? 'N/A' : number_format($row['average_grade'], 2);

    // Step 3: Fetch this student's subjects and grades
    $grades_sql = "SELECT id, subject, grade FROM grades WHERE student_id = $student_id";
    $grades_result = $conn->query($grades_sql);

    $grades_list = "";
    if ($grades_result->num_rows > 0) {
        $grades_list .= "<ul>";
        while ($g = $grades_result->fetch_assoc()) {
            $grades_list .= "
            <li>
                <strong>" . htmlspecialchars($g['subject']) . "</strong>: " . htmlspecialchars($g['grade']) . "
                <div class='action-buttons'>
                    <a href='grade_edit.php?id={$g['id']}' class='btn-edit'>Edit</a>
                    <a href='grade_delete.php?id={$g['id']}' class='btn-delete' onclick=\"return confirm('Delete this grade?')\">Delete</a>
                </div>
            </li>";
        }
        $grades_list .= "</ul>";
    } else {
        $grades_list = "<i>No grades yet</i>";
    }

    // Step 4: Display student row
    echo "<tr>
            <td>$rank</td>
            <td>$student_name</td>
            <td>$grades_list</td>
            <td>$average</td>
            <td>
                <div class='action-buttons'>
                    <a href='update.php?id=$student_id' class='btn-edit'>Edit</a>
                    <a href='delete.php?id=$student_id' class='btn-delete' onclick=\"return confirm('Delete student and all grades?')\">Delete</a>
                </div>
            </td>
          </tr>";
    $rank++;
}

echo "</table>";
?>
</div>
