<!DOCTYPE html>
<html>
<head>
  <title>Aufgabenverwaltung</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="container">
    
    <div class="navDiv">
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Tasks</a> 
        <a class="nav-item nav-link active" href="admin.php">Admin Site</a>
      </nav> 
    </div>

    <div>
      <button type="button" class="btn btn-primary" onclick="document.location='createNewTask.php'">Create a new Task</button>
    </div>

    </br>
    
    <div>
      <?php include 'displayTasks.php'; ?>
    </div>  

  </div>

</body>
</html>
