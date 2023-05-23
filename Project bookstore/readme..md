The "Bookstore" project is a web application that allows managing books in a database. The main purpose is to store information about books, such as title, description, publishing year, and publisher ID. The application features the following functionalities:

1. Add Book: Allows adding new books to the database. To add a book, the user needs to provide the title, description, publishing year, and publisher ID.

2. List Books: Displays a list of all books in the database. The list shows the book ID, title, description, publishing year, and publisher ID. It is also possible to delete a book from the list.

3. Search Book: Enables searching for books by title. The user can enter a search term, and the application will return books whose titles partially match the search term.

The application uses PHP for server-side logic and MySQL as the database to store the books. It includes CSS files for styling the pages, such as "book-table.css" and "book-form.css".

Make sure to provide the correct database credentials (host, username, password) in the code to establish a successful connection to the database.

To start first create your Databank with the following tables, and than use the index.PHP to filter and add books. 

To create the "bookstore" database, you can use the following SQL code in the PHPmyadmin:

```sql
CREATE DATABASE bookstore;
```

This code will create a new database named "bookstore".

After creating the database, you can then proceed to create the necessary tables within the "bookstore" database. Based on your previous table structure, you can use the following SQL code to create the "publisher" table:

```sql
CREATE TABLE publisher (
    publisher_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(50) COLLATE latin1_swedish_ci NOT NULL
);
```

Now create the "Books" table

```sql
CREATE TABLE Books (
    ID INT(11) PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(50) COLLATE latin1_swedish_ci NOT NULL,
    description VARCHAR(150) COLLATE latin1_swedish_ci NOT NULL,
    publishing_year INT(4) NOT NULL,
    publisher_id INT(11) NOT NULL,
    FOREIGN KEY (publisher_id) REFERENCES publisher(publisher_id)
);
```

This code will create a table named "Books" with the specified columns: ID, Title, description, publishing_year, and publisher_id. The ID column is defined as the primary key with auto-increment, ensuring each record has a unique identifier.



After creating the tables, you can proceed to insert data into them using the following SQL INSERT statements:

```sql
-- Inserting data into the "publisher" table
INSERT INTO publisher (Title)
VALUES ('Publisher A'), ('Publisher B'), ('Publisher C');

-- Inserting data into the "Books" table
INSERT INTO Books (Title, description, publishing_year, publisher_id)
VALUES ('Book 1', 'Description 1', 2021, 1),
       ('Book 2', 'Description 2', 2022, 2),
       ('Book 3', 'Description 3', 2023, 3);
       ```
These INSERT statements will insert sample data into the "publisher" and "Books" tables. Adjust the values and number of rows as needed for your specific data.


