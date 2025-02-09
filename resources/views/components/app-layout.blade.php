<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-thin.css">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Include any additional stylesheets or scripts here -->
</head>
<body>
    <!-- Header -->
    <header class="header">
        <h1 class="logo">Filmopedia</h1>
        @isset($header)
            {{ $header }}
        @endisset
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
