<?php include 'Connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f7f9fc; /* Soft background color */
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .container {
            max-width: 1200px;
            padding-top: 20px;
        }

        
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .actions a {
            margin: 0 5px;
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #0056b3; /* Updated background color */
            color: white;
            text-align: center;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header .btn {
            margin-left: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 1.75rem;
            letter-spacing: 1px;
        }
        .content-wrapper {
            flex: 1;
            padding-top: 80px; /* Space for fixed header */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }
        .table th {
            background-color: #0056b3; /* Header background color */
            color: white;
            font-weight: bold;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            border-radius: 50px;
        }
        .footer {
            background-color: #0056b3; /* Updated background color */
            color: white;
            padding: 10px 0;
            text-align: center;
            width: 100%;
            margin-top: auto;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <h1>Student Records System</h1>
        <a href="Newform.php" class="btn btn-light btn-sm">Add New Student</a>
    </header>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Email Address</th>
                        <th>Password</th>
                        <th>Applicant CNIC</th>
                        <th>Select Program</th>
                        <th>Program Preference 1</th>
                        <th>Program Preference 2</th>
                        <th>Program Preference 3</th>
                        <th>Select Hobby</th>
                        <th>Session</th>
                        <th>Upload Challan</th>
                        <th>Select Test Date</th>
                        <th>Select Test Time</th>
                        <th>Age Range</th>
                        <th>Reason for Joining University</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM getform";
                    $data = mysqli_query($con, $query);
                    $result = mysqli_num_rows($data);
                    if ($result) {
                        while ($row = mysqli_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo isset($row['email']) ? htmlspecialchars($row['email']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['password']) ? htmlspecialchars($row['password']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['cnic']) ? htmlspecialchars($row['cnic']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['select_program']) ? htmlspecialchars($row['select_program']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['program_preference_1']) ? htmlspecialchars($row['program_preference_1']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['program_preference_2']) ? htmlspecialchars($row['program_preference_2']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['program_preference_3']) ? htmlspecialchars($row['program_preference_3']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['hobbies']) ? htmlspecialchars($row['hobbies']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['session']) ? htmlspecialchars($row['session']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['challan']) ? htmlspecialchars($row['challan']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['test_date']) ? htmlspecialchars($row['test_date']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['test_time']) ? htmlspecialchars($row['test_time']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['ageRange']) ? htmlspecialchars($row['ageRange']) : 'N/A'; ?></td>
                                <td><?php echo isset($row['joinUni']) ? htmlspecialchars($row['joinUni']) : 'N/A'; ?></td>

                                <td class="actions">
                                    <a href="Newupdate.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td class="actions">
                                    <a href="Deletenew.php" class="btn btn-danger btn-sm delete-link" data-id="<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="17" class="text-center">No Records Found</td>
                        </tr>
                        <?php    
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Student Records System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Add click event listener to all delete links
            document.querySelectorAll('.delete-link').forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent default link behavior

                    const itemId = link.getAttribute('data-id'); // Get the item ID from the data attribute

                    // Show SweetAlert confirmation dialog
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
                            // Redirect to the delete.php page with the item ID
                            window.location.href = `Newdelete.php?id=${itemId}`;
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
