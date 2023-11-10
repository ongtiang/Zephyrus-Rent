
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = 'author' content = ""> 
    <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
    <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zephyrus Rental - Admin Login</title>
    <link rel = 'icon' href = '../images/logo1.png'> 
    <link rel = 'stylesheet' href = '../css/log.css?v=<?php echo time();?>'> 
</head>
<body>
    <?php 
    //This is where the logging in mechanism is coded 
    // When the user logs in , A session is started 
    // The user data such as user id , user firstname and user lastname is stored in the Session for further use 
        
        session_start() ; 
        include '../templates/dbcon.php' ; 
         if(!isset($_SESSION['login']) and isset($_SERVER['HTTP_REFERER'])) $_SESSION['login'] = $_SERVER['HTTP_REFERER']  ; 
        //Getting the user inputs from the login form  
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $mail = $_POST['mail'] ; 
            $password = $_POST['password'] ; 
            $sql = "SELECT * FROM adminn WHERE email = '$mail'" ; 
            $result = mysqli_query($con , $sql) ; 
            if(mysqli_num_rows($result) == 0){
                $error = 'Invalid email ID' ; 
                //When the entered email is not there in the database , this message is displayed 
            }
            else{
                while($row = mysqli_fetch_array($result)){
                    if($password == $row['password']){
                        
                        if(isset($_SESSION['login'] )) {
                            $s = $_SESSION['login'] ; 
                            unset($_SERVER['login']) ; 
                            header('location: viewuser.php') ;
                            //Once logged in , the code will redirect the user to previously loaded page 
                        }
                        else{
                            header('location: adminlogin.php') ;
                            //if login page is opened directly without coming from any other pages 
                            //after logging it will redirected to the index.php 
                        }
                    }
                    else{
                        $error = 'Invalid Password , Please try again' ; 
                        //when entered password doesn't match with the one in the database , this message will be displayed 
                    }
                    break ;  
                }
                mysqli_close($con)  ;
            }
        }

      
    ?>

    
    

    
    
    <div class="backdrop">
    <div class="logcontainer">
        <div class="login">
            <div class="companylogo">
                <img src = '../images/logo1.png' height = 70 width = 70> 
                <div class="companyname"><b>A</b>dmin <b>L</b>ogin</div>
            </div>
            <form action = "" method = "post" onsubmit = "return loginValidation()">
                <label for = 'email'>Email</label><br>
                <input type = 'text' id = 'email' name = 'mail'><br>
                <label for = 'pass'>Password</label><br>
                <input type = 'password' id = 'pass' name = 'password'> <br>
                <div id = 'error'></div>
                <div class = 'error'>
                <?php
                    if(isset($error)){
                        echo "<script> document.getElementsByClassName('error')[0].style.display = 'block';</script>";
                        echo $error ; 
                        //displaying the error message using some Javascript code 
                    }
                ?>
                </div>
                <input type = "submit" value = "LOGIN"> 
            </form>
            
        </div>
    </div>
    
    <!-- The attached Javascript file has the validation for the login form  -->
    <script src = "javascript/logsign.js?v=<?php echo time();?>"></script>
</body>
</html>
