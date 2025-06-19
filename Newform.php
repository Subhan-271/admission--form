<?php
include 'Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

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
    $range = intval($_POST['inputRange'] ?? 0);
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

        
        // Server-side validation
        if (empty($inputText) || !filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Validation failed. Please check your input.']);
        } else {
            $query = "INSERT INTO getform (name,email,password,cnic,select_program,program_preference_1,program_preference_2,program_preference_3,hobbies,session,challan,test_date,test_time,ageRange,joinUni)VALUES('$inputText','$inputEmail','$inputPassword','$inputNumber','$inputSelect','$inputProgramPreference1','$inputProgramPreference2','$inputProgramPreference3','$inputHobbies','$radioOptions','','$inputDate','$inputTime','$inputAgeRange','$inputTextarea')";
            if (mysqli_query($con, $query)) {
                echo json_encode(['status' => 'success', 'message' => 'Data Saved Successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($con)]);
            }
        }
        mysqli_close($con);
        exit; // Stop PHP execution here
        echo '<div class="alert alert-success" role="alert">Form submitted successfully!</div>';
    } else {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error) . '</div>';
        }
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Form with PHP Processing</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Existing styles */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body {
            background: linear-gradient(135deg, #f2f2f2 0%, #ffffff 100%);
            flex: 1;
        }
        .header {
            background-color: #003366;
            color: white;
            padding: 1rem 0;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: fixed;
            margin-bottom: 2rem;
        }
        .header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        .header nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
        }
        .header nav a:hover {
            text-decoration: underline;
        }
        .footer {
            background-color: #003366;
            color: white;
            padding: 1rem 0;
            text-align: center;
            margin-top: auto;
            box-shadow: 0 -4px 6px rgba(0,0,0,0.1);
        }
        .form-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            margin-top: 2rem;
            transition: all 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.3);
        }
        .form-container h1 {
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: #343a40;
        }
        .form-container .form-label {
            font-weight: 500;
            color: #343a40;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Student Form</h1>
            <nav>
        <ul>
            <a href="./Home.php">Home</a>
            <a href="./About.php">About Us</a>
            <a href="./Contact.php">Contact Us</a>
        </ul>
    </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container flex-grow-1">
        <div class="form-container">
            <h1 class="text-center">Submit Your Information</h1>
            <form id="mainForm" action="" method="POST" enctype="multipart/form-data" novalidate>
            <!-- Applicant Name -->
                <div class="form-group mb-3">
                    <label for="inputText" class="form-label"> Applicant Name</label>
                    <input type="text" class="form-control" id="inputText" name="inputText" placeholder="Enter your name" required>
                    <div class="invalid-feedback">
                        Please enter your name.
                    </div>
                </div>
                
                <!-- Email Input -->
                <div class="form-group mb-3">
                    <label for="inputEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="name@example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>

                <!-- Password Input -->
                <div class="form-group mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required minlength="6">
                    <div class="invalid-feedback">
                        Password must be at least 6 characters long.
                    </div>
                </div>


              <!-- Applicant CNIC -->
<div class="form-group mb-3">
    <label for="inputNumber" class="form-label">Applicant CNIC</label>
    <input type="text" class="form-control" id="inputNumber" name="inputNumber" placeholder="Enter your 13 digit CNIC number" required pattern="\d{13}">
    <div class="invalid-feedback">
        Please enter your CNIC number.
    </div>
</div>

                <!-- Select Dropdown -->
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

<!-- Hobby Checkboxes -->
<div class="form-group mb-3">
    <label for="inputHobbies" class="form-label">Select Hobby</label>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby1" name="inputHobbies" value="Reading" >
        <label class="form-check-label" for="hobby1">Reading</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby2" name="inputHobbies" value="Traveling" >
        <label class="form-check-label" for="hobby2">Traveling</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby3" name="inputHobbies" value="Gaming" >
        <label class="form-check-label" for="hobby3">Gaming</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby4" name="inputHobbies" value="Gardening" >
        <label class="form-check-label" for="hobby4">Gardening</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby5" name="inputHobbies" value="Cooking" >
        <label class="form-check-label" for="hobby5">Cooking</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby6" name="inputHobbies" value="Photography" >
        <label class="form-check-label" for="hobby6">Photography</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby7" name="inputHobbies" value="Painting" >
        <label class="form-check-label" for="hobby7">Painting</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby8" name="inputHobbies" value="Cycling" >
        <label class="form-check-label" for="hobby8">Cycling</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby9" name="inputHobbies" value="Hiking" >
        <label class="form-check-label" for="hobby9">Hiking</label>
    </div>
    <div id="inputHobbies" class="form-check">
        <input class="form-check-input" type="checkbox" id="hobby10" name="inputHobbies" value="Knitting" >
        <label class="form-check-label" for="hobby10">Knitting</label>
    </div>
    <div class="invalid-feedback">
        Please select at least one hobby.
    </div>
    <div id="hobbyPreferences" class="mt-2"></div>
</div>


                <!-- Radio Buttons -->
                <div class="form-group mb-3">
                    <label class="form-label">Session</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioOptions" id="radio1" value="Morning" required>
                        <label class="form-check-label" for="radio1">
                        Morning
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioOptions" id="radio2" value="Evening" required>
                        <label class="form-check-label" for="radio2">
                        Evening
                        </label>
                    </div>
                    <div class="invalid-feedback">
                        Please select a radio option.
                    </div>
                </div>

                <!--Upload Challan -->
                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">Upload Challan</label>
                    <input class="form-control" type="file" id="formFile" name="formFile" required>
                    <div class="invalid-feedback">
                        Please upload a file.
                    </div>
                </div>

                <!-- Select Test Date-->
                <div class="form-group mb-3">
                    <label for="inputDate" class="form-label">Select Test Date</label>
                    <input type="date" class="form-control" id="inputDate" name="inputDate" required>
                    <div class="invalid-feedback">
                        Please select a date.
                    </div>
                </div>

                <!-- Select Test Time Input -->
                <div class="form-group mb-3">
                    <label for="inputTime" class="form-label">Select Test Time </label>
                    <input type="time" class="form-control" id="inputTime" name="inputTime" required>
                    <div class="invalid-feedback">
                        Please select a time.
                    </div>
                </div>
<!-- Age Range -->
<div class="form-group mb-3">
    <label for="inputAgeRange" class="form-label">Age Range</label>
    <input type="range" class="form-control" id="inputAgeRange" name="inputAgeRange" min="0" max="120" value="30" required>
    <div class="invalid-feedback">
        Please select an age between 0 and 120.
    </div>
    <p>Selected Age: <span id="ageValue">30</span></p>
</div>


                <!-- Textarea -->
                <div class="form-group mb-3">
                    <label for="inputTextarea" class="form-label">Why do you want to join this university</label>
                    <textarea class="form-control" id="inputTextarea" name="inputTextarea" rows="3" required></textarea>
                    <div class="invalid-feedback">
                        Please enter a value in the textarea.
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="Newview.php" class="btn btn-secondary">View</a>
                  
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </footer>

    <script>
        function dataInseration(){
            event.preventDefault();
            var formData = new FormData(document.getElementById("mainForm"));
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); 
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'Newview.php'; // Redirect to the view page
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
            };
            xhr.send(formData);
        }

        document.getElementById("inputAgeRange").addEventListener("input", function() {
        document.getElementById("ageValue").textContent = this.value;
    });
        

    const programSelect = document.getElementById('inputSelect');
    const preference1 = document.getElementById('inputProgramPreference1');
    const preference2 = document.getElementById('inputProgramPreference2');
    const preference3 = document.getElementById('inputProgramPreference3');
    
    function updatePreferences() {
        const selectedProgram = programSelect.value;
        
        [preference1, preference2, preference3].forEach(preference => {
            const options = preference.querySelectorAll('option');
            options.forEach(option => {
                if (option.value === selectedProgram) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    programSelect.addEventListener('change', updatePreferences);

    document.querySelector('#mainForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting the traditional way
            var form = this;

            // Check for form validity
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            else
            {
                dataInseration();
            }
        });
</script>
</body>
</html>