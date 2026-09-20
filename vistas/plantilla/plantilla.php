<?php
if(!isset($_SESSION)){ 
    session_start(['name'=>'SD']); 
}

/* ============================================================
   PROTECCIÓN GLOBAL DE RUTAS PRIVADAS
   ------------------------------------------------------------
   Evita que una URL interna cargue una pantalla en blanco cuando
   no existe una sesión válida. Si el usuario intenta entrar a una
   ruta privada directamente, se redirige al login antes de emitir
   cualquier HTML.

   La Pantalla de Cocina independiente no pasa por esta plantilla,
   por lo que /cocina/ conserva su acceso independiente.
   ============================================================ */
$rutaSolicitada = '';

if (isset($_GET['views'])) {
    $rutaSolicitada = trim((string)$_GET['views'], '/');
}

$partesRuta = $rutaSolicitada !== ''
    ? explode('/', $rutaSolicitada)
    : [];

$vistaSolicitada = $partesRuta[0] ?? '';

$esRutaPublicaInicial =
    $vistaSolicitada === '' ||
    $vistaSolicitada === 'login' ||
    $vistaSolicitada === 'index';

$sesionValida =
    isset($_SESSION['token_sd']) &&
    isset($_SESSION['user_sd']) &&
    $_SESSION['user_sd'] !== null &&
    $_SESSION['user_sd'] !== '';

$modoSoloLecturaPagoActivo =
    $sesionValida &&
    isset($_SESSION['modo_solo_lectura_pago']) &&
    $_SESSION['modo_solo_lectura_pago'] === 'SI';

if (!$esRutaPublicaInicial && !$sesionValida) {
    header('Location: ' . SERVERURL . 'login/');
    exit;
}

require_once "./vistas/plantilla/modulos/tablerIcons.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo htmlspecialchars(COMPANY, ENT_QUOTES, 'UTF-8');?></title>
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>ajax/bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>ajax/bootstrap/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/styles.css" rel="stylesheet" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/my_style.css" rel="stylesheet" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/pagos.css" rel="stylesheet" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/facturasMovil.css" rel="stylesheet" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/main_cards.css" rel="stylesheet" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>ajax/bootstrap/css/bootstrap-select.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/select2-izzy.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>fontawesome/css/all.min.css">
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/notyf.min.css" rel="stylesheet" />
    <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/css/izzy-ui-2026.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/img/icono.png">
<!--     <link href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>ajax/sweetalert/sweetalert.css"
        rel="stylesheet" crossorigin="anonymous" /> -->   

    <style>
        /* Oculta por clase (sin romper display:flex) */
        .perm-hidden { display: none !important; }

        /* Evita el “flash” mientras aplican permisos */
        #sidenavAccordion.nav-loading,
        .sb-topnav.nav-loading { visibility: hidden; }
    </style>

</head>

