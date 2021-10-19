-- @author : Katherine Bellman
-- @student-ID: 100325825
-- @course: WEBD3201
-- @date: October 12th 2021

DROP TABLE IF EXISTS clients;

DROP SEQUENCE IF EXISTS client_id_seq CASCADE;
CREATE SEQUENCE client_id_seq START 5000;

CREATE TABLE clients (
    client_id INT PRIMARY KEY DEFAULT nextval('client_id_seq'),
    first_name VARCHAR(128),
    last_name VARCHAR(128), 
    phone_number CHAR(10),
    extension   INT, 
    email_address VARCHAR(255) UNIQUE,
    salesperson_id INT NOT NULL
    FOREIGN KEY (salesperson_id) REFERENCES users(Id)
    );


INSERT INTO clients (first_name, last_name, phone_number, email_address,salesperson_id ) 
VALUES ('Matt', 'Bellman', '9054563425','matthew.bellman@dcmail.ca', 1000);

INSERT INTO clients (first_name, last_name, phone_number, email_address,salesperson_id ) 
VALUES ('Johanna', 'Bellman', '9056792345','matthew.bellman@dcmail.ca', 1002);

SELECT * FROM client_id;
