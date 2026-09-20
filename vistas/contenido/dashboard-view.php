<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/dashboard.css">

<div class="container-fluid">
    <!-- Breadcrumb para Dashboard -->
    <div class="breadcrumb-container">
        <ol class="breadcrumb-harmony">
            <li class="breadcrumb-item active">
                <i class="fas fa-home breadcrumb-icon"></i>
                <span>Dashboard</span>
            </li>
        </ol>
    </div>

    <!-- Flujo diario: accesos existentes reorganizados -->
    <div class="dashboard-workflow mb-4" aria-label="Flujo diario">
        <div class="dashboard-workflow-copy">
            <span class="dashboard-workflow-eyebrow">Operación diaria</span>
            <strong>Empieza por lo que haces primero</strong>
            <small>Caja, facturación y seguimiento de cuentas por cobrar en un solo flujo.</small>
        </div>

        <div class="dashboard-workflow-actions">
            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>cajas/"
               class="dashboard-workflow-action cajas"
               style="display:none">
                <span class="dashboard-workflow-action-icon"><i class="fas fa-cash-register"></i></span>
                <span>
                    <small>01</small>
                    <strong>Aperturar caja</strong>
                </span>
            </a>

            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>facturas/"
               class="dashboard-workflow-action dashboard-workflow-action-primary facturas"
               style="display:none">
                <span class="dashboard-workflow-action-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                <span>
                    <small>02</small>
                    <strong>Facturar</strong>
                </span>
            </a>

            <a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>cobrarClientes/"
               class="dashboard-workflow-action cobrarClientes"
               style="display:none">
                <span class="dashboard-workflow-action-icon"><i class="fas fa-hand-holding-usd"></i></span>
                <span>
                    <small>03</small>
                    <strong>Facturas pendientes</strong>
                </span>
            </a>
        </div>
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
                <i class="fas fa-chevron-up mr-1"></i>
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

	<!-- Sección de Gráficos Mejorada -->
    <div class="card mb-4 dashboard-section-card" id="dashboard_graficos_card">
        <div class="card-header dashboard-section-header">
            <div class="dashboard-section-heading">
                <div class="dashboard-section-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <strong>Gráficos del Dashboard</strong>
                    <small class="d-block text-muted mt-1">Ventas, compras y productos más vendidos.</small>
                </div>
            </div>

            <button type="button"
                    class="btn btn-secondary dashboard-toggle-btn"
                    id="btn_toggle_dashboard_graficos"
                    data-target="#dashboard_graficos_body"
                    data-storage-key="izzy_dashboard_graficos_visible"
                    aria-expanded="true">
                <i class="fas fa-chevron-up mr-1"></i>
                <span>Ocultar</span>
            </button>
        </div>

        <div class="card-body dashboard-section-body" id="dashboard_graficos_body">
	        <div class="row">
		<!-- Gráfico Ventas - Versión Premium -->
		<div class="col-xl-6 col-md-12 mb-4">
			<div class="chart-card h-100">
				<div class="chart-header">
					<h3 class="chart-title">
						<i class="fas fa-chart-bar"></i>
						Reporte Ventas
					</h3>
					<div class="chart-actions">
						<div class="year-selector btn-group btn-group-sm">
							<button class="btn btn-year-ventas active" data-year="<?php echo date("Y"); ?>">
								<?php echo date("Y"); ?>
							</button>
							<button class="btn btn-year-ventas" data-year="<?php echo date("Y")-1; ?>">
								<?php echo date("Y")-1; ?>
							</button>
						</div>
						<a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteVentas/" 
						class="chart-btn" data-toggle="tooltip" data-placement="top" title="Ver reporte completo">
							<i class="fas fa-arrow-right"></i>
						</a>
						<button class="chart-btn download-ventas" data-toggle="tooltip" data-placement="top" title="Descargar gráfico">
							<i class="fas fa-download"></i>
						</button>
                        <button type="button"
                                class="chart-btn dashboard-chart-toggle"
                                data-target="#dashboard_chart_ventas_body"
                                data-storage-key="izzy_dashboard_chart_ventas_visible"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Ocultar gráfico"
                                aria-expanded="true">
                            <i class="fas fa-chevron-up"></i>
                        </button>
					</div>
				</div>
                <div id="dashboard_chart_ventas_body" class="dashboard-chart-body">
				    <div class="chart-container bar-chart dashboard-chart-scroll">
                        <div class="dashboard-chart-canvas">
                            <canvas id="graphVentas" height="250"></canvas>
                        </div>
                    </div>
				    <div class="chart-legend" id="ventas-legend">
					    <!-- Leyenda generada dinámicamente -->
				    </div>
                </div>
			</div>
		</div>
		
		<!-- Gráfico Compras - Versión Premium -->
		<div class="col-xl-6 col-md-12 mb-4">
			<div class="chart-card h-100">
				<div class="chart-header">
					<h3 class="chart-title">
						<i class="fas fa-chart-bar"></i>
						Reporte Compras
					</h3>
					<div class="chart-actions">
						<div class="year-selector btn-group btn-group-sm">
							<button class="btn btn-year-compras active" data-year="<?php echo date("Y"); ?>">
								<?php echo date("Y"); ?>
							</button>
							<button class="btn btn-year-compras" data-year="<?php echo date("Y")-1; ?>">
								<?php echo date("Y")-1; ?>
							</button>
						</div>
						<a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>reporteCompras/" 
						class="chart-btn" data-toggle="tooltip" data-placement="top" title="Ver reporte completo">
							<i class="fas fa-arrow-right"></i>
						</a>
						<button class="chart-btn download-compras" data-toggle="tooltip" data-placement="top" title="Descargar gráfico">
							<i class="fas fa-download"></i>
						</button>
                        <button type="button"
                                class="chart-btn dashboard-chart-toggle"
                                data-target="#dashboard_chart_compras_body"
                                data-storage-key="izzy_dashboard_chart_compras_visible"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Ocultar gráfico"
                                aria-expanded="true">
                            <i class="fas fa-chevron-up"></i>
                        </button>
					</div>
				</div>
                <div id="dashboard_chart_compras_body" class="dashboard-chart-body">
				    <div class="chart-container bar-chart dashboard-chart-scroll">
                        <div class="dashboard-chart-canvas">
                            <canvas id="graphCompras" height="250"></canvas>
                        </div>
                    </div>
				    <div class="chart-legend" id="compras-legend">
					    <!-- Leyenda generada dinámicamente -->
				    </div>
                </div>
			</div>
		</div>
		
		<!-- Gráfico Top Productos - Versión Premium -->
		<div class="col-12 mb-4">
			<div class="chart-card">
				<div class="chart-header">
					<h3 class="chart-title">
						<i class="fas fa-star"></i>
						Top 5 Productos Más Vendidos en 3 Meses
					</h3>
					<div class="chart-actions">
						<div class="year-selector btn-group btn-group-sm">
							<button class="btn btn-year-productos active" data-months="3">
								Últimos 3 Meses
							</button>
							<button class="btn btn-year-productos" data-months="6">
								Últimos 6 Meses
							</button>
						</div>
						<a href="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8'); ?>transferencia/" 
						class="chart-btn" data-toggle="tooltip" data-placement="top" title="Ver reporte completo">
							<i class="fas fa-arrow-right"></i>
						</a>
						<button class="chart-btn download-top-productos" data-toggle="tooltip" data-placement="top" title="Descargar gráfico">
							<i class="fas fa-download"></i>
						</button>
                        <button type="button"
                                class="chart-btn dashboard-chart-toggle"
                                data-target="#dashboard_chart_productos_body"
                                data-storage-key="izzy_dashboard_chart_productos_visible"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Ocultar gráfico"
                                aria-expanded="true">
                            <i class="fas fa-chevron-up"></i>
                        </button>
					</div>
				</div>
                <div id="dashboard_chart_productos_body" class="dashboard-chart-body">
				    <div class="chart-container bar-chart dashboard-chart-scroll">
                        <div class="dashboard-chart-canvas">
                            <canvas id="graphTopProductosporAno" height="120"></canvas>
                        </div>
                    </div>
				    <div class="chart-legend" id="top-products-legend">
					    <!-- La leyenda se generará dinámicamente con JavaScript -->
				    </div>
                </div>
			</div>
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
                            <i class="fas fa-file-invoice-dollar"></i>
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
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <button type="button"
                                class="btn btn-secondary dashboard-toggle-btn"
                                id="btn_toggle_dashboard_fiscales"
                                data-target="#dashboard_fiscales_body"
                                data-storage-key="izzy_dashboard_fiscales_visible"
                                aria-expanded="true">
                            <i class="fas fa-chevron-up mr-1"></i>
                            <span>Ocultar</span>
                        </button>
                    </div>
                </div>

                <div id="dashboard_fiscales_body" class="dashboard-fiscales-collapsible">
                    <div class="card-body">
                    <div class="dashboard-fiscales-toolbar">
                        <div class="dashboard-fiscales-actions">
                            <button type="button" class="btn btn-secondary table_actualizar ocultar" id="btn_dashboard_fiscales_actualizar">
                                <i class="fas fa-sync-alt mr-1"></i> Actualizar
                            </button>
                            <button type="button" class="btn btn-success table_reportes ocultar" id="btn_dashboard_fiscales_excel">
                                <i class="fas fa-file-excel mr-1"></i> Excel
                            </button>
                            <button type="button" class="btn btn-danger table_reportes ocultar" id="btn_dashboard_fiscales_pdf">
                                <i class="fas fa-file-pdf mr-1"></i> PDF
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
                                    <i class="fas fa-list-ul"></i>
                                    <span>Detalle</span>
                                </button>

                                <button type="button"
                                        class="dashboard-fiscales-view-btn"
                                        data-view="miniatura"
                                        title="Vista miniatura"
                                        aria-pressed="false">
                                    <i class="fas fa-th-large"></i>
                                    <span>Miniatura</span>
                                </button>
                            </div>

                            <div class="dashboard-fiscales-search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
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
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="dashboard_fiscales_loading" class="dashboard-fiscales-state d-none" role="status" aria-live="polite">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>Cargando documentos fiscales...</span>
                    </div>

                    <div id="dashboard_fiscales_empty" class="dashboard-fiscales-state d-none" role="status" aria-live="polite">
                        <i class="fas fa-inbox"></i>
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