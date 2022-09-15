<?php
    session_start();
    if(isset($_SESSION['userID'])){
        header('Location: /JJservice');
    }
    require 'database.php';
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT ID, Email, Pass FROM users WHERE Email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';

        if(count($results) > 0 && $results['Pass'] == $_POST['password']){
            $_SESSION['userID'] = $results['ID'];
            header('Location: /JJservice');
        }
        else{
            $message = 'Lo siento, esas credenciales no coinciden';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Login </title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>   
    <body>
        <?php require 'partials/header.php' ?>

        <h1>Login</h1>
        <span>or <a href="signup.php">SignUp</a></span>

        <?php if(!empty($message)):?>
            <p><?= $message ?></P>
        <?php endif; ?>

        <form action="login.php" method="post">
            <input type="text" name="email" placeholder="Ingresa tu correo">
            <input type="password" name="password" placeholder="Ingresa tu contraseña">
            <input type="submit" value="Send">
        </form>
    </body>
</html>