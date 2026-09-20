<nav class="sb-topnav navbar navbar-expand navbar-dark bg-color-navarlateral">
  <div class="navbar-brand logo-container">
    <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>dashboard/">
      <img src="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>vistas/plantilla/img/logos/logo.svg"
           alt="IZZY"
           class="logo img-fluid">
    </a>
  </div>

  <!-- Botón de alternar menú lateral (sidebar) -->
  <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" type="button" aria-label="Abrir menú lateral">
    <i class="fas fa-bars fa-lg"></i>
  </button>

  <!-- Botón Pantalla completa
  <button id="global-fullscreen-btn" class="btn btn-light ml-2" type="button" title="Pantalla completa" aria-label="Pantalla completa">
    <i class="fas fa-expand"></i>
  </button>
  -->

  <!-- ===== Botón "Menú principal" (solo tablets/móviles) ===== -->
  <div class="mobile-mainmenu-wrapper d-lg-none flex-grow-1 d-flex justify-content-center">
    <div class="dropdown">
      <button id="mobile-mainmenu-btn"
              class="btn btn-light btn-md px-3"
              type="button"
              aria-haspopup="true"
              aria-expanded="false">
        <i class="fas fa-bars mr-2"></i> Menú principal
      </button>
      <!-- Aquí se inyectan los enlaces clonados -->
      <div id="mobile-mainmenu"
           class="dropdown-menu dropdown-menu-center shadow"
           aria-labelledby="mobile-mainmenu-btn"></div>
    </div>
  </div>
  <!-- ===== /Menú principal móvil ===== -->

  <!-- Accesos rápidos de operación (desktop) -->
  <ul class="navbar-nav d-none d-lg-flex top-quick-nav" aria-label="Accesos rápidos">
    <li class="nav-item">
      <a class="nav-link link menu-item cajas top-quick-link"
         href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>cajas/"
         style="display:none"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Caja">
        <i class="fas fa-cash-register"></i>
        <span>Caja</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link link menu-item facturas top-quick-link top-quick-primary"
         href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>facturas/"
         style="display:none"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Facturar">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Facturar</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link link menu-item cobrarClientes top-quick-link"
         href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>cobrarClientes/"
         style="display:none"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Cuentas por cobrar">
        <i class="fas fa-hand-holding-usd"></i>
        <span>CxC</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link link menu-item transferencia top-quick-link"
         href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>transferencia/"
         style="display:none"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Inventario">
        <i class="fas fa-boxes"></i>
        <span>Inventario</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link link menu-item reporteVentas top-quick-link"
         href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteVentas/"
         style="display:none"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Reporte de ventas">
        <i class="fas fa-chart-line"></i>
        <span>Ventas</span>
      </a>
    </li>
  </ul>

  <!-- Navbar usuario -->
  <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0 navbar-nav-user">
    <!-- Campana (oculta si no hay notificaciones) -->
    <li class="nav-item dropdown mx-1" style="display: none;">
      <a class="nav-link dropdown-toggle position-relative" id="notification-bell" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell"></i>
        <span id="notification-count" class="position-absolute top-0 start-100 translate-middle" style="display: none;"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notification-bell">
        <h6 class="dropdown-header d-flex justify-content-between align-items-center">
          <span>Notificaciones</span>
        </h6>
        <a class="dropdown-item d-flex align-items-center" href="<?php echo SERVERURL; ?>DetallesFacturacion/">
          <i class="fas fa-file-invoice mr-2"></i>
          <span class="flex-grow-1 ml-2">Facturas pendientes</span>
          <span id="notification-dropdown-count" class="badge">0</span>
        </a>
      </div>
    </li>

    <!-- Menú de usuario -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-lg mr-2"></i>
        <span id="user_session" class="mr-1"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#" id="cambiar_contraseña_usuarios_sistema">
          <i class="fas fa-key"></i> Modificar Contraseña
        </a>
        <a class="dropdown-item" href="#" id="modificar_perfil_usuario_sistema">
          <i class="fas fa-id-card"></i> Mi Perfil
          <span id="badge-codigo-cliente" class="badge bg-primary ml-2"></span>
        </a>
        <a class="dropdown-item" href="#" id="ver-pin-usuario" data-toggle="popover">
          <i class="fas fa-lock"></i> Ver mi PIN
          <span id="badge-pin-cliente" class="badge bg-info ml-2"></span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item d-flex align-items-center" href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>DetallesFacturacion/">
          <i class="fas fa-file-invoice"></i>
          <span class="flex-grow-1 ml-2">Detalles de Facturación</span>
          <span id="badge-facturas-pendientes-dropdown" class="badge bg-danger" style="display: none;">0</span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item btn-exit-system" href="<?php echo $lc->encryption($_SESSION['token_sd']);?>">
          <i class="fas fa-sign-out-alt"></i> Salir
        </a>
      </div>
    </li>
  </ul>
</nav>
