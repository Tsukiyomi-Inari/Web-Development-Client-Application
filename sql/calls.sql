-- @author : Katherine Bellman
-- @student-ID: 100325825
-- @course: WEBD3201
-- @date: October 12th 2021

DROP TABLE IF EXISTS calls;

DROP SEQUENCE IF EXISTS call_id_seq CASCADE;
CREATE SEQUENCE call_id_seq START 1000;

CREATE TABLE calls (
    id INT PRIMARY KEY DEFAULT nextval('calls_id_seq'),
    client_name VARCHAR(128),
    call_time TIMESTAMP
   
);

INSERT INTO calls ('Matt' ,'2020-06-22 19:10:25');
