<?php

// Include the database connection file
include('db_connection.php');

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the form data
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $mail_address = mysqli_real_escape_string($conn, $_POST['mail_address']);

  // Check that all fields are filled in
  if (empty($name) || empty($first_name) || empty($mail_address)) {
    echo "Please fill in all fields.";
  } else {
    // Insert the person into the database
    $sql = "INSERT INTO persons (name, first_name, email) VALUES ('$name', '$first_name', '$mail_address')";
    if (mysqli_query($conn, $sql)) {
      header('Location:admin.php');
    } else {
      $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
      echo "<script type='text/javascript'>alert('$error_message');</script>";
    }
  }
}

mysqli_close($conn);

?>