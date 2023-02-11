<!DOCTYPE html>
<html>
<head>
  <title>To-Do Website</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="container">

    <div class="navDiv">
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Admin</a> 
        <a class="nav-item nav-link active" href="tasks.php">Tasks Site</a>
      </nav> 
    </div>

    <div>
      <!-- HTML form for adding a person -->
      <form action="addPerson.php" method="post">
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">First Name</label>
          <div class="col-sm-10">
            <input name="name" type="text" class="form-control" id="name" placeholder="First Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="first_name" class="col-sm-2 col-form-label">Last Name</label>
          <div class="col-sm-10">
            <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="mail_address" class="col-sm-2 col-form-label">E-Mail Address</label>
          <div class="col-sm-10">
            <input name="mail_address" type="text" class="form-control" id="mail_address" placeholder="E-Mail Address">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <input type="submit" name="submit" class="btn btn-primary" value="Add Person">
          </div>
        </div>
      </form>
    </div>
    
    <div>
      <!-- HTML form for adding a task type -->
      <form action="addType.php" method="post">
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input name="name" type="text" class="form-control" id="name" placeholder="Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="color" class="col-sm-2 col-form-label">Color</label>
          <div class="col-sm-10">
            <input name="color" type="color" class="form-control" id="color" placeholder="color">
          </div>
        </div>
        <div class="form-group row">
          <label for="due_date" class="col-sm-2 col-form-label">Due Date (in days)</label>
          <div class="col-sm-10">
            <input name="due_date" type="text" class="form-control" id="due_date" placeholder="Due Date (in days)">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <input type="submit" name="submit" class="btn btn-primary" value="Add Type">
          </div>
        </div>
      </form>
    </div>  

    <div>
      <form method="post" enctype="multipart/form-data" action="importTask2.php">
        <label for="import_file">Import File:</label>
        <input type="file" name="import_file" accept=".json, .xml">
        <input type="submit" value="Import">
      </form>
    </div>

  </div>
</body>
</html>