<?php include 'Connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Name - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #003366;
            color: white;
            padding: 1em 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #002244;
        }
        nav a {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
        }
        nav a:hover {
            background-color: #001133;
        }
        .hero {
            background: url('university-campus.jpg') no-repeat center center/cover;
            color:Grey ;
            padding: 100px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 3em;
            margin: 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h2 {
            font-size: 2em;
            color: #003366;
        }
        .content p {
            font-size: 1.2em;
            line-height: 1.6;
        }
        footer {
            background-color: #002244;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>University Name</h1>
    </header>
    
    <section class="hero">
        <h1>Welcome to University</h1>
        <p>Empowering Future Leaders Through Quality Education</p>
    </section>
    <section class="content">
        <h2>Our Vision</h2>
        <p>University Name is a prestigious institution known for its commitment to excellence in education and research. Our diverse range of programs and dedicated faculty ensure that students receive a world-class education and are prepared for success in their chosen fields.</p>
        <p>Located in the heart of [City], we offer state-of-the-art facilities and a vibrant campus life that fosters learning and growth. Join us in shaping the future!</p>
    </section>
    <footer>
        <p>&copy; 2024 University Name | All Rights Reserved | <a href="mailto:info@universityname.edu" style="color: white;">info@universityname.edu</a></p>
    </footer>
</body>
</html>
