<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/dashboard.css">

<div class="container-fluid">
    <!-- Breadcrumb para Dashboard -->
    <div class="breadcrumb-container">
        <ol class="breadcrumb-harmony">
            <li class="breadcrumb-item active">
                <?php echo izzyTablerIcon('home', 'breadcrumb-icon'); ?>
                <span>Dashboard</span>
            </li>
        </ol>
    </div>


<!-- Cards de Métricas - Versión Mejorada -->
    <div class="card mb-4 dashboard-section-card" id="dashboard_kpis_card">
        <div class="card-header dashboard-section-header">
            <div class="dashboard-section-heading">
                <div class="dashboard-section-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <strong>Resumen del Dashboard</strong>
                    <small class="d-block text-muted mt-1">Indicadores principales de clientes, proveedores, facturación y compras.</small>
                </div>
            </div>

            <button type="button"
                    class="btn btn-secondary dashboard-toggle-btn"
                    id="btn_toggle_dashboard_kpis"
                    data-target="#dashboard_kpis_body"
                    data-storage-key="izzy_dashboard_kpis_visible"
                    aria-expanded="true">
                <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon mr-1'); ?>
                <span>Ocultar</span>
            </button>
        </div>

        <div class="card-body dashboard-section-body" id="dashboard_kpis_body">
            <div class="row">
        <!-- Card Clientes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>clientes/" class="card-link">
                <div class="card dashboard-card bg-gradient-primary hover-effect">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Clientes</h6>
                                <h2 class="mb-0" id="main_clientes">0</h2>
                            </div>
                            <div class="icon-circle">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="card-footer-text">
                                <i class="fas fa-info-circle mr-1"></i> Nuestros Clientes
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Card Proveedores -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>proveedores/" class="card-link">
                <div class="card dashboard-card bg-gradient-success hover-effect">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Proveedores</h6>
                                <h2 class="mb-0" id="main_proveedores">0</h2>
                            </div>
                            <div class="icon-circle">
                                <i class="fas fa-user-alt"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="card-footer-text">
                                <i class="fas fa-info-circle mr-1"></i> Nuestros Proveedores
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Card Facturas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteVentas/" class="card-link">
                <div class="card dashboard-card bg-gradient-warning hover-effect">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Facturas</h6>
                                <h2 class="mb-0" id="main_facturas">0</h2>
                            </div>
                            <div class="icon-circle">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="card-footer-text" id="mes_factura">
                                <i class="fas fa-calendar-alt mr-1"></i> <?= date('F Y'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Card Compras -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteCompras/" class="card-link">
                <div class="card dashboard-card bg-gradient-danger hover-effect">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Compras</h6>
                                <h2 class="mb-0" id="main_compras">0</h2>
                            </div>
                            <div class="icon-circle">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="card-footer-text" id="mes_compra">
                                <i class="fas fa-calendar-alt mr-1"></i> <?= date('F Y'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
        </div>
    </div>

    <!-- Ventas y Compras -->
    <div class="card mb-4 dashboard-section-card" id="dashboard_graficos_card">
        <div class="card-header dashboard-section-header">
            <div class="dashboard-section-heading">
                <div class="dashboard-section-icon"><?php echo izzyTablerIcon('chart-bar', 'izzy-icon-md'); ?></div>
                <div>
                    <strong>Ventas y Compras</strong>
                    <small class="d-block text-muted mt-1">Comportamiento anual de ventas y compras con datos reales del sistema.</small>
                </div>
            </div>

            <button type="button"
                    class="btn btn-secondary dashboard-toggle-btn"
                    id="btn_toggle_dashboard_graficos"
                    data-target="#dashboard_graficos_body"
                    data-storage-key="izzy_dashboard_graficos_visible"
                    aria-expanded="true">
                <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon mr-1'); ?>
                <span>Ocultar</span>
            </button>
        </div>

        <div class="card-body dashboard-section-body" id="dashboard_graficos_body">
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="chart-card h-100 dashboard-main-chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">
                                <?php echo izzyTablerIcon('shopping-cart', 'izzy-icon-md'); ?>
                                Gráfica de Ventas
                            </h3>
                            <div class="chart-actions">
                                <div class="year-selector btn-group btn-group-sm">
                                    <button class="btn btn-year-ventas active" data-year="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></button>
                                    <button class="btn btn-year-ventas" data-year="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></button>
                                </div>
                                <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteVentas/"
                                   class="chart-btn" data-toggle="tooltip" data-placement="top" title="Ver reporte completo">
                                    <?php echo izzyTablerIcon('arrow-right'); ?>
                                </a>
                                <button class="chart-btn download-ventas" data-toggle="tooltip" data-placement="top" title="Descargar gráfico">
                                    <?php echo izzyTablerIcon('download'); ?>
                                </button>
                                <button type="button"
                                        class="chart-btn dashboard-chart-toggle"
                                        data-target="#dashboard_chart_ventas_body"
                                        data-storage-key="izzy_dashboard_chart_ventas_visible"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Ocultar gráfico"
                                        aria-expanded="true">
                                    <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon'); ?>
                                </button>
                            </div>
                        </div>
                        <div id="dashboard_chart_ventas_body" class="dashboard-chart-body">
                            <div class="chart-container bar-chart dashboard-chart-scroll">
                                <div class="dashboard-chart-canvas"><canvas id="graphVentas" height="250"></canvas></div>
                            </div>
                            <div class="chart-legend" id="ventas-legend"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="chart-card h-100 dashboard-main-chart-card dashboard-purchases-chart">
                        <div class="chart-header">
                            <h3 class="chart-title">
                                <?php echo izzyTablerIcon('shopping-bag', 'izzy-icon-md'); ?>
                                Gráfica de Compras
                            </h3>
                            <div class="chart-actions">
                                <div class="year-selector btn-group btn-group-sm">
                                    <button class="btn btn-year-compras active" data-year="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></button>
                                    <button class="btn btn-year-compras" data-year="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></button>
                                </div>
                                <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteCompras/"
                                   class="chart-btn" data-toggle="tooltip" data-placement="top" title="Ver reporte completo">
                                    <?php echo izzyTablerIcon('arrow-right'); ?>
                                </a>
                                <button class="chart-btn download-compras" data-toggle="tooltip" data-placement="top" title="Descargar gráfico">
                                    <?php echo izzyTablerIcon('download'); ?>
                                </button>
                                <button type="button"
                                        class="chart-btn dashboard-chart-toggle"
                                        data-target="#dashboard_chart_compras_body"
                                        data-storage-key="izzy_dashboard_chart_compras_visible"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Ocultar gráfico"
                                        aria-expanded="true">
                                    <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon'); ?>
                                </button>
                            </div>
                        </div>
                        <div id="dashboard_chart_compras_body" class="dashboard-chart-body">
                            <div class="chart-container bar-chart dashboard-chart-scroll">
                                <div class="dashboard-chart-canvas"><canvas id="graphCompras" height="250"></canvas></div>
                            </div>
                            <div class="chart-legend" id="compras-legend"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Se conserva la funcionalidad existente de Top Productos -->
    <div class="card mb-4 dashboard-section-card" id="dashboard_productos_card">
        <div class="card-header dashboard-section-header">
            <div class="dashboard-section-heading">
                <div class="dashboard-section-icon"><?php echo izzyTablerIcon('star', 'izzy-icon-md'); ?></div>
                <div>
                    <strong>Productos más vendidos</strong>
                    <small class="d-block text-muted mt-1">Top de productos por los últimos 3 o 6 meses.</small>
                </div>
            </div>
            <button type="button"
                    class="btn btn-secondary dashboard-toggle-btn"
                    id="btn_toggle_dashboard_productos"
                    data-target="#dashboard_productos_body"
                    data-storage-key="izzy_dashboard_productos_visible"
                    aria-expanded="true">
                <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon mr-1'); ?>
                <span>Ocultar</span>
            </button>
        </div>

        <div class="card-body dashboard-section-body" id="dashboard_productos_body">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <?php echo izzyTablerIcon('star', 'izzy-icon-md'); ?>
                        Top 5 Productos Más Vendidos
                    </h3>
                    <div class="chart-actions">
                        <div class="year-selector btn-group btn-group-sm">
                            <button class="btn btn-year-productos active" data-months="3">Últimos 3 Meses</button>
                            <button class="btn btn-year-productos" data-months="6">Últimos 6 Meses</button>
                        </div>
                        <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>transferencia/"
                           class="chart-btn" data-toggle="tooltip" data-placement="top" title="Ver reporte completo">
                            <?php echo izzyTablerIcon('arrow-right'); ?>
                        </a>
                        <button class="chart-btn download-top-productos" data-toggle="tooltip" data-placement="top" title="Descargar gráfico">
                            <?php echo izzyTablerIcon('download'); ?>
                        </button>
                        <button type="button"
                                class="chart-btn dashboard-chart-toggle"
                                data-target="#dashboard_chart_productos_body"
                                data-storage-key="izzy_dashboard_chart_productos_visible"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Ocultar gráfico"
                                aria-expanded="true">
                            <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon'); ?>
                        </button>
                    </div>
                </div>
                <div id="dashboard_chart_productos_body" class="dashboard-chart-body">
                    <div class="chart-container bar-chart dashboard-chart-scroll">
                        <div class="dashboard-chart-canvas"><canvas id="graphTopProductosporAno" height="120"></canvas></div>
                    </div>
                    <div class="chart-legend" id="top-products-legend"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentos Fiscales - Listado por DIVs -->
    <div class="row dashboard-fiscales-row">
        <div class="col-12">
            <div class="card mb-4 dashboard-fiscales-card">
                <div class="card-header dashboard-fiscales-header">
                    <div class="dashboard-fiscales-heading">
                        <div class="dashboard-fiscales-heading-icon">
                            <?php echo izzyTablerIcon('file-invoice'); ?>
                        </div>
                        <div>
                            <strong>Documentos Fiscales</strong>
                            <small class="d-block text-muted mt-1">
                                Control rápido de documentos fiscales, rangos autorizados, correlativo siguiente y fecha de expiración.
                            </small>
                        </div>
                    </div>

                    <div class="dashboard-fiscales-header-actions">
                        <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>secuencia/"
                           class="dashboard-fiscales-link"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Ver secuencias">
                            <span>Ver secuencias</span>
                            <?php echo izzyTablerIcon('arrow-right'); ?>
                        </a>

                        <button type="button"
                                class="btn btn-secondary dashboard-toggle-btn"
                                id="btn_toggle_dashboard_fiscales"
                                data-target="#dashboard_fiscales_body"
                                data-storage-key="izzy_dashboard_fiscales_visible"
                                aria-expanded="true">
                            <?php echo izzyTablerIcon('chevron-up', 'dashboard-toggle-icon mr-1'); ?>
                            <span>Ocultar</span>
                        </button>
                    </div>
                </div>

                <div id="dashboard_fiscales_body" class="dashboard-fiscales-collapsible">
                    <div class="card-body">
                    <div class="dashboard-fiscales-toolbar">
                        <div class="dashboard-fiscales-actions">
                            <button type="button" class="btn btn-secondary table_actualizar ocultar" id="btn_dashboard_fiscales_actualizar">
                                <?php echo izzyTablerIcon('refresh', 'mr-1'); ?> Actualizar
                            </button>
                            <button type="button" class="btn btn-success table_reportes ocultar" id="btn_dashboard_fiscales_excel">
                                <?php echo izzyTablerIcon('file-spreadsheet', 'mr-1'); ?> Excel
                            </button>
                            <button type="button" class="btn btn-danger table_reportes ocultar" id="btn_dashboard_fiscales_pdf">
                                <?php echo izzyTablerIcon('file-type-pdf', 'mr-1'); ?> PDF
                            </button>
                        </div>

                        <div class="dashboard-fiscales-tools">
                            <div class="dashboard-fiscales-page-size">
                                <label for="dashboard_fiscales_page_size">Mostrar</label>
                                <select id="dashboard_fiscales_page_size"
                                        class="form-control form-control-sm">
                                    <option value="3" selected>3</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                                <span>registros</span>
                            </div>

                            <div class="dashboard-fiscales-view-switch"
                                 role="group"
                                 aria-label="Tipo de vista de documentos fiscales">
                                <button type="button"
                                        class="dashboard-fiscales-view-btn active"
                                        data-view="detalle"
                                        title="Vista detalle"
                                        aria-pressed="true">
                                    <?php echo izzyTablerIcon('list'); ?>
                                    <span>Detalle</span>
                                </button>

                                <button type="button"
                                        class="dashboard-fiscales-view-btn"
                                        data-view="miniatura"
                                        title="Vista miniatura"
                                        aria-pressed="false">
                                    <?php echo izzyTablerIcon('layout-grid'); ?>
                                    <span>Miniatura</span>
                                </button>
                            </div>

                            <div class="dashboard-fiscales-search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <?php echo izzyTablerIcon('search'); ?>
                                        </span>
                                    </div>
                                    <input type="search"
                                           id="dashboard_fiscales_buscar"
                                           class="form-control"
                                           placeholder="Buscar secuencia..."
                                           autocomplete="off">
                                    <button type="button"
                                            id="dashboard_fiscales_buscar_limpiar"
                                            class="dashboard-fiscales-search-clear"
                                            aria-label="Limpiar búsqueda"
                                            title="Limpiar búsqueda">
                                        <?php echo izzyTablerIcon('x'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="dashboard_fiscales_loading" class="dashboard-fiscales-state d-none" role="status" aria-live="polite">
                        <?php echo izzyTablerIcon('loader-2', 'izzy-icon-spin'); ?>
                        <span>Cargando documentos fiscales...</span>
                    </div>

                    <div id="dashboard_fiscales_empty" class="dashboard-fiscales-state d-none" role="status" aria-live="polite">
                        <?php echo izzyTablerIcon('inbox'); ?>
                        <div>
                            <strong>No se encontraron documentos fiscales</strong>
                            <small>No hay secuencias disponibles para mostrar.</small>
                        </div>
                    </div>

                    <div id="dashboard_fiscales_listado" class="dashboard-fiscales-listado" aria-live="polite"></div>

                    <div class="dashboard-fiscales-footer-list">
                        <div id="dashboard_fiscales_info" class="dashboard-fiscales-info">Mostrando 0 registros</div>
                        <nav id="dashboard_fiscales_paginacion" class="dashboard-fiscales-paginacion" aria-label="Paginación de documentos fiscales"></nav>
                    </div>
                </div>

                <div class="card-footer small text-muted">
                    <?php
                        require_once "./core/mainModel.php";

                        $insMainModel = new mainModel();
                        $entidad = "secuencia_facturacion";

                        if($insMainModel->getlastUpdate($entidad)->num_rows > 0){
                            $consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
                            $fecha_registro = htmlspecialchars($consulta_last_update['fecha_registro'], ENT_QUOTES, 'UTF-8');
                            $hora = htmlspecialchars(date('g:i:s a', strtotime($fecha_registro)), ENT_QUOTES, 'UTF-8');
                            echo "Última Actualización ".htmlspecialchars($insMainModel->getTheDay($fecha_registro, $hora), ENT_QUOTES, 'UTF-8');
                        } else {
                            echo "No se encontraron registros";
                        }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>