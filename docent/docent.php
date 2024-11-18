<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>docent</title>
    <link rel="stylesheet" href="..//.css">
</head>
<body>
   <header>
      <h1>Docent</h1>
  </header>

  <nav>
      <a href="../index.php">Home</a>
  </nav>

  <div class="docent">
  <h2>welke regel zit een foutmelding?</h2>

   <div class="docentimg">
    <img src="img1.png" alt="line 22">
    <style>
        /* Align image to the left */
        .docentimg{
         display: flex;
            margin: 10px 0px 10px 100px;
            float: center;
            width: 350px; /* Set width */
            height: 375px; /* Maintain aspect ratio */
        }
        </style>
   </div>
      <form method="post" action="">
          <label for="answer">voer het getal in voor de foute regel: </label>
          <input type="number" name="answer" id="answer" required>
          <button type="submit">Submit</button>
      </form>

      <?php
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $correctAnswer = "22";
          $userAnswer = trim($_POST['answer']); 
          if ($userAnswer === $correctAnswer) {
              header("Location: docent2.php"); 
              exit();
          } else {
              header("Location: wrong1.php");
              exit();
          }
      }
      ?>
  </div>

  <footer>
        <p>&copy; the quizzler</p>
  </footer>
</body>
</html>
