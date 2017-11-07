# Simple CakePHP Blog

A simple blog created using the CakePHP framework.

## Setup of the database

### Create the users table
```
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(20),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);
```

### Create the posts table
```
CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    body TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    user_id INT(11)
);
```

## Setting up database.php
Begin by copying `/app/Config/database.php.default` to `/app/Config/database.php`.
Configure the file accordingly, by entering your database details such as username and password.
