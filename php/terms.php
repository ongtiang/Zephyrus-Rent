<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = ""> 
    <title>Zephyrus Rental-Terms & Condition</title>
    <link rel = 'stylesheet' href= '../css/header.css?v=<?php echo time(); ?>'> 
    <link rel = 'stylesheet' href = '../css/terms.css?v=<?php echo time();?>'>
    <link rel = 'icon' href = '../images/logo1.png'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 
</head>
<body>
    <?php
    //This is the php file which states the terms and conditions for the website 
    //This page also gives a brief information about the product is offering to the user 
    include '../templates/header.php' ?>
    <?php
        include_once "../templates/dbcon.php";
    ?>
    <div class="terms-display">
        <h1>Terms &amp; Conditions </h1>
        <div class="display-content">
                <?php 
                    $query = "SELECT * FROM content";
                    $query_run = mysqli_query($con, $query);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $row)
                        {
                ?>

                    <section>
                        <h2> <td><li><?= $row['header']?></li></td> </h2>
                        <ul>
                            
                            <td><?= $row['content']?> </td>
                            
                        </ul>
                        
                    </section>
                <?php
                        }
                    }
                    else
                    {
                        echo "<h5>No Record Found</h5>";
                    }
                ?>
                        </div>
                    </div>
                    <!DOCTYPE html>
<html>

</body>
</html>
    
    <?php include '../templates/footer.php'?>
</body>
</html>
