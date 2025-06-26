<?php
include 'Connect.php';

header('Content-Type: application/json');

$id = $_POST['id'] ?? 0;

// Get all input values
$name = $_POST['inputText'] ?? '';
$email = $_POST['inputEmail'] ?? '';
$password = $_POST['inputPassword'] ?? '';
$cnic = $_POST['inputNumber'] ?? '';
$select_program = $_POST['inputSelect'] ?? '';
$pref1 = $_POST['inputProgramPreference1'] ?? '';
$pref2 = $_POST['inputProgramPreference2'] ?? '';
$pref3 = $_POST['inputProgramPreference3'] ?? '';
$session = $_POST['radioOptions'] ?? '';
$hobbiesArray = $_POST['inputHobbies'] ?? []; // array if multiple
$hobbies = is_array($hobbiesArray) ? implode(',', $hobbiesArray) : $hobbiesArray;
$date = $_POST['inputDate'] ?? '';
$time = $_POST['inputTime'] ?? '';
$age = $_POST['inputAgeRange'] ?? 0;
$textarea = $_POST['inputTextarea'] ?? '';
$filePath = '';

// File upload handling
if (isset($_FILES['formFile']) && $_FILES['formFile']['error'] === 0) {
    $fileName = uniqid() . '_' . basename($_FILES['formFile']['name']);
    $targetDir = "upload/";
    $targetPath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['formFile']['tmp_name'], $targetPath)) {
        $filePath = $targetPath;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload file.']);
        exit;
    }
}

// Basic validation
if (!$id || !$name || !$email || !$password || !$cnic || !$select_program || !$session) {
    echo json_encode(['status' => 'error', 'message' => 'All required fields must be filled.']);
    exit;
}

// Prepare the update query
$query = "UPDATE getform SET 
            name='$name',
            email='$email',
            password='$password',
            cnic='$cnic',
            select_program='$select_program',
            program_preference_1='$pref1',
            program_preference_2='$pref2',
            program_preference_3='$pref3',
            hobbies='$hobbies',
            session='$session',
            test_date='$date',
            test_time='$time',
            ageRange='$age',
            joinUni='$textarea'";

// Conditionally add file_path if new file uploaded
if ($filePath) {
    $query .= ", file_path='$filePath'";
}

$query .= " WHERE id='$id'";

// Execute
if (mysqli_query($con, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($con)]);
}
