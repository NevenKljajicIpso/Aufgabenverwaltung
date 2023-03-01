<!DOCTYPE html>
<html>
<head>
  <title>Aufgabenverwaltung</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <?php

  // Include database connection file
  include('db_connection.php');

  // Check if form has been submitted
  if (isset($_POST['submit'])) {
    // Get the form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $person_id = mysqli_real_escape_string($conn, $_POST['person']);
    $task_type_id = mysqli_real_escape_string($conn, $_POST['task_type']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);

    // Validate the form data
    if (empty($title) || empty($description) || empty($person_id) || empty($task_type_id) || empty($due_date)) {
      $error_message = "All fields are required";
      echo "<script type='text/javascript'>alert('$error_message');</script>";
    } else {
      // Check if Due Date is not in the past
      if (strtotime($due_date) < time()) {
        $error_message = "Due date cannot be in the past";
        echo "<script type='text/javascript'>alert('$error_message');</script>";
      } else {
        // Insert task into the database
        $sql = "INSERT INTO tasks (title, description, person_id, task_type_id, due_date) VALUES ('$title', '$description', '$person_id', '$task_type_id', '$due_date')";
        if (mysqli_query($conn, $sql)) {
          $success_Message = "Task created successfully!";
          echo "<script type='text/javascript'>alert('$success_Message');</script>";
          header("Location: tasks.php");
          exit;
        } else {
          $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
          echo "<script type='text/javascript'>alert('$error_message');</script>";
        }
      }
    }
  }

  mysqli_close($conn);

  ?>

  <div class="container">

    <div class="navDiv">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Create a Task</a> 
      </nav> 
    </div>

    <!-- HTML form for creating a new task -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" id="title" value="<?php echo isset($title) ? $title : ''; ?>">
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description"><?php echo isset($description) ? $description : ''; ?></textarea>
      </div>

      <div class="form-group">
        <label for="person">Person:</label>
        <select class="form-control" name="person" id="person">
          <option value="">Select a person</option>
          <?php
          // Connect to database
          $conn = mysqli_connect($host, $username, $password, $dbname);

          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          // Retrieve all persons from the database
          $sql = "SELECT * FROM persons";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              // Output each person in dropdown
              echo "<option value='" . $row['id'] . "'>" . $row['name'] . " " . $row['first_name'] . " (id: " . $row['id'] . ")</option>";
            }
          }

          mysqli_close($conn);
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="task_type">Task Type:</label>
        <select class="form-control" name="task_type" id="task_type">
          <option value="">Select a task type</option>
          <?php
          // Connect to the database
          $conn = mysqli_connect($host, $username, $password, $dbname);

          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          // Retrieve all task types from the database
          $sql = "SELECT * FROM task_types";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              // Output each task type as an option in the select menu
              echo "<option value='" . $row['id'] . "'>" . $row['name'] . " (id: " . $row['id'] . ")</option>";
            }
          }

          mysqli_close($conn);
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="due_date">Due Date:</label>
        <input class="form-control" type="date" name="due_date" id="due_date" value="<?php echo isset($due_date) ? $due_date : ''; ?>">
      </div>

      <input class='btn btn-primary' type="submit" name="submit" value="Create Task">
      
    </form>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start fixed-bottom">
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-dark" href="#">Neven Kljajić</a>
      </div>
    </footer>

  </div>
</body>