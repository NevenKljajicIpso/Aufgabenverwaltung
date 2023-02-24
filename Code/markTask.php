<?php

// Include the database connection file
include('db_connection.php');

// Check if the task ID is set in the URL
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  // Mark the task as completed in the database
  $sql = "UPDATE tasks SET completed = 1 WHERE id = '$id'";
  if (mysqli_query($conn, $sql)) {
    header("Location: tasks.php");
    exit;
  } else {
    $error_Message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<script type='text/javascript'>alert('$error_message');</script>";
  }
} 

mysqli_close($conn);

?>