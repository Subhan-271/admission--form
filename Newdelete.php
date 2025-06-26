<?php
include 'Connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM getform WHERE id='$id'";
    $data = mysqli_query($con, $query);

    if ($data) {
        header("Location: Newview.html?status=success");
    } else {
        header("Location: Newview.html?status=error");
    }
    exit();
}
?>
