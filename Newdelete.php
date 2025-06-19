<?php
include 'Connect.php'; // Include your database connection file

// Check if an ID is provided for deletion
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM getform WHERE id='$id'";
    $data = mysqli_query($con, $query);

    // Redirect with a status parameter based on the result of the delete operation
    if ($data) {
        header('Location: Newdelete.php?status=success');
        exit();
    } else {
        header('Location: Newdelete.php?status=error');
        exit();
    }
}

// Check for status in the URL and set SweetAlert message
$statusMessage = '';
$statusIcon = '';
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status === 'success') {
        $statusMessage = 'Data Deleted Successfully';
        $statusIcon = 'success';
    } elseif ($status === 'error') {
        $statusMessage = 'Please try again';
        $statusIcon = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert Delete Confirmation</title>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Button to trigger delete confirmation -->
    <button id="deleteButton">Delete Item</button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusMessage = "<?php echo $statusMessage; ?>";
            const statusIcon = "<?php echo $statusIcon; ?>";

            // Trigger SweetAlert confirmation dialog
            document.getElementById('deleteButton').addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Get the item ID dynamically if available
                        // Example static ID for illustration (Replace 'YOUR_ITEM_ID' with actual ID)
                        const itemId = 'YOUR_ITEM_ID'; // Replace this with dynamic value
                        window.location.href = `Newdelete.php?id=${itemId}`;
                    }
                });
            });

            // Display SweetAlert message based on status
            if (statusMessage) {
                Swal.fire({
                    title: statusIcon === 'success' ? 'Deleted!' : 'Error!',
                    text: statusMessage,
                    icon: statusIcon,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'http://localhost/Get/Newview.php'; // Redirect after showing the message
                });
            }
        });
    </script>
</body>
</html>