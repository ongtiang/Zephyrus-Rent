<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = 'author' content = ""> 
    <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
    <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zephyrus Rental - Registration</title>
    <link rel = 'icon' href = '../images/logo1.png'> 
    <link rel = 'stylesheet' href = '../css/sign.css?v=<?php echo time();?>'> 
</head>
<body>
    <?php 
    //This php file is responsible for creating an account for the user 
        include '../templates/dbcon.php' ; 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get all the information that a user has entered
        $fname  = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $dob = $_POST['date'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['pass'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        // Check if the email is already in use
        $checkEmailQuery = "SELECT COUNT(*) as count FROM account WHERE email = '$mail'";
        $emailResult = mysqli_query($con, $checkEmailQuery);
        $emailData = mysqli_fetch_assoc($emailResult);
        $emailCount = $emailData['count'];

        if ($emailCount > 0) {
            // Email is already in use, display an error message
            echo '<script>';
            echo 'alert("This email is already in use. Please use a different email address.");';
            echo '</script>';
        } else {
            // Email is not registered, proceed with registration
            if (strlen($password) < 8) {
                // Password must be at least 8 characters, display an error message
                echo '<script>';
                echo 'alert("Password must be at least 8 characters long.");';
                echo '</script>';
            } else {
                // Password is of the required length, proceed with registration
                $query = "INSERT INTO account(fname, lname, age, dob, email, phone, password, city, state) VALUES ('$fname', '$lname', '$age', '$dob', '$mail', '$phone', '$password', '$city', '$state')";
                if (mysqli_query($con, $query)) {
                    header('Location: signupsuccessful.php');
                } else {
                    echo $con->error;
                    die('<h1>Data not added to the database</h1>');
                }
            }
        }
    }
    ?>







    <div class="main">
        <div class="content">
        <div class="companylogo">
                <img src = '../images/logo1.png' height = 70 width = 70> 
                <div class="companyname"><b>Z</b>phyrus <b>R</b>ent</div>
            </div>
            <form action = "" onsubmit = "return registerValidation()" method = 'POST'>
                <label for = 'fnm'>Name:</label>
                <input id = 'fnm' name = 'fname' type = 'text' required placeholder = 'James'>

                <label for = 'lname'>Last Name:</label>
                <input type = 'text' name = 'lname' id = 'lname' required placeholder = 'Milner'> 

                <label for = 'age'>Age:</label>
                <input type = 'number' id = 'age' min='1' name = 'age' required placeholder = 40> 

                <label for = 'date'>DoB:</label>
                <input type = 'date' id = 'date' name = 'date' required value ="1980-11-22"> 

                <label for = 'email'>Email:</label>
                <input type = 'text' name = 'email' id = 'email' required placeholder = 'jamesmilner@gmail.com'>

                <label for = 'phone'>Phone Number:</label>
                <input type = 'text' name = 'phone' id ='phone' required placeholder = 01011xxxxx>

                <label for = 'state'>State:</label>
                <input type = 'text' name = 'state' id = 'state' required placeholder = 'TamilNadu'>

                <label for = 'city'>City:</label>
                <input type = 'text' name = 'city' id = 'city' required placeholder = 'Chennai'>

                <label for ='pass'>Password:</label>
                <input type = 'password' name = 'pass' id = 'pass' required placeholder = 'hifrands'>

                <label for = 'repass'>Re-Enter Password:</label>
                <input type = 'password' id = 'repass'  placeholder = 'hifrands'>
                <div class = 'terms'><input type  ='checkbox' name = 'terms'  placeholder='agreed' id = 'terms' required> 
                <label for = 'terms'>I agree to all&nbsp; <a href = 'terms.php'>Terms &amp; condtions</a></label></div>
                <div class="error" id = 'err'></div>
                <input type = 'submit' value = 'REGISTER' class = 'submit-btn'>
                

            </form>
            <div class="logsign">Already have an account ? <a href = "login.php">Login Now</a></div>
        </div>
        
    </div>
    <!-- A javascript file that is used for validation of this signup form  -->
    <script src = '../javascript/logsign.js?v=<?php echo time();?>'></script>
</body>


</html>


