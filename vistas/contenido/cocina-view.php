<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Cocina - IZZY</title>
    <meta name="theme-color" content="#0B1F52">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230B1F52'/%3E%3Cpath fill='white' d='M18 11h4v16c0 5-2 8-6 10v16h-5V37c-4-2-6-5-6-10V11h4v13h2V11h4v13h3V11zm26 0c7 0 12 7 12 16 0 7-3 12-8 14v12h-5V11z'/%3E%3C/svg%3E">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>fontawesome/css/all.min.css">
    <?php $cocinaCssVersion = @filemtime(dirname(__DIR__) . '/plantilla/css/cocina.css') ?: time(); ?>
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/cocina.css?v=<?php echo (int)$cocinaCssVersion; ?>">
    <?php $cocinaThemeVersion = @filemtime(dirname(__DIR__) . '/plantilla/css/izzy-cocina-theme.css') ?: time(); ?>
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/izzy-cocina-theme.css?v=<?php echo (int)$cocinaThemeVersion; ?>">

    <style>
        .header-cocina{
            position:relative;
        }
        .header-cocina-main{
            text-align:center;
        }
        .cocina-fullscreen-btn{
            position:absolute;
            top:50%;
            right:18px;
            transform:translateY(-50%);
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            min-height:38px;
            padding:8px 13px;
            border:1px solid rgba(255,255,255,.22);
            border-radius:10px;
            background:rgba(255,255,255,.10);
            color:#fff;
            font:inherit;
            font-size:13px;
            font-weight:700;
            line-height:1;
            cursor:pointer;
            transition:background .18s ease,border-color .18s ease,transform .18s ease;
            z-index:5;
        }
        .cocina-fullscreen-btn:hover,
        .cocina-fullscreen-btn:focus-visible{
            background:rgba(255,255,255,.18);
            border-color:rgba(255,255,255,.38);
            outline:none;
        }
        .cocina-fullscreen-btn:active{
            transform:translateY(-50%) scale(.98);
        }
        .cocina-fullscreen-btn i{
            font-size:14px;
        }

        body.cocina-fullscreen-activo .header-cocina{
            min-height:58px;
            padding-top:8px;
            padding-bottom:8px;
        }

        @media (max-width:700px){
            .header-cocina{
                padding-right:58px;
            }
            .cocina-fullscreen-btn{
                right:10px;
                width:38px;
                min-width:38px;
                height:38px;
                padding:0;
                border-radius:9px;
            }
            .cocina-fullscreen-btn span{
                display:none;
            }
        }
    </style>

</head>
<body>
    <script>
        var SERVERURL = '<?php echo SERVERURL; ?>';
        window.COCINA_URL_TOKEN = <?php echo json_encode($tokenCocina ?? '', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    </script>

    <div class="vista-cocina-container">
        <header class="header-cocina">
            <div class="header-cocina-main">
                <h1><i class="fas fa-utensils"></i> Pantalla de Cocina</h1>
                <p id="hora-actual" aria-live="off"></p>
            </div>

            <button type="button"
                    id="btn-fullscreen-cocina"
                    class="cocina-fullscreen-btn"
                    aria-label="Activar pantalla completa"
                    aria-pressed="false"
                    title="Pantalla completa">
                <i class="fas fa-expand"></i>
                <span>Pantalla completa</span>
            </button>
        </header>

        <section id="cocina-pairing" class="cocina-pairing" hidden>
            <div class="cocina-pairing-card">
                <div class="cocina-pairing-icon"><i class="fas fa-tv"></i></div>
                <h2>Vincular esta pantalla</h2>
                <p class="cocina-pairing-help">Esta pantalla está lista para vincularse. En IZZY abra <strong>Restaurante → Gestionar → Centro de configuración → Cocina</strong> y escriba el código temporal.</p>
                <div id="cocina-pair-code" class="cocina-pair-code" aria-live="polite">------</div>
                <div id="cocina-pair-status" class="cocina-pair-status"><i class="fas fa-spinner fa-spin"></i> Generando código seguro…</div>
                <p id="cocina-pair-expire" class="cocina-pair-expire"></p>
                <button type="button" id="btn-nuevo-codigo-cocina" class="cocina-pair-new">
                    <i class="fas fa-rotate"></i> Generar otro código
                </button>
                <small>El código es temporal y solo sirve para vincular esta pantalla.</small>
            </div>
        </section>

        <main class="comandas-container" id="comandas-container" aria-live="polite" aria-busy="false" hidden>
            <div class="no-comandas" role="status">
                <div class="no-comandas-icon"><i class="fas fa-spinner fa-spin"></i></div>
                <strong>Preparando Cocina…</strong>
                <p>Validando el acceso de esta pantalla.</p>
            </div>
        </main>

        <div class="refresh-button" id="btn-refresh" title="Actualizar comandas">
            <i class="fas fa-sync-alt"></i>
        </div>
    </div>

    <?php $cocinaJsVersion = @filemtime(dirname(__DIR__, 2) . '/ajax/js/cocina.js') ?: time(); ?>
    <script src="<?php echo SERVERURL; ?>ajax/js/cocina.js?v=<?php echo (int)$cocinaJsVersion; ?>"></script>
    <script>
      window.setTimeout(function(){
        if(window.COCINA_APP_BOOTED) return;
        var box=document.getElementById('comandas-container');
        if(!box) return;
        box.style.display='grid';
        box.innerHTML='<div class="no-comandas" role="alert"><div class="no-comandas-icon"><i class="fas fa-triangle-exclamation"></i></div><strong>No se pudo iniciar Cocina</strong><p>El archivo de funcionamiento no cargó correctamente. Actualice la pantalla con Ctrl + F5.</p></div>';
      },4000);
    </script>
</body>
</html>