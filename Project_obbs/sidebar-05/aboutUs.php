<?php
// Database connection details (adjust according to your setup)
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch dynamic content if needed
$sql = "SELECT * FROM about WHERE id = 1";
$result = $conn->query($sql);

$aboutContent = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $aboutContent = $row["content"];
} else {
    $aboutContent = "Default about content";
}

$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Document Title, Description, and Author -->
    <title>About Us - Online Blood Bank System</title>
    <meta name="description" content="Learn more about our Online Blood Bank System, how it works, and how you can contribute.">
    <meta name="author" content="Online Blood Bank System">

    <!-- Canonical -->
    <link rel="canonical" href="#">

    <!-- Favicon -->
    <link rel="icon" href="path_to_favicon" sizes="32x32">
    <link rel="icon" href="path_to_favicon" sizes="192x192">
    <link rel="apple-touch-icon" href="path_to_favicon">
    <meta name="msapplication-TileImage" content="path_to_favicon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/prismjs@1.29.0/themes/prism.min.css">
    <link rel="stylesheet" href="path_to_custom_css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SJFXLJLFXH"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-SJFXLJLFXH');
    </script>
</head>
<body>
    <!-- Main -->
    <main id="main">
        <div class="py-3 py-md-5 bsb-demo-bg-blue border-0 border-bottom bsb-demo-border-blue-subtle">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7X col-xxl-6X">
                        <h1 class="text-center fs-4 mb-4">About the Online Blood Bank System</h1>
                        <div class="text-center">
                            <a class="d-inline-flex m-0 px-2 py-1 fw-semibold text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 text-decoration-none" href="#how-to-use">How to use this system</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <section class="py-3 py-md-5">
            <div class="container">
                <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6 col-xl-5">
                        <img class="img-fluid rounded" loading="lazy" src="css/donation.jpg" alt="Donation">
                    </div>
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="row justify-content-xl-center">
                            <div class="col-12 col-xl-11">
                                <h2 class="mb-3">Who Are We?</h2>
                                <p class="lead fs-4 text-secondary mb-3">
                                    We help save lives by providing an efficient platform for blood donation. Our mission is to connect donors with those in need of blood through a user-friendly, secure system.
                                </p>
                                <p class="mb-5">
                                    Our team is dedicated to ensuring that blood donations are managed effectively, reducing wastage and ensuring a steady supply for hospitals and medical facilities.
                                </p>
                                <div class="row gy-4 gy-md-0 gx-xxl-5X">
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex">
                                            <div class="me-4 text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h2 class="h4 mb-3">Versatile System</h2>
                                                <p class="text-secondary mb-0">
                                                    Our platform is designed to be versatile, supporting various functionalities that ensure smooth operations across all devices.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex">
                                            <div class="me-4 text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h2 class="h4 mb-3">Innovative Approach</h2>
                                                <p class="text-secondary mb-0">
                                                    We leverage innovative solutions to streamline blood donation processes, making it easier for donors and recipients to connect.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="mt-5">Key Features</h2>
                                <ul>
                                    <li>Donor registration and profile management</li>
                                    <li>Real-time blood inventory tracking</li>
                                    <li>Appointment scheduling for blood donations</li>
                                    <li>Notification system for donor eligibility and blood requirements</li>
                                    <li>Secure and user-friendly interface</li>
                                </ul>
                                <h2 class="mt-5">System Architecture</h2>
                                <p>
                                    The system architecture is designed to ensure scalability, security, and reliability. The backend is built on a robust database system that handles all donor and blood data, while the frontend is designed to provide a seamless user experience.
                                </p>
                                <h2 class="mt-5">Benefits</h2>
                                <ul>
                                    <li>Ensures a steady supply of blood for hospitals and medical facilities</li>
                                    <li>Facilitates efficient blood management and reduces wastage</li>
                                    <li>Provides a platform for donors to easily find and donate blood</li>
                                </ul>
                                <h2 class="mt-5">Get Involved</h2>
                                <p>
                                    Join us in making a difference. Sign up as a donor today and contribute to saving lives. Your small effort can make a huge impact.
                                </p>
                                <a class="btn btn-primary mt-3" href="register.php">Become a Donor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- JavaScript Files -->
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/prismjs@1.29.0/prism.min.js"></script>
</body>
</html>