<body class="sb-nav-fixed izzy-ui-2026<?php echo $modoSoloLecturaPagoActivo ? ' izzy-payment-readonly' : ''; ?>">
    <?php
        if (defined('SISTEMA_PRUEBA_LABEL') && SISTEMA_PRUEBA_LABEL !== '') {
            echo '<div class="env-badge" data-toggle="tooltip" data-placement="left" title="Entorno de demostración - Datos no reales">
                    <i class="fas fa-flask"></i> ' . htmlspecialchars(SISTEMA_PRUEBA_LABEL, ENT_QUOTES, 'UTF-8') . '
                </div>';
        }
    ?>

    <?php
    $peticionAjax = false;
    require_once "./controladores/vitasControlador.php";
    $vt = new vistasControlador();
    $vistasR = $vt->getVistasControlador();

    if($vistasR=="login" || $vistasR=="404"):
        if($vistasR=="login"){
            require_once "./vistas/contenido/login-view.php";
        }else{
            require_once "./vistas/contenido/404-view.php";
        } 
    else:		   
        require_once "./controladores/loginControlador.php";
        $lc = new loginControlador();
        if(!isset($_SESSION['token_sd']) || !isset($_SESSION['user_sd'])){
            $lc->forzar_cierre_sesion_controlador();
        }   
        $ruta = explode("/", htmlspecialchars($_GET['views'], ENT_QUOTES, 'UTF-8'));//DIVIDIMOS EN PARTES LA VARIABLE           
    ?>

    <!-- Navbar Top -->
    <?php
    // Procesamiento del nombre de la base de datos
    $prefixes = DB_PREFIX . "_";
    $nombre_db_final = str_replace($prefixes, "", $GLOBALS['db']);
    // Mostrar banner de modo soporte si está activo
    if (isset($_SESSION['modo_soporte']) && $_SESSION['modo_soporte'] === "SI") {
        echo '<div class="modo_soporte">
                <i class="fas fa-headset fa-lg"></i>
                <span>MODO SOPORTE ACTIVO - CLIENTE: '.htmlspecialchars($nombre_db_final, ENT_QUOTES, 'UTF-8').'</span>
            </div>';
    }
    ?>

    <?php require_once "./vistas/plantilla/modulos/navbartop.php";?>
    <!-- fin Navbar Top -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Navbar Lateral -->
            <?php require_once "./vistas/plantilla/modulos/navbarlateral.php";?>
            <!-- Fin Navbar Lateral -->
        </div>

        <div id="layoutSidenav_content">
            <?php if ($modoSoloLecturaPagoActivo): ?>
                <div class="izzy-payment-readonly-banner" role="status" aria-live="polite">
                    <div class="izzy-payment-readonly-banner-copy">
                        <span class="izzy-payment-readonly-banner-icon" aria-hidden="true">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <div>
                            <strong>Cuenta con pago pendiente · Modo consulta</strong>
                            <span>Puede consultar toda la información del sistema, pero las acciones que modifican datos permanecerán deshabilitadas hasta regularizar el pago.</span>
                            <span class="izzy-payment-readonly-contact">
                                Por ahora, el pago se gestiona por WhatsApp al
                                <a href="https://wa.me/50489136844"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   data-izzy-payment-readonly-allowed="1"
                                   aria-label="Contactar por WhatsApp al +504 8913-6844">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    <strong>+504 8913-6844</strong>
                                </a>.
                            </span>
                        </div>
                    </div>
                    <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>DetallesFacturacion/"
                       class="btn btn-warning izzy-payment-readonly-banner-action"
                       data-izzy-payment-readonly-allowed="1">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Ver facturación</span>
                    </a>
                </div>
            <?php endif; ?>

            <main>
                <!-- Contenido -->
                <?php 			
                require_once htmlspecialchars($vistasR, ENT_QUOTES, 'UTF-8');
                ?>
                <!-- Fin Contenido -->

                <?php 
                if(is_file("./vistas/plantilla/modulos/".htmlspecialchars($ruta[0], ENT_QUOTES, 'UTF-8').".php")){
                    require_once "./vistas/plantilla/modulos/".htmlspecialchars($ruta[0], ENT_QUOTES, 'UTF-8').".php"; 
                }else{
                    require_once "./vistas/plantilla/modulos/footer.php";
                }  			
                ?>
            </main>
        </div>
    </div>

    <?php 
    if(is_file("./vistas/contenido/modals/".htmlspecialchars($ruta[0], ENT_QUOTES, 'UTF-8').".php")){
        require_once "./vistas/contenido/modals/".htmlspecialchars($ruta[0], ENT_QUOTES, 'UTF-8').".php"; 
    }       
    //VENTANAS MODALES
    require_once "./vistas/contenido/modals/vistasModals.php";   
    //Scripts
    require_once "./vistas/plantilla/modulos/script.php";
    
    //SELECT2 GLOBAL (se carga después de jQuery/bootstrap scripts)
    echo '<script src="' . htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8') . 'ajax/librerias/select2.min.js"></script>';
    //CIERRE DE SESIÓN
    require_once "./vistas/plantilla/modulos/logoutScript.php";
    //SCRIPT VENTANAS MODALES
    require_once "./ajax/js/main.php";
    //LLAMAMOS EL AJAX SEGUN LA VISTA 
    if(is_file("./ajax/js/".htmlspecialchars($ruta[0], ENT_QUOTES, 'UTF-8').".php")){
        require_once "./ajax/js/".htmlspecialchars($ruta[0], ENT_QUOTES, 'UTF-8').".php"; 
    }                    
    endif; 		
    ?>

    <script>
        // Parche global: evita que reviente si selectpicker aún no existe
        (function() {
            if (!window.jQuery) { console.error('jQuery no cargó aún'); return; }

            // No-op para que no explote .selectpicker()
            if (!$.fn.selectpicker) {
                $.fn.selectpicker = function(){ return this; };
            }

            // Helper seguro para refrescar
            window.safeRefresh = function($el){
                try {
                if ($el && $el.length && $.fn && $.fn.selectpicker) {
                    $el.selectpicker('refresh');
                }
                } catch(e) {
                // silenciar
                }
            };
        })();
    </script>

    <a href="https://api.whatsapp.com/send?phone=50489136844&text=Hola%20ES%20MULTISERVICIOS,%20nos%20gustar%C3%ADa%20que%20nos%20puedan%20brindar%20asistencia%20t%C3%A9cnica,%20muchas%20gracias."
        class="float-ws" target="_blank" data-toggle="tooltip" data-placement="top" title="Soporte ES MULTISERVICIOS">
        <i class="fab fa-whatsapp my-float-ws"></i>
    </a>  
    
</body>

</html>