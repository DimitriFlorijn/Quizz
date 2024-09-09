<?php
session_start();
if(!isset($_SESSION['user_id'])){
    $msg = "eerst inloggen voordat je kan zien wat u heeft";
    header('location: ../login.php?msg=$msg');
    exit;
}


if($_POST['action'] == 'create'){


    //Variabelen vullen
    //$ = $_POST[''];
 //   if(empty($)){
 //       $errors[] = "";
 //  }
    



    require_once 'conn.php';

    $query = "INSERT INTO Users()"; 

    $statement = $conn ->prepare($query);

    $statement ->execute([
        
    ]);
}

if ($_POST['action'] == 'update'){


     $id = $_POST['id'];
    $capaciteit = $_POST['']; 
    if(!is_numeric($capaciteit)){
        $errors[] = "";
    }
    if(isset($_POST[''])){
        $prioriteit = 1;
    }
    else{
        $prioriteit = 0;
    }

    $melder = $_POST[''];
    if(empty($melder)){
        $errors[] = "";
    }
    $overige_info = $_POST[''];



    require_once 'conn.php';
//--------------------------------------------------------------><
    $query = "";

    $statement = $conn -> prepare($query);

    $statement ->execute([
        
        ":id"           => $id
    ]);
    $msg = "melding opgeslagen";
    header("location: ../meldingen/index.php?msg=$msg" );
}

if($_POST['action'] == 'delete')
{
     $id = $_POST['id'];

    require_once 'conn.php';

    $query = "DELETE FROM quizz WHERE id = :id";

    $statement = $conn -> prepare($query);

    $statement ->execute([
        ":id"           => $id
    ]);
    $msg = "melding verwijdert";
    header("location: ../meldingen/index.php?msg=$msg" );
}


?>