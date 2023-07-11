<?php
session_start();
include('header.php');
if(isset($_POST['signinBtn'])) {
    // Get the username and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $dbname = "moviebooking";
    $conn = new mysqli($servername, $username, "", $dbname);
    if($conn->connect_error) {
        die ("Connection failed ".$conn->connect_error);
    }

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        // Start the session and store the user's email
        $_SESSION['email'] = $email;
        // Redirect the user to the home page
        header ('location: index.php');
        // echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
    else {
        echo "Username or password invalid";
    }
}
?>


<div class="form">
    <div class="form-box">
        <h1 id="Title">Sign In</h1>
        <form method="post" action="login.php">
            <div class="input-group">
                <div class="input-field">
                    <input type="email" placeholder="Enter Your email" name="email" required><br>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Password" name="password" required><br>
                </div>
                <p>Forgot Password? <a href="Forgot.html">Click here!</a></p>
                <br>
                <div class="SignUp-link">
                    <button type="submit" name="signinBtn">Sign In</button>
                </div>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
