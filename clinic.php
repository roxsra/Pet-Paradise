<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <style>
           
            .details{
                font-size: 20px; color: pink; font-family:'Courier New', Courier, monospace;
            } 
            
            h4 span {
                color: rgb(255, 122, 122);
                font-weight:bolder;
                font-family: Georgia, 'Times New Roman', Times, serif;
                }

    table {
      
      width: 100%;
    }
    th, td {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    .month {
      background-color: black;
      color: white;
    }
    .day {
      background-color: palevioletred;
      color: white;
    }
    .event {
      background-color: palevioletred;
      color: white;
    }
        </style>
        <body>
            <div >
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
            <li><a href="game.html">Fun Page </a></li>
                </ul>
            </div>
            <div class="container">
            <h1><img src="Clinic.png" alt="Clinic header"></h1>
            <p class="container" style="font-weight:bolder; padding-left: 380px; font-size: 30px; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">Book an appointment for your pet!</p>
            <br/><br/>
            
            <br/>
            <div class="row">
            <?php
                // Check if form data is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get form data
                    $name = $_POST["name"];
                    $phoneNumber = $_POST["phoneNumber"];
                    $age = $_POST["age"];
                    $passW = $_POST["password"];
                    $petName = $_POST["petName"];
                    $petAge = $_POST["petAge"];
                    $appointDate = $_POST["appointmentDate"];
                    $details = $_POST["extraDetails"];
                    echo "<h4 style=\"font-weight:bolder; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;\">Your appointment is reserved successfully on $appointDate</h4>";
                    // Check if all required fields are filled
                    if (!empty($name) && !empty($phoneNumber) && !empty($age) && !empty($passW) && !empty($petName) && !empty($petAge) && !empty($appointDate) && !empty($details)) {
                        // Connect to the database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "petParadise";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Insert data into the database table
                        $sql = "INSERT INTO clinic (name, phoneNumber, age, passW, petName, petAge, appointDate, details) VALUES ('$name', '$phoneNumber', '$age', '$passW', '$petName', '$petAge', '$appointDate', '$details')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('The appointment is successfully reserved and added to the database!');</script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                        // Close the database connection
                        $conn->close();
                    } else {
                        echo "<script>alert('Please fill in all the fields!');</script>";
                    }
                }
                ?>

<div class="col">
    <br><br><br>
    <label style="font-weight:bolder; font-size: 20px; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">Search for appointments details using pet's name: <input type="text" id="searchInput" placeholder="Search appointments"></label>
    <button onclick="filterAppointments()">Search</button>
    <br><br>
    <table id="appointmentCalendar">
        <tr>
            <th>Date</th>
            <th>Client Name</th>
            <th>Phone Number</th>
            <th>Pet Name</th>
            <th>Details</th>
        </tr>
        <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "petParadise";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch appointments from the database
        $sql = "SELECT * FROM clinic";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["appointDate"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["phoneNumber"] . "</td>";
                echo "<td>" . $row["petName"] . "</td>";
                echo "<td>" . $row["details"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No appointments found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

<script>
    // Function to filter appointments based on search input
    function filterAppointments() {
        var searchInput = document.getElementById("searchInput").value.toLowerCase();
        var tableRows = document.getElementById("appointmentCalendar").getElementsByTagName("tr");

        // Loop through table rows and hide those that do not match the search input
        for (var i = 1; i < tableRows.length; i++) { // Start from index 1 to skip the header row
            var petNameCell = tableRows[i].getElementsByTagName("td")[3]; // Index 3 corresponds to the column with pet names
            if (petNameCell) {
                var petName = petNameCell.textContent.toLowerCase();
                if (petName.includes(searchInput)) {
                    tableRows[i].style.display = ""; // Show row if pet name matches search input
                } else {
                    tableRows[i].style.display = "none"; // Hide row if pet name does not match search input
                }
            }
        }
    }
</script>



            </div>
          </div>
            <hr class="container">
            <div class="container">
                <a href="index.html"><img src="logo.png" alt="logo"></a><br /><br />
                <a href="aboutus.html">About Us</a><br /><br />
                <a href="contactus.html">Contact Us</a>
                <br/><br/>
            </div>
             </div>
             

            
        </body>
    </head>
</html>
