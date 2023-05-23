<!DOCTYPE html>
<html>
<head>
  <title>Edit Book</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Edit Book</h1>
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

      if (isset($_GET['id'])) {
        $bookId = $_GET['id'];

        // Retrieve book details from the database
        $query = "SELECT * FROM books WHERE ID = $bookId";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

          // Display the book details in the form
          echo '<form action="update_book.php" method="post">';
          echo '  <input type="hidden" name="id" value="' . $row['ID'] . '">';
          echo '  <div class="form-group">';
          echo '    <label for="title">Title:</label>';
          echo '    <input type="text" class="form-control" id="title" name="title" value="' . $row['Title'] . '" required>';
          echo '  </div>';
          echo '  <div class="form-group">';
          echo '    <label for="description">Description:</label>';
          echo '    <textarea class="form-control" id="description" name="description" required>' . $row['Description'] . '</textarea>';
          echo '  </div>';
          echo '  <div class="form-group">';
          echo '    <label for="publishing_year">Publishing Year:</label>';
          echo '    <input type="number" class="form-control" id="publishing_year" name="publishing_year" value="' . $row['publishing_year'] . '" required>';
          echo '  </div>';
          echo '  <div class="form-group">';
          echo '    <label for="publisher_id">Publisher:</label>';
          echo '    <select class="form-control" id="publisher_id" name="publisher_id" required>';

          // Retrieve publishers from the database and populate the select options
          $publishersQuery = "SELECT * FROM publishers";
          $publishersResult = mysqli_query($conn, $publishersQuery);

          while ($publisherRow = mysqli_fetch_assoc($publishersResult)) {
            $selected = ($publisherRow['ID'] == $row['publisher_id']) ? 'selected' : '';
            echo '<option value="' . $publisherRow['ID'] . '" ' . $selected . '>' . $publisherRow['Title'] . '</option>';
          }

          echo '    </select>';
          echo '  </div>';
          echo '  <button type="submit" class="btn btn-primary">Update</button>';
          echo '  <a class="btn btn-success" href="index.php">Back to Main Page</a>';
         
          echo '</form>';
        } else {
          echo '<p>No book found with the given ID.</p>';
        }
      } else {
        echo '<p>Invalid book ID.</p>';
      }

      mysqli_close($conn);
    ?>
  </div>
</body>
</html>