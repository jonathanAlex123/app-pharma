<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', function () {
    // La caja con los datos de las categorías
    $categorias = json_decode(json_encode([
        ["codigo" => "A02", "categoria" => "Medicamentos para el tratamiento de Trastornos causados por Ácidos"],
        ["codigo" => "A03", "categoria" => "Medicamentos contra Trastornos Funcionales Gastrointestinales"],
        ["codigo" => "A04", "categoria" => "Medicamentos Antieméticos y Antinauseosos"],
        ["codigo" => "A06", "categoria" => "Medicamentos para el Estreñimiento"]
    ]));

    // Dibujando la tabla
    $html = "<h2>Lista de Categorías</h2><table border='1'><tr><th>CÓDIGO</th><th>CATEGORÍA</th></tr>";

    // La maquinita que repite las filas
    foreach ($categorias as $cat) {
        $html .= "<tr><td>$cat->codigo</td><td>$cat->categoria</td></tr>";
    }
    
    $html .= "</table>";
    return $html;
});

Route::get('/medicamentos', function () {
    // La caja con los datos de los medicamentos
    $medicamentos = json_decode(json_encode([
        ["codigo" => "A02BA02", "n" => "1", "nombre" => "Ranitidina", "dosis" => "50 mg", "forma" => "Líquidos parenterales", "via" => "IM/IV"],
        ["codigo" => "A02BA03", "n" => "2", "nombre" => "Famotidina", "dosis" => "40 mg", "forma" => "Sólidos orales", "via" => "VO"]
    ]));

    // Dibujando la tabla
    $html = "<h2>Lista de Medicamentos</h2><table border='1'><tr><th>Código</th><th>N°</th><th>Nombre</th><th>Dosis</th><th>Forma</th><th>Vía</th></tr>";

    // La maquinita que repite las filas
    foreach ($medicamentos as $med) {
        $html .= "<tr><td>$med->codigo</td><td>$med->n</td><td>$med->nombre</td><td>$med->dosis</td><td>$med->forma</td><td>$med->via</td></tr>";
    }
    
    $html .= "</table>";
    return $html;
});
// Ejercicio 1: Catálogo de Clientes VIP
Route::get('/clientes/vip', function () {
    $clientes = [
        (object) ['id' => 1, 'nombre' => 'Juan Pérez', 'telefono' => '7777-1111', 'puntos_altruistas' => 120],
        (object) ['id' => 2, 'nombre' => 'Ana Gómez', 'telefono' => '7777-2222', 'puntos_altruistas' => 340],
        (object) ['id' => 3, 'nombre' => 'Carlos López', 'telefono' => '7777-3333', 'puntos_altruistas' => 50],
    ];
    $html = '<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;"><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Puntos Altruistas</th></tr>';
    foreach ($clientes as $cliente) {
        $html .= "<tr><td>{$cliente->id}</td><td>{$cliente->nombre}</td><td>{$cliente->telefono}</td><td>{$cliente->puntos_altruistas}</td></tr>";
    }
    $html .= '</table>';
    echo $html;
});

// Ejercicio 2: Panel de Proveedores Internacionales
Route::get('/proveedores/internacionales', function () {
    $proveedores = [
        (object) ['empresa' => 'PharmaCorp', 'pais_origen' => 'Alemania', 'medicamento_principal' => 'Aspirina', 'tiempo_entrega_dias' => 10],
        (object) ['empresa' => 'MediLife', 'pais_origen' => 'India', 'medicamento_principal' => 'Paracetamol', 'tiempo_entrega_dias' => 20],
        (object) ['empresa' => 'HealthInc', 'pais_origen' => 'EEUU', 'medicamento_principal' => 'Ibuprofeno', 'tiempo_entrega_dias' => 12],
    ];
    $html = '<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;"><tr><th>Empresa</th><th>País de Origen</th><th>Medicamento Principal</th><th>Tiempo de Entrega (Días)</th></tr>';
    foreach ($proveedores as $proveedor) {
        $advertencia = $proveedor->tiempo_entrega_dias > 15 ? ' <strong style="color:red;">(Demora Crítica)</strong>' : '';
        $html .= "<tr><td>{$proveedor->empresa}</td><td>{$proveedor->pais_origen}</td><td>{$proveedor->medicamento_principal}</td><td>{$proveedor->tiempo_entrega_dias}{$advertencia}</td></tr>";
    }
    $html .= '</table>';
    echo $html;
});

// Ejercicio 3: Inventario Automatizado de Lotes
Route::get('/lotes/inventario', function () {
    $lotes = [
        (object) ['codigo_lote' => 'L-001', 'nombre_medicamento' => 'Insulina', 'cantidad_cajas' => 50, 'temperatura_requerida_celsius' => 4],
        (object) ['codigo_lote' => 'L-002', 'nombre_medicamento' => 'Amoxicilina', 'cantidad_cajas' => 150, 'temperatura_requerida_celsius' => 20],
        (object) ['codigo_lote' => 'L-003', 'nombre_medicamento' => 'Vacuna Antitetánica', 'cantidad_cajas' => 30, 'temperatura_requerida_celsius' => 2],
    ];
    $html = '<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;"><tr><th>Código de Lote</th><th>Nombre del Medicamento</th><th>Cantidad de Cajas</th><th>Temperatura Requerida (°C)</th></tr>';
    foreach ($lotes as $lote) {
        $cadenaFrio = $lote->temperatura_requerida_celsius <= 5 ? ' <strong style="color:blue;">[Requiere Cadena de Frío]</strong>' : '';
        $html .= "<tr><td>{$lote->codigo_lote}</td><td>{$lote->nombre_medicamento}{$cadenaFrio}</td><td>{$lote->cantidad_cajas}</td><td>{$lote->temperatura_requerida_celsius}</td></tr>";
    }
    $html .= '</table>';
    echo $html;
});