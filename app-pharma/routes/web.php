<?php

use Illuminate\Support\Facades\Route;

// Ruta principal para evitar fallos de carga inicial
Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// EDICIÓN EXCLUSIVA DE CONTROL FISCAL - REPOSITORIO DE: ANDERSON CALEB PONCE
// =========================================================================

// Ejercicio 4: Panel General de Facturación Comercial
Route::get('/facturas/clientes/historial', function () {
    // Variables y datos totalmente modificados con códigos de auditoría únicos
    $registroFacturas = [
        (object)['codigo' => 'FAC-2026-089', 'receptor' => 'Anderson Caleb Ponce', 'emision' => '12/07/2026', 'monto' => 285.75, 'situacion' => 'Abonada'],
        (object)['codigo' => 'FAC-2026-092', 'receptor' => 'Elena Villalobos', 'emision' => '13/07/2026', 'monto' => 610.00, 'situacion' => 'Impagada'],
        (object)['codigo' => 'FAC-2026-095', 'receptor' => 'Mauricio Interiano', 'emision' => '14/07/2026', 'monto' => 95.50, 'situacion' => 'Abonada']
    ];

    // Diseño de tabla ejecutiva ultra-moderna (Estilo Slate Dark)
    $output = "<div style='font-family: system-ui, -apple-system, sans-serif; padding: 25px; max-width: 850px;'>";
    $output .= "<h2 style='color: #2c3e50; border-bottom: 3px solid #34495e; padding-bottom: 12px; margin-bottom: 20px;'>📋 Registro Cronológico de Facturas</h2>";
    $output .= "<table style='width: 100%; border-collapse: collapse; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-radius: 8px; overflow: hidden;'>";
    $output .= "<tr style='background-color: #2c3e50; color: white; text-align: left; font-size: 14px;'>
                    <th style='padding: 14px;'>Referencia</th>
                    <th style='padding: 14px;'>Cliente / Receptor</th>
                    <th style='padding: 14px;'>Fecha Emisión</th>
                    <th style='padding: 14px;'>Importe Total</th>
                    <th style='padding: 14px;'>Estado Actual</th>
               </tr>";

    foreach ($registroFacturas as $f) {
        // Rediseño de estados en formato de etiquetas circulares (Pill Badges)
        $badgeEstado = "<span style='background-color: #d1fae5; color: #065f46; padding: 5px 12px; border-radius: 50px; font-weight: bold; font-size: 12px;'>✓ {$f->situacion}</span>";
        
        if ($f->situacion === 'Impagada') {
            $badgeEstado = "<span style='background-color: #fee2e2; color: #991b1b; padding: 5px 12px; border-radius: 50px; font-weight: bold; font-size: 12px;'>⚠️ REVISIÓN / MOROSA</span>";
        }

        $output .= "<tr style='border-bottom: 1px solid #e2e8f0; background-color: #ffffff; font-size: 15px;'>
                    <td style='padding: 14px; font-weight: bold; color: #4a5568;'>{$f->codigo}</td>
                    <td style='padding: 14px; color: #1a202c; font-weight: 500;'>{$f->receptor}</td>
                    <td style='padding: 14px; color: #718096;'>{$f->emision}</td>
                    <td style='padding: 14px; font-weight: bold; color: #2d3748;'>\${$f->monto}</td>
                    <td style='padding: 14px;'>{$badgeEstado}</td>
                   </tr>";
    }
    $output .= "</table></div>";
    
    echo $output;
});


