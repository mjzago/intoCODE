To create the "bookstore" database, you can use the following SQL code:

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


Test
