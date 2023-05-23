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
    } elseif (isset($_POST["update"])) {
        $updateID = $_POST["update"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $publishingYear = $_POST["publishing_year"];
        $publisherID = $_POST["publisher_id"];

        // Prepare the SQL query using prepared statements
        $updateQuery = "UPDATE Books SET Title = ?, description = ?, publishing_year = ?, publisher_id = ? WHERE ID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssiii", $title, $description, $publishingYear, $publisherID, $updateID);

        if ($updateStmt->execute()) {
            echo "Book updated successfully.";
        } else {
            echo "Error updating the book: " . $updateStmt->error;
        }

        $updateStmt->close();
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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $searchTerm = $_GET["search"];

    $query = "SELECT * FROM Books WHERE Title LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Search result</h2>";
        echo "<table class='book-table'>";
        echo "<tr><th>Book ID</th><th>Title</th><th>Description</th><th>Publishing Year</th><th>Publisher ID</th><th>Edit</th><th>Delete</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['publishing_year'] . "</td>";
            echo "<td>" . $row['publisher_id'] . "</td>";
            echo "<td>
                <form method='POST' action=''>
                <input type='hidden' name='edit' value='" . $row['ID'] . "'>
                <!-- <button type='submit' name='edit_button' class='edit-button'>Edit</button> -->
                <a href='edit.php?id=" . $row['ID'] . "'>Edit 123</a>
            </form>
            </td>";
            echo "<td>
                    <form method='POST' action=''>
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

    $stmt->close();
} else {
    $query = "SELECT * FROM Books";
    $result = $conn->query($query);

    echo "<h2>Book list</h2>";
    echo "<table class='book-table'>";
    echo "<tr><th>Book ID</th><th>Title</th><th>Description</th><th>Publishing Year</th><th>Publisher ID</th><th>Edit</th><th>Delete</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['publishing_year'] . "</td>";
        echo "<td>" . $row['publisher_id'] . "</td>";
        echo "<td>
                <form method='POST' action='edit.php?id=" . $row['ID'] . "'>
                    <input type='hidden' name='edit' value='" . $row['ID'] . "'>
                    <button type='submit' name='edit_button' class='edit-button'>Edit</button>
                </form>
            </td>";
        echo "<td>
                <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
                    <input type='hidden' name='delete' value='" . $row['ID'] . "'>
                    <button type='submit' name='delete_button' class='delete-button'>Delete</button>
                </form>
            </td>";
        echo "</tr>";
    }
    echo "</table>";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Add a new book</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <br><br>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <br><br>
        <label for="publishing_year">Publishing Year:</label>
        <input type="number" name="publishing_year" required>
        <br><br>
        <label for="publisher_id">Publisher ID:</label>
        <input type="number" name="publisher_id" required>
        <br><br>
        <button type="submit">Add Book</button>
    </form>
    <h2>Search books</h2>
    <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="search">Search term:</label>
        <input type="text" name="search" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
