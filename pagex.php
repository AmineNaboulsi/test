<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php
    // Database connection details
    $hostname = "localhost";
    $username = "root";
    $password = "";  // Empty password for default WampServer setup
    $database = "ScratchDB";

    // Create connection
    $connection = new mysqli($hostname, $username, $password, $database);

    // Check for connection errors
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors in the SQL execution
    if (!$result) {
        die("Query failed: " . $stmt->error);
    }

    // Fetch the results into an associative array
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Convert the associative array to JSON
    $json_result = json_encode($rows);

    // Display the JSON result
    echo  $json_result;

    // Close the connection
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>
