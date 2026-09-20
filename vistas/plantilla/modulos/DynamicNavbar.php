<?php
// Menu navegación dinámico desde base de datos
class DynamicNavbar {
    private $conexion;
    
    public function __construct() {
        // Inicializa la conexión a la base de datos (ajusta según tu configuración)
        $this->conexion = $this->conectar();
    }
    
    private function conectar() {
        // Configura la conexión a la base de datos según tu entorno
        $servidor = SERVER;
        $usuario = USER;
        $clave = PASS;
        $base_datos = $GLOBALS['db']; // Usando la variable global de la base de datos
        
        $conexion = new mysqli($servidor, $usuario, $clave, $base_datos);
        
        // Verificar conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        
        $conexion->set_charset("utf8");
        return $conexion;
    }
    
    // Obtener los menús principales
    public function getMenus() {
        $menus = [];
        
        $query = "
            SELECT m.menu_id, m.name, m.icon, m.descripcion
            FROM plan p
            INNER JOIN menu_plan mp ON p.planes_id = mp.planes_id
            INNER JOIN menu m ON mp.menu_id = m.menu_id
            WHERE m.visible = 1
            ORDER BY m.orden ASC, m.menu_id ASC";
        
        $result = $this->conexion->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $menus[] = $row;
            }
        }
        
        return $menus;
    }

    // Obtener los submenús de nivel 1 para un menú específico
    public function getSubmenus($menu_id) {
        $submenus = [];
        
        $query = "
            SELECT sm.submenu_id, sm.name, sm.icon, sm.descripcion
            FROM plan p
            INNER JOIN submenu_plan sp ON p.planes_id = sp.planes_id
            INNER JOIN submenu sm ON sp.submenu_id = sm.submenu_id
            WHERE sm.visible = 1 
            AND sm.menu_id = ?
            ORDER BY sm.orden ASC, sm.submenu_id ASC";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $menu_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $submenus[] = $row;
            }
        }
        
        return $submenus;
    }

    // Obtener los submenús de nivel 2 para un submenú de nivel 1 específico
    public function getSubmenus1($submenu_id) {
        $submenus1 = [];
        
        $query = "
            SELECT sm1.submenu1_id, sm1.name, sm1.icon, sm1.descripcion
            FROM plan p
            INNER JOIN submenu1_plan sp1 ON p.planes_id = sp1.planes_id
            INNER JOIN submenu1 sm1 ON sp1.submenu1_id = sm1.submenu1_id
            WHERE sm1.visible = 1 
            AND sm1.submenu_id = ?
            ORDER BY sm1.orden ASC, sm1.submenu1_id ASC";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $submenu_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $submenus1[] = $row;
            }
        }
        
        return $submenus1;
    }
    
    // Determinar si el usuario actual tiene permisos para ver el menú
    private function tienePermiso($id, $tipo) {
        // Aquí puedes implementar la lógica para verificar permisos
        // Por ahora asumimos que todos tienen permiso
        return true;
    }
    
    /**
     * Orden visual preferido de IZZY.
     * Solo reordena la presentación; no modifica IDs, rutas ni permisos.
     */
    private function ordenarPorPrioridad(array $items, array $prioridades) {
        $posicionOriginal = [];
        foreach ($items as $index => $item) {
            $posicionOriginal[(string)$index] = $index;
            $items[$index]['__orden_original'] = $index;
        }

        usort($items, function ($a, $b) use ($prioridades) {
            $pa = $prioridades[$a['name']] ?? 900;
            $pb = $prioridades[$b['name']] ?? 900;

            if ($pa === $pb) {
                return ($a['__orden_original'] ?? 0) <=> ($b['__orden_original'] ?? 0);
            }

            return $pa <=> $pb;
        });

        foreach ($items as &$item) {
            unset($item['__orden_original']);
        }
        unset($item);

        return $items;
    }

    private function prioridadesMenu() {
        return [
            'dashboard' => 10,
            'ventas' => 20,
            'compras' => 30,
            'almacen' => 40,
            'contabilidad' => 50,
            'reportes' => 60,
            'recursosHumanos' => 70,
            'configuracion' => 80,
        ];
    }

    private function prioridadesSubmenu($menuName) {
        $map = [
            'ventas' => [
                'cajas' => 10,
                'facturas' => 20,
                'clientes' => 30,
                'cotizacion' => 40,
            ],
            'compras' => [
                'proveedores' => 10,
                'facturaCompras' => 20,
            ],
            'almacen' => [
                'productos' => 10,
                'inventario' => 20,
                'transferencia' => 30,
            ],
            'contabilidad' => [
                'ingresosContabilidad' => 10,
                'gastosContabilidad' => 20,
                'cuentasContabilidad' => 30,
                'movimientosContabilidad' => 40,
                'chequesContabilidad' => 50,
                'confBancos' => 60,
                'confTipoPago' => 70,
                'confImpuestos' => 80,
                'confCtaContabilidad' => 90,
            ],
            'reportes' => [
                'reporte_ventas' => 10,
                'reporte_compras' => 20,
                'reporte_historial' => 30,
            ],
            'recursosHumanos' => [
                'colaboradores' => 10,
                'contrato' => 20,
                'nomina' => 30,
                'asistencia' => 40,
            ],
            'configuracion' => [
                'empresa' => 10,
                'secuencia' => 20,
                'confAlmacen' => 30,
                'confUbicacion' => 40,
                'confMedida' => 50,
                'confCategoria' => 60,
                'confImpresora' => 70,
                'confEmail' => 80,
                'puestos' => 90,
                'users' => 100,
                'tipoUser' => 110,
                'privilegio' => 120,
            ],
        ];

        return $map[$menuName] ?? [];
    }

    private function prioridadesSubmenuNivel2($submenuName) {
        $map = [
            'reporte_ventas' => [
                'reporteVentas' => 10,
                'cobrarClientes' => 20,
                'reporteCotizacion' => 30,
            ],
            'reporte_compras' => [
                'reporteCompras' => 10,
                'pagarProveedores' => 20,
            ],
            'reporte_historial' => [
                'historialAccesos' => 10,
                'bitacora' => 20,
            ],
        ];

        return $map[$submenuName] ?? [];
    }

    // Generar el HTML del navbar dinámicamente
    public function generarNavbar() {
        $html = '<nav class="sb-sidenav accordion bg-color-navarlateral nav-loading" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">';

        
        // Obtener todos los menús principales
        $menus = $this->ordenarPorPrioridad($this->getMenus(), $this->prioridadesMenu());
        
        foreach ($menus as $menu) {
            $menu_id = $menu['menu_id'];
            $menu_name = $menu['name'];
            $menu_descripcion = $menu['descripcion'];
            $menu_icon = $menu['icon'];
            $display = $this->tienePermiso($menu_id, 'menu') ? '' : 'style="display:none"';
            
            // Obtener los submenús de nivel 1 para este menú
            $submenus = $this->ordenarPorPrioridad(
                $this->getSubmenus($menu_id),
                $this->prioridadesSubmenu($menu_name)
            );
            
            // Si no hay submenús, es un enlace directo
            if (empty($submenus)) {
                $html .= '
                <a class="nav-link link" href="' . htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8') . $menu_name . '/" id="' . $menu_name . '" ' . $display . '>
                    <div class="sb-nav-link-icon"><i class="' . $menu_icon . '"></i></div>
                    <span class="menu-text">' . $menu_descripcion . '</span>
                </a>';
            } else {
                // Si tiene submenús, es un menú desplegable
                $html .= '
                <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#collapse' . ucfirst($menu_name) . '"
                    aria-expanded="false" aria-controls="collapse' . ucfirst($menu_name) . '" id="' . $menu_name . '" ' . $display . '>
                    <div class="sb-nav-link-icon"><i class="' . $menu_icon . '"></i></div>
                    <span class="menu-text">' . ucfirst($menu_descripcion) . '</span>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse' . ucfirst($menu_name) . '" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav' . ($menu_name == 'reportes' ? ' accordion" id="sidenavAccordionPages"' : '"') . '>';
                
                foreach ($submenus as $submenu) {
                    $submenu_id = $submenu['submenu_id'];
                    $submenu_name = $submenu['name'];
                    $submenu_descripcion = $submenu['descripcion'];
                    $submenu_icon = $submenu['icon'];
                    $submenu_display = $this->tienePermiso($submenu_id, 'submenu') ? '' : 'style="display:none"';
                    
                    // Obtener los submenús de nivel 2 para este submenú
                    $submenus1 = $this->ordenarPorPrioridad(
                        $this->getSubmenus1($submenu_id),
                        $this->prioridadesSubmenuNivel2($submenu_name)
                    );
                    
                    // Si no hay submenús de nivel 2, es un enlace directo
                    if (empty($submenus1)) {
                        $html .= '
                        <a class="nav-link link" href="' . htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8') . $submenu_name . '/" id="' . $submenu_name . '" ' . $submenu_display . '>
                            <div class="sb-nav-link-icon"><i class="' . $submenu_icon . '"></i></div><span class="menu-text">' . ucfirst(str_replace('_', ' ', $submenu_descripcion)) . '</span>
                        </a>';
                    } else {
                        // Si tiene submenús de nivel 2, es un menú desplegable
                        $html .= '
                        <a class="nav-link collapsed link" href="#" data-toggle="collapse" data-target="#' . $submenu_name . 'Collapse"
                            aria-expanded="false" aria-controls="' . $submenu_name . 'Collapse" id="' . $submenu_name . '" ' . $submenu_display . '>
                            <div class="sb-nav-link-icon"><i class="' . $submenu_icon . '"></i></div>
                            <span class="menu-text">' . ucfirst(str_replace('_', ' ', $submenu_descripcion)) . '</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down fa-lg"></i></div>
                        </a>
                        <div class="collapse" id="' . $submenu_name . 'Collapse" aria-labelledby="headingOne"
                            data-parent="' . ($menu_name == 'reportes' ? '#sidenavAccordionPages' : '#sidenavAccordion') . '">
                            <nav class="sb-sidenav-menu-nested nav">';
                        
                        foreach ($submenus1 as $submenu1) {
                            $submenu1_id = $submenu1['submenu1_id'];
                            $submenu1_name = $submenu1['name'];
                            $submenu1_descripcion = $submenu1['descripcion'];
                            $submenu1_icon = $submenu1['icon'];
                            $submenu1_display = $this->tienePermiso($submenu1_id, 'submenu1') ? '' : 'style="display:none"';
                            
                            $html .= '
                            <a class="nav-link link" href="' . htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8') . $submenu1_name . '/" id="' . $submenu1_name . '" ' . $submenu1_display . '>
                                <div class="sb-nav-link-icon"><i class="' . $submenu1_icon . '"></i></div><span class="menu-text">' . ucfirst(str_replace('_', ' ', $submenu1_descripcion)) . '</span>
                            </a>';
                        }
                        
                        $html .= '
                            </nav>
                        </div>';
                    }
                }
                
                $html .= '
                    </nav>
                </div>';
            }
        }
        
        $prefixes = DB_PREFIX . "_";
        $nombre_db_final = str_replace($prefixes, "", $GLOBALS['db']);
        
        // Variables para WhatsApp
        $telefono_ws = "50489136844";
        $mensaje_ws = "Hola ES MULTISERVICIOS, nos gustaría que nos puedan brindar asistencia técnica, muchas gracias.";
        $title = "ES MULTISERVICIOS";
        
        // Codificar mensaje para URL
        $mensaje_codificado = urlencode($mensaje_ws);
        
        // Construir URL de WhatsApp
        $url_ws = "https://api.whatsapp.com/send?phone={$telefono_ws}&text={$mensaje_codificado}";
        
        $html .= '
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="db-badge">
                <i class="fas fa-database db-icon"></i>
                <div class="db-info">
                    <span class="db-label">Base de Datos:</span>
                    <span class="db-name">' . htmlspecialchars($nombre_db_final, ENT_QUOTES, 'UTF-8') . '</span>
                </div>
            </div>
        </div>
        
        <a href="' . $url_ws . '" class="float-ws" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$title.'">
           <i class="fab fa-whatsapp my-float-ws"></i>
        </a>
        </nav>';        
        
        return $html;
    }
}