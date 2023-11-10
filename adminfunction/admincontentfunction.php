<?php
    session_start();
    include '../templates/dbcon.php';

    if(isset($_POST['delete']))
    {
        $id = mysqli_real_escape_string($con, $_POST['delete']);
        $query = "DELETE FROM content WHERE id='$id' ";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header("Location: ../admin/viewcontent.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header("Location: ../admin/viewcontent.php");
            exit(0);
        }
    }
    if(isset($_POST['update']))
    {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $header = mysqli_real_escape_string($con, $_POST['header']);
        $content = mysqli_real_escape_string($con, $_POST['content']);
        $query = "UPDATE content SET header='$header', content='$content' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "Updated Successfully";
            header("Location: ../admin/viewcontent.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Updated";
            header("Location: ../admin/viewcontent.php");
            exit(0);
        }
    }
    if(isset($_POST['save']))
    {
        $header = mysqli_real_escape_string($con, $_POST['header']);
        $content = mysqli_real_escape_string($con, $_POST['content']);
        $query = "INSERT INTO content (header,content) VALUES ('$header','$content')";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "Created Successfully";
            header("Location: ../admin/viewcontent.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Created";
            header("Location: ../admin/viewcontent.php");
            exit(0);
        }
    }
?>