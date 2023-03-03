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
      $id = mysqli_real_escape_string($conn, $_POST['id']);
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $description = mysqli_real_escape_string($conn, $_POST['description']);
      $person = mysqli_real_escape_string($conn, $_POST['person']);
      $type = mysqli_real_escape_string($conn, $_POST['type']);
      $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);

      // Check that all fields are filled in
      if (empty($title) || empty($description) || empty($person) || empty($type) || empty($due_date)) {
        $error_Message = "Please fill in all fields.";
        echo "<script type='text/javascript'>alert('$error_message');</script>";
      } else {
        // Update task in the database
        $sql1 = "UPDATE tasks SET title='$title', description='$description', person_id='$person', task_type_id='$type', due_date='$due_date' WHERE id=$id";
        if (mysqli_query($conn, $sql1)) {
          header("Location: tasks.php");
          exit;
        } else {
          $error_Message = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
          echo "<script type='text/javascript'>alert('$error_message');</script>";
        }
      }
    } else {
      // Get the task ID from the query string
      $id = mysqli_real_escape_string($conn, $_GET['id']);

      // Select the task from the database
      $sql2 = "SELECT * FROM tasks WHERE id=$id";
      $result = mysqli_query($conn, $sql2);
      $task = mysqli_fetch_assoc($result);
    }

    mysqli_close($conn);

  ?>

  <div class="container">

    <div class="navDiv">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Edit the Task</a> 
      </nav> 
    </div>

    <!-- HTML form for editing a task -->
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <input class="form-control" type="hidden" name="id" value="<?php echo $task['id']; ?>">

        <div class="form-group col-6">
          <label for="title">Title:</label><br>
          <input class="form-control" type="text" name="title" id="title" value="<?php echo $task['title']; ?>">
        </div>

        <div class="form-group col-6">
          <label for="description">Description:</label>
          <textarea class="form-control" name="description" id="description"><?php echo $task['description']; ?></textarea>
        </div>
        
        <div class="form-group col-3">
          <label for="person">Person:</label>
          <select class="form-control" name="person" id="person">
            <?php
              // Connect to the database and retrieve all persons
              $conn = mysqli_connect($host, $username, $password, $dbname);
              $sql = "SELECT * FROM persons";
              $result = mysqli_query($conn, $sql);

              // Iterate over each person and output an option element
              while ($row = mysqli_fetch_assoc($result)) {
                $selected = ($row['id'] == $task['person_id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['name']} {$row['first_name']}</option>";
              }

              mysqli_close($conn);
            ?>
          </select>
        </div>     

        <div class="form-group col-3">
          <label for="type">Type:</label>
          <select class="form-control" name="type" id="type">
            <?php
              // Connect to the database and retrieve all task types
              $conn = mysqli_connect($host, $username, $password, $dbname);
              $sql = "SELECT * FROM task_types";
              $result = mysqli_query($conn, $sql);

              // Iterate over each task type and output an option element
              while ($row = mysqli_fetch_assoc($result)) {
                $selected = ($row['id'] == $task['task_type_id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
              }

              mysqli_close($conn);
            ?>
          </select>
        </div>

        <div class="form-group col-3">
          <label for="due_date">Due Date:</label>
          <input class="form-control" type="date" name="due_date" id="due_date" value="<?php echo $task['due_date']; ?>"><br><br>
        </div>  

        <div class="form-group col-3">
          <input class='btn btn-primary' type="submit" name="submit" value="Save">
          <button type="button" class="btn btn-secondary" onclick="location.href='tasks.php';">Cancel</button>
        </div> 

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
</html>