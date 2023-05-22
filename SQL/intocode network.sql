CREATE TABLE users (
  user_ID int(10) NOT NULL AUTO_INCREMENT,
  vorname varchar(150),
  nachname varchar(150) NOT NULL,
  email_address varchar(50) NOT NULL,
  password TEXT NOT NULL,
  registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  photo varchar(100),
  PRIMARY KEY (user_ID)
);

CREATE TABLE posts (
  post_ID int(10) NOT NULL AUTO_INCREMENT,
  user_ID int(10) NOT NULL,
  title varchar(150),
  content varchar(250),
  status varchar(150),
  private varchar(150),
  creation_date varchar(150),
  lastchange_date varchar(150),
  PRIMARY KEY (post_ID),
  FOREIGN KEY (user_ID) REFERENCES users(user_ID)
);

CREATE TABLE commentary (
  comment_ID int(10) NOT NULL AUTO_INCREMENT,
  user_ID int(10) NOT NULL,
  post_ID int(10) NOT NULL,
  content varchar(150),
  reply_ID varchar(100),
  creation_date varchar(150),
  lastchange_date varchar(150),
  PRIMARY KEY (comment_ID),
  FOREIGN KEY (user_ID) REFERENCES users(user_ID),
  FOREIGN KEY (post_ID) REFERENCES posts(post_ID)
);

CREATE TABLE friendship (
  friend_ID int(10) NOT NULL,
  user_ID int NOT NULL,
  creation_date varchar(150),
  PRIMARY KEY (friend_ID, user_ID),
  FOREIGN KEY (user_ID) REFERENCES users(user_ID),
  FOREIGN KEY (friend_ID) REFERENCES users(user_ID)
);


CREATE TABLE shared (
  user_ID int NOT NULL,
  post_ID int NOT NULL,
  creation_date varchar(150),
  PRIMARY KEY (user_ID, post_ID),
  FOREIGN KEY (user_ID) REFERENCES users(user_ID),
  FOREIGN KEY (post_ID) REFERENCES posts(post_ID)
);



INSERT INTO users (nachname, vorname, email_address, password, photo)
VALUES
('Masri', 'Abdulrahman', 'noreply@hs-hannover.de', 'k8Hc#E9$m4', 'documents/profile_photos/abdulrahman_masri.jpg'),
('Al Nasouh', 'Mohammad', 'mohammad.al-nasouh@stud.hs-hannover.de', 'sT7@fj#oP2', 'documents/profile_photos/mohammad_alnasouh.jpg'),
('Alam', 'Ahmad Bilal', 'noreply@hs-hannover.de', 'g5$dF8#mL3', 'documents/profile_photos/ahmad_bilal_alam.jpg'),
('Alhalabe', 'Tammam', 'noreply@hs-hannover.de', 'x7Z#k2vM1', 'documents/profile_photos/tammam_alhalabe.jpg'),
('Assoss', 'Bilal', 'bilal.assoss@hs-hannover.de', 'q6@lN3$hR5', 'documents/profile_photos/bilal_assoss.jpg'),
('Ergün', 'Gizem', 'gizem.erguen@hs-hannover.de', 'w2#sF9$qP1', 'documents/profile_photos/gizem_ergun.jpg'),
('Haji', 'Diyar', 'noreply@hs-hannover.de', 'r9$K4#xW5',  'documents/profile_photos/diyar_haji.jpg'),
('Hrachova', 'Kateryna', 'noreply@hs-hannover.de', 'y5@vM3$tG8', 'documents/profile_photos/kateryna_hrachova.jpg'),
('Inostroza Piedra', 'Andres', 'noreply@hs-hannover.de', 'd7@xV2$pL1', 'documents/profile_photos/andres_inostroza_piedra.jpg'),
('Jones Zago', 'Matheus', 'noreply@hs-hannover.de', 'm9$bF3#hX8', 'documents/profile_photos/matheus_jones_zago.jpg'),
('Kirhet', 'Oleksandr', 'noreply@hs-hannover.de', 'a5#rM8$nZ3', 'documents/profile_photos/oleksandr_kirhet.jpg'),
('Parkhomchuk', 'Liudmyla', 'parkhomchuk.liudmyla@stud.hs-hannover.de', 'h6$tE5#xG1', 'documents/profile_photos/liudmyla_parkhomchuk.jpg'),
('Panthulu', 'Praveen', 'noreply@hs-hannover.de', 'z8$qR2#lF4', 'documents/profile_photos/praveen_panthulu.jpg'),
('Schnehage', 'Tim-Lars', 'tim-lars.schnehage@hs-hannover.de', '12343%$&43','documents/profile_photos/tim-lars.jpg'),
('Schult', 'Thomas J.', 'ThomasJ.Schult@hs-hannover.de', '12343%$&43', 'documents/profile_photos/Schult.jpg'),
('Yousufzai', 'Fahim Ahmad', 'noreply@hs-hannover.de', 'r9$K4#xW5', 'documents/profile_photos/Fahim.jpg');


