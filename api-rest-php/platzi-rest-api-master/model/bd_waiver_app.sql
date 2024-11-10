CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_birth DATE,
    username VARCHAR(100),
    middlename VARCHAR(100),
    lastname VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    signed_consent VARCHAR(20)
);

CREATE TABLE child (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    child_name VARCHAR(100),
    child_middlename VARCHAR(100),
    child_lastname VARCHAR(100),
    child_date_of_birth DATE,
    CONSTRAINT fk_guardian FOREIGN KEY (user_id) REFERENCES users(id)
);




-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     date_birth DATE,
--     username VARCHAR(100),
--     middlename VARCHAR(100),
--     lastname VARCHAR(100),
--     email VARCHAR(100),
--     phone VARCHAR(20),
--     signed_consent VARCHAR(20)
--     CONSTRAINT chk_name CHECK (username REGEXP '^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$'),
--     CONSTRAINT chk_middle CHECK (middlename REGEXP '^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$'),
--     CONSTRAINT chk_lastname CHECK (lastname REGEXP '^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$'),
--     CONSTRAINT chk_email CHECK (email REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
--     CONSTRAINT chk_phone CHECK (phone REGEXP '^\+[0-9]{1,3}-[0-9]{3}-[0-9]{3}-[0-9]{4}$')
-- );


-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     date_birth DATE,
--     username VARCHAR(100),
--     middlename VARCHAR(100),
--     lastname VARCHAR(100),
--     email VARCHAR(100),
--     phone VARCHAR(20),
--     signed_consent VARCHAR(20)
-- );