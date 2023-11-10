
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"></script>
    <script src="javascript/panolens.min.js"></script>
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
        /* CSS for responsive images */
            .responsive-image {
                max-width: 80%;
                height: auto;
                margin-left: 10%;
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
                                    
                                    <h3>Content Informations
                                    <a href="../adminfunction/contentinsert.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus"> ADD</i></a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped" >
                                        <thead>
                                            <tr>
                                               
                                                <th>Header</th>
                                                <th>Content</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = "SELECT * FROM content";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                    foreach($query_run as $row)
                                                    {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?= $row['header']?></td>
                                                            <td><?= $row['content']?></td>
                                                            
                                                            
                                                            <td>
                                                            <div class="col-md-12 text-center">
                                                                <a href="../adminfunction/contentedit.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                <form action="../adminfunction/admincontentfunction.php" method="POST" class="d-inline">
                                                                    <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                                
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
                                    <br>    
                                    
                                    <table id="example" class="table table-bordered table-striped" >
                                        <thead>
                                        <h3>Edit Panorama Image<h3>
                                            <tr>
                                                <th>Image ID</th>
                                                <th style="width:40%">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = "SELECT * FROM panorama";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                    foreach($query_run as $row)
                                                    {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?= $row['id']?></td>
                                                            <td>

                                                                <!-- <?= $row['image_path']?> -->
                                                                <?php
                                                                $image_path = $row['image_path'];
                                                                $query = "SELECT * FROM panorama WHERE image_path = '$image_path'";
                                                                $res = mysqli_query($con, $query);

                                                                if (mysqli_num_rows($res) > 0) {
                                                                    while ($r = mysqli_fetch_array($res)) {
                                                                        ?>
                                                                        <div class="image">
                                                                            <img src='../images/img/<?php echo $r['image_path']; ?>'  class="responsive-image">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                    ?>
                                                                    </td>
                                                            <td><!-- Create a form for replacing the panorama image -->
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <label for="image">Replace Panorama Image:</label>
                                                                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" class="btn btn-success btn-sm">
                                                                <input type="submit" value="Replace Image" class="btn btn-success btn-sm">
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

                    // Handle the image replacement
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
                        $target_directory = "";
                        $target_file = $target_directory . basename($_FILES["image"]["name"]);
                        
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image_path = basename($_FILES["image"]["name"]);
                            $sql = "UPDATE panorama SET image_path = '$image_path' WHERE id = 1";

                            if (mysqli_query($conn, $sql)) {
                                $message = "Image replaced successfully.";
                                $panorama = $image_path; // Update the current image path
                            } else {
                                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        } else {
                            $message = "Sorry, there was an error uploading your file.";
                        }
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
                </style>

    
    

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

                        // JavaScript to display a popup box with the message
                        function showMessage() {
                            var message = "<?php echo $message; ?>";
                            if (message !== "") {
                                alert(message);
                            }
                        }
                        showMessage();
                </script>
            </div>
        </div>
      </div>    
</div>

</body>
</html>

   