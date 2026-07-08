// =========================================================================
// PARTE 2: GESTIÓN DE FACTURACIÓN
// =========================================================================

// Ejercicio 4: Historial General de Facturas de Clientes
Route::get('/facturas/clientes/historial', function () {
    $facturas = [
        (object) ['num_factura' => 'F-001', 'cliente' => 'Juan Pérez', 'fecha_emision' => '2026-07-01', 'total_pagar' => 150.50, 'estado' => 'Pagada'],
        (object) ['num_factura' => 'F-002', 'cliente' => 'Ana Gómez', 'fecha_emision' => '2026-07-05', 'total_pagar' => 320.00, 'estado' => 'Pendiente'],
        (object) ['num_factura' => 'F-003', 'cliente' => 'Carlos López', 'fecha_emision' => '2026-07-08', 'total_pagar' => 45.25, 'estado' => 'Pagada'],
    ];

    $html = '<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;">
                <tr>
                    <th>Número de Factura</th>
                    <th>Cliente</th>
                    <th>Fecha de Emisión</th>
                    <th>Total a Pagar</th>
                    <th>Estado</th>
                </tr>';

    foreach ($facturas as $factura) {
        // Validación del estado Pendiente
        $estadoStr = $factura->estado;
        if ($estadoStr === 'Pendiente') {
            $estadoStr = '<strong style="color: red;">⚠️ PENDIENTE DE COBRO</strong>';
        }

        $html .= "<tr>
                    <td>{$factura->num_factura}</td>
                    <td>{$factura->cliente}</td>
                    <td>{$factura->fecha_emision}</td>
                    <td>\${$factura->total_pagar}</td>
                    <td>{$estadoStr}</td>
                  </tr>";
    }

    $html .= '</table>';
    echo $html;
});

// Ejercicio 5: Detalle de Factura de Cliente Específica
Route::get('/facturas/clientes/detalle/{numero}', function ($numero) {
    $facturas = [
        (object) ['num_factura' => 'F-001', 'cliente' => 'Juan Pérez', 'fecha_emision' => '2026-07-01', 'total_pagar' => 150.50, 'estado' => 'Pagada'],
        (object) ['num_factura' => 'F-002', 'cliente' => 'Ana Gómez', 'fecha_emision' => '2026-07-05', 'total_pagar' => 320.00, 'estado' => 'Pendiente'],
        (object) ['num_factura' => 'F-003', 'cliente' => 'Carlos López', 'fecha_emision' => '2026-07-08', 'total_pagar' => 45.25, 'estado' => 'Pagada'],
    ];

    $facturaEncontrada = null;
    foreach ($facturas as $factura) {
        if ($factura->num_factura === $numero) {
            $facturaEncontrada = $factura;
            break; // Si la encontramos, salimos del ciclo
        }
    }

    // Renderizado con condicional
    if ($facturaEncontrada) {
        $html = "
            <div style='border: 1px solid #000; padding: 20px; width: 350px; background-color: #f9f9f9;'>
                <h2>Ficha de Factura</h2>
                <ul>
                    <li><strong>Número:</strong> {$facturaEncontrada->num_factura}</li>
                    <li><strong>Cliente:</strong> {$facturaEncontrada->cliente}</li>
                    <li><strong>Fecha de Emisión:</strong> {$facturaEncontrada->fecha_emision}</li>
                    <li><strong>Total a Pagar:</strong> \${$facturaEncontrada->total_pagar}</li>
                    <li><strong>Estado:</strong> {$facturaEncontrada->estado}</li>
                </ul>
            </div>
        ";
    } else {
        $html = "<h1 style='color: red;'>Factura No Encontrada</h1>";
    }

    echo $html;
});

// Ejercicio 6: Libro de Facturas de Proveedores (Cálculo de Totales)
Route::get('/facturas/proveedores/resumen', function () {
    $proveedores = [
        (object) ['proveedor' => 'Bayer', 'nrc' => '123456-7', 'monto_sin_iva' => 1000.00],
        (object) ['proveedor' => 'Pfizer', 'nrc' => '765432-1', 'monto_sin_iva' => 2500.00],
        (object) ['proveedor' => 'MK', 'nrc' => '112233-4', 'monto_sin_iva' => 500.00],
    ];

    $html = '<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;">
                <tr>
                    <th>Proveedor</th>
                    <th>NRC</th>
                    <th>Monto Sin IVA</th>
                    <th>IVA (13%)</th>
                    <th>Monto Total</th>
                </tr>';

    $sumaTotalAcumulada = 0;

    foreach ($proveedores as $prov) {
        $iva = $prov->monto_sin_iva * 0.13;
        $totalFila = $prov->monto_sin_iva + $iva;
        
        $sumaTotalAcumulada += $totalFila;

        $html .= "<tr>
                    <td>{$prov->proveedor}</td>
                    <td>{$prov->nrc}</td>
                    <td>\${$prov->monto_sin_iva}</td>
                    <td>\${$iva}</td>
                    <td>\${$totalFila}</td>
                  </tr>";
    }

    // Agregamos la fila de TFOOT al final
    $html .= "<tfoot>
                <tr>
                    <td colspan='4' style='text-align: right; padding-right: 10px;'><strong>Sumatoria Total Acumulada:</strong></td>
                    <td style='background-color: #d1f7d1;'><strong>\${$sumaTotalAcumulada}</strong></td>
                </tr>
              </tfoot>";
    
    $html .= '</table>';
    echo $html;
});