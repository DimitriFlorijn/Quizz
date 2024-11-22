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
        
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            font-size: 18px;
        }
        table{
            padding: 10PX;
        }
    </style>
</head>
<body>
    <h1>Funny Names</h1>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <h2>je kan ook zelf een grappige naam toevoegen</h2>
    <form method="post" action="backend/funnyNameController.php">
        <input type="text" id="funnynames" name="funnynames" required>
        <button type="submit">Add Name</button>
    </form>
    
    <ul>
    <?php
            require_once 'backend/conn.php';

            $query = "SELECT * FROM funnynames";

            $statement = $conn ->prepare($query);

            $statement ->execute();

            $funnynames = $statement-> fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if (!empty($funnynames)): ?>
            <?php foreach ($funnynames as $funnyname): ?>
             <table> <tr> <?php echo $funnyname['funnyname'];?> </tr> </table>
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
