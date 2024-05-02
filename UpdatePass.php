<?php
error_reporting(0);
include "includes/ConectBd.php";
if(isset($_GET['guardar'])){
  $IdPass = $_GET['idRpass'];
  $Pass = $_GET['npass'];
  $Correo = $_GET['EmaiR'];
  $NewPass = md5($Pass);
  // actualizar el password al usuario 
  $actualizar = "UPDATE Usuario SET Password = '$NewPass' WHERE Id_Usuario = '$IdPass'";
  $E = $ConectionBd->query($actualizar);
  if($E > 0){
// enviar un email 
$para = $Correo;
$titulo = 'Modificacion de password en la plataforma sistemAdmin';
$mensaje = 'Tu nuevo Password es: '.$Pass;
$cabezera = 'FROM: contacto@sistemadmin.com'."\r\n".
            'Reply-to: webmaster@sistemadmin.com'."\r\n".
            'X-Mailer: PHP/'.phpversion();
            mail($para,$titulo,$mensaje,$cabezera);
$MensajeAlert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Tu nuevo password se envio a la direccion de correo registrado en la plataforma.</strong> Por favor revisa tu bandeja de entradao en la seccion de no deceados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';            
            
  } 
  else{
    header("location:RecuperarPass.php");
  }
}



?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/pace.css" rel="stylesheet">
        <link href="css/dark.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <title>Se restablecio tu Password | SistemAdmin</title>
    </head>
    <body>
    <div class="container mt-4">
        <div class="row justify-content-center h-100 py-4 mt-4">
            <div class="col-sm-10 col-md-10 col-lg-10 bg-light mt-3">
                <p class="text-center py-2">Se modifico tu password Exitosamente! dentro de la plataforma</p>
                <hr>
                <div class="container text-center">
                    <div class="row py-2 mt-3">
                         <div class="col py-1">
                             <h4>Email : <?php echo $Correo; ?></h4>
                             <p>El nuevo password es : <?php echo $Pass; ?></p>
                         </div>
                         <div class="row py-2 mt-2">
                            <div class="d-grid gap-2 py-3">
                                <a href="index.php" class="btn btn-sm btn-outline-success rounded-pill">Iniciar Sesión</a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-2 mt-2">
            <div class="container">
                <?php echo $MensajeAlert; ?>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.js"></script>
    <script src="js/dark-mode.js"></script>    
    </body>
</html>