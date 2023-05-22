<?php

$host = "localhost";
$username = "admin";
$password = "Mjones00";
$database = "user_repository";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$query = "SELECT * FROM users Limit 5";
$result = $conn->query($query);
echo "<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>";

echo "<table>";
?>


<table>
<tr>
<th>ID</th>
<th>Vorname</th>
<th>Nachname</th>
<th>Alter</th>
<th>Position</th>
<th>Aktive</th>
<th>Role_ID</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['FORENAME'] . "</td>";
        echo "<td>" . $row['SURENAME'] . "</td>";
        echo "<td>" . $row['AGE'] . "</td>";
        echo "<td>" . $row['POSITION'] . "</td>";
        echo "<td>" . $row['ACTIVE'] . "</td>";
        echo "<td>" . $row['ROLE_ID'] . "</td>";
        echo "</tr>";
    }
}
?>

</table>

<?php
$conn->close();
?>
fff