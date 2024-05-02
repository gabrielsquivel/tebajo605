<?php
error_reporting(0);
require "includes/ConectBd.php";
require "includes/configuracion.php";
include "includes/consultas.php";
require "library/phpqrcode/qrlib.php";
require "includes/Acciones.php";
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
    <title>Perfil de Usuario | SistemAdmin</title>
</head>
<!-- navbar-->

<body>
    <?php include "process/navbar.php"; ?>
    <!-- termina navbar -->
    <!-- inicia menu -->
    <?php
    if ($Tmenu == $Msistemas) {
        include "process/MenuSistem.php";
    } else if ($Tmenu == $MAdmin) {
        include "process/MenuAdmin.php";
    } else if ($Tmenu == $MUDocente) {
        include "process/MenuUsuarios.php";
    } else if ($Tmenu == $MAlumno) {
        include "process/MenuAlumnos.php";
    } ?>
    <!-- terminar el menu -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="row mt-3">
                <a href="UsuariosSistem" class="text-star text-success text-decoration-none">
                    <svg class="bi" width="15" height="15" fill="currentColor">
                        <use xlink:href="library/icons/bootstrap-icons.svg#arrow-left-circle-fill" />
                    </svg> Regresar a Usuarios</a>
            </div>
            <div class='table-responsive container mt-3 mb-3'>
                <div class='col-sm-12 col-md-12 col-lg-12 mt-3'>
                    <table class='table'>
                        <thead class='bg-light'>
                            <tr>
                                <th class='bg-light' scope='col'>Imagen</th>
                                <th class='bg-light' scope='col'>Nombre</th>
                                <th scope='col'>ApellidoPaterno</th>
                                <th scope='col'>ApellidoMaterno</th>
                                <th scope='col'>Telefono</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>UserName</th>
                                <th scope='col'>FechadeRegistro</th>
                                <th scope='col'>Online</th>
                                <th scope='col'>Opcione</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($LineaDatos = $EUsuario->fetch_assoc()) { ?>
                                <tr>
                                    <td class='bg-light text-center' scope='row'><img src="img/Users/<?php echo $LineaDatos['ImgUser']; ?>" style="width: 30px; height: 30px;" class="rounded-circle"></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['Nombre']; ?></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['ApellidoP']; ?></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['ApellidoM']; ?></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['Telefono']; ?></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['Email']; ?></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['UserName']; ?></td>
                                    <td class='bg-light' scope='row'><?php echo $LineaDatos['FechaReg']; ?></td>
                                    <?php if ($LineaDatos['Online'] == $On) {
                                        $IconOn = "<svg class='bi text-success' width='15' height='15' fill='currentColor'>
                                    <use xlink:href='library/icons/bootstrap-icons.svg#circle-fill'/> 
                                </svg>";
                                    } else {
                                        $IconOn = "<svg class='bi text-danger' width='15' height='15' fill='currentColor'>
                                    <use xlink:href='library/icons/bootstrap-icons.svg#circle'/> 
                                </svg>";
                                    } ?>
                                    <td class="bg-light text-center" scope="row"> <?php echo $IconOn; ?></td>
                                    <td class="bg-light" scope="row">
                                        <a href="EditarUser.php?Id_Usuario=<?php echo $LineaDatos['Id_Usuario'];?>" class="text-success text-decoration-none">
                                            <svg class="bi" width="15" height="15" fill="currentColor">
                                                <use xlink:href='library/icons/bootstrap-icons.svg#pencil-fill' />
                                            </svg>
                                        </a> -
                                        <a href="includes/Busqueda_EliminarUser.php?Id_Usuario=<?php echo $LineaDatos['Id_Usuario']; ?>" class="text-success text-decoration-none">
                                            <svg class="bi" width="15" height="15" fill="currentColor">
                                                <use xlink:href="library/icons/bootstrap-icons.svg#trash-fill" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                </div>
            </div>
           
            <!-- Modal -->
            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="UpdateUserModal" tabindex="-1" aria-labelledby="UpdateUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-light">
                        <div class="modal-header">
                            <h5 class="modal-title" id="NewUserModalLabel">
                                <svg class="bi" width="20" height="20" fill="currentColor">
                                    <use xlink:href="library/icons/bootstrap-icons.svg#person-add" />
                                </svg>
                                <span> Modificar usuario</span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" class="px-3 needs-validation" novalidate>
                                <div class="container">

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="input-group mb-1">
                                                <span class="input-group-text" id="Nom">
                                                    <svg class="bi" width="20" height="20" fill="currentColor">
                                                        <use xlink:href="library/icons/bootstrap-icons.svg#person-vcard" />
                                                    </svg>
                                                </span>
                                                <input type="text" class="form-control" name="Nombre" placeholder="Nombre" value="<?php echo $LineaDatos['Nombre']; ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" name="ApellidoP" placeholder="Apellido Paterno" aria-label="Apellido Paterno" required />
                                            <span class="input-group-text">
                                                <svg class="bi" width="20" height="20" fill="currentColor">
                                                    <use xlink:href="library/icons/bootstrap-icons.svg#plus-square-fill" />
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control" name="ApellidoM" placeholder="Apellido Materno" aria-label="Apellido Materno" required />
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="input-group mb-1">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <svg class="bi" width="20" height="20" fill="currentColor">
                                                                <use xlink:href="library/icons/bootstrap-icons.svg#phone-vibrate-fill" />
                                                            </svg>
                                                        </span>
                                                        <input type="tel" class="form-control" name="Telefono" placeholder="Telefono" aria-label="Telefono" aria-describedby="basic-addon1" required/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="input-group mb-1">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <svg class="bi" width="20" height="20" fill="currentColor">
                                                                <use xlink:href="library/icons/bootstrap-icons.svg#envelope-paper-fill" />
                                                            </svg>
                                                        </span>
                                                        <input type="email" name="Email" class="form-control" placeholder="Email" aria-label="Email" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-1">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="Plantel" id="Plantel" aria-label="Selecciona al plantel" required>
                                                                    <option value="">Selecciona el plantel</option>
                                                                    <?php while ($LineaPlantel = $EPlanteles->fetch_assoc()) { ?>
                                                                        <option value="<?php echo $LineaPlantel['Id_Plantel']; ?>"><?php echo $LineaPlantel['NombrePlantel'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <label for="Planetl">Plantel Asignado</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="Tusuario" id="Tusuario" aria-label="Selecciona el tipo de usuario" required>
                                                                    <option value="">Selecciona el tipo de usuario</option>
                                                                    <?php while ($LineaTipo = $ECTUsuario->fetch_assoc()) { ?>
                                                                        <option value="<?php echo $LineaTipo['Id_TUsuario']; ?>"><?php echo $LineaTipo['NTUsuario']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <label for="Planetl">Tipo de usuario Asignado</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                            <div class="input-group mb-1">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <svg class="bi" width="20" height="20" fill="currentColor">
                                                                        <use xlink:href="library/icons/bootstrap-icons.svg#journal-bookmark" />
                                                                    </svg>
                                                                </span>
                                                                <input type="text" class="form-control" name="UserName" placeholder="Nombre de Usuario" aria-label="UserName" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                            <div class="input-group mb-1">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <svg class="bi" width="20" height="20" fill="currentColor">
                                                                        <use xlink:href="library/icons/bootstrap-icons.svg#lock-fill" />
                                                                    </svg>
                                                                </span>
                                                                <input type="password" name="Password" class="form-control" placeholder="Password" aria-label="Password" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                        <input type="submit" class="btn btn-sm btn-outline-success rounded-pill" name="btnRegistrar" value="Registrar Nuevo Usuario">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    (function() {
                        'use strict'

                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.querySelectorAll('.needs-validation')

                        // Loop over them and prevent submission
                        Array.prototype.slice.call(forms)
                            .forEach(function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (!form.checkValidity()) {
                                        event.preventDefault()
                                        event.stopPropagation()
                                    }

                                    form.classList.add('was-validated')
                                }, false)
                            })
                    })()
                </script>
                <script type='text/javascript'>
                    $(function() {
                        $(document).bind("contextmenu", function(e) {
                            return false;
                        });
                    });
                </script>
                <script src="js/dark-mode.js"></script>
                <script src="js/pace.js"></script>
</body>

</html>