<?php

// Include the database connection file
include('db_connection.php');

// Check if the form has been submitted
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
    // Update the task in the database
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

<!-- HTML form for editing a task -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
  <label for="title">Title:</label><br>
  <input type="text" name="title" id="title" value="<?php echo $task['title']; ?>"><br>
  <label for="description">Description:</label><br>
  <textarea name="description" id="description"><?php echo $task['description']; ?></textarea><br>
  <label for="person">Person:</label><br>
  <select name="person" id="person">
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

      // Close the database connection
      mysqli_close($conn);
    ?>
  </select>
  <br>
  <label for="type">Type:</label><br>
  <select name="type" id="type">
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

      // Close the database connection
      mysqli_close($conn);
    ?>
  </select>
  </br>
  <label for="due_date">Due Date:</label><br>
  <input type="date" name="due_date" id="due_date" value="<?php echo $task['due_date']; ?>"><br><br>
  <input type="submit" name="submit" value="Save">
</form>
