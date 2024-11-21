<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Funny Names</title>
    <link rel="stylesheet" href=".css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
        }
        h1 {
            color: #333;
            background-color: grey;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Funny Names</h1>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <ul>
        <?php if (!empty($funnyNames)): ?>
            <?php foreach ($funnyNames as $name): ?>
                <li><?= htmlspecialchars($name) ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No funny names found!</li>
        <?php endif; ?>
    </ul>
</body>
<footer>
    <p>&copy; the quizzler</p>
</footer>
</html>
