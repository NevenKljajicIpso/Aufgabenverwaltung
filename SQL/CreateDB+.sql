CREATE DATABASE todo;

USE todo;

CREATE TABLE persons (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);

-- Insert 3 persons
INSERT INTO persons (name, first_name, email)
VALUES 
('Potter', 'Harry', 'harry.potter@Zmail.com'),
('Parker', 'Peter', 'spidey.parker@Smail.com'),
('Baumeister', 'Bob', 'bob.B@Bmail.com');

CREATE TABLE task_types (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  color VARCHAR(255) NOT NULL,
  due_days VARCHAR(255) NOT NULL
);

-- Insert 3 task types
INSERT INTO task_types (name, color, due_days)
VALUES 
('A', 'blue', '14'),
('B', 'green', '7'),
('C', 'red', '1');

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

-- Insert 8 random tasks
INSERT INTO tasks (title, description, person_id, task_type_id, due_date, completed)
VALUES
('Clean', 'Clean the toilet', 3, 3, '2023-05-20', 0),
('Shopping', 'Buy 1 KG Banana', 3, 2, '2023-05-02', 0),
('Ollivanders', 'Choose a Wand', 1, 3, '2023-06-03', 0),
('Work', 'Save NYC', 2, 3, '2023-08-11', 0),
('Relationship', 'Go see Mary Jane', 2, 1, '2023-05-28', 0),
('Relationship', 'Have fun with Ron and Hermione', 1, 1, '2023-05-06', 0),
('School', 'Finish the Project', 2, 2, '2023-09-25', 0),
('Shopping', 'Buy Bricks', 3, 2, '2023-10-10', 0);

-- Create a user for the database
CREATE USER 'tester'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON todo.* TO 'tester'@'localhost';