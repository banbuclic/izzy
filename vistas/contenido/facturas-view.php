<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/nota_credito.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/facturas.css">
<body id="view_bill">
    <div class="container-fluid">
        <div class="card mb-4 facturas-workspace-card">
            <div class="card-header facturas-workspace-header">
                <i class="fas fa-file-invoice fa-lg mr-1"></i>
                Facturas
            </div>
            <div class="card-body facturas-workspace-body">
                <form class="FormularioAjax" id="invoice-form" method="POST" action="" data-form="" autocomplete="off" enctype="multipart/form-data">
                    
                    <div class="facturas-context-grid">
                    <div class="form-group row customer-bill-box-left">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="bill-header-row">
                                <span id="rtn-customers-bill"></span>
                                <span id="client-customers-bill"></span>
                            </div>
                            <div class="bill-row">
                                <span id="vendedor-customers-bill"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row customer-bill-box-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div id="mensajeFacturas" class="facturas-counter alert-normal">
                                <i class="fas fa-spinner fa-spin"></i>
                                <span class="counter-text">Verificando estado de facturas...</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row customer-bill-box-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <span id="fecha-customers-bill"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <span id="hora-customers-bill"></span>
                        </div>
                    </div>

                    </div>

                    <div class="bill facturas-operacion">
                        <!-- SECCIÓN DE BOTONES MEJORADA (SOLO REORGANIZACIÓN VISUAL) -->
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <!-- Primera fila de botones principales -->
                                <div class="d-flex flex-wrap mb-2 facturas-primary-toolbar">

                                    <!-- Ayuda -->
                                    <button
                                        class="btn btn-secondary mr-2"
                                        type="button"
                                        id="help_factura"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Ayuda</strong><br>Abre la guía rápida de facturación.<br><small>Tip: presiona <b>F1</b> en cualquier momento.</small>">
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-question-circle fa-lg"></i> [F1] Ayuda
                                    </button>

                                    <!-- Guardar Factura -->
                                    <button
                                        class="btn btn-secondary mr-2"
                                        type="submit"
                                        id="guardar_factura"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Guardar</strong><br>Almacena la factura como <u>borrador</u> para continuar más tarde.<br>No emite documento fiscal ni descuenta la secuencia del SAR.<br>Podrás <strong>reabrirla</strong>, <strong>editarla</strong> o <strong>eliminarla</strong> cuando quieras, sin afectar la numeración ni la contabilidad.">
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-save fa-lg"></i> [F2] Guardar
                                    </button>

                                    <!-- Registrar Factura -->
                                    <button
                                        class="btn btn-success mr-2"
                                        type="submit"
                                        id="reg_factura"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Registrar factura</strong><br>Emite el documento fiscal.<br><u>Acción definitiva</u>: no se puede editar luego. Para corregir, debes <strong>anular</strong> la factura o emitir una <strong>Nota de Crédito</strong>.">
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-hand-holding-usd fa-lg"></i> [F7] Registrar Factura
                                    </button>

                                    <!-- Cliente -->
                                    <button
                                        class="btn btn-secondary mr-2"
                                        type="button"
                                        id="add_cliente"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Cliente</strong><br>Busca un cliente existente o <u>créalo</u> sin salir de la venta.<br>Autocompleta: <u>Nombre</u>, <u>RTN</u> y <u>condición</u> de pago.<br>Útil para fidelización y créditos."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-user-plus fa-lg"></i> [F8] Cliente
                                    </button>

                                    <!-- Vendedor / Empleado -->
                                    <button
                                        class="btn btn-secondary mr-2"
                                        type="button"
                                        id="add_vendedor"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Vendedor</strong><br>Asigna el colaborador responsable de la venta.<br>Impacta <u>comisiones</u>, <u>reportes</u> y trazabilidad.<br>Requerido para facturar correctamente."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-plus-circle fa-lg"></i> [F9] Vendedor
                                    </button>

                                    <!-- Aperturar Caja -->
                                    <button
                                        class="btn btn-secondary mr-2"
                                        type="button"
                                        id="btn_apertura"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Aperturar Caja</strong><br>Crea el registro de apertura (fecha, hora, usuario, caja).<br>Habilita <u>facturación</u> y <u>cobros</u> para el turno actual.<br>Puedes definir un <u>monto inicial</u> opcional."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-cash-register fa-lg"></i> [F10] Aperturar
                                    </button>

                                    <!-- Cerrar Caja -->
                                    <button
                                        class="btn btn-secondary mr-2"
                                        type="button"
                                        id="btn_cierre"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        style="display:none;"
                                        title="<strong>Cerrar Caja</strong><br>Realiza el <u>arqueo</u> del turno y bloquea nueva facturación.<br>Genera totales por forma de pago y diferencias.<br>Si tienes impresora, puedes emitir el <u>comprobante</u>."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-cash-register fa-lg"></i> [F11] Cerrar
                                    </button>

                                    <!-- Retirar Dinero de Caja -->
                                    <span
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Retirar dinero de caja</strong><br>Registra una <u>salida de efectivo</u> de la caja actual.<br>No afecta la factura que estás trabajando.<br>Úsalo para retiros, pagos internos o salidas de dinero controladas."
                                    >
                                        <button
                                            class="btn btn-warning mr-2"
                                            type="button"
                                            id="btn_retiro_caja">
                                            <div class="sb-nav-link-icon"></div>
                                            <i class="fas fa-money-bill-wave fa-lg"></i> Retirar Caja
                                        </button>
                                    </span>    
                                    
                                    <!-- Botón sugerido: colocarlo después del botón Ver Caja -->
                                    <button
                                        type="button"
                                        id="btn_config_factura"
                                        class="btn btn-dark ml-2"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Configuración de facturación</strong><br>Administra caja, proformas, ISV, conversión de proformas y seguridad de descuentos/precios.<br><strong>Siempre requiere validación de administrador.</strong>">
                                        <i class="fas fa-cogs fa-lg"></i> Config
                                    </button>                                    

                                </div>

                                <!-- Segunda fila de botones y controles -->
                                <div class="d-flex flex-wrap align-items-center facturas-options-toolbar">
                                    <!-- Controles de Tipo y Proforma -->
                                    <div class="d-flex align-items-center mr-3">
                                        <label class="col-form-label mr-2 mb-0">Tipo de Factura:</label>

                                        <!-- NUEVO CONTROL: BOTONES CONTADO / CRÉDITO -->
                                        <div id="tipo-factura-control" class="btn-group btn-group-sm" role="group" aria-label="Tipo de factura"
                                             data-toggle="tooltip" data-placement="top"
                                             title="<?php 
                                                if ($_SESSION['planes_id_sistema'] == 1) {
                                                    echo 'En el Plan Emprendedor, si la factura es crédito, se podrá emitir pero no se registrarán los pagos. Esto solo aplica para los siguientes planes';
                                                } else {
                                                    echo 'Tipo de Factura, Contado o Crédito';
                                                }
                                             ?>">
                                            <button type="button" class="btn btn-primary active" data-tipo="contado" id="btn-tipo-contado">Contado</button>
                                            <button type="button" class="btn btn-outline-primary" data-tipo="credito" id="btn-tipo-credito">Crédito</button>
                                        </div>

                                        <!-- campo compatible con backend: 1=Contado, 0=Crédito -->
                                        <input type="hidden" id="facturas_activo" name="facturas_activo" value="1" class="form-control">                                       
                                    </div>

                                    <?php if ($_SESSION['planes_id_sistema'] != 1): ?>
                                        <!-- BLOQUE PROFORMA -->
                                        <div class="proforma-ui-box d-flex flex-wrap align-items-center mr-3" id="facturas_proforma_container">

                                            <div class="d-flex align-items-center mr-3 mb-2 mb-md-0">
                                                <label class="col-form-label mr-2 mb-0 font-weight-bold" for="facturas_proforma">
                                                    ¿Generar factura Proforma?
                                                </label>

                                                <label class="switch mb-0" data-toggle="tooltip" data-placement="top" title="Factura Proforma">
                                                    <input type="checkbox" id="facturas_proforma" name="facturas_proforma" value="1">
                                                    <div class="slider round"></div>
                                                </label>

                                                <span class="badge badge-light ml-2 px-3 py-2" id="label_facturas_proforma">No</span>
                                            </div>

                                            <div class="d-flex align-items-center proforma-inventario-box" id="proforma_rebajar_inventario_container" style="display:none !important;">
                                                <label class="col-form-label mr-2 mb-0 font-weight-bold" for="bajar_inventario_proforma">
                                                    ¿Rebajar inventario?
                                                </label>

                                                <label class="switch mb-0" data-toggle="tooltip" data-placement="top" title="Si activa esta opción, la proforma rebajará inventario">
                                                    <input type="checkbox" id="proforma_bajar_inventario" name="proforma_bajar_inventario" value="1">
                                                    <div class="slider round"></div>
                                                </label>

                                                <span class="badge badge-light ml-2 px-3 py-2" id="label_bajar_inventario_proforma">No</span>
                                            </div>

                                        </div>
                                    <?php endif; ?>

                                    <!-- Botón de Exoneración -->
                                    <button type="button" id="btn_exoneracion" class="btn btn-info" data-toggle="modal" data-target="#exoneracionModal">
                                        <i class="fas fa-file-invoice"></i> Datos de Exoneración
                                    </button>

                                    <button
                                        type="button"
                                        id="btn_ver_caja_factura"
                                        class="btn btn-dark"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Ver Caja</strong><br>Consulta la caja actual o el historial de cajas desde facturación.<br>Permite ver ventas, retiros, neto y acciones disponibles.">
                                        <i class="fas fa-cash-register fa-lg"></i> Ver Caja
                                    </button>                                    
                                </div>

                            </div>
                        </div>

                        <!-- RESTO DEL CÓDIGO (EXACTAMENTE IGUAL) -->
                        <div class="form-group row" style="display:none">
                            <label for="inputCliente" class="col-sm-1 col-form-label-md">Cliente <span class="priority">*<span /></label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" placeholder="Proceso" id="proceso_factura" name="proceso_factura" readonly>
                                    <input type="text" class="form-control" placeholder="Factura" id="facturas_id" name="facturas_id" readonly>
                                    <input type="text" class="form-control" placeholder="row" id="bill_row" name="bill_row" readonly value="0">
                                    <input type="hidden" class="form-control" placeholder="Cliente" id="cliente_id" name="cliente_id" readonly required>
                                    <input type="text" class="form-control" placeholder="Cliente" id="cliente" name="cliente" required readonly data-toggle="tooltip" data-placement="top" title="Cliente">
                                    <div class="input-group-append" id="grupo_buscar_colaboradores">
                                        <span data-toggle="tooltip" data-placement="top" title="Búsqueda de Empleados"><a data-toggle="modal" href="#" class="btn btn-outline-success" id="buscar_clientes">
                                            <div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i>
                                        </a></span>
                                    </div>
                                </div>
                            </div>
                            <label for="inputFecha" class="col-sm-1 col-form-label-md">Fecha <span class="priority">*<span /></label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required id="fecha" name="fecha" data-toggle="tooltip" data-placement="top" title="Fecha de Facturación" style="width:165px">
                            </div>
                        </div>
                        <div class="form-group row" style="display:none">
                            <label for="inputCliente" class="col-sm-1 col-form-label-md">Vendedor <span class="priority">*<span /></label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" placeholder="Vendedor" id="colaborador_id" name="colaborador_id" aria-label="Colaborador" aria-describedby="basic-addon2" readonly required>
                                    <input type="text" class="form-control" placeholder="Vendedor" id="colaborador" name="colaborador" aria-label="Colaborador" aria-describedby="basic-addon2" required readonly data-toggle="tooltip" data-placement="top" title="Vendedor">
                                    <div class="input-group-append" id="grupo_buscar_colaboradores">
                                        <span data-toggle="tooltip" data-placement="top" title="Búsqueda de Colaboradores"><a data-toggle="modal" href="#" class="btn btn-outline-success" id="buscar_colaboradores">
                                            <div class="sb-nav-link-icon"></div><i class="fas fa-search-plus fa-lg"></i>
                                        </a><span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row table-responsive-xl table table-hover">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table id="invoiceItem" class="table-header-pro table-footer-pro">
                                    <thead class="text-align: center">
                                        <tr>
                                            <th width="2%" scope="col"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                            <th width="17.28%">Código</th>
                                            <th width="24.28%">Descripción del Producto</th>
                                            <th width="10.28%">Cantidad</th>
                                            <th width="10.28%">Medida</th>
                                            <th width="11.28%">Precio</th>
                                            <th width="11.28%">Descuento</th>
                                            <th width="11.28%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class="itemRow" type="checkbox"></td>
                                            <td>
                                                <input type="hidden" name="referenciaProducto[]" id="referenciaProducto_0" class="form-control inputfield-details1" placeholder="Referencia Producto Precio" autocomplete="off">
                                                <input type="hidden" name="isv[]" id="isv_0" class="form-control inputfield-details1" placeholder="Producto ISV" autocomplete="off">

                                                <!-- ISV1 (15% u otro valor que venga como ISV id=1) -->
                                                <input type="hidden" name="valor_isv[]" id="valor_isv_0" class="form-control inputfield-details1" placeholder="Valor ISV (id=1)" autocomplete="off">

                                                <!-- NUEVO: ISV2 (18% u otro valor que venga como ISV id=2) -->
                                                <input type="hidden" name="valor_isv1[]" id="valor_isv1_0" class="form-control inputfield-details1" placeholder="Valor ISV2 (id=2)" autocomplete="off">

                                                <!-- ¿qué ISV aplica a ESTA fila? 1/0 -->
                                                <input type="hidden" name="isv1_flag[]" id="isv1_flag_0" value="0">  <!-- 1 => usa ISV id=1 (15%) -->
                                                <input type="hidden" name="isv2_flag[]" id="isv2_flag_0" value="0">  <!-- 1 => usa ISV id=2 (18%) -->

                                                <input type="hidden" name="facturas_detalle_id[]" id="facturas_detalle_id_0" class="form-control" placeholder="Código Producto" autocomplete="off">
                                                <input type="hidden" name="productos_id[]" id="productos_id_0" class="form-control inputfield-details1" placeholder="Código del Producto" autocomplete="off">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <button type="button" data-toggle="modal" 
                                                                class="btn btn-link buscar_productos p-0"
                                                                data-toggle="tooltip" data-placement="top" 
                                                                title="Búsqueda de Productos"
                                                                id="icon-search-bar_0">
                                                            <i class="fas fa-search icon-color" style="font-size: 0.875rem;"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="bar-code-id[]" id="bar-code-id_0" class="form-control product-bar-code inputfield-details1" placeholder="Código del Producto" autocomplete="off">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="productName[]" id="productName_0" placeholder="Descripción del Producto" readonly class="form-control inputfield-details1" autocomplete="off">
                                                <span id="productName_text_0" class="product-description">Descripción del Producto</span>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" id="quantity_0" placeholder="Cantidad" class="buscar_cantidad form-control inputfield-details" autocomplete="off" step="0.01">
                                                <input type="hidden" name="cantidad_mayoreo[]" id="cantidad_mayoreo_0" placeholder="Cantidad Mayoreo" class="buscar_cantidad form-control inputfield-details" autocomplete="off" step="0.01">
                                            </td>
                                            <td>
                                                <input type="hidden" name="medida[]" id="medida_0" readonly class="form-control buscar_medida" autocomplete="off" placeholder="Medida">
                                                <span id="medida_text_0" class="medida-description">Medida</span>
                                                <input type="hidden" name="bodega[]" id="bodega_0" readonly class="form-control buscar_bodega" autocomplete="off">
                                            </td>
                                            <td>
                                                <input type="hidden" name="precio_real[]" id="precio_real_0" placeholder="Precio Real" class="form-control inputfield-details" step="0.01" readonly autocomplete="off">
                                                <div class="input-group mb-3">
                                                    <input type="number" name="price[]" id="price_0" class="form-control" step="0.01" placeholder="Precio" readonly autocomplete="off">
                                                    <div id="suggestions_producto_0" class="suggestions"></div>
                                                    <div class="input-group-append">
                                                        <a data-toggle="modal" href="#" class="btn btn-outline-success">
                                                            <div class="sb-nav-link-icon"></div><i class="aplicar_precio fas fa-plus fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="precio_mayoreo[]" id="precio_mayoreo_0" placeholder="Precio mayoreo" step="0.01" class="form-control inputfield-details" readonly autocomplete="off">
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <input type="number" name="discount[]" id="discount_0" class="form-control" step="0.01" placeholder="Descuento" readonly autocomplete="off">
                                                    <div id="suggestions_producto_0" class="suggestions"></div>
                                                    <div class="input-group-append">
                                                        <a data-toggle="modal" href="#" class="btn btn-outline-success">
                                                            <div class="sb-nav-link-icon"></div><i class="aplicar_descuento fas fa-plus fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><input type="number" name="total[]" id="total_0" placeholder="Total" class="form-control total inputfield-details" step="0.01" readonly autocomplete="off"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <hr class="line_table" />
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                <!-- Agregar fila -->
                                <button
                                    class="btn btn-secondary ml-3 bill-bottom-add"
                                    id="addRows"
                                    type="button"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-html="true"
                                    title="<strong>Agregar línea</strong><br>Inserta una nueva fila en el detalle de la factura.<br>Puedes añadir productos/servicios y editar <u>cantidad</u>, <u>precio</u> y <u>descuento</u>."
                                    >
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-plus fa-lg"></i> Agregar
                                </button>

                                <!-- Quitar fila -->
                                <button
                                    class="btn btn-secondary delete bill-bottom-remove"
                                    id="removeRows"
                                    type="button"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-html="true"
                                    title="<strong>Quitar línea</strong><br>Elimina la(s) fila(s) seleccionada(s) del detalle.<br>No afecta inventario hasta emitir la factura."
                                    >
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-minus fa-lg"></i> Quitar
                                </button>

                                <!-- Convertir cotización en factura -->
                                <?php if ($_SESSION['planes_id_sistema'] != 1): ?>
                                    <button
                                        class="btn btn-secondary bill-bottom-remove cotizacion"
                                        id="addQuotetoBill"
                                        type="button"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Convertir cotización</strong><br>Carga una cotización como factura.<br>Trae cliente, productos, precios y descuentos.<br>Revisa existencias y autorizaciones de elio SAR antes de emitir."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-file-invoice-dollar fa-lg"></i> Cotizaciones
                                    </button>

                                    <!-- Factura recurrente -->
                                    <button
                                        class="btn btn-secondary bill-bottom-remove"
                                        id="addRecurringBill"
                                        type="button"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Factura recurrente</strong><br>Programa esta venta para generarse automáticamente.<br>Define <u>frecuencia</u>, <u>fecha inicial</u> y <u>fin</u>.<br>Opcional: envío por correo al generarse."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-redo-alt fa-lg"></i> Recurrente
                                    </button>

                                    <!-- Cuentas por cobrar (CxC) -->
                                    <button
                                        class="btn btn-secondary bill-bottom-remove cobrarClientes"
                                        id="addPayCustomers"
                                        type="button"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-html="true"
                                        title="<strong>Cuentas por cobrar (CxC)</strong><br>Registra abonos/pagos de clientes.<br>Permite <u>pagos parciales</u> y <u>múltiples formas de pago</u>.<br>Puedes emitir comprobante."
                                        >
                                        <div class="sb-nav-link-icon"></div>
                                        <i class="fas fa-hand-holding-usd fa-lg"></i> CxC
                                    </button>                                    
                                <?php endif; ?>                                 

                                <!-- Borradores -->
                                <button
                                    class="btn btn-secondary bill-bottom-remove"
                                    id="addDraft"
                                    type="button"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-html="true"
                                    title="<strong>Facturas pendientes</strong><br>Lista de facturas guardadas como <u>borrador</u>.<br>Puedes reanudar, editar o emitir (asignar autorizaciones de el SAR)."
                                    >
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-file-invoice fa-lg"></i> Pendientes
                                </button>

                                <!-- Historial de facturas -->
                                <button
                                    class="btn btn-secondary bill-bottom-remove"
                                    id="BillReports"
                                    type="button"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-html="true"
                                    title="<strong>Facturas</strong><br>Consulta el historial de facturas emitidas/guardadas.<br>Filtra por fecha, cliente o estado; reimprime, envía por correo y exporta."
                                    >
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-file-invoice fa-lg"></i> Facturas
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="col-sm-12 col-md-12">
                                    <h3>Notas: </h3>
                                    <div class="form-group">
                                        <textarea class="form-control txt" rows="3" name="notesBill" id="notesBill" placeholder="Notas" maxlength="2000"></textarea>
                                        <p id="charNum_notasQuote">2000 Caracteres</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group row">
                                        <div class="card-body">
                                            <div class="form-group mx-sm-3 mb-1">
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <div class="sb-nav-link-icon"></div>Fecha Cambio Dolar
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control" id="fecha_dolar" name="fecha_dolar" value="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>Importe:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-append mb-1">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control" name="subTotalImporte" id="subTotalImporte" readonly placeholder="Importe">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>Descuento:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-append mb-1">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control" name="taxDescuento" id="taxDescuento" readonly placeholder="Descuento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>Subtotal:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-append mb-1">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control" name="subTotal" id="subTotal" readonly placeholder="Subtotal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>ISV 15%:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" readonly placeholder="Impuesto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>ISV 18%:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control" name="taxAmount18" id="taxAmount18" readonly placeholder="Impuesto">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>Total:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" readonly placeholder="Total">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="RespuestaAjax"></div>

                    <!-- Campos ocultos para almacenar datos de exoneración -->
                    <input type="hidden" id="exoneracion_orden" name="exoneracion_orden">
                    <input type="hidden" id="exoneracion_constancia" name="exoneracion_constancia">
                    <input type="hidden" id="exoneracion_sag" name="exoneracion_sag">
                    <input type="hidden" id="exoneracion_orden_interno" name="exoneracion_orden_interno">                    
                </form>
            </div>
            <div class="card-footer small text-muted">
                <?php
                    require_once './core/mainModel.php';
                    $insMainModel = new mainModel();
                    $entidad = 'facturas';

                    if ($insMainModel->getlastUpdate($entidad)->num_rows > 0) {
                        $consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
                        $fecha_registro = htmlspecialchars($consulta_last_update['fecha_registro'], ENT_QUOTES, 'UTF-8');
                        $hora = htmlspecialchars(date('g:i:s a', strtotime($fecha_registro)), ENT_QUOTES, 'UTF-8');
                        echo 'Última Actualización ' . htmlspecialchars($insMainModel->getTheDay($fecha_registro, $hora), ENT_QUOTES, 'UTF-8');
                    } else {
                        echo 'No se encontraron registros ';
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal para datos de exoneración -->
    <div class="modal fade" id="exoneracionModal" tabindex="-1" role="dialog" aria-labelledby="exoneracionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="exoneracionModalLabel">Datos de Exoneración</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="modal_exoneracion_orden">No. Orden</label>
                            <input type="text" class="form-control" id="modal_exoneracion_orden" placeholder="Número de Orden">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modal_exoneracion_constancia">Constancia</label>
                            <input type="text" class="form-control" id="modal_exoneracion_constancia" placeholder="Constancia">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="modal_exoneracion_sag">Identificativo SAG</label>
                            <input type="text" class="form-control" id="modal_exoneracion_sag" placeholder="Identificativo SAG">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modal_exoneracion_orden_interno">Número de orden interno</label>
                            <input type="text" class="form-control" id="modal_exoneracion_orden_interno" placeholder="Número de orden interno">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">
                        <i class="fas fa-times fa-lg mr-1"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" id="guardar_exoneracion"><i class="far fa-save fa-lg mr-1"></i> Guardar datos</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE CONFIRMACIÓN PARA CAMBIAR A CRÉDITO -->
    <div class="modal fade" id="confirmTipoFactura" tabindex="-1" role="dialog" aria-labelledby="confirmTipoFacturaLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header py-2">
            <h6 class="modal-title" id="confirmTipoFacturaLabel">Cambiar a Crédito</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Vas a cambiar el <b>Tipo de Factura</b> a <b>Crédito</b>. Esto generará una <b>cuenta por cobrar</b> al cliente.
            <br>¿Deseas continuar?
          </div>
          <div class="modal-footer py-2">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary btn-sm" id="confirmarCambioTipo">Sí, cambiar</button>
          </div>
        </div>
      </div>
    </div>    

<?php
// FASE 3: Nota de Crédito compartida. Luego Restaurante puede reutilizar estos mismos archivos.
require_once './vistas/contenido/modals/notaCredito-modals.php';
require_once __DIR__ . '/../../ajax/js/notaCredito.php';
?>

</body>

<?php
require_once './core/mainModel.php';
$insMainModel = new mainModel();
$insMainModel->guardar_historial_accesos('Ingreso al modulo Facturas');
?>