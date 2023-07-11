<?php
include('header.php');
?>
<link rel="stylesheet" href="style.css">
    <div class="form">
        <div class="form-box">
            <h1 id="Title">Sign In</h1>
            <h2>WELCOME TO MOVIES WORLD</h2>
            <form method="POST" action="loginbackend.php">
                <div class="input-group">
                        <div class="input-field">
                            <input type="text" placeholder="Enter Your Name" name="uname" required><br>
                        </div>
                    <div class="input-field">
                    <input type="password" placeholder="Password" name="password" required><br>
                    </div>
                    <br>
                    <div class="SignUp-link">
                        <button type="submit" name="signinBtn">Sign In</button>
                    </div>
                    <p> Don't have a account..<a href="register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php

session_start();
// Check if the user is already logged in
if(isset($_SESSION['email'])) {
    // Redirect the user to the home page or any other authenticated page
    header("Location:../dashboard.php");
    exit;
}

if(isset($_POST['signinBtn'])) {
    // Get the username and password from the form
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $dbname = "moviebooking";
    $conn = new mysqli($servername, $username, "", $dbname);
    if($conn->connect_error)
        die ("Connection failed ".$conn->connect_error);
    $sql = "SELECT * FROM user WHERE uname = '$uname' and password = '$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0)    {
        // Start the session and store the user's email
        $row = $result->fetch_assoc();
        $_SESSION['uname'] = $row['uname'];
        $_SESSION['uid'] = $row['uid'];
        
        // Redirect the user to the home page
        header("Location:dashboard/userdash/dash.php");
        }
    else
        echo "username or password invalid";
}
?>





