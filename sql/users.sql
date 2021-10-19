-- @author : Katherine Bellman
-- @student-ID: 100325825
-- @course: WEBD3201
-- @date: September 12, 2012
CREATE EXTENSION IF NOT EXISTS pgcrypto;

DROP SEQUENCE IF EXISTS users_id_seq CASCADE;
CREATE SEQUENCE users_id_seq START 1000;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT PRIMARY KEY DEFAULT nextval('users_id_seq'),
    email_address VARCHAR(255) UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(128),
    last_name VARCHAR(128), 
    last_access TIMESTAMP,
    enrol_date TIMESTAMP,
    enable BOOLEAN,
    type VARCHAR(2)
);

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, enable, type) 
VALUES ('jdoe@dcmail.ca',crypt('some_password', gen_salt('bf')),'John', 'Doe','2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 'a');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, enable, type) 
VALUES ('jhele@dcmail.ca',crypt('that_password', gen_salt('bf')),'James', 'Hele','2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 'a');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, enable, type) 
VALUES ('kbellman@gmail.ca',crypt('got_password', gen_salt('bf')),'Keith', 'Bellman','2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 'a');

INSERT INTO users (email_address, password, first_name, last_name, last_access, enrol_date, enable, type) 
VALUES ('salem@gmail.ca',crypt('catPass', gen_salt('bf')),'Salem', 'Bellman','2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 's');


SELECT * FROM users;
