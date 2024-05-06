<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "pets";

// Create connection
$conn = new mysqli($sname, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set in the URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    // SQL to delete record
    $sql = "DELETE FROM rescue WHERE user_ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
