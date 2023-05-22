## IntoCODE Social Network
This project aims to create a network of users, posts, and comments using SQL. The SQL language, which stands for Structured Query Language, is a programming language used for managing relational databases. It allows you to define the structure of your database, store and retrieve data, and perform various operations on the data.

In this project, the objective is to create several tables to represent different entities in the network:

# use the file intocode network.sql to insert data on your database

The "users" table stores information about the users, such as their names, email addresses, passwords, registration dates, and profile photos.

The "posts" table represents the posts created by users. It contains fields for the post's title, content, status, privacy settings, and creation and last change dates. The "user_ID" field establishes a relationship between the posts and the users who created them using a foreign key constraint.

The "commentary" table is used to store comments made by users on specific posts. It includes fields for the user ID, post ID, comment content, reply ID (for replies to other comments), and creation and last change dates. The "user_ID" and "post_ID" fields establish relationships with the respective users and posts using foreign key constraints.

The "friendship" table represents the relationships between users. It has two fields, "friend_ID" and "user_ID," indicating that a user (identified by "user_ID") is friends with another user (identified by "friend_ID"). The "creation_date" field stores the date when the friendship was established. This table also utilizes foreign key constraints to link the user IDs.

The "shared" table is used to track which users have shared (or reposted) specific posts. It has two fields, "user_ID" and "post_ID," indicating that a user (identified by "user_ID") has shared a post (identified by "post_ID"). The "creation_date" field stores the date when the sharing occurred. Like the previous tables, this table also employs foreign key constraints.

These tables, along with their relationships and constraints, form a network of users, posts, and comments. They allow users to create posts, comment on posts, establish friendships, and share posts within the network. The SQL language is used to perform queries and manipulations on the data stored in these tables, enabling functionalities like retrieving posts, adding comments, and managing user relationships.

**SQL Queries**


## 1. Select all posts.
SELECT title, content FROM posts;

## 2. Select the title and content of the first three posts.
SELECT title, content 
FROM posts
LIMIT 3;

## 3. Select all comments for a specific post.
SELECT * FROM commentary WHERE post_ID = 1;

## 4. Select the title of the last post with the first two comments.
SELECT posts.title, posts.content, commentary.comment, commentary.creation_date
FROM (SELECT * FROM posts ORDER BY post_ID DESC LIMIT 1) posts
INNER JOIN commentary ON posts.post_ID = commentary.post_ID
LIMIT 2;

## 5. Select all friends of a user.
SELECT u.first_name, u.last_name
FROM friendship f
INNER JOIN users u ON f.friend_ID = u.user_ID
WHERE f.user_ID = 3; 
-- Here are all friends from User_ID = 3 (Bilal)


## 6. Update the data of a user.
UPDATE users
SET email_address = "matheus.zago@hs-hannover.de"
WHERE user_ID = 10;
-- With this code, you update the email address for Matheus Zago


## 7. Update the content of a post.
UPDATE posts
SET content = 'HTML is the standard markup language used to create web pages. Professor Schult taught HTML and CSS in the INTOcode course.' 
WHERE post_ID = 3;
-- With this code, you update the post content about HTML


Please note that these queries assume you have the appropriate tables and columns in your database schema. Adjust the table and column names as needed for your specific setup.
