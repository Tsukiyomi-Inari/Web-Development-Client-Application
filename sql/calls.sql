-- @author : Katherine Bellman
-- @student-ID: 100325825
-- @course: WEBD3201
-- @date: October 12th 2021

DROP TABLE IF EXISTS calls;

DROP SEQUENCE IF EXISTS call_id_seq CASCADE;
CREATE SEQUENCE call_id_seq START 9000;

CREATE TABLE calls (
    call_id INT PRIMARY KEY DEFAULT nextval('call_id_seq'),
    client_id INT,
    call_time TIMESTAMP,
    call_note VARCHAR,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

INSERT INTO calls ( client_id, call_time, call_note )  
VALUES(5000,'2020-06-22 19:10:25', 'post-register call');

INSERT INTO calls ( client_id, call_time, call_note ) 
VALUES(5001,'2020-08-10 12:15:26', 'courtesy introduction call');

SELECT * FROM calls;