<?php include 'Connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .contact-info, .contact-form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #003366;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            border-top: #bbb 1px solid;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .invalid-feedback {
            display: none; /* Fixing invalid-feedback display property */
        }
        header {
            background-color: #003366; /* Header background color */
            color: white; /* Header text color */
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="mb-0">Contact Us</h1>
        </div>
    </header>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 contact-info">
                <h2>Contact Information</h2>
                <p><strong>Phone:</strong></p>
                <p>General Inquiries: +1 (123) 456-7890</p>
                <p>Customer Support: +1 (123) 456-7891</p>

                <p><strong>Email:</strong></p>
                <p>General Inquiries: <a href="mailto:info@example.com">info@example.com</a></p>
                <p>Support: <a href="mailto:support@example.com">support@example.com</a></p>
                <p>Sales: <a href="mailto:sales@example.com">sales@example.com</a></p>

                <p><strong>Address:</strong></p>
                <p>[Company Name]</p>
                <p>1234 Main Street,</p>
                <p>City, State, ZIP Code,</p>
                <p>Country</p>

                <p><strong>Business Hours:</strong></p>
                <p>Monday to Friday: 9:00 AM - 6:00 PM</p>
                <p>Saturday: Closed</p>
                <p>Sunday: Closed</p>

                <p><strong>Social Media:</strong></p>
                <div class="d-flex">
                    <a href="https://www.facebook.com/yourpage" class="me-2" target="_blank">Facebook</a>
                    <a href="https://www.twitter.com/yourpage" class="me-2" target="_blank">Twitter</a>
                    <a href="https://www.linkedin.com/company/yourpage" class="me-2" target="_blank">LinkedIn</a>
                    <a href="https://www.instagram.com/yourpage" target="_blank">Instagram</a>
                </div>
            </div>

            <div class="col-md-6 contact-form">
                <h2>Contact Form</h2>
                <form id="contactForm" action="your-server-endpoint" method="post" novalidate>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                        <div class="invalid-feedback">
                            Please enter the subject.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea id="message" class="form-control" name="message" rows="6" required></textarea>
                        <div class="invalid-feedback">
                            Please enter your message.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark">Send</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p class="mb-0">&copy; 2024 [Company Name]. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.querySelector('#contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting the traditional way
            var form = this;

            // Check for form validity
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            // Simulate form submission and show SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your message has been sent successfully.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.reset(); // Reset form fields if needed
                }
            });

            // For real submission, uncomment the line below and set your server endpoint
            // form.submit();
        });
    </script>
</body>
</html>
