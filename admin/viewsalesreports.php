<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "zephyrus_rent");

$test = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedYear = $_POST["selectedYear"]; // Assuming you have a form with a select input for selecting the year.
    
    // Fetch and process data from the database for the selected year
    $query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(price) AS total_price FROM sales WHERE YEAR(date) = '$selectedYear' GROUP BY month";
    $res = mysqli_query($link, $query);
    
    $months = array(
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    );
    
    $monthlyData = array();
    
    while ($row = mysqli_fetch_array($res)) {
        $month = date("F", strtotime($row["month"] . "-01")); // Format month name
        $total_price = $row["total_price"];
        $monthlyData[$month] = $total_price;
    }
    
    // Generate data for all 12 months
    foreach ($months as $monthName) {
        $price = isset($monthlyData[$monthName]) ? $monthlyData[$monthName] : 0;
        $test[] = array("label" => $monthName, "y" => $price);
    }
}

?>
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
    <script>
        window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "View Sales Report By Selected Year"
        },
        axisY: {
            title: "The Total Price ",
            valueFormatString: "RM#,##0.##",

        },
        data: [{
            type: "column", // Use "column" for a bar chart
            xValueFormatString: "MMMM", // Format to display full month name
            yValueFormatString: "RM#,##0.##",
            dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
        }]
    });

    chart.render();
}

        
    </script>
    
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
                                    
                                    <h3>View Sales Reports
                                        
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped" >
                                        <thead>
                                            <tr>
                                                <th>Property ID</th>
                                                <th>Price (RM)</th>
                                                <th>Type Of Property</th>
                                                <th>Date Of Sales</th>
                                            </tr>
                                           
                                        </thead>
                                        <tbody>
                                            
                                        <?php
                                            $query = "SELECT * FROM sales";
                                            $query_run = mysqli_query($con, $query);
                                            
                                            $showCount = 5; // Number of listings to show initially
                                            $data = mysqli_fetch_all($query_run, MYSQLI_ASSOC); // Fetch all data
                                            
                                            if (count($data) > 0) {
                                            
                                                for ($i = 0; $i < min($showCount, count($data)); $i++) {
                                                    // Display the first $showCount rows
                                                    echo '<tr>';
                                                    echo '<td>' . $data[$i]['pid'] . '</td>';
                                                    echo '<td>' . $data[$i]['price'] . '</td>';
                                                    echo '<td>' . $data[$i]['type'] . '</td>';
                                                    echo '<td>' . $data[$i]['date'] . '</td>';
                                                    echo '<td>
                                                        <form action="../adminfunction/admindeletesales.php" method="POST" class="d-inline">
                                                            <div class="col-md-12 text-center">
                                                                <button type="submit" name="delete" value="' . $data[$i]['pid'] . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                            </div>
                                                        </form>
                                                    </td>';
                                                    echo '</tr>';
                                                }
                                                

                                                // Show the "View More" button if there are more records
                                                if (count($data) > $showCount) {
                                                    echo '<button class="btn btn-success" id="view-more-btn" data-showcount="' . $showCount . '">View More &#8659;</button>';
                                                    echo '<button class="btn btn-danger"  id="view-less-btn" data-showcount="10" style="display: none;">View Less &#8657;</button>';
                                                }

                                            } else {
                                                echo "<h5>No Record Found</h5>";
                                            }
                                        ?>
                                        </tbody>
                                        
                                    </table>
                                    <br>
                                    <table>
                                        <tr>
                                            <a href="viewsales.php"><button type="button" class="btn btn-success btn-lg" style="margin-left:5%;margin-bottom:2%">View Bar Chart</button></a>
                                            &nbsp;<a href="viewsalespie.php"><button type="button" class="btn btn-success btn-lg" style="margin-bottom:2%">View Pie Chart</button></a>
                                            &nbsp;<a href="viewsalesreports.php"><button type="button" class="btn btn-success btn-lg" style="margin-bottom:2%">Sales Repoert</button></a>
                                        </tr><br>
                                        
                                        <tr>
                                            <form method="POST">
                                                <label for="selectedYear" style="margin-left:5%"><b>Select Year:</b></label>
                                                <select name="selectedYear" id="selectedYear">
                                                    <?php
                                                    // Fetch all distinct years from the database
                                                    $query = "SELECT DISTINCT YEAR(date) AS year FROM sales";
                                                    $res = mysqli_query($link, $query);

                                                    // Retrieve the selected year from the form data
                                                    $selectedYear = isset($_POST["selectedYear"]) ? $_POST["selectedYear"] : null; // Use null if not set

                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $year = $row["year"];
                                                        $selected = ($selectedYear == $year) ? 'selected' : '';
                                                        echo "<option value='$year' $selected>$year</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </form>                          
                                        </tr>
                                        <tr><p style="margin-left:5%">"Please click 'Submit' button above to generate and view the report."</p></tr>
                                        <tr>
                                            <div style="margin-top:3%">
                                                
                                                <div id="chartContainer" style="height: 500px; width: 95%; margin-left:2%;margin-bottom:7%"></div>
                                                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                            </div>
                                            </tr>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const viewMoreBtn = document.getElementById('view-more-btn');
        const viewLessBtn = document.getElementById('view-less-btn');
        const table = document.querySelector('table');
        let showCount = parseInt(viewMoreBtn.getAttribute('data-showcount'));

        viewMoreBtn.addEventListener('click', function() {
            const data = <?= json_encode($data) ?>;
            for (let i = showCount; i < data.length; i++) {
                const row = table.insertRow();
                row.innerHTML = '<td>' + data[i]['pid'] + '</td>' +
                    '<td>' + data[i]['price'] + '</td>' +
                    '<td>' + data[i]['type'] + '</td>' +
                    '<td>' + data[i]['date'] + '</td>' +
                    '<td><form action="../adminfunction/admindeletesales.php" method="POST" class="d-inline"><div class="col-md-12 text-center"><button type="submit" name="delete" value="' + data[i]['pid'] + '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></div></form></td>';
            }
            showCount = data.length;

            viewMoreBtn.style.display = 'none';
            viewLessBtn.style.display = 'inline';
        });

        viewLessBtn.addEventListener('click', function() {
            const data = <?= json_encode($data) ?>;
            // Remove all rows from the table
            while (table.rows.length > 0) {
                table.deleteRow(0);
            }
            // Display the first 5 rows
            for (let i = 0; i < 5; i++) {
                if (data[i]) {
                    const row = table.insertRow();
                    row.innerHTML = '<td>' + data[i]['pid'] + '</td>' +
                        '<td>' + data[i]['price'] + '</td>' +
                        '<td>' + data[i]['type'] + '</td>' +
                        '<td>' + data[i]['date'] + '</td>' +
                        '<td><form action="../adminfunction/admindeletesales.php" method="POST" class="d-inline"><div class="col-md-12 text-center"><button type="submit" name="delete" value="' + data[i]['pid'] + '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></div></form></td>';
                }
            }
            showCount = 5;

            viewLessBtn.style.display = 'none';
            viewMoreBtn.style.display = 'inline';
        });
    });
</script>

</body>

</html>

   