INSERT INTO posts (user_ID, title, content, status, private, creation_date, lastchange_date) VALUES
(1, 'Introduction to Python', 'Python is a powerful programming language that is easy to learn and use. It is widely used in scientific computing, data analysis, and web development.', 'published', 'public', '2023-05-08 13:30:00', '2023-05-08 13:30:00'),
(2, 'Java for Beginners', 'Java is an object-oriented programming language that is widely used for developing web applications and Android mobile apps. This post is an introduction to Java for beginners.', 'published', 'public', '2023-05-08 13:35:00', '2023-05-08 13:35:00'),
(3, 'Getting Started with HTML', 'HTML is the standard markup language used to create web pages. This post will give you a brief introduction to HTML and how to create your first webpage.', 'published', 'public', '2023-05-08 13:40:00', '2023-05-08 13:40:00'),
(4, 'CSS Basics', 'CSS is a language used to style web pages. In this post, we will cover the basics of CSS, including how to select elements and apply styles to them.', 'published', 'public', '2023-05-08 13:45:00', '2023-05-08 13:45:00'),
(5, 'JavaScript Fundamentals', 'JavaScript is a programming language used to create dynamic web pages and web applications. This post will cover the fundamentals of JavaScript, including variables, data types, and functions.', 'published', 'public', '2023-05-08 13:50:00', '2023-05-08 13:50:00'),
(6, 'Python Libraries for Data Science', 'Python has become the most popular language for data science. This post will introduce some of the most popular Python libraries for data science, including NumPy, Pandas, and Matplotlib.', 'published', 'public', '2023-05-08 13:55:00', '2023-05-08 13:55:00'),
(7, 'Object-Oriented Programming in C++', 'C++ is an object-oriented programming language widely used in game development, system programming, and high-performance computing. This post will cover the basics of object-oriented programming in C++.', 'published', 'public', '2023-05-08 14:00:00', '2023-05-08 14:00:00'),
(8, 'Web Development with Ruby on Rails', 'Ruby on Rails is a popular web application framework written in the Ruby programming language. This post will introduce the basics of Ruby on Rails and how to build web applications with it.', 'published', 'public', '2023-05-08 14:05:00', '2023-05-08 14:05:00'),
(9, 'Introduction to SQL', 'SQL is a language used to manage relational databases. This post will introduce the basics of SQL, including how to create tables, insert data, and query data.', 'published', 'public', '2023-05-08 14:10:00', '2023-05-08 14:10:00'),
(10, 'Version Control with Git', 'Git is a distributed version control system used by developers to track changes in their code' , 'published', 'public', '2023-05-08 14:10:00', '2023-05-08 14:10:00');

INSERT INTO commentary (user_ID, post_id, content, reply_ID, creation_date, lastchange_date) VALUES
(1, 2, 'Great introduction to Python!', 2, '2023-05-08 14:30:00', '2023-05-08 14:30:00'),
(2, 3, 'I found this post very helpful. Thank you!', 3, '2023-05-08 14:35:00', '2023-05-08 14:35:00'),
(3, 1, 'Im excited to learn more about HTML.', 4, '2023-05-08 14:40:00', '2023-05-08 14:40:00'),
(4, 5, 'CSS can be tricky to learn, but this post makes it easier!', 5, '2023-05-08 14:45:00', '2023-05-08 14:45:00'),
(5, 7, 'JavaScript is a powerful language that Im looking forward to mastering.', 6, '2023-05-08 14:50:00', '2023-05-08 14:50:00'),
(6, 8, 'Im already familiar with some of these libraries, but this post gave me some new ideas for my projects.', 7, '2023-05-08 14:55:00', '2023-05-08 14:55:00'),
(7, 3, 'C++ is a bit intimidating, but this post is a great starting point.', 8, '2023-05-08 15:00:00', '2023-05-08 15:00:00'),
(8, 9, 'I ve been interested in Ruby on Rails for a while, and this post gave me a good overview of the basics.', 9, '2023-05-08 15:05:00', '2023-05-08 15:05:00'),
(9, 4, 'SQL is a must-know for anyone working with databases. Thanks for the intro!', 10, '2023-05-08 15:10:00', '2023-05-08 15:10:00'),
(10, 5, 'I use Git every day, but it never hurts to brush up on the basics.', 11, '2023-05-08 15:15:00', '2023-05-08 15:15:00'),
(1, 2, 'I ve been using Python for a while, and I still learned something new from this post.', 2, '2023-05-08 15:20:00', '2023-05-08 15:20:00'),
(2, 2, 'This post is a great starting point for anyone new to Java.', 3, '2023-05-08 15:25:00', '2023-05-08 15:25:00'),
(3, 4, 'I can t wait to start building my own websites with HTML!', 4, '2023-05-08 15:30:00', '2023-05-08 15:30:00'),
(4, 5, 'CSS can be frustrating, but this post is helping me understand it better.', 5, '2023-05-08 15:35:00', '2023-05-08 15:35:00');

INSERT INTO friendship (friend_ID, user_ID, creation_date) VALUES
(2, 1, '2023-05-08 15:30:00'),  -- user 1 is friends with user 2
(3, 1, '2023-05-08 15:31:00'),  -- user 1 is friends with user 3
(4, 1, '2023-05-08 15:32:00'),  -- user 1 is friends with user 4
(5, 1, '2023-05-08 15:33:00'),  -- user 1 is friends with user 5
(6, 1, '2023-05-08 15:34:00'),  -- user 1 is friends with user 6
(7, 2, '2023-05-08 15:35:00'),  -- user 2 is friends with user 7
(8, 2, '2023-05-08 15:36:00'),  -- user 2 is friends with user 8
(9, 2, '2023-05-08 15:37:00'),  -- user 2 is friends with user 9
(10, 2, '2023-05-08 15:38:00'), -- user 2 is friends with user 10
(11, 3, '2023-05-08 15:39:00'), -- user 3 is friends with user 11
(12, 3, '2023-05-08 15:40:00'), -- user 3 is friends with user 12
(13, 3, '2023-05-08 15:41:00'); -- user 3 is friends with user 13

