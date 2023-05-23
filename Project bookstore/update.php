<?php
$host = "localhost";
$username = "admin";
$password = "Mjones00";
$database = "bookstore";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $bookId = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $publishingYear = $_POST['publishing_year'];
  $publisherId = $_POST['publisher_id'];

  // Update the book details in the database
  $query = "UPDATE books SET Title='$title', Description='$description', publishing_year='$publishingYear', publisher_id='$publisherId' WHERE ID='$bookId'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Redirect to the index.php page with a success parameter
    header('Location: index.php?success=true');
    exit();
  } else {
    echo 'Error updating book: ' . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>