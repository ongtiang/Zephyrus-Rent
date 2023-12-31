<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = ""> 
    <title>Zephyrus Rental - List</title>
    <link rel = 'stylesheet' href=  '../css/header.css?v=<?php echo time();?>'> 
    <link rel = 'stylesheet' href= '../css/list.css?v=<?php echo time() ; ?>'>
    <link rel = 'icon' href='../images/logo1.png'>
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 

</head>
<body class = 'list'>
    <?php
    //This file is reponsible for getting the property data from the data
    // and pushes it into the database for displaying to other users for renting 
    include '../templates/header.php' ;
    include '../templates/dbcon.php' ; 
    if($_SERVER['REQUEST_METHOD']== 'POST'){

        //Getting all the inputs from the form 
        $type = $_POST['type']  ; 
        $sqft = $_POST['sqft'] ;  
        $street = $_POST['street'] ; 
        $area = $_POST['area'] ; 
        $city = $_POST['city']  ; 
        $pincode = $_POST['pincode'] ; 
        $state=  $_POST['state']  ; 
        $tenant = $_POST['tenants'] ; 
        $country = $_POST['country'] ;  
        $expiry = $_POST['expiry'] ;
        $detail = $_POST['detail'] ;
        $furnish = $_POST['furnish'] ; 
        $price = $_POST['price'] ; 
        $owner = $_SESSION['id'] ; 
        // $panorama = $_POST['panorama']; 
        $owner_name = $_SESSION['name']." ".$_SESSION['lname'] ; 
        

        //Query to insert data into the properties table 

        $sql = "INSERT INTO properties(type,sqft,expiry,detail,street,area,pincode,city,country,state,price,owner,ownername,tenant,furnish) VALUES ( '$type','$sqft','$expiry','$detail','$street','$area','$pincode','$city','$country','$state','$price','$owner','$owner_name','$tenant','$furnish')" ; 
        if(!mysqli_query($con , $sql)){
            echo "<script>alert('Data not inserted , please try again later. If this problem occurs too often contact the admin') ; </script>" ; 
            echo $con ->error  ;
        }
        $target = '../images/property_images/' ; 
        $allowtypes = array('jpg','png','jpeg') ; 
        $sql = "SELECT * FROM properties WHERE pincode = '$pincode' AND sqft = '$sqft' AND expiry = '$expiry' AND type = '$type' AND street = '$street' AND price = '$price'" ; 
        $result = mysqli_query($con,$sql) ; 

        //The following code in this PHP block is entirely responsible for uploading the images file
        //Image file uploading takes place in the following steps 
        //First the type of the file is checked only .jpg , .png and .jpeg file is accepted 
        //As a second step the file which was uploaded is moved into the specified directory using move_uploaded_file() function 
        //Then atlast , the image file name and to which property it belongs to is updated into the database 
        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_array($result)){
                $fileNames = array_filter($_FILES['files']['name']) ;
                $id  =$row['id'] ;  
                if(!empty($fileNames)){
                    foreach($_FILES['files']['name'] as $key => $value){
                        $fileName = basename($_FILES['files']['name'][$key]) ; 
                        $targetFilePath = $target.$fileName ; 
                        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION) ; 
                        if(in_array($fileType , $allowtypes)){
                            if(!move_uploaded_file($_FILES['files']['tmp_name'][$key] , $targetFilePath)){
                                echo "Image was not moved to the database" ; 
                            } 
                            $sql = "INSERT INTO images(imagename,property) VALUES('$fileName','$id')" ; 
                            if(!mysqli_query($con,$sql)) echo $con -> error ; 
                        }
                        else{
                            echo "<script>alert('Image file type not supported');</script>" ; 
                            $sql  = "DELETE FROM properties WHERE id = '$id'" ; 
                            mysqli_query($con ,$sql) ; 
                            $fail = 1;  
                            break  ;
                        }
                    }
                    if(!isset($fail)) echo "<script>alert('Your Property has been successfully listed!')</script>";  
                } 
                else{
                    echo "<script>alert('Please Upload Some images of your property') ; </script>" ; 
                    $sql  = "DELETE FROM properties WHERE id = '$id'" ; 
                    mysqli_query($con ,$sql) ; 
                }
            }
        }

    }
    ?>
    <div class="list-form">
    <form action="" method="post" enctype="multipart/form-data" onsubmit = "return listValidate()">
        <fieldset>
            <legend>Property Info</legend>
    
            <label for = 'type'>Property Type:</label>
            <input type = 'text' id = 'type' name = 'type' placeholder = 'Apartment/Condo/Bungalow etc'  required>
        
            <label for = 'sqft'>Property Square feet:</label>
            <input type = 'number' id = 'sqft' name = 'sqft' min='1' placeholder = 'sqft' required>

            
            <div class = 'radio'>
            <label >Preferred Tenants:</label>
                <div class = 'radio-input'><input type = 'radio' name = 'tenants' id = 'tenant1' value = 'Family' required >
                <label for = 'tenant1' class = 'radio-labels'>Family</label></div>
                <div class = 'radio-input'><input type = 'radio' name = 'tenants' id = 'tenant2' value = 'Bachelors' required>
                <label for = 'tenant2' class = 'radio-labels'>Bachelors</label></div>
                <div class = 'radio-input'><input type = 'radio' name = 'tenants' id = 'tenant3' value = 'Any' checked checked>
                <label for = 'tenant3' class = 'radio-labels'>Any</label></div>
            </div>

            
            <div class = 'radio'>
                <label>Furnishing Status:</label><br><br>
                <div class = 'radio-input'><input type = 'radio' name = 'furnish' id = 'furnish1' value = 'Fully-Furnished' required >
                <label for = 'furnish1' class = 'radio-labels'>Fully-Furnished</label></div>
                <div class = 'radio-input'><input type = 'radio' name = 'furnish' id = 'furnish2' value = 'Semi-Furnished' required>
                <label for = 'furnish2' class = 'radio-labels'>Semi-Furnished</label></div>
                <div class = 'radio-input'><input type = 'radio' name = 'furnish' id = 'furnish3' value = 'No-Furnishing' checked>
                <label for = 'furnish3' class = 'radio-labels'>No-Furnishing</label></div>
            </div>
            
            <label for = 'price'>Property Price/Month:</label>
            <input type = 'number' id = 'price' name = 'price' min='1' placeholder = 1400 required>

            <label for = 'expiry'>Listing Expiry Date:</label>
            <input type = 'date' id = 'expiry' name = 'expiry' required value="2024-11-24">

            <label for = 'expiry'>Detail Of Property:</label>
            <input type = 'text' id = 'detail' name = 'detail'  placeholder="3 bed room, 2 toilet">
        </fieldset> 
        <fieldset>
            <legend>Location Info</legend>
        
            <label for = 'street'>Street:</label>
            <input type = 'text' id = 'street' name = 'street'  Placeholder = 'Enter Street Name along with Door number' >
        
            <label for = 'area'>Area:</label>
            <input type = 'text' id = 'area' name = 'area' placeholder = 'Jalan Raja Uda'>
        
            <label for = 'pincode'>Pincode:</label>
            <input type = 'number' id = 'pincode' name = 'pincode' placeholder = 12300 required>
        
            <label for = 'city'>City:</label>
            <input type = 'text' id = 'city' name = 'city' placeholder = 'Butterworth' required>
        
            <label for = 'state'>State:</label>
            <input type = 'text' id = 'state' name = 'state' placeholder = 'Penang' required>
        
            <label for = 'country'>Country:</label>
            <input type = 'text' id = 'country' name = 'country' placeholder = 'Malaysia' required>
        </fieldset>
        <fieldset>
        <legend>Main Image</legend>
            <label for = 'image'>Upload the main property image</label>
            <input type="file" name="files[]" multiple required>
        </fieldset>
        <fieldset style="display: flex; flex-direction: row;">
        <legend>Images</legend>
            <label for = 'image'>image1</label>
            <input type="file" name="files[]" multiple required>
            <label for = 'image'>image2</label>
            <input type="file" name="files[]" multiple required>
            <label for = 'image'>image3</label>
            <input type="file" name="files[]" multiple required>
        </fieldset>
        <!-- <fieldset>
        <legend>Panorama Image (Optional)</legend>
            <label for = 'image'>Panorama Image (Optional)</label>
            <input type="file" id="panorama" name="panorama" required>
        </fieldset> -->
        <div class="button"><input type = 'submit' value = 'List' ></div>
    </form>
    </div>
    <script src  = '../javascript/list.js'></script>
    

<?php  include '../templates/footer.php' ;?>
</body>
</html>
