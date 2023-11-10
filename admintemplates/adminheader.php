<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = 'author' content = ""> 
        <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
        <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zephyrus Rental Admin Panel</title>
        <link rel = 'icon' href = 'images/logo1.png'> 
        <link rel = 'stylesheet' href = 'css/header.css?v=<?php echo time() ;?>'>
    </head>
<body>
    
    <nav>
        <div class="logo"><img src = '../images/logo1.png' height="96" width="96">
        <div class="title"><b>Z</b>ephyrus&nbsp;<b>A</b>dmin&nbsp;<b>P</b>anel</div>
        </div>
        <label for = 'btn' class = 'icon'>
            <span class = 'threebars'>☰</span>
        </label>
        <input type  ='checkbox' id = 'btn'>
        <ul>
            <li><a href="../admin/viewuser.php">User Information</a></li>
            <li><a href="../admin/viewproperty.php">Property Listing</a></li>
            <li><a href="../admin/viewcontent.php">Edit Contents</a></li>
            <li><a href="../admin/viewsales.php">View Sales</a></li>
            <li><a href="../admintemplates/adminlogout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="modal" id = 'modal'>
        <div class="modal-header">
                
        </div>
        <div class="modal-body">
            
                 
        </div>
    </div>
    <div id = 'overlay'></div>
    <script src = 'javascript/header.js'></script>
</body>
</html>
