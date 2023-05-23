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

$message = ""; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bookId = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $publishingYear = $_POST['publishing_year'];
  $publisherId = $_POST['publisher_id'];

  // Update the book record in the database
  $updateQuery = "UPDATE books SET Title=?, description=?, publishing_year=?, publisher_id=? WHERE ID=?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("ssisi", $title, $description, $publishingYear, $publisherId, $bookId);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    // Book updated successfully
    $message = "Book updated successfully.";
  } else {
    // Error occurred while updating book
    $message = "Error occurred while updating the book.";
  }
}

// Retrieve the updated book details from the database
$query = "SELECT books.*, publisher.Title AS publisher_name FROM books INNER JOIN publisher ON books.publisher_id = publisher.publisher_id WHERE books.ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
}

// Retrieve all publishers for populating the options
$publisherQuery = "SELECT * FROM publisher";
$publisherResult = $conn->query($publisherQuery);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Book</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Update Book</h1>
    <?php if (!empty($message)) { ?>
      <div class="alert alert-<?php echo $message == 'Book updated successfully.' ? 'success' : 'danger'; ?>" role="alert">
        <?php echo $message; ?>
      </div>
    <?php } ?>
    <form action="update_book.php" method="post">
      <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['Title']; ?>" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required><?php echo $row['description']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="publishing_year">Publishing Year:</label>
        <input type="number" class="form-control" id="publishing_year" name="publishing_year" value="<?php echo $row['publishing_year']; ?>" required>
      </div>
      <div class="form-group">
        <label for="publisher_id">Publisher:</label>
        <select class="form-control" id="publisher_id" name="publisher_id" required>
          <?php
          while ($publisherRow = $publisherResult->fetch_assoc()) {
            $selected = ($publisherRow['id'] == $row['publisher_id']) ? 'selected' : '';
            echo '<option value="' . $publisherRow['id'] . '" ' . $selected . '>' . $publisherRow['Title'] . '</option>';
          }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a class="btn btn-success" href="index.php">Back to Main Page</a>
    </form>
  </div>
</body>
</html>
