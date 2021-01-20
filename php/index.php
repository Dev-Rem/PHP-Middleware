<!doctype html>
<html lang="en">
    <head>
        <title>

        </title>   
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        </nav>
        <div class="flex-container">
            <div class="card-container">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Public Content</h4>
                    <h6 class="card-subtitle mb-2 text-muted">General information</h6>
                    <p class="card-text">Login authentication is not required to view this content.</p>
                    <a href="public.php" class="card-link" >Click to view public content</a>
                </div>
            </div>
        </div>
        <div class="card-container">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Protected content</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Only for logged in users</h6>
                    <p class="card-text">Login authentication  required to view this content</p>
                    <a href="protected.php" class="card-link">Click to view protected content</a>
                </div>
            </div>
        </div>
        </div>
        
    </body>
</html>