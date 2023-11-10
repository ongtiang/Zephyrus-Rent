<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
    <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
    <title>Zephyrus Rental Admin Panel</title>
    <link rel = 'stylesheet' href = '../admincss/adminheader.css?v=<?php echo time();?>'>
    <link rel = 'stylesheet' href=  '../admincss/adminindex.css?v=<?php echo time() ;?>'> 
    <link rel = 'icon' href= '../images/logo1.png'>

    <!--Meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font-awesome CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
    <!--table-->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
    .responsive-image {
    max-width: 100%; /* Ensure the image doesn't exceed its container's width */
    height: auto; /* Maintain the image's aspect ratio */
    width: 35%; /* Set a specific width as needed */
}
</style>
</head>

  <body>
    
    <?php
    session_start();
        include_once "../templates/dbcon.php";
     
        //All the pages will have some files , included from the templates folder 
        //Files that contain the header , footer and connection to the database will included in every php file of this website
        include '../admintemplates/adminheader.php' ; 
    ?>
    

<div class="homepage-container">

    <?php include('../admincomponent/messages.php'); ?>
        
        <div class="row" style="respnsive">
        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    
                                    <h3>User Account Informations
                                        
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Age</th>
                                                <th>Date of Birth</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Phone</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = "SELECT * FROM account";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                    foreach($query_run as $row)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?= $row['id']?></td>
                                                            <td>
                                                            <?php
                                                                $image = $row['image'];
                                                                $query = "SELECT * FROM account WHERE image = '$image'";
                                                                $res = mysqli_query($con, $query);

                                                                if (mysqli_num_rows($res) > 0) {
                                                                    while ($r = mysqli_fetch_array($res)) {
                                                                        ?>
                                                                        <div class="image">
                                                                            <img src='../images/profile/<?php echo $r['image']; ?>'  class="responsive-image">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    // If no image is found, display nothing
                                                                    ?>
                                                                    
                                                                    <div class="image">
                                                                        No Image yet
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                            </td>
                                                            <td><?= $row['fname']?></td>
                                                            <td><?= $row['lname']?></td>
                                                            <td><?= $row['age']?></td>
                                                            <td><?= $row['dob']?></td>
                                                            <td><?= $row['email']?></td>
                                                            <td><?= $row['password']?></td>
                                                            <td><?= $row['state']?></td>
                                                            <td><?= $row['city']?></td>
                                                            <td><?= $row['phone']?></td>
                                                            
                                                            <td>
                                                                
                                                                <form action="../adminfunction/admindeleteuser.php" method="POST" class="d-inline">
                                                                <div class="col-md-12 text-center">
                                                                    <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash" ></i></button>
                                                                </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<h5>No Record Found</h5>";
                                                }
                                            ?>
                                            
                                        </tbody>
                                        
                                    </table>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                   

                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
                </script>
            

            </div>
            
            
            
        </div>
      </div>    
                
        
      
           

  
</div>


</body>
</html>

   