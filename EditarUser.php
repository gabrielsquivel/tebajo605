<?php 
error_reporting(0);
require "includes/ConectBd.php";
require "includes/configuracion.php";
include "includes/consultas.php";
include "includes/acciones.php";
$IdMUser = $_GET['Id_Usuario'];
// consulta para extraer los datos del usuario a editar 
$MUsuarios = "SELECT U.Id_Usuario, U.Nombre, U.ApellidoP, U.ApellidoM, U.Telefono, U.Email,
U.Id_Plantel, U.Id_TUsuario, U.UserName, U.FechaReg ,U.Password, U.Online, U.EstatusUser,
U.ImgUser, P.Id_Plantel, P.NombrePlantel, P.DireccionPlantel, P.EmailPlantel, 
TU.Id_TUsuario, TU.NTUsuario, ES.Id_EstatusUser, ES.DEstatusUser FROM Usuario U INNER JOIN
Plantel P ON U.Id_Plantel =P.Id_Plantel INNER JOIN TUsuario TU ON U.Id_TUsuario = TU.Id_TUsuario 
INNER JOIN EstatusUser ES ON U.EstatusUser = ES.Id_EstatusUser WHERE Id_Usuario = '$IdMUser'";
$EMUsuarios = $ConectionBd->query($MUsuarios); 
$MUsuariosE = $EMUsuarios->fetch_assoc();
// modificar usuario en sistemas 

    



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/dark.css">
    <link rel="stylesheet" type="text/css" href="css/pace.css">
    <link rel="stylesheet" type="text/css" href="css/Config.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <title>Editar Usuario | Dashboard SistemAdmin</title>
</head>
<!-- navbar-->
<body>
<?php include "process/navbar.php"; ?>
<!-- termina navbar -->
<!-- inicia menu -->
<?php 
 if($Tmenu == $Msistemas){include "process/MenuSistem.php";}
 else if($Tmenu == $MAdmin){include "process/MenuAdmin.php";}
 else if($Tmenu == $MUDocente){include "process/MenuUsuarios.php";}
 else if($Tmenu == $MAlumno){include "process/MenuAlumnos.php";}?>
<!-- terminar el menu -->
<div class="container mt-2">
    <div class="row mt-4">
        <h3 class="text-center display-6 fs-5">Modulo Editar Usuario <span class="text-success"> Sistemas</span></h3>
    </div>
    <hr>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="row mt-2 d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row mt-3">
                <a href="OptionUser" class="text-star text-success text-decoration-none">
                    <svg class="bi" width="15" height="15" fill="currentColor">
                        <use xlink:href="library/icons/bootstrap-icons.svg#arrow-left-circle-fill" />
                    </svg> Regresar a Opcion de Usuarios</a>
            </div>
            <div class="row d-flex justify-content-center">
                <img src="img/Users/<?php echo $MUsuariosE['ImgUser']?>" alt="Imagen de perfil" class="img-fluid" style="width: 200px; height: 180px; border-radius:50%;">
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6 text-end">
                    <a href="#" class="text-decoration-none text-star text-success">
                        <svg class="bi" width="15" height="15" fill="currentColor">
                            <use xlink:href="library/icons/bootstrap-icons.svg#lock-fill" />
                        </svg> Cambiar Password
                    </a>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-6 col-md-6-col-lg-6">
                <input type="hidden" name="Id_Mod" id="Id_Mod" value="<?php echo $MUsuariosE['Id_Usuario']; ?>">
                <input type="text" name="ModNombre" id="ENombre" placeholder="Ingresa tu nombre" class="form-control" value="<?php echo $MUsuariosE['Nombre']; ?>">
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-3 col-md-3 col-lg-3 mt-2">
                <input type="text" name="EApellidoP" id="EApellidoP" placeholder="Apellido Paterno" class="form-control" value="<?php echo $MUsuariosE['ApellidoP']; ?>">
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 mt-2">
                <input type="text" name="EApellidoMat" id="EApellidoM" placeholder="Apellido Materno" class="form-control" value="<?php echo $MUsuariosE['ApellidoM']; ?>">
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-3 col-md-3 col-lg-3">
                <input type="tel" name="ETelefono" id="ETelefono" placeholder="Telefono" class="form-control" value="<?php echo $MUsuariosE['Telefono']; ?>">
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                <input type="text" name="EEmail" id="EEmail" placeholder="Email" class="form-control" value="<?php echo $MUsuariosE['Email']; ?>">
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <select name="EPlantel" id="EPlantel" class="form-select">
                        <option value="<?php echo $MUsuariosE['Id_Plantel']; ?>"><?php echo $MUsuariosE['NombrePlantel']; ?></option>
                        <?php while ($LineaPlantel = $EPlanteles->fetch_assoc()) { ?>
                              <option value="<?php echo $LineaPlantel['Id_Plantel']; ?>"><?php echo $LineaPlantel['NombrePlantel'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <select name="EId_TUsuario" id="EId_TUsuario" class="form-select">
                        <option value="<?php echo $MUsuariosE['Id_TUsuario']; ?>"><?php echo $MUsuariosE['NTUsuario']; ?></option>
                        <?php while($LineaTipo = $ECTUsuario->fetch_assoc()) { ?>
                              <option value="<?php echo $LineaTipo['Id_TUsuario']; ?>"><?php echo $LineaTipo['NTUsuario']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <select name="EEstatusUser" id="EEstatusUser" class="form-select">
                        <option value="<?php echo $MUsuariosE['EstatusUser']; ?>"><?php echo $MUsuariosE['DEstatusUser']; ?></option>
                        <?php while($LineaEstatus = $EstatusUserE->fetch_assoc()){ ?>
                              <option value="<?php echo $LineaEstatus['Id_EstatusUser']; ?>"><?php echo $LineaEstatus['DEstatusUser']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="d-grid gap-2">
                         <input type="submit" name="BtnMUsuerS" value="Modificar" class="btn btn-sm btn-outline-success rounded-pill">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<?php include "process/ModalSoporte.php"; ?>
<?php include "process/footer.php"; ?>
<script src="js/dark-mode.js"></script>
<script src="js/pace.js"></script>
</body>

</html>