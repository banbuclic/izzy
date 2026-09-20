<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/cotizacion_modales.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plantilla/css/cotizacion-ui-2026.css">
<body id="view_quote">
    <div class="container-fluid">
        <div class="card mb-4 cotizacion-workspace-card">
            <div class="card-header cotizacion-workspace-header">
                <i class="fas fa-file-invoice-dollar fa-lg mr-1"></i>
                Cotización
            </div>
            <div class="card-body cotizacion-workspace-body">
                <form class="FormularioAjax" id="quoteForm" action="<?php echo htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8');?>ajax/addCotizacionAjax.php"
                    method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    <div class="cotizacion-context-grid">
                    <div class="form-group row customer-bill-box-left">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="bill-header-row">
                                <span id="rtn-customers-quote"></span>
                                <span id="client-customers-quote"></span>
                            </div>
                            <div class="bill-row"> <!-- Si necesitas otra fila para Vendedor -->
                                <span id="vendedor-customers-quote"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row customer-bill-box-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <span id="fecha-customers-quote"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <span id="hora-customers-quote"></span>
                        </div>
                    </div>
                    </div>
                    <div class="bill cotizacion-operacion">
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cotizacion-primary-toolbar">
                                <button class="btn btn-secondary" type="submit" id="help_factura" form="quoteForm"
                                    data-toggle="tooltip" data-placement="top" title="Ayuda">
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-question-circle fa-lg"></i>
                                    [F1] Ayuda
                                </button>
                                <button class="btn btn-secondary" type="submit" id="reg_cotizacion" form="quoteForm"
                                    data-toggle="tooltip" data-placement="top" title="Ingresar">
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-hand-holding-usd fa-lg"></i>
                                    [F6] Registrar
                                </button>
                                <button class="btn btn-secondary" type="submit" id="add_cliente" form="quoteForm"
                                    data-toggle="tooltip" data-placement="top" title="Agregar Cliente">
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-user-plus fa-lg"></i> [F7]
                                    Cliente
                                </button>
                                <button class="btn btn-secondary" type="submit" id="add_vendedor" form="quoteForm"
                                    data-toggle="tooltip" data-placement="top" title="Agregar Vendeor o Empleado">
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-plus-circle fa-lg"></i> [F8]
                                    Vendedor
                                </button>
                            </div>
                        </div>
                        <div class="form-group row" style="display:none">
                            <label for="inputCliente" class="col-sm-1 col-form-label-md">Cliente <span
                                    class="priority">*<span /></label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" placeholder="Proceso" id="proceso_quote"
                                        name="proceso_quote" readonly>
                                    <input type="hidden" class="form-control" placeholder="Cotización"
                                        id="cotizacion_id" name="cotizacion_id" readonly>
                                    <input type="hidden" class="form-control" placeholder="Cliente" id="cliente_id"
                                        name="cliente_id" readonly required>
                                    <input type="text" class="form-control" placeholder="Cliente" id="cliente"
                                        name="cliente" required readonly data-toggle="tooltip" data-placement="top"
                                        title="Cliente">
                                    <div class="input-group-append" id="grupo_buscar_colaboradores">
                                        <span data-toggle="tooltip" data-placement="top"
                                            title="Búsqueda de Empleados"><a data-toggle="modal" href="#"
                                                class="btn btn-outline-success" id="buscar_clientes">
                                                <div class="sb-nav-link-icon"></div><i
                                                    class="fas fa-search-plus fa-lg"></i>
                                            </a></span>
                                    </div>
                                </div>
                            </div>
                            <label for="inputFecha" class="col-sm-1 col-form-label-md">Fecha <span
                                    class="priority">*<span /></label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required
                                    id="fecha" name="fecha" data-toggle="tooltip" data-placement="top"
                                    title="Fecha de Facturación" style="width:165px">
                            </div>
                        </div>
                        <div class="form-group row" style="display:none">
                            <label for="inputCliente" class="col-sm-1 col-form-label-md">Vendedor <span
                                    class="priority">*<span /></label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" placeholder="Vendedor" id="colaborador_id"
                                        name="colaborador_id" aria-label="Colaborador" aria-describedby="basic-addon2"
                                        readonly required>
                                    <input type="text" class="form-control" placeholder="Vendedor" id="colaborador"
                                        name="colaborador" aria-label="Colaborador" aria-describedby="basic-addon2"
                                        required readonly data-toggle="tooltip" data-placement="top" title="Vendedor">
                                    <div class="input-group-append" id="grupo_buscar_colaboradores">
                                        <span data-toggle="tooltip" data-placement="top"
                                            title="Búsqueda de Colaboradores"><a data-toggle="modal" href="#"
                                                class="btn btn-outline-success" id="buscar_colaboradores">
                                                <div class="sb-nav-link-icon"></div><i
                                                    class="fas fa-search-plus fa-lg"></i>
                                            </a><span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row table-responsive-xl table table-hover">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table id="QuoteItem" class="table-header-pro table-footer-pro">
                                    <thead class="text-align: center">
                                        <tr>
                                            <th width="2%" scope="col"><input id="checkAllQuote" class="formcontrol"
                                                    type="checkbox"></th>
                                            <th width="17.28%">Código</th>
                                            <th width="24.28%">Descripción del Producto</th>
                                            <th width="10.28%">Cantidad</th>
                                            <th width="11.28%">Precio</th>
                                            <th width="11.28%">Descuento</th>
                                            <th width="11.28%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class="itemRowQuote" type="checkbox"></td>
                                            <td>
                                                <input type="hidden" name="referenciaProductoQuote[]"
                                                    id="referenciaProductoQuote_0"
                                                    class="form-control inputfield-details1"
                                                    placeholder="Referencia Producto Precio" autocomplete="off">
                                                <input type="hidden" name="isvQuote[]" id="isvQuote_0"
                                                    class="form-control inputfield-details1" placeholder="Producto ISV"
                                                    autocomplete="off">

                                                <!-- ISV1 (15% u otro valor que venga como ISV id=1) -->
                                                <input type="hidden" name="valorQuote_isv[]" id="valorQuote_isv_0" class="form-control inputfield-details1" placeholder="Valor ISV (id=1)" autocomplete="off">

                                                <!-- NUEVO: ISV2 (18% u otro valor que venga como ISV id=2) -->
                                                <input type="hidden" name="valorQuote_isv1[]" id="valorQuote_isv1_0" class="form-control inputfield-details1" placeholder="Valor ISV2 (id=2)" autocomplete="off">

                                                <!-- ¿qué ISV aplica a ESTA fila? 1/0 -->
                                                <input type="hidden" name="isv1_flagQuote[]" id="isv1_flagQuote_0" value="0">  <!-- 1 => usa ISV id=1 (15%) -->
                                                <input type="hidden" name="isv2_flagQuote[]" id="isv2_flagQuote_0" value="0">  <!-- 1 => usa ISV id=2 (18%) -->

                                                <input type="hidden" name="productosQuote_id[]" id="productosQuote_id_0"
                                                    class="form-control inputfield-details1"
                                                    placeholder="Código del Producto" autocomplete="off">
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <button type="button" data-toggle="modal" 
                                                                class="btn btn-link buscar_productos_quote p-0"
                                                                data-toggle="tooltip" data-placement="top" 
                                                                title="Búsqueda de Productos"
                                                                id="icon-search-bar_0">
                                                            <i class="fas fa-search icon-color" style="font-size: 0.875rem;"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="bar-code-id[]" id="bar-code-id_0"
                                                        class="form-control product-bar-code inputfield-details1"
                                                        placeholder="Código del Producto" autocomplete="off">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="productNameQuote[]" id="productNameQuote_0" placeholder="Descripción del Producto" readonly
                                                    class="form-control inputfield-details1" autocomplete="off">
                                                <span id="productNameQuote_text_0" class="product-description">Descripción del Producto</span>
                                            </td>
                                            <td>
                                                <input type="number" name="quantityQuote[]" id="quantityQuote_0"
                                                    placeholder="Cantidad"
                                                    class="buscar_cantidad form-control inputfield-details"
                                                    autocomplete="off" step="0.01">
                                                <input type="hidden" name="cantidad_mayoreoQuote[]"
                                                    id="cantidad_mayoreoQuote_0" placeholder="Cantidad Mayoreo"
                                                    class="buscar_cantidad form-control inputfield-details"
                                                    autocomplete="off" step="0.01">
                                            </td>
                                            <td>
                                                <input type="hidden" name="precio_realQuote[]" id="precio_realQuote_0"
                                                    placeholder="Precio Real" class="form-control inputfield-details"
                                                    readonly autocomplete="off" step="0.01">
                                                <div class="input-group mb-3">
                                                    <input type="number" name="priceQuote[]" id="priceQuote_0"
                                                        class="form-control" step="0.01" placeholder="Precio" readonly
                                                        autocomplete="off">
                                                    <div id="suggestions_producto_0" class="suggestions"></div>
                                                    <div class="input-group-append">
                                                        <a data-toggle="modal" href="#" class="btn btn-outline-success">
                                                            <div class="sb-nav-link-icon"></div><i
                                                                class="aplicar_precio_cotizacion fas fa-plus fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="precio_mayoreoQuote[]"
                                                    id="precio_mayoreoQuote_0" step="0.01" placeholder="Precio mayoreo"
                                                    class="form-control inputfield-details" readonly autocomplete="off">
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <input type="number" name="discountQuote[]" id="discountQuote_0" class="form-control" step="0.01" placeholder="Descuento"
                                                        readonly autocomplete="off">
                                                    <div id="suggestions_producto_0" class="suggestions"></div>
                                                    <div class="input-group-append">
                                                        <a data-toggle="modal" href="#" class="btn btn-outline-success">
                                                            <div class="sb-nav-link-icon"></div><i
                                                                class="aplicar_descuento_cotizacion fas fa-plus fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><input type="number" name="totalQuote[]" id="totalQuote_0"
                                                    placeholder="Total" class="form-control total inputfield-details"
                                                    step="0.01" readonly autocomplete="off"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="line_table" />
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <button class="btn btn-secondary ml-3 bill-bottom-add" id="addRowsQuote" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Agregar filas en la factura">
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-plus"></i> Agregar
                                </button>
                                <button class="btn btn-secondary delete bill-bottom-remove" id="removeRowsQuote"
                                    type="button" data-toggle="tooltip" data-placement="top"
                                    title="Remover filas en la factura">
                                    <div class="sb-nav-link-icon"></div><i class="fas fa-minus"></i> Quitar
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="col-sm-12 col-md-12">
                                    <h3>Notas: </h3>
                                    <div class="form-group">
                                        <textarea class="form-control txt" rows="3" name="notesQuote" id="notesQuote"
                                            placeholder="Notas" maxlength="2000"></textarea>
                                        <p id="charNum_notasQuote">2000 Caracteres</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="card-body">
                                        <div class="form-group mx-sm-3 mb-1">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>Vigencia Cotización
                                                    </span>
                                                </div>
                                                <select id="vigencia_quote" name="vigencia_quote" class="custom-select"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Vigencia Cotización">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="card-body">
                                        <div class="form-group mx-sm-3 mb-1">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>Fecha Cambio Dolar
                                                    </span>
                                                </div>
                                                <input type="date" class="form-control" id="fecha_dolar"
                                                    name="fecha_dolar" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label data-toggle="tooltip" data-placement="top"
                                                title="Valor antes del Descuento">Importe:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-append mb-1">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control"
                                                    name="subTotalImporteQuote" id="subTotalImporteQuote" readonly
                                                    placeholder="Importe ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 form-inline">
                                            <label>Descuento:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <div class="sb-nav-link-icon"></div>L</i>
                                                    </span>
                                                </div>
                                                <input value="" type="number" class="form-control"
                                                    name="taxDescuentoQuote" id="taxDescuentoQuote" readonly
                                                    placeholder="Descuento">
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
                                                <input value="" type="number" class="form-control" name="subTotalQuote"
                                                    id="subTotalQuote" readonly placeholder="Subtotal">
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
                                                <input value="" type="number" class="form-control" name="taxAmountQuote"
                                                    id="taxAmountQuote" readonly placeholder="Impuesto">
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
                                                <input value="" type="number" class="form-control" name="taxAmountQuote18"
                                                    id="taxAmountQuote18" readonly placeholder="Impuesto">
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
                                                <input value="" type="number" class="form-control"
                                                    name="totalAftertaxQuote" id="totalAftertaxQuote" readonly
                                                    placeholder="Total">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="RespuestaAjax"></div>
                </form>
            </div>
            <div class="card-footer small text-muted">
                <?php
					require_once "./core/mainModel.php";
					
					$insMainModel = new mainModel();
					$entidad = "cotizacion";
					
					if($insMainModel->getlastUpdate($entidad)->num_rows > 0){
						$consulta_last_update = $insMainModel->getlastUpdate($entidad)->fetch_assoc();
						$fecha_registro = htmlspecialchars($consulta_last_update['fecha_registro'], ENT_QUOTES, 'UTF-8');
						$hora = htmlspecialchars(date('g:i:s a', strtotime($fecha_registro)), ENT_QUOTES, 'UTF-8');
						echo "Última Actualización ".htmlspecialchars($insMainModel->getTheDay($fecha_registro, $hora), ENT_QUOTES, 'UTF-8');
					} else {
						echo "No se encontraron registros ";
					}				
				?>
            </div>
        </div>
    </div>
</body>

<?php
	require_once "./core/mainModel.php";
	
	$insMainModel = new mainModel();				
	$insMainModel->guardar_historial_accesos("Ingreso al modulo Facturas");
?>