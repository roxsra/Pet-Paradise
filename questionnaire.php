<html>
    <head>
    <title>Questionnaire Information</title>
    <link rel="stylesheet" href="style.css">
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
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .heading{
            color :black;
            text-align: center;

        }
        
    </style>
    </head>
    <body>
    <div class="Navigation">
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
            <li><a href="fun.html">Fun Page </a></li>
        </ul>
    </div>
<?php 
   $sname = "localhost";
   $user = "root";
   $pass = "";
   $dbname = "pets";
   // Create connection
   $conn = mysqli_connect($sname, $user, $pass,$dbname);
   // Check connection
   if (!$conn) {
    die("Connection failed: ". 
    mysqli_connect_error());
   }
   //read all rows
   $sql = "SELECT * FROM questionnaire";
   $result = mysqli_query($conn,$sql);
   
   if(!$result){
       die("Invalid query: ".$connection->error);
   }
   // Define a class to maintain information about one row in the table
   class Pet {
       public $name;
       public $email;
       public $gender;
       public $pets;
       public $message;
   
       public function __construct($name, $email, $gender, $pets, $message) {
           $this->name = $name;
           $this->email = $email;
           $this->gender = $gender;
           $this->pets = $pets;
           $this->message = $message;
       }
   }
   
   // Array to maintain all rows
   $petsArray = [];
   
   // Process form submission
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Get form data
       $name = $_POST['name'];
       $email = $_POST['email'];
       $gender = isset($_POST['gender'])? "Male":"Female";
       $pets = isset($_POST['pets']) ? "Yes" : "No";
       $message = $_POST['message'];
   
       // Create a new Pet object
       $pet = new Pet($name, $email, $gender, $pets, $message);
   
       // Add the Pet object to the array
       $petsArray[] = $pet;
   }
   
   // Function to display table format of the content
   function displayTable($petsArray) {
       echo " <h2 class='heading'>Your Information</h2>";
       echo "<table border='1'>";
       echo "<tr><th>Name</th><th>Email</th><th>Gender</th><th>Owns Pets</th><th>Message</th></tr>";
       foreach ($petsArray as $pet) {
           echo "<tr>";
           echo "<td>" . $pet->name . "</td>";
           echo "<td>" . $pet->email . "</td>";
           echo "<td>" . $pet->gender . "</td>";
           echo "<td>" . $pet->pets . "</td>";
           echo "<td>" . $pet->message . "</td>";
           echo "</tr>";
       }
       echo "</table>";

   }

   
   // Display the table
   displayTable($petsArray);
   // Insert data into database
   $query = mysqli_query($conn,"Insert into questionnaire ( name, email, gender, own_pets, message)
   VALUES ('$pet->name', '$pet->email', '$pet->gender', '$pet->pets', '$pet->message')");
   if ($query){
    echo "<script>alert('data inserted succssfully')</script>";
   } 
   else{
    echo "<script>alert('there is error')</script>";
   }
?>
<?php
   echo "<h1 class='heading'>All records appear here</h1>";
   //read data of each row 
   echo "<table border='1'>";
   echo "<tr><th>Id</th><th>Name</th><th>Email</th><th>Gender</th><th>Owns Pets</th><th>Message</th></tr>";
   while($row = $result->fetch_assoc()){
    echo "
    <tr>
        <td>$row[user_ID]</td>
        <td>$row[name]</td>
        <td>$row[email]</td>
        <td>$row[gender]</td>
        <td>$row[own_pets]</td>
        <td>$row[message]</td>
    </tr>" ;
   } echo"</table>";
    
   ?>
    <div >
                <a href="index.html"><img src="logo.png" alt="logo"></a><br /><br />
                <a href="aboutus.html">About Us</a><br /><br />
                <a href="contactus.html">Contact Us</a>
                <br /><br />
            </div>
   </body>
   </html>
