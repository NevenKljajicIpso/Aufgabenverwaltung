<?php

// Include database connection file
include('db_connection.php');

// Check if task_ID is set in the URL
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  // Delete the task from the database
  $sql = "DELETE FROM tasks WHERE id = '$id'";
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