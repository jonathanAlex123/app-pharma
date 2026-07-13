<?php

use Illuminate\Support\Facades\Route;

// Ruta principal para que no falle la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// ==========================================================
// PARTE 2: GESTIÓN DE FACTURACIÓN (EJERCICIOS DE LA GUÍA)
// ==========================================================

// Ejercicio 4: Historial General de Facturas de Clientes
Route::get('/facturas/clientes/historial', function () {
    // Simulación de los datos en un arreglo de objetos
    $facturas = [
        (object)['num_factura' => 'F001', 'cliente' => 'Juan Pérez', 'fecha_emision' => '2026-07-01', 'total_pagar' => 150.50, 'estado' => 'Pagada'],
        (object)['num_factura' => 'F002', 'cliente' => 'María Gómez', 'fecha_emision' => '2026-07-05', 'total_pagar' => 320.00, 'estado' => 'Pendiente'],
        (object)['num_factura' => 'F003', 'cliente' => 'Carlos Ruiz', 'fecha_emision' => '2026-07-10', 'total_pagar' => 45.00, 'estado' => 'Pagada']
    ];

    $html = "<h2>Historial General de Facturas</h2>";
    $html .= "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    $html .= "<tr style='background-color: #e0e0e0;'><th>N° Factura</th><th>Cliente</th><th>Fecha</th><th>Total</th><th>Estado</th></tr>";

    foreach ($facturas as $factura) {
        $estadoFormateado = $factura->estado;
        
        // Si está pendiente, se resalta con texto en mayúsculas y alerta en rojo
        if ($factura->estado === 'Pendiente') {
            $estadoFormateado = "<strong style='color: red;'>PENDIENTE DE COBRO ⚠️</strong>";
        }

        $html .= "<tr>
                    <td>{$factura->num_factura}</td>
                    <td>{$factura->cliente}</td>
                    <td>{$factura->fecha_emision}</td>
                    <td>\${$factura->total_pagar}</td>
                    <td>{$estadoFormateado}</td>
                  </tr>";
    }
    $html .= "</table>";
    
    echo $html;
});


// Ejercicio 5: Detalle de Factura de Cliente Específica
Route::get('/facturas/clientes/detalle/{numero}', function (string $numero) {
    $facturas = [
        (object)['num_factura' => 'F001', 'cliente' => 'Juan Pérez', 'fecha_emision' => '2026-07-01', 'total_pagar' => 150.50, 'estado' => 'Pagada'],
        (object)['num_factura' => 'F002', 'cliente' => 'María Gómez', 'fecha_emision' => '2026-07-05', 'total_pagar' => 320.00, 'estado' => 'Pendiente'],
        (object)['num_factura' => 'F003', 'cliente' => 'Carlos Ruiz', 'fecha_emision' => '2026-07-10', 'total_pagar' => 45.00, 'estado' => 'Pagada']
    ];

    $facturaEncontrada = null;

    // Buscamos la factura que coincida con el número de la URL
    foreach ($facturas as $factura) {
        if ($factura->num_factura === $numero) {
            $facturaEncontrada = $factura;
            break;
        }
    }

    // Si la encuentra arma la ficha técnica, si no, muestra el error 404
    if ($facturaEncontrada) {
        $html = "<div style='border: 2px solid #333; padding: 20px; max-width: 400px; font-family: Arial;'>
                    <h2>Ficha de Factura: <strong>{$facturaEncontrada->num_factura}</strong></h2>
                    <hr>
                    <ul>
                        <li><strong>Cliente:</strong> {$facturaEncontrada->cliente}</li>
                        <li><strong>Fecha de Emisión:</strong> {$facturaEncontrada->fecha_emision}</li>
                        <li><strong>Total a Pagar:</strong> \${$facturaEncontrada->total_pagar}</li>
                        <li><strong>Estado actual:</strong> {$facturaEncontrada->estado}</li>
                    </ul>
                 </div>";
    } else {
        $html = "<h1>Factura No Encontrada</h1>";
    }

    echo $html;
});


// Ejercicio 6: Libro de Facturas de Proveedores
Route::get('/facturas/proveedores/resumen', function () {
    $proveedores = [
        (object)['proveedor' => 'Lab Bayer', 'nrc' => '123456-7', 'monto_sin_iva' => 1000.00],
        (object)['proveedor' => 'Pfizer', 'nrc' => '765432-1', 'monto_sin_iva' => 2500.00],
        (object)['proveedor' => 'AstraZeneca', 'nrc' => '987654-3', 'monto_sin_iva' => 1500.00]
    ];

    $html = "<h2>Resumen de Facturas de Proveedores</h2>";
    $html .= "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    $html .= "<tr style='background-color: #d0d0d0;'><th>Proveedor</th><th>NRC</th><th>Monto sin IVA</th><th>IVA (13%)</th><th>Monto Total</th></tr>";

    $sumaTotalGlobal = 0;

    foreach ($proveedores as $prov) {
        // Cálculo dinámico del 13% de IVA y el total por fila
        $iva = $prov->monto_sin_iva * 0.13;
        $montoTotalFila = $prov->monto_sin_iva + $iva;
        
        // Sumatoria acumulada para el pie de tabla
        $sumaTotalGlobal += $montoTotalFila;

        $html .= "<tr>
                    <td>{$prov->proveedor}</td>
                    <td>{$prov->nrc}</td>
                    <td>\${$prov->monto_sin_iva}</td>
                    <td>\${$iva}</td>
                    <td>\${$montoTotalFila}</td>
                  </tr>";
    }

    // Fila final de totales
    $html .= "<tfoot>
                <tr style='background-color: #f5f5f5; font-weight: bold;'>
                    <td colspan='4' style='text-align: right;'>Sumatoria Acumulada:</td>
                    <td>\${$sumaTotalGlobal}</td>
                </tr>
              </tfoot>";
              
    $html .= "</table>";
    
    echo $html;
});