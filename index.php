<?php
include "includes/ConectBd.php";
include "includes/ProLogin.php";
// configurar la zona horaria de nuestro servidor
ini_Set('date.timezone', 'America/Mexico_City');
$hora_actual = date('H');
if ($hora_actual >= 5 && $hora_actual < 12) {
    $saludo = '¡Buenos días!';
} elseif ($hora_actual >= 12 && $hora_actual < 18) {
    $saludo = '¡Buenas tardes!';
} else {
    $saludo = '¡Buenas noches!';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Inicio de Sistema | AdminCherry's</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dark.css">
    <link rel="stylesheet" type="text/css" href="css/pace.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="row justify-content-center mt-3">
        <div class="col-md-10 col-lg-6 px-2 mt-2">
            <h3 class="mb-4 text-center mt-3 display-6">Inicio de sesión</h3>
            <div class="row">
                <div class="d-flex justify-content-center">
                    <span class="text-muted fs-5 display-5">Hola&nbsp; </span><span class="text-success fs-5 display-5"><?php echo " " . $saludo; ?></span>
                </div>
            </div>
            <div class="row mt-1 text-center">
                <div class="col container ">
                    <img src="img/Logo proyecto.png" alt="logoCherryTreeSoftware" style="width: 250px;" class="img-fluid" id="img1">
                </div>

            </div>
            <div class="row py-1">
                <div id="estado" class="alert alert-success alert-dismissible fade show" role="alert">
                    <span> Actualmente tu conexión a internet es estable</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                    <div class="form-check form-switch">
                        <input type="checkbox" id="darkSwitch" class="form-check-input">
                        <label for="darkSwitch" class="form-check-label">
                            <svg class="bi" width="22" height="22" fill="currentColor">
                                <use xlink:href="library/icons/bootstrap-icons.svg#brightness-low" />
                            </svg>
                        </label> |
                        <svg class="bi" width="15" height="15" fill="currentColor">
                            <use xlink:href="library/icons/bootstrap-icons.svg#moon-stars" />
                        </svg>
                    </div>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" name="FormLogin" class="px-3 needs-validation" novalidate>
                <div class="input-group mb-3 mt-1">
                    <span class="input-group-text bg-success" id="User">
                        <svg class="bi text-white" width="15" height="15" fill="currentColor">
                            <use xlink:href="library/icons/bootstrap-icons.svg#person-fill-check" />
                        </svg>
                    </span>
                    <input type="text" name="usuario" class="form-control border-success" placeholder="Nombre de Usuario" aria-label="Usuario" autocomplete="off" required />
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-success" id="Pas">
                        <svg class="bi text-white" width="15" height="15" fill="currentColor">
                            <use xlink:href="library/icons/bootstrap-icons.svg#lock-fill" />
                        </svg>
                    </span>
                    <input type="password" name="password" class="form-control border-success" placeholder="Password" id="VerPassWord" aria-label="Password" required />
                </div>
                <div class="row py-1 px-1">
                    <div class="col">
                        <div class="form-check form-switch">
                            <input type="checkbox" id="VerPass" class="form-check-input" onclick="verPass(this);">
                            <label for="VerPass" class="form-check-label">
                                Visualizar Password
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <a href="RecuperarPass" class="link-success link-offset-2 link-underline-opacity-25 text-decoration-none link-underline-opacity-100-hover">
                            <svg class="bi" width="20" height="20" fill="currentColor">
                                <use xlink:href="library/icons/bootstrap-icons.svg#key-fill" />
                            </svg>&nbsp;&nbsp;¿Perdiste tu Password?
                        </a> |
                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" class="link-success link-offset-2 link-underline-opacity-25 text-decoration-none link-underline-opacity-100-hover">
                            <svg class="bi" width="20" height="20" fill="currentColor">
                                <use xlink:href="library/icons/bootstrap-icons.svg#exclamation-circle" />
                            </svg> Ayuda
                        </a>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-2">
                    <input type="submit" name="BtnLogin" value="Ingresar" class="btn btn-sm btn-outline-success rounded-pill">
                </div>
            </form>
            <div class="row py-1 px-2 mt-3">
                <div class="col container">
                    <?php echo $alerta; ?>
                </div>
            </div>
            <div class="row py-1 mt-1 justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="border-0 ">
                        <div class="row mt-1 py-1 text-center">
                            <div class="col">
                                <a href="https://github.com/JlchavezG" target="_blank" class="text-secondary text-decoration-none">
                                    <svg class="bi" width="25" height="25" fill="currentColor">
                                        <use xlink:href="library/icons/bootstrap-icons.svg#github" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col">
                                <a href="https://www.facebook.com/iscjoseluischavezg" target="_blank" class="text-secondary text-decoration-none">
                                    <svg class="bi" width="25" height="25" fill="currentColor">
                                        <use xlink:href="library/icons/bootstrap-icons.svg#facebook" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col">
                                <a href="https://www.instagram.com/iscjlchavezg/" target="_blank" class="text-secondary text-decoration-none">
                                    <svg class="bi" width="25" height="25" fill="currentColor">
                                        <use xlink:href="library/icons/bootstrap-icons.svg#instagram" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col">
                                <a href="https://twitter.com/daerblack" target="_blank" class="text-secondary text-decoration-none">
                                    <svg class="bi" width="25" height="25" fill="currentColor">
                                        <use xlink:href="library/icons/bootstrap-icons.svg#twitter" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalSoporte" class="text-decoration-none text-secondary">
                                    <svg class="bi" width="25" height="25" fill="currentColor">
                                        <use xlink:href="library/icons/bootstrap-icons.svg#headset" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6 text-center mt-4"><span class="text-success text-wrap fs-6">AdminCherry's|Digitalcherrys.com </span></div>
            </div>
            <!-- ayuda -->
            <div class="offcanvas offcanvas-end bg-light" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="text-center text-success fs-5 display-6">Ayuda en login</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <ul class="list-group list-group-flush bg-light">
                            <li class="list-group-item bg-light"><span class="text-success">1.- Ingresa tu usuario y password asignados</span></li>
                            <li class="list-group-item bg-light"><span class="text-success">2.- Da click en ingresar e ingresa al sistema segun tu tipo de usuario.</span></li>
                            <li class="list-group-item bg-light"><span class="text-success">3.- Si perdiste tu password da click en la opción recuperar password.</span></li>
                            <li class="list-group-item bg-light"><span class="text-success">4.- Ingresa tu nombre de usuario y email registrado en la plataforma.</span></li>
                            <li class="list-group-item bg-light"><span class="text-success">5.- Si los datos ingresados son correctos podras cambiar tu password.</li>
                            <li class="list-group-item bg-light"><span class="text-success">6.- Inicia sesión normalmente con el usuario y nuevo password.</li>
                            <li class="list-group-item bg-light"><span class="text-success">7.- Si no puedes ingresar contacta a nuestro equipo de soporte dando
                                <a href="mailto:soporte@iscjoseluischavezg.mx" class="text-decoration-none"> 
                                    clic aqui.
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- termina ayuda -->
            <?php include "process/ModalSoporte.php"; ?>
            <?php include "process/ModalRecuperar.php"; ?>

            <script>
                function verPass(ck) {
                    if (ck.checked)
                        $('#VerPassWord').attr("type", "text");
                    else
                        $('#VerPassWord').attr("type", "password");
                }
            </script>
            <script src="js/dark-mode.js"></script>
            <script src="js/pace.js"></script>
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
            <script>
                var verificarconexion = function() {
                    var estado = document.getElementById('estado');

                    if (navigator.onLine && estado.classList.contains('alert-danger')) {
                        estado.innerHTML = 'Estas Conectado a Internet !';
                        estado.classList.remove('alert-danger');
                        estado.classList.add('alert-success');
                    }
                    if (!navigator.onLine && estado.classList.contains('alert-success')) {
                        estado.innerHTML = 'Estas Desconectado de Internet !';
                        estado.classList.remove('alert-success');
                        estado.classList.add('alert-danger');
                    }
                };

                window.addEventListener('online', verificarconexion);
                window.addEventListener('offline', verificarconexion);
            </script>
</body>

</html>