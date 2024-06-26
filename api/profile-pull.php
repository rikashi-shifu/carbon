<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // User is not logged in, redirect to login page or handle the error
    header("Location: login.php");
    exit;
}

$sql = "CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    commuting_method VARCHAR(255),
    energy_source VARCHAR(255),
    dietary_preference VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$email = $_SESSION["email"];
// echo $email;

// Prepare and execute SQL query to select user data based on email
$sql = "SELECT * FROM profiles WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if data is found
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $username = $row['username'];
    $phone = $row['phone'];
    $commutingMethod = $row['commuting_method'];
    $energySource = $row['energy_source'];
    $dietaryPreference = $row['dietary_preference'];
} else {
    // Handle case where no data is found for the user
    // You can either set default values or display an error message
    $name = '';
    $username = '';
    $phone = '';
    $commutingMethod = '';
    $energySource = '';
    $dietaryPreference = '';
}

// Close the statement
$stmt->close();

echo '<div class="w-75 d-flex shadow border">';
echo '<!-- Left -->';
echo '<div class="w-50 d-flex justify-content-center align-items-center">';
echo '<img src="../img/profile/pfp.svg" alt="pfp" />';
echo '</div>';
echo '<!-- Right -->';
echo '<div class="w-50 d-flex justify-content-center align-items-center bg-secondary-subtle">';
echo '<form action="../api/profile-post.php" method="post" enctype="multipart/form-data" id="user-data" class="p-5 w-100 h-100 gap-4 form-floating d-flex flex-column justify-content-center align-items-center">';
echo '<div class="d-flex flex-column gap-2 w-100">';
echo '<div class="form-floating">';
echo '<input type="text" class="form-control bg-white border-0" id="name" name="name" value="' . $name . '" disabled required oninput="validateInput(this, /^[A-Za-z\s]+$/);" />';
echo '<label for="name">Name</label>';
echo '<div class="invalid-feedback">Please provide a valid name</div>';
echo '</div>';
echo '<div class="form-floating">';
echo '<input type="text" class="form-control bg-white border-0" id="username" name="username" value="' . $username . '" disabled required oninput="validateInput(this, /^[a-z\d._-]+$/);" />';
echo '<label for="username">Username</label>';
echo '<div class="invalid-feedback">';
echo 'Username must be lowercase without spacing containing only';
echo 'alphabets, numbers, and following the symbols: \'.\', \'-\', \'_\'';
echo '</div>';
echo '</div>';
echo '<div class="form-floating">';
echo '<input type="email" class="form-control bg-white border-0" id="email" name="email" value="' . $email . '" disabled />';
echo '<label for="email">Email</label>';
echo '</div>';
echo '<div class="form-floating">';
echo '<input type="tel" class="form-control bg-white border-0" id="phone" name="phone" value="' . $phone . '" disabled required oninput="validateInput(this, /^[\d\s-]+$/);" />';
echo '<label for="phone">Phone number</label>';
echo '<div class="invalid-feedback">Please enter your phone number using digits and "-" only</div>';
echo '</div>';
echo '<div class="form-floating">';
echo '<input type="text" class="form-control bg-white border-0" id="commuting-method" name="commuting-method" value="' . $commutingMethod . '" disabled required oninput="validateInput(this, /^[A-Za-z\s]+$/);" />';
echo '<label for="commuting-method">Commuting method</label>';
echo '<div class="invalid-feedback">Please provide a valid commuting method</div>';
echo '</div>';
echo '<div class="form-floating">';
echo '<input type="text" class="form-control bg-white border-0" id="energy-source" name="energy-source" value="' . $energySource . '" disabled required oninput="validateInput(this, /^[A-Za-z\s]+$/);" />';
echo '<label for="energy-source">Energy source</label>';
echo '<div class="invalid-feedback">Please provide an energy source</div>';
echo '</div>';
echo '<div class="form-floating">';
echo '<input type="text" class="form-control bg-white border-0" id="dietary-preference" name="dietary-preference" value="' . $dietaryPreference . '" disabled required oninput="validateInput(this, /^[A-Za-z\s]+$/);" />';
echo '<label for="dietary-preference">Dietary preference</label>';
echo '<div class="invalid-feedback">Please provide a dietary preference</div>';
echo '</div>';
echo '</div>';
echo '<button id="save-changes-btn" class="btn btn-dark w-100" type="button" onclick="editProfile(); saveChanges()">Edit profile</button>';
echo '</form>';
echo '</div>';
echo '</div>';

$conn->close();
?>
