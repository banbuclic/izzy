<?php
if (!function_exists('izzyTablerIcon')) {
    function izzyTablerIcon(string $name, string $extraClass = ''): string {
        $safeName = preg_replace('/[^a-z0-9\-]/i', '', $name);
        $safeClass = trim(preg_replace('/[^a-z0-9_\-\s]/i', '', $extraClass));
        $classAttr = 'ti-svg' . ($safeClass !== '' ? ' ' . $safeClass : '');
        $sprite = htmlspecialchars(SERVERURL, ENT_QUOTES, 'UTF-8') . 'vistas/plantilla/icons/tabler-dashboard-sprite.svg';
        return '<svg class="' . htmlspecialchars($classAttr, ENT_QUOTES, 'UTF-8') . '" aria-hidden="true" focusable="false"><use href="' . $sprite . '#ti-' . htmlspecialchars($safeName, ENT_QUOTES, 'UTF-8') . '"></use></svg>';
    }
}
