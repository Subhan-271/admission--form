<?php
header('Content-Type: application/json'); // Ensure JSON output
include 'Connect.php'; // Ensure no output from this file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Validate text input
    $inputText = trim($_POST['inputText'] ?? '');
    if (empty($inputText)) {
        $errors[] = 'Text input is required.';
    }

    // Validate email input
    $inputEmail = trim($_POST['inputEmail'] ?? '');
    if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate password
    $inputPassword = trim($_POST['inputPassword'] ?? '');
    if (strlen($inputPassword) < 6) {
        $errors[] = 'Password must be at least 6 characters long.';
    }

    // Validate CNIC
    $inputNumber = preg_replace('/[^0-9]/', '', $_POST['inputNumber'] ?? '');
    if (strlen($inputNumber) != 13) {
        $errors[] = 'CNIC must be exactly 13 digits.';
    }

    // Select option
    $inputSelect = $_POST['inputSelect'] ?? '';
    if (empty($inputSelect)) {
        $errors[] = 'Select option is required.';
    }

    // Radio
    $radioOptions = $_POST['radioOptions'] ?? '';
    if (empty($radioOptions)) {
        $errors[] = 'Radio option is required.';
    }

    // File upload
    $filePath = '';
    if (isset($_FILES['formFile']) && $_FILES['formFile']['error'] === 0) {
        $fileType = $_FILES['formFile']['type'];
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Only JPEG, PNG, and PDF files are allowed.';
        } else {
            $uploadDir = 'upload/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $fileName = uniqid() . '_' . basename($_FILES['formFile']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['formFile']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            } else {
                $errors[] = 'Failed to upload file.';
            }
        }
    } else {
        $errors[] = 'File upload is required.';
    }

    // Date & Time
    $inputDate = $_POST['inputDate'] ?? '';
    if (empty(trim($inputDate))) {
        $errors[] = 'Date is required.';
    }
    $inputTime = $_POST['inputTime'] ?? '';

    // Age Range
    $inputAgeRange = intval($_POST['inputAgeRange'] ?? 0);
    if ($inputAgeRange < 0 || $inputAgeRange > 100) {
        $errors[] = 'Age range must be between 0 and 100.';
    }

    // Textarea
    $inputTextarea = trim($_POST['inputTextarea'] ?? '');
    if (empty($inputTextarea)) {
        $errors[] = 'Textarea is required.';
    }

    // Optional
    $inputProgramPreference1 = $_POST['inputProgramPreference1'] ?? '';
    $inputProgramPreference2 = $_POST['inputProgramPreference2'] ?? '';
    $inputProgramPreference3 = $_POST['inputProgramPreference3'] ?? '';
    $inputHobbies = $_POST['inputHobbies'] ?? '';

    // Validation errors?
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'messages' => $errors]);
        exit;
    }

    // Save to DB
    $query = "INSERT INTO getform (name, email, password, cnic, select_program, program_preference_1, program_preference_2, program_preference_3, hobbies, session, test_date, test_time, ageRange, joinUni, file_path)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssssssssssssss", $inputText, $inputEmail, $inputPassword, $inputNumber, $inputSelect, $inputProgramPreference1, $inputProgramPreference2, $inputProgramPreference3, $inputHobbies, $radioOptions, $inputDate, $inputTime, $inputAgeRange, $inputTextarea, $filePath);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
    $con->close();
}
?>
