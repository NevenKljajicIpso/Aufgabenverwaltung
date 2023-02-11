<?php

// Include the database connection file
include('db_connection.php');

    // Check if a file has been uploaded
    if (!empty($_FILES['import_file']['name'])) {
        // Get the file extension
        $file_extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);

        if ($file_extension == 'json') {
            // Import the JSON file
            $import_data = file_get_contents($_FILES['import_file']['tmp_name']);
            $tasks = json_decode($import_data, true);

            // Add each task to the database
            foreach ($tasks as $task) {
                // Get the form data
                $title = mysqli_real_escape_string($conn, $task['title']);
                $description = mysqli_real_escape_string($conn, $task['description']);
                $person_id = mysqli_real_escape_string($conn, $task['person_id']);
                $task_type_id = mysqli_real_escape_string($conn, $task['task_type_id']);
                $due_date = mysqli_real_escape_string($conn, $task['due_date']);

                    // Check if the due date is in the past
                    if (strtotime($due_date) < time()) {
                        $error_Message = "Due date cannot be in the past";
                        echo "<script type='text/javascript'>alert('$error_message');</script>";
                    } else {
                        // Insert the task into the database
                        $sql = "INSERT INTO tasks (title, description, person_id, task_type_id, due_date) VALUES ('$title', '$description', '$person_id', '$task_type_id', '$due_date')";
                        if (mysqli_query($conn, $sql)) {
                            // added successfully task
                        } else {
                            $error_Message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                            echo "<script type='text/javascript'>alert('$error_message');</script>";
                        }
                    }
            } 
            header("Location: tasks.php");
            exit;
        } elseif ($file_extension == 'xml') {
            // Import the XML file
            $import_data = simplexml_load_file($_FILES['import_file']['tmp_name']);

            // Add each task to the database
            foreach ($import_data->task as $task) {
                // Get the form data
                $title = mysqli_real_escape_string($conn, $task->title);
                $description = mysqli_real_escape_string($conn, $task->description);
                $person_id = mysqli_real_escape_string($conn, $task->person_id);
                $task_type_id = mysqli_real_escape_string($conn, $task->task_type_id);
                $due_date = mysqli_real_escape_string($conn, $task->due_date);

                    // Check if the due date is in the past
                    if (strtotime($due_date) < time()) {
                        $error_Message = "Due date cannot be in the past";
                        echo "<script type='text/javascript'>alert('$error_message');</script>";
                    } else {
                        // Insert the task into the database
                        $sql = "INSERT INTO tasks (title, description, person_id, task_type_id, due_date) VALUES ('$title', '$description', '$person_id', '$task_type_id', '$due_date')";
                        if (mysqli_query($conn, $sql)) {
                            // added successfully task
                        } else {
                            $error_Message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                            echo "<script type='text/javascript'>alert('$error_message');</script>";
                        }
                    }
            }
            header("Location: tasks.php");
            exit;
        } 
    } else {
        header("Location: admin.php");
        exit;
    }

?>