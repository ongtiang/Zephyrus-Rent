<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = ""> 
    <title>Zephyrus Rental - Requested</title>
    <link rel = 'icon' href = '../images/logo1.png'> 
    <link rel = 'stylesheet' href = '../css/header.css?v=<?php echo time();?>'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 
    <style>
        .success-container{
            display:flex ; 
            justify-content:center ; 
            align-items: center ; 
            height:100vh ; 
        }
        .success{
            display:flex ; 
            justify-content:center ; 
            align-items: center ; 
            color:white ; 
            background-color:#1b1b1b ; 
            padding:50px;
        }
    </style>
</head>
<body>
    <?php
        include '../templates/header.php' ;
        include '../templates/dbcon.php' ; 
    ?>
    <?php
    //This is a php file which will run once the property request has been confirm 
    // This php file will take the request and put it into the table called as inbox 
    //with the sender id and reciever id and the property id 
    if (isset($_SESSION['id']) && isset($_SERVER['HTTP_REFERER'])) {
        $pid = $_GET['pid'];
    
        // Fetch the price and type from the 'properties' table based on the property ID
        $priceTypeQuery = "SELECT price, type FROM properties WHERE id = $pid";
        $priceTypeResult = mysqli_query($con, $priceTypeQuery);
        $rowPriceType = mysqli_fetch_array($priceTypeResult);
    
        if ($rowPriceType) {
            $price = $rowPriceType['price'];
            $type = $rowPriceType['type'];
    
            // Now, you can add the price and type into the 'inbox' table, assuming you have other necessary variables like sender and receiver set up
            // Insert the sender, receiver, property ID, price, and type into the 'inbox' table
            $sender = $_SESSION['id'];
            $query = "SELECT owner FROM properties WHERE id = $pid ";
            $result = mysqli_query($con, $query);
    
            while ($row = mysqli_fetch_array($result)) {
                $reciever = $row['owner'];
                break;
            }
           // Now, insert the data into the 'inbox' table, including the price and type
        $query = "INSERT INTO inbox(sender, reciever, pid, price, type) VALUES($sender, $reciever, $pid, $price, '$type')";
        mysqli_query($con, $query);
        } else {
            // Handle the case where the property doesn't exist or other errors
            // You may want to display an error message or take appropriate actions
        }
    ?>
    <div class="success-container">
        <div class="success">
            <h1>Your Request has been sent to the Property Owner</h1>
        </div>
    </div>
    <?php 
    }
    else{
        header('Location: ../index.php') ; 
    }
    ?>
    <?php include '../templates/footer.php' ; ?> 
</body>
</html>
