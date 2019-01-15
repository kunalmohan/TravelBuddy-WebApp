# TravelBuddy-WebApp

**Instructions-**

The project requires PHP and MySQL in their system. To store the user data for the webapp you will need to create two tables in MySQL database. First you need to create a database in MySQL and select it. To do so run the following commands in MySQL-

    CREATE DATABASE TravelBuddy;
    USE TravelBuddy;

(You may use database name of your choice.)
Run the following commands in MySQL to create tables in this database-

    CREATE TABLE members(id INT AUTO_INCREMENT, fname VARCHAR(50), lname VARCHAR(50), dobirth DATE, gender VARCHAR(10), email VARCHAR(50), mobileno VARCHAR(10), username VARCHAR(50), password VARCHAR(50), PRIMARY KEY(id));
    CREATE TABLE triplist(id INT AUTO_INCREMENT, username VARCHAR(50), tripdate DATE, dest VARCHAR(50), descrp VARCHAR(255), PRIMARY KEY(ID));

In “connect.php” you need to enter the database name, username and password (for accessing MySQL tables through PHP)(**Note:** The user should have all the privileges for that database) in the respective variables.
You are now ready to run the webapp.

**About the Project-**

The aim of this project was to make a web application where students can post their future travel plans so that other people who want to travel to the same place around the same time can view and contact them if they are looking for a travel companion.

The website consists of the following pages-
- Home- The first page where the user will initially be directed.
- Login and Register- New users can register themselves and existing users can login. Each user has unique username.
- Profile- Users can view and edit their profile information and change passwords.
- Manage Trips- User can view the trips they have added, add new trips and delete existing trips.
- Calendar- Page where users can view the planned trips of all registered users. To view the trips on a particular date you can click on that date in the calendar. To view the user information of a user you can click on the name of the user in the trip list (But you must be logged in to view other users’ information).

The webapp will automatically delete trips of all users that are older than the present date. The Webapp is completely responsive.
