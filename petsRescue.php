<!DOCTYPE html>
<html lang="en">
<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="style.css">
    <title>Pets Rescue Information</title>
    <style>
       table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .abt {
            background-color: pink;
            color: #fff;
            padding: 5px 30px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .abt:hover {
            background-color: #ff66b2;
        }
        .h2{
            color: pink;
            text-align: center;
            
        }
       
    </style>
</head>
<body>
<
                <div class="Navigation"  >
                <a href="index.html"><img src="logo.png" alt="Logo" class="logo" ></a>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="aboutus.html">About Us</a></li>
                    <li><a href="contactus.html">Contact Us</a></li>
                    <li><a href="adoption.html">Pets Adoption</a></li>
                    <li><a href="petsstore.html">Pets Store</a></li>
                    <li><a href="veterinaryclinic.html">Veterinary Clinic</a></li>
                    <li><a href="petsRescue.html">Pets Rescue</a></li>
                    <li><a href="Questionnaire.html">Questionnaire page</a></li>
            <li><a href="calculation.html">Bill Calculator</a></li>
            <li><a href="game.html">Fun Page </a></li>
                </ul>
            </div>
            <div class="container">
            <h1><img src="rescue.png" alt="Pet rescue header"></h1>
            <br>
            <h2>Your Pets Rescue Information</h2>

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
        echo "<script>alert('Information submitted.')</script>";
        // Display the received information using XHTML elements
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
        echo "<script>alert('No information submitted.')</script>";
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
$sql = "SELECT * FROM rescue";
$result = mysqli_query($conn, $sql);
$noR = mysqli_num_rows($result); //numners of rows
print "<h2>You can delete records here</h2>";
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

    
<div >
                <a href="index.html"><img src="logo.png" alt="logo"></a><br /><br />
                <a href="aboutus.html">About Us</a><br /><br />
                <a href="contactus.html">Contact Us</a>
                <br /><br />
            </div>
</body>
</html>
