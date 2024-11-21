<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homescreen</title>
    <link rel="stylesheet" href="..//.css">
</head>
<style>
  *{
    background-color: grey;
    }    
  h2{
    color: black;
  }
</style>
<body>
   <header>
      <h1>Docent</h1>
  </header>

  <nav>
      <a href="../index.php">Home</a>
  </nav>

  <div class="docent">
    <style>
      .docent{
       padding: 10px;
       display: flex;
       background-color: grey;
      }      
    </style>
    <h2>Wat is de output van de volgende code van python </h2>
    <div class="docentP">
            <p><strong>A:</strong> Alleen "Hello, Alice!"</p>
            <p><strong>B:</strong> "Before function call", "Hello, Alice!", "After function call"</p>
            <p><strong>C:</strong> "Before function call", "After function call", "Hello, Alice!"</p>
            <p><strong>D:</strong> Geen output vanwege een fout</p>
        </div>
    <div class="docentimg">
      <img src="img2.png" alt="code">
      <style>
        .docentimg{
              display: flex;
                margin: 0px 0px 0px 100px;
                float: center;
                width: 250px; 
                height: 250px; 
          }
        </style>
    </div>
    <form method="post" action="">
            <label for="answer">Enter the correct answer:</label>
            <input type="text" name="answer" id="answer" required>
            <button type="submit">Submit</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userAnswer = trim(strtolower($_POST['answer']));
            if ($userAnswer === "b") {
                header("Location: corect.php");
                exit();
            } else {
                header("Location: wrong2.php");
                exit();
            }
        }
        ?>
      </div>
    </div>

  <footer>
        <p>&copy; the quizzler</p>
  </footer>
</body>
</html>
