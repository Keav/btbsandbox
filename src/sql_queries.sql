#=========================
# btbsandbox Photo Gallery
#=========================

# Create the Database
# ========================

-- Create the Database --
CREATE DATABASE IF NOT EXISTS btbsandbox COLLATE utf8_general_ci;

# Create Required Tables
# ========================

-- Create table 'users' --
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL
);

-- Create table 'photographs' --
CREATE TABLE photographs (
  id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  filename VARCHAR (255) NOT NULL,
  type VARCHAR (100) NOT NULL,
  size INT (11) NOT NULL,
  caption VARCHAR (255) NOT NULL
);

-- Create table 'comments' --
CREATE TABLE comments (
  id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  photograph_id INT (11) NOT NULL,
  created DATETIME NOT NULL,
  author VARCHAR (255) NOT NULL,
  body TEXT NOT NULL
);

-- Set 'comments' table Relational DB SECONDARY KEY --
ALTER TABLE comments ADD INDEX (photograph_id);
