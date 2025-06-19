<?php
include 'Connect.php';

$id = $_GET['id'] ?? 0; // Get the ID of the record to be updated

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $id = $_POST['id'] ?? 0;

    // Initialize $inputRange to prevent undefined variable warning
    $inputRange = $_POST['inputRange'] ?? 0;

    // Validate text input
    if (empty(trim($_POST['inputText'] ?? ''))) {
        $errors[] = 'Text input is required.';
    }

    // Validate email input
    $email = trim($_POST['inputEmail'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate password input
    $password = trim($_POST['inputPassword'] ?? '');
    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters long.';
    }

    $cnic = $_POST['inputNumber'] ?? '';
    $cnic = preg_replace('/[^0-9]/', '', $cnic); // Remove non-numeric characters

    if (strlen($cnic) != 13 || !is_numeric($cnic)) {
        $errors[] = 'CNIC number must be exactly 13 digits long.';
    }

    // Validate select dropdown
    if (empty($_POST['inputSelect'] ?? '')) {
        $errors[] = 'Select option is required.';
    }

    // Validate radio buttons
    if (empty($_POST['radioOptions'] ?? '')) {
        $errors[] = 'Radio option is required.';
    }

    // Validate file input
    if (!isset($_FILES['formFile']) || $_FILES['formFile']['error'] != 0) {
        $errors[] = 'File upload is required.';
    } else {
        $fileType = $_FILES['formFile']['type'];
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Only JPEG, PNG, and PDF files are allowed.';
        }
    }

    // Validate date input
    if (empty(trim($_POST['inputDate'] ?? ''))) {
        $errors[] = 'Date input is required.';
    }

    // Validate time input
    if (empty(trim($_POST['inputTime'] ?? ''))) {
        $errors[] = 'Time input is required.';
    }

    // Validate range input
    $range = intval($inputRange); // Use the initialized variable
    if ($range < 0 || $range > 100) {
        $errors[] = 'Range must be between 0 and 100.';
    }

    // Validate textarea
    if (empty(trim($_POST['inputTextarea'] ?? ''))) {
        $errors[] = 'Textarea is required.';
    }

    if (empty($errors)) {
        // Get POST data
        $inputText = $_POST['inputText'] ?? '';
        $inputEmail = $_POST['inputEmail'] ?? '';
        $inputPassword = $_POST['inputPassword'] ?? '';
        $inputNumber = $_POST['inputNumber'] ?? '';
        $inputSelect = $_POST['inputSelect'] ?? '';
        $inputProgramPreference1 = $_POST['inputProgramPreference1'] ?? '';
        $inputProgramPreference2 = $_POST['inputProgramPreference2'] ?? '';
        $inputProgramPreference3 = $_POST['inputProgramPreference3'] ?? '';
        $inputHobbies = $_POST['inputHobbies'] ?? '';
        $radioOptions = $_POST['radioOptions'] ?? '';
        $inputDate = $_POST['inputDate'] ?? '';
        $inputTime = $_POST['inputTime'] ?? '';
        $inputAgeRange = $_POST['inputAgeRange'] ?? '';
        $inputTextarea = $_POST['inputTextarea'] ?? '';

        // Update query
        $query = "UPDATE getform SET name='$inputText', email='$inputEmail', password='$inputPassword', cnic='$inputNumber', select_program='$inputSelect', program_preference_1='$inputProgramPreference1', program_preference_2='$inputProgramPreference2', program_preference_3='$inputProgramPreference3', hobbies='$inputHobbies', session='$radioOptions', test_date='$inputDate', test_time='$inputTime', ageRange='$inputAgeRange', joinUni='$inputTextarea' WHERE id='$id'";

        if (mysqli_query($con, $query)) {
            $message = 'Data Updated Successfully';
            $icon = 'success';
            $redirect = 'Newview.php'; // Redirect to Newview.php or any other page
        } else {
            $message = 'Error: ' . mysqli_error($con);
            $icon = 'error';
            $redirect = ''; // No redirection on error
        }
        mysqli_close($con);
        exit; // Stop PHP execution here
    } else {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error) . '</div>';
        }
    }
} else {
    // Fetch the current record data
    $result = mysqli_query($con, "SELECT * FROM getform WHERE id='$id'");
    if ($row = mysqli_fetch_assoc($result)) {
        $inputText = $row['name'];
        $inputEmail = $row['email'];
        $inputPassword = $row['password'];
        $inputNumber = $row['cnic'];
        $inputSelect = $row['select_program'];
        $inputProgramPreference1 = $row['program_preference_1'];
        $inputProgramPreference2 = $row['program_preference_2'];
        $inputProgramPreference3 = $row['program_preference_3'];
        $inputHobbies = $row['hobbies'];
        $radioOptions = $row['session'];
        $inputDate = $row['test_date'];
        $inputTime = $row['test_time'];
        $inputAgeRange = $row['ageRange'];
        $inputTextarea = $row['joinUni'];
        // Initialize $inputRange to prevent undefined variable warning
        $inputRange = $row['range'] ?? 0; // Ensure this column name exists
    } else {
        echo 'Record not found.';
        exit; // Stop PHP execution here if record not found
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Include SweetAlert library -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Update Record</h1>
        <form action="Newupdate.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="mb-3">
                <label for="inputText" class="form-label">Text:</label>
                <input type="text" id="inputText" name="inputText" class="form-control" value="<?php echo htmlspecialchars($inputText); ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email:</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" value="<?php echo htmlspecialchars($inputEmail); ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password:</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" value="<?php echo htmlspecialchars($inputPassword); ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputNumber" class="form-label">CNIC:</label>
                <input type="text" id="inputNumber" name="inputNumber" class="form-control" value="<?php echo htmlspecialchars($inputNumber); ?>" required>
            </div>

            <div class="form-group mb-3">
    <label for="inputSelect" class="form-label">Select Program</label>
    <select class="form-select" id="inputSelect" name="inputSelect" required>
        <option value="">Select Program</option>
        <option value="1">BS in Computer Science BS(CS)</option>
        <option value="2">BS in Software Engineering BS(SE)</option>
        <option value="3">BS in Information Technology BS(IT)</option>
        <option value="4">BS in Artificial Intelligence BS(AI)</option>
        <option value="5">ADP in Computer Science ADP(CS)</option>
        <option value="6">ADP in Account and Finance-ADP(AF)</option>
        <option value="7">ADP in Digital Marketing-ADP(DM)</option>
        <option value="8">Bachelor of Business Administration- BBA</option>
        <option value="9">Bachelor of Fashion Design- BFD</option>
        <option value="10">Bachelor of Textile Design- BTD</option>                        
    </select>
    <div class="invalid-feedback">
        Please select an option.
    </div>
</div>

           <!-- Program Preference 1 -->
<div class="form-group mb-3">
    <label for="inputProgramPreference1" class="form-label">Program Preference 1</label>
    <select class="form-select" id="inputProgramPreference1" name="inputProgramPreference1" required>
        <option value="">Select Program Preference 1</option>
        <option value="1">BS in Computer Science BS(CS)</option>
        <option value="2">BS in Software Engineering BS(SE)</option>
        <option value="3">BS in Information Technology BS(IT)</option>
        <option value="4">BS in Artificial Intelligence BS(AI)</option>
        <option value="5">ADP in Computer Science ADP(CS)</option>
        <option value="6">ADP in Account and Finance-ADP(AF)</option>
        <option value="7">ADP in Digital Marketing-ADP(DM)</option>
        <option value="8">Bachelor of Business Administration- BBA</option>
        <option value="9">Bachelor of Fashion Design- BFD</option>
        <option value="10">Bachelor of Textile Design- BTD</option>
    </select>
    <div class="invalid-feedback">
        Please select an option for Program Preference 1.
    </div>
</div>

<!-- Program Preference 2 -->
<div class="form-group mb-3">
    <label for="inputProgramPreference2" class="form-label">Program Preference 2</label>
    <select class="form-select" id="inputProgramPreference2" name="inputProgramPreference2" required>
        <option value="">Select Program Preference 2</option>
        <option value="1">BS in Computer Science BS(CS)</option>
        <option value="2">BS in Software Engineering BS(SE)</option>
        <option value="3">BS in Information Technology BS(IT)</option>
        <option value="4">BS in Artificial Intelligence BS(AI)</option>
        <option value="5">ADP in Computer Science ADP(CS)</option>
        <option value="6">ADP in Account and Finance-ADP(AF)</option>
        <option value="7">ADP in Digital Marketing-ADP(DM)</option>
        <option value="8">Bachelor of Business Administration- BBA</option>
        <option value="9">Bachelor of Fashion Design- BFD</option>
        <option value="10">Bachelor of Textile Design- BTD</option>
    </select>
    <div class="invalid-feedback">
        Please select an option for Program Preference 2.
    </div>
</div>

<!-- Program Preference 3 -->
<div class="form-group mb-3">
    <label for="inputProgramPreference3" class="form-label">Program Preference 3</label>
    <select class="form-select" id="inputProgramPreference3" name="inputProgramPreference3" required>
        <option value="">Select Program Preference 3</option>
        <option value="1">BS in Computer Science BS(CS)</option>
        <option value="2">BS in Software Engineering BS(SE)</option>
        <option value="3">BS in Information Technology BS(IT)</option>
        <option value="4">BS in Artificial Intelligence BS(AI)</option>
        <option value="5">ADP in Computer Science ADP(CS)</option>
        <option value="6">ADP in Account and Finance-ADP(AF)</option>
        <option value="7">ADP in Digital Marketing-ADP(DM)</option>
        <option value="8">Bachelor of Business Administration- BBA</option>
        <option value="9">Bachelor of Fashion Design- BFD</option>
        <option value="10">Bachelor of Textile Design- BTD</option>
    </select>
    <div class="invalid-feedback">
        Please select an option for Program Preference 3.
    </div>
</div>

            <div class="mb-3">
                <label for="inputHobbies" class="form-label">Hobbies:</label>
                <input type="text" id="inputHobbies" name="inputHobbies" class="form-control" value="<?php echo htmlspecialchars($inputHobbies); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Session</label>
                <div class="form-check">
                    <input type="radio" id="radioOption1" name="radioOptions" value="option1" class="form-check-input" <?php echo ($radioOptions == 'option1') ? 'checked' : ''; ?>>
                    <label for="radioOption1" class="form-check-label">Morning</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="radioOption2" name="radioOptions" value="option2" class="form-check-input" <?php echo ($radioOptions == 'option2') ? 'checked' : ''; ?>>
                    <label for="radioOption2" class="form-check-label">Evening</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputDate" class="form-label">Test Date</label>
                <input type="date" id="inputDate" name="inputDate" class="form-control" value="<?php echo htmlspecialchars($inputDate); ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputTime" class="form-label">Test Time</label>
                <input type="time" id="inputTime" name="inputTime" class="form-control" value="<?php echo htmlspecialchars($inputTime); ?>" required>
            </div>

           <!--Age Range-->
<div class="form-group mb-3">
    <label for="inputAgeRange" class="form-label">Age Range</label>
    <input type="range" class="form-control" id="inputAgeRange" name="inputAgeRange" min="0" max="120" value="30" required>
    <div class="invalid-feedback">
        Please select an age between 0 and 120.
    </div>
    <p>Selected Age: <span id="ageValue">30</span></p>
</div>

            <div class="mb-3">
                <label for="inputTextarea" class="form-label">Textarea:</label>
                <textarea id="inputTextarea" name="inputTextarea" class="form-control" rows="3" required><?php echo htmlspecialchars($inputTextarea); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">File input:</label>
                <input class="form-control" type="file" id="formFile" name="formFile">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="Newview.php" class="btn btn-primary">Back</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($message)): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $icon; ?>',
                title: '<?php echo $message; ?>',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                <?php if (!empty($redirect)): ?>
                    window.location.href = '<?php echo $redirect; ?>';
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>
   
</body>
</html>
