CREATE DATABASE todo;

USE todo;

CREATE TABLE persons (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);

CREATE TABLE task_types (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  color VARCHAR(255) NOT NULL,
  due_days VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  person_id INT NOT NULL,
  task_type_id INT NOT NULL,
  due_date VARCHAR(255) NOT NULL,
  completed TINYINT(1) NOT NULL,
  FOREIGN KEY (person_id) REFERENCES persons(id),
  FOREIGN KEY (task_type_id) REFERENCES task_types(id)
);
