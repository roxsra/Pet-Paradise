<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Rescue Information</title>
    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .abt{ background-color: gray;
            color : darkred;
            padding: 5px 30px;

        }
        .abt:hover{
            background-color:darkred ;
            color : white;

        }
    </style>
</head>
<body>
    <h1>Pets Rescue Information</h1>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data
        $name = $_POST['name'];
        $phone_number = $_POST['Phone_number'];
        $city = $_POST['city'];
        $age = $_POST['age'];
        $address = $_POST['Address'];
        $extra_details = $_POST['Feedback'];
        

        

        // Display the received information using XHTML elements
        echo "<h2>Rescue Information:</h2>";
        echo "<table>";
        echo "<tr><th>Field</th><th>Value</th></tr>";
        echo "<tr><td>Name</td><td>$name</td></tr>";
        echo "<tr><td>Phone Number</td><td>$phone_number</td></tr>";
        echo "<tr><td>City</td><td>$city</td></tr>";
        echo "<tr><td>Age of the pet</td><td>$age</td></tr>";
        echo "<tr><td>Address</td><td>$address</td></tr>";
        echo "<tr><td>Extra Details</td><td>$extra_details</td></tr>";
        echo "</table>";
    } else {
        // If form is not submitted, display a message
        echo "<p>No information submitted.</p>";
    }
    ?>
<?php
$sname = "localhost";
$user = "root";
$pass = "";
$dbname = "pets";
// Create connection
$conn = new mysqli($sname, $user, $pass,$dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$sql="select * from rescue";
$result = mysqli_query($conn, $sql);
$noR = mysqli_num_rows($result); //no of rows
print "<br/>There are $noR pets rescue in the database<br/>";
?>
<table border="2">
    <tr><th>Name</th><th>Phone number</th>
    <th>City</th><th>Age</th><th>Adrees</th><th>Feedback</th><th>Action</th>
    </tr>
<?php
for ($i = 0; $i < $noR; $i++) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['user_ID']; // Assuming 'id' is the primary key of your 'rescue' table
    print "<tr>";
    print "<td>" . $row['name'] . "</td>";
    print "<td>" . $row['phone_number'] . "</td>";
    print "<td>" . $row['city'] . "</td>";
    print "<td>" . $row['age'] . "</td>";
    print "<td>" . $row['Address'] . "</td>";
    print "<td>" . $row['Feedback'] . "</td>";
    // Adding a delete button for each row
    print "<td><a class='abt' href='delete.php?id=".$row['user_ID']."'>Delete</a></td>";
    print "</tr>";
}

mysqli_close($conn);
?> 
</table>

    

</body>
</html>
