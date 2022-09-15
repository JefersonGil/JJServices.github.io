<?php
    require 'database.php';

    $message = '';

    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (User, Email, Pass) VALUE (:User, :Email, :Pass)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':User',$_POST['name']);
        $stmt->bindParam(':Email',$_POST['email']);
        //$password = password_hash($_POST['password'],PASSWORD_BCRYPT);*/
        $stmt->bindParam(':Pass',$_POST['password']);

        if($stmt->execute()){
            $message = 'Su usuario fué creado satisfactoriamente';
        }else{
            $message = 'Lo siento, ha ocurrido un error al crear su cuenta';
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title> Signup </title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>

        <?php require 'partials/header.php' ?>

        <?php if(!empty($message)):?>
            <p><?= $message?></p>
        <?php endif; ?>
        <h1>SignUp</h1>
        <span>or <a href="login.php">Login</a></span>
        
        <form action="signup.php" method="post">
            <input type="text" name="name" placeholder="Enter your name"> 
            <input type="text" name="email" placeholder="Enter your email">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" value="Send">
        </form>

    </body>
</html>