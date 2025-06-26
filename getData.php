<?php
include 'Connect.php';

header('Content-Type: application/json');

$query = "SELECT * FROM getform";
$result = mysqli_query($con, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['file_path'] = !empty($row['file_path']) ? "<img src='".htmlspecialchars($row['file_path'])."' width='100' height='100'>" : 'N/A';
    $row['actions'] = '
        <a href="Editform.html?id='.$row['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="#" class="btn btn-danger btn-sm delete-link" data-id="'.$row['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
    ';
    $data[] = $row;
}

echo json_encode(["data" => $data]);
