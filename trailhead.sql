
CREATE TABLE IF NOT EXISTS USERS (
  uname varchar(255),
  pass varchar(255),
  email varchar(255),
  id int,
  PRIMARY KEY(uname, pass, email, id)
);


CREATE TABLE IF NOT EXISTS ADMINISTRATION (
  adminid int,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS COURSES (
  courseid varchar(255),
  coursename varchar(255),
  PRIMARY KEY(courseid)
);

CREATE TABLE IF NOT EXISTS SCHEDULES (
  studentid int NOT NULL,
  courseid varchar(255),
  PRIMARY KEY(studentid, courseid)
);


CREATE TABLE IF NOT EXISTS STUDENTS (
  studentid int(11) NOT NULL,
  firstname text NOT NULL,
  lastname text NOT NULL,
  PRIMARY KEY(studentid)
);

INSERT INTO COURSES VALUES 
("CSCI406","Algorithms"),
("CSCI441","Computer Graphics"),
("CSCI445","Web Programming");
