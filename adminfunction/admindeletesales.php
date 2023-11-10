<?php
    session_start();
    include '../templates/dbcon.php';

    if(isset($_POST['delete']))
    {
        $pid = mysqli_real_escape_string($con, $_POST['delete']);
        $query = "DELETE FROM sales WHERE pid='$pid' ";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header("Location: ../admin/viewsales.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header("Location: ../admin/viewsales.php");
            exit(0);
        }
    }
    ?>