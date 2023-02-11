<?php

// Include the database connection file
include('db_connection.php');

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the form data
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $color = mysqli_real_escape_string($conn, $_POST['color']);
  $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);

  // Check that all fields are filled in
  if (empty($name) || empty($color) || empty($due_date)) {
    echo "Please fill in all fields.";
  } else {
    // Insert the task type into the database
    $sql = "INSERT INTO task_types (name, color, due_days) VALUES ('$name', '$color', '$due_date')";
    if (mysqli_query($conn, $sql)) {
      // Redirect to the admin page
      header("Location: admin.php");
    } else {
      // Print an error message
      $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
      echo "<script type='text/javascript'>alert('$error_message');</script>";
    }
  }
}
mysqli_close($conn);
?>
