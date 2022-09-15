<?php

    $message = '';

    require 'database.php';

    if(isset($_SESSION['userID'])){
        
        $records = $conn->prepare('SELECT ID,User, Email,Pass FROM users WHERE ID = :id');
        $records->bindParam(':id',$_SESSION['userID']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = '';

        if(count($results) > 0){
            $user = $results;
        }

        if(!empty($user) && !empty($_POST['servicio']) && !empty($_POST['producto'])){
            $message = 'Segundo';
            $sql = "INSERT INTO servicios (servicio, producto, cliente, email, IdCliente) VALUE (:servicio, :producto, :cliente, :email, :ID)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':servicio',$_POST['servicio']);
            $stmt->bindParam(':producto',$_POST['producto']);
            $stmt->bindParam(':cliente',$user['User']);
            $stmt->bindParam(':email',$user['Email']);
            $stmt->bindParam(':ID',$user['ID']);
                            
            if($stmt->execute()){
                $message = 'Servicio solicitado';
            }else{
                 $message = 'Algo salio mal';
            }
        }
    }
    else{
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="assets/css/mainStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body>
    <section class="addServicio">
        <h2 class="titulo">Solicitar servicio</h2>
        <div class="addServicioInput">
            <form action="index.php" method="post">
                <input type="text" class="servicio" name = "servicio" placeholder="Servicio">
                <input type="text" class="producto" name= "producto" placeholder="Producto">
                <input type="submit" value="Send">
            </form>
            <?php if(!empty($message)):?>
                <p><?= $message?></p>
            <?php endif; ?>
        </div>
    </section>
    <section class="entreSeccion">
        <div class="wave" style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: rgb(255, 255, 255);"></path></svg></div>
    </section>
    <section class="muestras">
        <div class="muestra">
            <img src="assets/imagenes/Reparacion.jpg" alt="">
            <div class="muestraDescripcion">
                <h4>Reparación</h4>
                <p>Nuestra especialidad es reparar muebles de casi todo tipo, no tires esos muebles que crees irreparables, haz tu solicitud arriba y JJservices hará el resto.</p>
            </div>
        </div>
        <div class="muestra">
            <img src="assets/imagenes/Crear.jpg" alt="">
            <div class="muestraDescripcion">
                <h4>Crear</h4>
                <p>Nada como unos hermosos muebles hechos a tu gusto, has tu solicitud más arriba y JJservices hará lo posible para adaptarse a tu presupuesto e incluso respetanto tus preferencias en el diseño.</p>
            </div>
        </div>
    </section>
</body>
<footer>
    <div class="contenedorFooter" id="Contactos">
        <div class="contenedorInfo">
            <h4>Número</h4>
            <p>829-347-3029</p>
        </div>
        <div class="contenedorInfo">
            <h4>Email</h4>
            <p>201804883@p.uapa.edu.do</p>
        </div>
    </div>
    <h2 class="propietario">&copy; Ing Jeferson Gil</h2>
</footer>
</html>