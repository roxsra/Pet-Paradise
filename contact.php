<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        th {
            color: #000000;
        }
    </style>
</head>
<body>
<div class="Navigation">
    <a href="index.html"><img src="logo.png" alt="Logo" class="logo"></a>
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
        <li><a href="game.html">Fun Page</a></li>
    </ul>
</div>
<div id="top" class="container">
    <img src="contactus.png" alt="page header"><br/><br/>
    <p class="container" style="font-weight: bolder; padding-left: 300px; font-size: 30px; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">Please contact us if you have any questions!</p>
    <br/><br/>
    <table style="border-collapse: collapse;">
        <tr>
            <p class="container" style="font-weight: bolder; padding-left: 380px; font-size: 50px; color: #000000; font-family: Georgia, 'Times New Roman', Times, serif;">Reviews & Questions</p>
        </tr>
        <tr>
            <div class="container">
                
                <table id="reviewstable" style="font-size: x-large; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">
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

                    // Validate and sanitize the form data
                    $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : "";
                    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
                    $message = isset($_POST["Feedback"]) ? htmlspecialchars($_POST["Feedback"]) : "";

                    // Insert data into the database table
                    if (!empty($name) && !empty($email) && !empty($message)) {
                        $sql = "INSERT INTO contact (Name, email, message) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sss", $name, $email, $message);

                        if ($stmt->execute()) {
                            echo "<script>alert('Message submitted successfully');</script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // Fetch reviews from the database table
                    $sql = "SELECT * FROM contact";
                    $result = $conn->query($sql);
                    ?>

                    <table id="reviewstable" style="font-size: x-large; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr id='row_{$row["Name"]}'>
                                        <td>{$row["Name"]}</td>
                                        <td>{$row["email"]}</td>
                                        <td>{$row["message"]}</td>
                                        <td>
                                            <form id='delete_form_{$row["Name"]}' action='".$_SERVER["PHP_SELF"]."' method='post'>
                                                <button type='button' onclick='deleteRow(\"{$row["Name"]}\")'>Delete</button>
                                                <input type='hidden' name='delete_name' value='{$row["Name"]}'>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>0 results</td></tr>";
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_name"])) {
                            $delete_name = $_POST["delete_name"];

                            // Delete the record from the database based on the person's name
                            $sql_delete = "DELETE FROM contact WHERE Name=?";
                            $stmt_delete = $conn->prepare($sql_delete);
                            $stmt_delete->bind_param("s", $delete_name);

                            if ($stmt_delete->execute()) {
                                echo "<script>alert('Record deleted successfully');</script>";
                                echo "<script>location.reload();</script>"; // Reload the page after deletion
                            } else {
                                echo "Error deleting record: " . $stmt_delete->error;
                            }
                            
                        }
                        ?>
                    </table>

                    <script>
                        function deleteRow(name) {
                            if (confirm('Are you sure you want to delete the records for ' + name + '?')) {
                                var row = document.getElementById('row_' + name);
                                if (row) {
                                    row.style.display = 'none';
                                }
                                // Submit the form to delete the record
                                document.getElementById('delete_form_' + name).submit();
                            }
                        }
                    </script>

                    <?php
                    // Close connection
                    $conn->close();
                    ?>

            </div>
        </tr>
    </table>
    <br/><br/><br/>
    <p class="container" style="font-weight: bolder; padding-left: 400px; font-size: 30px; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">Employees contact information</p>
    <div style="padding-left: 450px;">
        <input type="text" placeholder="Search by employee's name" size="30px" id="searchInput" style="border-radius: 10px;">
        <button type="button" onclick="search()" style="border-radius: 10px; border-color: rgba(127, 255, 212, 0);background-color: #000000; color: white;"> Search</button>
    </div>
    <div style="padding-left: 400px;">
        <br/>
        <table id="employeestable" style="font-size: x-large; color: #999999; font-family: Georgia, 'Times New Roman', Times, serif;">
            <!-- This table will be populated based on the search results -->
        </table>
    </div>
</div>
<br/>
<hr class="container">
<div class="container">
    <a href="index.html"><img src="logo.png" alt="logo"></a><br/><br/>
    <a href="aboutus.html">About Us</a><br/><br/>
    <a href="contactus.html">Contact Us</a>
    <br/><br/>
</div>

<script>
    // Define a constructor function for creating employee objects
    function employee(name, phoneNumber, email, address) {
        this.name = name;
        this.phoneNumber = phoneNumber;
        this.email = email;
        this.address = address;
    }

    // Array to store employee objects
    var employees = [
        new employee("Latifa", 98364765, "latifa33@gmail.com", "Sohar"),
        new employee("Leen", 74893660, "leenWork@gmail.com", "Muscat"),
        new employee("Moza", 92353623, "mozaWorkemail@gmail.com", "Saham"),
        new employee("Sultan", 729493757, "sultanclinic@gmail.com", "Al Buraimi")
    ];

    // Function to search for an employee by name
    function search() {
        // Get the name entered by the user from the search input field
        var name = document.getElementById("searchInput").value.toLowerCase();

        // Get the table element where search results will be displayed
        var generatedTable = document.getElementById("employeestable");

        // Clear the table before displaying search results
        generatedTable.innerHTML = "";

        // Create a new row for displaying search results
        var eventRow = generatedTable.insertRow();

        // Initialize index as -1
        var index = -1;

        // Loop through the employees array to find a match for the entered name
        for (var i = 0; i < employees.length; i++) {
            if (name === employees[i].name.toLowerCase()) {
                index = i; // Store the index of the matching employee
                break; // Exit the loop once a match is found
            }
        }

        // Check if a match was found
        if (index !== -1) {
            // Display the details of the matching employee in the table
            eventRow.innerHTML = "<th>Name</th><td>" + employees[index].name + "</td>";
            var eventRow = generatedTable.insertRow();
            eventRow.innerHTML = "<th>Phone Number</th><td>" + employees[index].phoneNumber + "</td>";
            var eventRow = generatedTable.insertRow();
            eventRow.innerHTML = "<th>Email</th><td>" + employees[index].email + "</td>";
            var eventRow = generatedTable.insertRow();
            eventRow.innerHTML = "<th>Address</th><td>" + employees[index].address + "</td>";
        } else {
            // If no match was found, display a message indicating so
            eventRow.innerHTML = "<td colspan='2'>No employee with this name</td>";
        }
    }
</script>

</body>
</html>
