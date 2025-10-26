<div class="container">
<link rel="stylesheet" href="style.css">
<?php
include 'connectiondb.php';
$id = $_GET['id'];

$conn->query("DELETE FROM grades WHERE id = $id");
header("Location: read.php");
?>
</div>