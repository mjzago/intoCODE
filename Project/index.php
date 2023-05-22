<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="book-table.css">
</head>
<body>
  
    </form>
</body>
</html>

<style>
    .container {
        display: flex;
            }

    .column {
        margin: 10px;
        flex-basis: 50%;
    }
</style>

<div class="container">
    <div class="column">
        <link rel="stylesheet" type="text/css" href="book-form.css">
        <form class="book-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <body>
    <h2>Add New Book</h2>
    <link rel="stylesheet" type="text/css" href="book-form.css">
    <form class="book-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="publishing_year">Publishing Year:</label>
            <input type="number" name="publishing_year" id="publishing_year" required>
        </div>

        <div class="form-group">
            <label for="publisher_id">Publisher ID:</label>
            <input type="number" name="publisher_id" id="publisher_id" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Add Book" class="add-button">
            <link rel="stylesheet" type="text/css" href="book-table.css">
        </div>
    </form>
        </form>
    </div>
    
    <div class="column">
        <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h2>Search book</h2>
    <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="search">Search book title:</label>
            <input type="text" name="search" id="search" required>
            <input type="submit" value="Search">
        </div>
    </form>
</body>
</html>
        </form>
    </div>
</div>
<?php
$host = "localhost";
$username = "admin";
$password = "Mjones00";
$database = "bookstore";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}



    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
        $searchTerm = $_GET["search"];
    
        $query = "SELECT * FROM Books WHERE Title LIKE ?";
        $stmt = $conn->prepare($query);
        $searchTerm = "%" . $searchTerm . "%"; // Adiciona o caractere % para buscar o início do nome
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "<h2>Search result</h2>";
            echo "<table class='book-table'>";
            echo "<tr><th>Book ID</th><th>Title</th><th>Description</th><th>Publishing Year</th><th>Publisher ID</th><th>Delete</th></tr>";
    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['Title'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['publishing_year'] . "</td>";
                echo "<td>" . $row['publisher_id'] . "</td>";
                echo "<td>
                    <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
                        <input type='hidden' name='delete' value='" . $row['ID'] . "'>
                        <button type='submit' name='delete_button' class='delete-button'>Delete</button>
                    </form>
                </td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "Nenhum livro encontrado.";
        }
    
        $stmt->close();
    }
   
    ?>


<?php


$host = "localhost";
$username = "admin";
$password = "Mjones00";
$database = "bookstore";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $deleteID = $_POST["delete"];

        // Prepare the SQL query using prepared statements
        $deleteQuery = "DELETE FROM Books WHERE ID = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $deleteID);

        if ($deleteStmt->execute()) {
            echo "Book deleted successfully.";
        } else {
            echo "Error deleting the book: " . $deleteStmt->error;
        }

        $deleteStmt->close();
    } else {
        // Get the form values
        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        $publishingYear = isset($_POST["publishing_year"]) ? $_POST["publishing_year"] : "";
        $publisherID = isset($_POST["publisher_id"]) ? $_POST["publisher_id"] : "";

        // Prepare the SQL query using prepared statements
        $query = "INSERT INTO Books (Title, description, publishing_year, publisher_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $title, $description, $publishingYear, $publisherID);

        if ($stmt->execute()) {
            echo "New book added successfully.";
        } else {
            echo "Error adding the book: " . $stmt->error;
        }

        $stmt->close();
    }
}

$query = "SELECT * FROM Books";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="book-table.css">
</head>
<body>
   

    <h2>Book list</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='book-table'>";
        echo "<tr><th>Book ID</th><th>Title</th><th>Description</th><th>Publishing Year</th><th>Publisher ID</th><th>Delete</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['publishing_year'] . "</td>";
            echo "<td>" . $row['publisher_id'] . "</td>";
            echo "<td>
                <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
                    <input type='hidden' name='delete' value='" . $row['ID'] . "'>
                    <button type='submit' name='delete_button' class='delete-button'>Delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No books found.";
    }
    ?>
</body>
</html>
