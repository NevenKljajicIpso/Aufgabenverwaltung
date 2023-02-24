<?php

// Include the database connection file
include('db_connection.php');

// Retrieve all task types from the database
$sql_TaskTypes = "SELECT * FROM task_types";
$result_TaskTypes = mysqli_query($conn, $sql_TaskTypes);

echo "<div class='container'>";
// Create a form to filter the tasks by task type
echo "<form class='form-inline' method='post'>";
echo "<div class='form-group col-md-2'>";
echo "<label>Filter by Task Type: </label>";
echo "</div>";
echo "<div class='form-group col-md-2'>";
echo "<select id='inputState' class='form-control' name='task_type_id'>";
echo "<option value=''>All</option>";
while ($row = mysqli_fetch_assoc($result_TaskTypes)) {
  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";
echo "</div>";
echo "<div class='form-group col-md-1'>";
echo "<input class='btn btn-primary' type='submit' value='Filter'>";
echo "</div>";
echo "</form>";
echo "</br>";

// Retrieve all tasks from the database
$sql_Tasks = "SELECT * FROM tasks WHERE completed = 0";

// If a task type was selected, filter the tasks by that task type
if (isset($_POST['task_type_id']) && !empty($_POST['task_type_id'])) {
  $task_type_id = mysqli_real_escape_string($conn, $_POST['task_type_id']);
  $sql_Tasks .= " AND task_type_id = '$task_type_id'";
}

$sql_Tasks .= " ORDER BY due_date ASC;";

$result_Tasks = mysqli_query($conn, $sql_Tasks);

if (mysqli_num_rows($result_Tasks) > 0) {
    // Output the tasks in a table
      echo '<table class="table">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Person</th>
                  <th scope="col">Task Type</th>
                  <th scope="col">Due Date</th>
                </tr>
              </thead>';
    while($row = mysqli_fetch_assoc($result_Tasks)) {
      // Get the person and task type names from the corresponding tables
      $person_sql = "SELECT name, first_name FROM persons WHERE id = " . $row['person_id'];
      $person_result = mysqli_query($conn, $person_sql);
      $person = mysqli_fetch_assoc($person_result);
  
      $task_type_sql = "SELECT * FROM task_types WHERE id = " . $row['task_type_id'];
      $task_type_result = mysqli_query($conn, $task_type_sql);
      $task_type = mysqli_fetch_assoc($task_type_result);
  
      $task_color_sql = "SELECT color FROM task_types WHERE id = " . $row['task_type_id'];
      $task_color_result = mysqli_query($conn, $task_color_sql);
      $task_color = mysqli_fetch_assoc($task_color_result);
  
      
      // Check if the task is within its deadline
      $current_date = time();
      $due_date = strtotime($row['due_date']);
      $deadline = $task_type['due_days'] * 86400;  // Calculate deadline in seconds
  
      if ($current_date < $due_date && $due_date <= $current_date + $deadline) {
          // Task is within its deadline, use the color specified for its task type
          $task_color = $task_color['color'];
      } else {
          // Task is not within its deadline, use a default color
          $task_color = '#ffffff';
      }
  
      // Output the task data
      echo "<tr style='background-color: " . $task_color . "'>";
      echo '<th scope="row"></th>';
      echo "<td>" . $row['title'] . "</td>";
      echo "<td>" . $row['description'] . "</td>";
      echo "<td>" . $person['name'] . " " . $person['first_name'] . "</td>";
      echo "<td>" . $task_type['name'] . "</td>";
      echo "<td>" . $row['due_date'] . "</td>";
      echo "<td><a href='editTask.php?id=" . $row['id'] . "'>Edit</a><br></td>";
      echo "<td><a href='deleteTask.php?id=" . $row['id'] . "'>Delete</a><br></td>";
      echo "<td><a href='markTask.php?id=" . $row['id'] . "'>Done</a><br></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "";
  } else {
    echo "No tasks found";
  }
  
  mysqli_close($conn);
  
  ?>
<footer class="bg-light text-center text-lg-start fixed-bottom">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-dark" href="#">Neven Kljajić</a>
  </div>
  <!-- Copyright -->
</footer>
</div>