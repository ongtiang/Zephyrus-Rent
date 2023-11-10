<?php
    session_start();
    include '../templates/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
    <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
    <title>Zephyrus Rental</title>
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
</head>

  <body>
    <?php
        include_once "../templates/dbcon.php";
     
        //All the pages will have some files , included from the templates folder 
        //Files that contain the header , footer and connection to the database will included in every php file of this website
        include '../admintemplates/adminheader.php' ; 
    ?>


<div class="homepage-container">
    <body>
        <div class="container mt-5">
            <?php include('../admincomponent/messages.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit The Content Detail At Below!
                                <a href="../admin/viewcontent.php" class="btn btn-danger float-end"><i class="fa-solid fa-circle-arrow-left"> Back</i></a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_GET['id']))
                                {
                                    $id = mysqli_real_escape_string($con, $_GET['id']);
                                    $query = "SELECT * FROM content WHERE id='$id' ";
                                    $query_run = mysqli_query($con, $query);
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        $row = mysqli_fetch_array($query_run);
                                        ?>
                                        <form action="../adminfunction/admincontentfunction.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <div class="mb-3">
                                                <label>Header</label>
                                                <input type="text" name="header" value="<?=$row['header'];?>" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Content</label>
                                                <textarea name="content" rows="10" cols="156"><?=$row['content'];?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<h4>No Such Id Found</h4>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>