<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = "SOURAV KUMAR NRS 2020115089"> 
    <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
    <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
    <title>Zephyrus Rental</title>
    <link rel = 'stylesheet' href = 'css/header.css?v=<?php echo time();?>'>
    <link rel = 'stylesheet' href=  'css/index.css?v=<?php echo time() ;?>'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time(); ?>'> 
    <link rel = 'icon' href= 'images/logo1.png'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"></script>
    <script src="javascript/panolens.min.js"></script>
    
    <style>
            .img-box{
                margin: 20px auto;
                text-align:center;
                width: 100% ;
            }
        </style>
</head>
<body class = 'homepage'>
    <?php
        //All the pages will have some files , included from the templates folder 
        //Files that contain the header , footer and connection to the database will included in every php file of this website
        include 'templates/indexheader.php' ; 
    ?>
    <div class="homepage-container">
        <div class="banner1">
            <h1>
                <?php 
                //All the php code blocks will bring dynamicness to the webpage such as displaying the username 
                // removing /updating content according to the login 
                if(!isset($_SESSION['name'])){ ?>
                Join the Our Property renting platform now!
                <?php }
                else{
                    ?> Welcome to Zephyrus Rent , <?php echo $_SESSION['name']." ".$_SESSION['lname'] ; ?>
                    <br> Hope you are doing Good. 
                    <?php
                }?> 
            </h1>
        </div>
        <div class="banner3">
            <div class="list">
                    <?php if(!isset($_SESSION['name'])){ ?>
                   <h2> List Properties <br> Get tenants at lightning speed</h2>
                   <?php }
                   else{
                       ?>   
                       <a href="php/list.php">List Property</a>
                       <?php
                   }
                   ?>
            </div>
            
            <div class="rent">
                    <?php if(!isset($_SESSION['name'])){ ?>
                        <h2>Rent <br> The Most Comfortable place around you</h2>
                   <?php }
                   else{
                       ?>   
                       <a href="php/rent.php">Rent Property</a>
                       <?php
                   }
                   ?>
            </div>     
        </div>
        <?php if(!isset($_SESSION['name'])){?>
        <div class="banner2-content">
            <div class="buttons">
                    <h1>Get Started Now</h1>
                    <a href="php/login.php">Login</a>
                    <a href="php/signup.php">SignUp</a>
            </div>
            <div class="display-image">
                    <img src = 'images/balcony.jpg' alt = 'img not found'> 
            </div>
        </div>

        <?php } ?>

        <!-- 350 image -->
        <?php
            // Connect to your database
            $conn = mysqli_connect("localhost", "root", "", "zephyrus_rent");
            $message = ""; // Initialize an empty message

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to fetch the 360-degree panorama image path from the "panorama" table
            $query = "SELECT image_path FROM panorama WHERE id = 1"; // Adjust the condition as needed
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $image_path = $row['image_path'];
                $panorama = $image_path; // Use the database image path
            }


            mysqli_close($conn);
        ?>

        <style>
            .main-container {
                display: flex;
                height: 100vh;
                align-items: center;
                background: #262626;
                padding: 0 100px;
            }

            .main-container .image-container {
                flex: 1;
                height: 80%;
            }

            @media all and (max-width:968px){
                .main-container .image-container{
                    flex-direction: column;
                }
                .main-container .image-container{
                    width:100% ; 
                    padding:10px ;
                }
                .main-container .image-container{
                    font-size:200% ; 
                }
            }
            
        </style>


        <div class="banner1" style="height:10%"><h1>View a 360 degree image below</h1></div>
            <div class="main-container">
                <div class="image-container"></div>
        </div>

       
        <div class= "banner3">
            <iframe style="width:49%;height:400px " frameborder="2" src="https://momento360.com/e/u/759e33d0ef6649ff80da5f66b9a83f5d?utm_campaign=embed&utm_source=other&heading=39.38&pitch=-8.46&field-of-view=66&size=medium&display-plan=true">
            </iframe>
            <iframe style="width:49%;height: 400px "  frameborder="2" src="https://momento360.com/e/u/4dc63898b75f4e5dad3526acf27f3d44?utm_campaign=embed&utm_source=other&heading=-238.92&pitch=-0.68&field-of-view=75&size=medium&display-plan=true">
            </iframe>
        </div>
    
        <?php include 'templates/indexfooter.php' ; ?>
    </div>

    <script>
        // Check if a panorama filename is available
        const panoramaImage = new PANOLENS.ImagePanorama("images/img/" + "<?php echo $panorama; ?>");
        const imageContainer = document.querySelector(".image-container");

        const viewer = new PANOLENS.Viewer({
            container: imageContainer,
            autoRotate: true,
            autoRotateSpeed: 1.0,
            controlBar: false,
            zoom: 14,
            zoomControl: false,
        });

        viewer.add(panoramaImage);

        
    </script> 

    
   
</body>
</html>