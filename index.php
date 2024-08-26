<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My PHP Website</title>
    <link rel="stylesheet" href=".css">
</head>
<body>

    <header>
        <h1>Welcome to My PHP Website</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="start.php"></a>
    </nav>

    <div class="container">
        <h2>Home Page</h2>
        <p>This is the home page of your website. You can start building your content here.</p>
        
        <?php
            // Example PHP code
            echo "<p>Today is " . date("l, F j, Y") . ".</p>";
        ?>
    </div>

    <footer>
        <p>&copy; the quizzler</p>
    </footer>

</body>
</html>