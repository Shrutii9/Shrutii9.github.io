<?php

include 'partials/_dbconnect.php';

$task = $_GET['task'];

$sql = "DELETE FROM todo WHERE task = '{$task}'";

$query = mysqli_query($conn, $sql);

header('location:welcome.php');

?>