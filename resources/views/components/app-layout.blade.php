<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-thin.css">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Include any additional stylesheets or scripts here -->
</head>
<body>
    <!-- Header -->
    <header class="header">
        <h1 class="logo">Filmopedia</h1>
    </header>
    <div class="content-wrapper">
        {{$slot}}
    </div>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-title">
                <h2>Filmopedia</h2>
            </div>
            <div class="footer-support">
                <p>© 2024 Filmopedia. All rights reserved.</p>
                <p>Created by Víctor Manuel</p>
                <p>Support: support@filmopedia.com</p>
            </div>
        </div>
    </footer>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
</body>

</html>
