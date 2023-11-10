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
            max-width: 50%; /* Ensure the image doesn't exceed its container's width */
            height: auto; /* Maintain the image's aspect ratio */
            margin-bottom:1%
        }
</style>
    
</head>

  <body>
    
    <?php
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
                                    
                                    <h3>Perperty List</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Type</th>
                                                <th>Expiry</th>
                                                <th>Square Feets</th>
                                                <th>Pin Code</th>
                                                <th>Area</th>
                                                <th>Street</th>
                                                <th>Price</th>
                                                <th>Owner ID</th>
                                                <th>Owner Name</th>
                                                <th>Tenant</th>
                                                <th>Furnish</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = "SELECT * FROM properties";
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
                                                            $id = $row['id'] ; 
                                                            $query = "SELECT * FROM images WHERE property = '$id'" ; 
                                                            $res = mysqli_query($con, $query) ; 

                                                            while($r = mysqli_fetch_array($res)){ ?>
                                                                <div class="rent-items-image">
                                                                    <img class="responsive-image" src='../images/property_images/<?php echo $r['imagename'];?>' alt='Image not found'>
                                                                </div>
                                                                <?php
                                                            } ?>
                                                        </td>
                                                            <td><?= $row['city']?></td>
                                                            <td><?= $row['state']?></td>
                                                            <td><?= $row['country']?></td>
                                                            <td><?= $row['type']?></td>
                                                            <td><?= $row['expiry']?></td>
                                                            <td><?= $row['sqft']?></td>
                                                            <td><?= $row['pincode']?></td>
                                                            <td><?= $row['area']?></td>
                                                            <td><?= $row['street']?></td>
                                                            <td><?= $row['price']?></td>
                                                            <td><?= $row['owner']?></td>
                                                            <td><?= $row['ownername']?></td>
                                                            <td><?= $row['tenant']?></td>
                                                            <td><?= $row['furnish']?></td>
                                                            
                                                            <td>
                                                                
                                                                <form action="../adminfunction/admindeleteproperty.php" method="POST" class="d-inline">
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
                
            </div>
        </div>
      </div>    
</div>
    </body>
</html>


   