<?php
$version="1.0";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "traveldb";

define('DBUSER', $username);
define('DBPWD', $password);
define('DBHOST', $servername);
define('DBNAME', $dbname);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the SQL query
$sql = "
    SELECT 
        CONCAT(u.firstname, ' ', u.lastname) AS name,
        u.phone AS phone,
        u.email AS email,
        pbd.qty AS Quantity,
        up.name AS package_name,
        ur.name AS room_name,
        ur.rateperperson AS rateperperson,
        CASE 
            WHEN pb.status = 0 THEN 'Booked' 
            WHEN pb.status = 1 THEN 'Confirmed' 
        END AS status,
        pb.pnr,
        CASE 
            WHEN LENGTH(pb.notes) > 1 THEN 'Yes' 
            ELSE 'No' 
        END AS notes,
        DATE_FORMAT(pb.dated, '%b, %d %Y') AS formatted_date
    FROM 
        upackage_booking_details pbd
    JOIN 
        users u ON u.user_id = pbd.user_id
    JOIN 
        upackages up ON up.id = pbd.pid
    JOIN 
        upackageroom ur ON ur.tblumrahpackages_id = up.id
    JOIN 
        upackage_bookings pb ON pb.pid = pbd.pid AND pb.user_id = pbd.user_id
    WHERE 
        pb.status < 2
    ORDER BY 
        pb.dated DESC;
";

// Execute the query
$result = $conn->query($sql);
$progress = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $progress[] = $row;
    }
} else {
    $progress = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables with Excel and PDF Export</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons extension for Excel and PDF export -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- pdfmake and pdfmake-vfs for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
</head>
<body>

<div class="container">
    <h2>Booking Data</h2>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Quantity</th>
                <th>Package Name</th>
                <th>Room Name</th>
                <th>Rate per Person</th>
                <th>Status</th>
                <th>PNR</th>
                <th>Notes</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($progress as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                <td><?php echo htmlspecialchars($row['rateperperson']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo htmlspecialchars($row['pnr']); ?></td>
                <td><?php echo htmlspecialchars($row['notes']); ?></td>
                <td><?php echo htmlspecialchars($row['formatted_date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>

    $(document).ready(function() {
    $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [
    'excelHtml5',
    'pdfHtml5'
    ]
    });
    });			
</script>



</body>
</html>