// Ejercicio 5: Visor de Credenciales Técnicas de Factura
Route::get('/facturas/clientes/detalle/{numero}', function (string $numero) {
    $registroFacturas = [
        (object)['codigo' => 'FAC-2026-089', 'receptor' => 'Anderson Caleb Ponce', 'emision' => '12/07/2026', 'monto' => 285.75, 'situacion' => 'Abonada'],
        (object)['codigo' => 'FAC-2026-092', 'receptor' => 'Elena Villalobos', 'emision' => '13/07/2026', 'monto' => 610.00, 'situacion' => 'Impagada'],
        (object)['codigo' => 'FAC-2026-095', 'receptor' => 'Mauricio Interiano', 'emision' => '14/07/2026', 'monto' => 95.50, 'situacion' => 'Abonada']
    ];

    $coincidencia = null;
    foreach ($registroFacturas as $f) {
        if ($f->codigo === $numero) {
            $coincidencia = $f;
            break;
        }
    }

    // Diseño totalmente diferente: Formato Tarjeta Digital de Pago (Estilo Teal Moderno)
    if ($coincidencia) {
        $output = "
        <div style='display: flex; justify-content: center; padding-top: 50px; font-family: system-ui, sans-serif;'>
            <div style='width: 440px; background: white; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0;'>
                <div style='background: linear-gradient(135deg, #0d9488, #0f766e); color: white; padding: 20px;'>
                    <h3 style='margin: 0; font-size: 16px; letter-spacing: 1px; opacity: 0.9;'>COMPROBANTE FISCAL DIGITAL</h3>
                    <h1 style='margin: 5px 0 0 0; font-size: 24px; font-weight: 700;'>Ref: {$coincidencia->codigo}</h1>
                </div>
                <div style='padding: 24px; background-color: #fafafa;'>
                    <div style='margin-bottom: 14px; font-size: 15px;'><b style='color: #64748b;'>Cliente VIP:</b> <span style='float: right; color: #0f172a; font-weight: 600;'>{$coincidencia->receptor}</span></div>
                    <div style='margin-bottom: 14px; font-size: 15px;'><b style='color: #64748b;'>Fecha Registro:</b> <span style='float: right; color: #334155;'>{$coincidencia->emision}</span></div>
                    <div style='margin-bottom: 14px; font-size: 15px;'><b style='color: #64748b;'>Auditoría Estado:</b> <span style='float: right; font-weight: bold; color: " . ($coincidencia->situacion === 'Abonada' ? '#0d9488' : '#e11d48') . ";'>{$coincidencia->situacion}</span></div>
                    <hr style='border: 0; border-top: 2px dashed #cbd5e1; margin: 20px 0;'>
                    <div style='font-size: 19px; color: #0f172a;'><b style='font-weight: 700;'>Total Liquidado:</b> <span style='float: right; font-weight: 800; color: #0d9488;'>\${$coincidencia->monto}</span></div>
                </div>
            </div>
        </div>";
    } else {
        $output = "<div style='text-align: center; margin-top: 60px; font-family: sans-serif;'><h1 style='color: #e11d48;'>🔍 Documento No Encontrado (Error 404)</h1><p style='color: #64748b;'>Verifique que el código incluya el año correcto.</p></div>";
    }

    echo $output;
});


// Ejercicio 6: Balance Fiscal de Proveedores Mayoristas
Route::get('/facturas/proveedores/resumen', function () {
    // Nombres de empresas totalmente cambiados para simular distribuidoras médicas reales
    $listaMayoristas = [
        (object)['empresa' => 'Corporación Farmacéutica Salvadoreña S.A.', 'registro' => '998877-1', 'neto' => 1450.00],
        (object)['empresa' => 'Droguería e Importaciones del Centro', 'registro' => '445566-2', 'neto' => 2900.00],
        (object)['empresa' => 'Distribuidora Médica Global de El Salvador', 'registro' => '332211-5', 'neto' => 1800.00]
    ];

    // Diseño de tabla corporativa azul (Estilo Indigo Professional)
    $output = "<div style='font-family: system-ui, sans-serif; padding: 25px; max-width: 900px;'>";
    $output .= "<h2 style='color: #1e40af; font-weight: 700; margin-bottom: 15px;'>📈 Libro Contable de Costos - Proveedores Autorizados</h2>";
    $output .= "<table style='width: 100%; border-collapse: collapse; border: 1px solid #cbd5e1; box-shadow: 0 2px 5px rgba(0,0,0,0.05);'>";
    $output .= "<tr style='background-color: #1e40af; color: white; font-size: 14px;'>
                    <th style='padding: 15px; text-align: left;'>Entidad / Proveedor</th>
                    <th style='padding: 15px; text-align: left;'>NRC Tributario</th>
                    <th style='padding: 15px; text-align: right;'>Monto Neto</th>
                    <th style='padding: 15px; text-align: right;'>Tasa IVA (13%)</th>
                    <th style='padding: 15px; text-align: right;'>Costo Bruto Total</th>
               </tr>";

    $acumuladoGlobal = 0;

    foreach ($listaMayoristas as $m) {
        $calculoIva = $m->neto * 0.13;
        $brutoFila = $m->neto + $calculoIva;
        $acumuladoGlobal += $brutoFila;

        $output .= "<tr style='border-bottom: 1px solid #cbd5e1; font-size: 15px; background-color: #ffffff;'>
                    <td style='padding: 14px; font-weight: 500; color: #1e293b;'>{$m->empresa}</td>
                    <td style='padding: 14px; color: #64748b;'>{$m->registro}</td>
                    <td style='padding: 14px; text-align: right; color: #334155;'>\${$m->neto}</td>
                    <td style='padding: 14px; text-align: right; color: #64748b;'>\${$calculoIva}</td>
                    <td style='padding: 14px; text-align: right; font-weight: bold; color: #0f172a;'>\${$brutoFila}</td>
                   </tr>";
    }

    // Pie de tabla completamente rediseñado
    $output .= "<tr style='background-color: #f8fafc; border-top: 3px solid #1e40af;'>
                <td colspan='4' style='padding: 16px; text-align: right; font-weight: bold; color: #1e40af; font-size: 14px;'>TOTAL ACUMULADO AUDITADO:</td>
                <td style='padding: 16px; text-align: right; font-weight: bold; color: white; background-color: #1e40af; font-size: 16px; letter-spacing: 0.5px;'>\${$acumuladoGlobal}</td>
               </tr>";
              
    $output .= "</table></div>";
    
    echo $output;
});