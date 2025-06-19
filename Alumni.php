<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni - University Name</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            padding-bottom: 60px; /* Ensure there is space for the footer */
        }
        header {
            background-color: #003366;
            color: white;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        header h1 {
            margin: 0;
        }
        .section-title {
            margin-top: 30px;
            margin-bottom: 20px;
            color: #003366;
        }
        .alumni-card {
            margin-bottom: 20px;
        }
        footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <header class="text-center">
        <div class="container">
            <h1>University Name</h1>
            <p>Alumni Page</p>
        </div>
    </header>

    <div class="container">
        <section id="introduction">
            <h2 class="section-title">Welcome to Our Alumni Page</h2>
            <p>At University Name, we take pride in the achievements of our alumni. This page is dedicated to showcasing the success stories of our graduates and keeping our alumni community connected.</p>
        </section>

        <section id="notable-alumni">
            <h2 class="section-title">Notable Alumni</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card alumni-card">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Alumni Image">
                        <div class="card-body">
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">John Doe, a graduate of [Year], is a renowned [Profession/Field]. He has made significant contributions to [Industry/Field].</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card alumni-card">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Alumni Image">
                        <div class="card-body">
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">Jane Smith, a graduate of [Year], is an influential [Profession/Field]. Her work in [Industry/Field] has been widely recognized.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card alumni-card">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Alumni Image">
                        <div class="card-body">
                            <h5 class="card-title">Michael Johnson</h5>
                            <p class="card-text">Michael Johnson, a graduate of [Year], is a successful [Profession/Field]. He has achieved notable success in [Industry/Field].</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="alumni-directory">
            <h2 class="section-title">Alumni Directory</h2>
            <form class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by name or field">
                    <button class="btn btn-primary" type="button">Search</button>
                </div>
            </form>
            <ul class="list-group">
                <li class="list-group-item">Emily Davis - [Profession/Field]</li>
                <li class="list-group-item">Robert Brown - [Profession/Field]</li>
                <li class="list-group-item">Sarah Wilson - [Profession/Field]</li>
                <!-- Add more alumni here -->
            </ul>
        </section>
    </div>

    <footer>
        <p>&copy; [Year] University Name. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
