<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EncomiendaController;
use App\Http\Controllers\AsignacionRutaController;
use App\Http\Middleware\RoleMiddleware;


// Ruta principal (pública)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas protegidas por autenticación y verificación de email
Route::middleware(['auth', 'verified'])->group(function () {


    //rutas para reportes 
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{encomienda}/generate-pdf', [ReportController::class, 'generatePdf'])->name('reports.generatePdf');
    
    // Dashboard principal que redirige según el rol
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource route para reportes (accesible por todos los roles autenticados)
    Route::resource('reportes', ReportController::class);
    
    // Rutas de perfil (comunes a todos los roles)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // ================== RUTAS DE ADMINISTRADOR ==================
    Route::middleware(RoleMiddleware::class . ':admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        
        // Rutas de recursos para administrador
        Route::resource('users', UserController::class);
        Route::resource('encomiendas', EncomiendaController::class);
        Route::resource('incidencias', IncidenciaController::class)->only(['index', 'update', 'destroy']);
        
        // Ruta de reportes para administrador
        Route::get('/reportes', [ReportController::class, 'index'])->name('reportes');
    });

    // ================== RUTAS DE OPERADOR ==================
    Route::middleware(RoleMiddleware::class . ':operador')->prefix('operador')->name('operador.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'operadorDashboard'])->name('dashboard');
        
        // Ruta de reportes para operador
        Route::get('/reportes', [ReportController::class, 'index'])->name('reportes');
        
        // Recursos de encomiendas para operador
        Route::resource('encomiendas', EncomiendaController::class);
        
        // Los operadores pueden crear incidencias
        Route::resource('incidencias', IncidenciaController::class)->only(['create', 'store', 'index', 'show']);
    });
    
    // ================== RUTAS DE REMITENTE (Remitente) ==================
    Route::middleware(RoleMiddleware::class . ':remitente')->prefix('remitente')->name('remitente.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'remitenteDashboard'])->name('dashboard');
        Route::resource('encomiendas', EncomiendaController::class)->only(['index', 'show']); 
    });
    
    // ================== RUTAS DE TRANSPORTISTA ==================
Route::middleware(RoleMiddleware::class . ':transportista')->prefix('transportista')->name('transportista.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'transportistaDashboard'])->name('dashboard');

    // Permitir al transportista ver su lista de encomiendas y actualizarlas
    Route::resource('encomiendas', EncomiendaController::class)->only(['index', 'show', 'edit', 'update']);

    // Permitir al transportista ver la página de reportes
    Route::get('/reportes', [ReportController::class, 'index'])->name('reportes.index'); // Asumiendo que el controlador de reportes también filtra por rol
});

// --- RUTA PÚBLICA DE SEGUIMIENTO ---
Route::get('/seguimiento/{numero_seguimiento}', [AsignacionRutaController::class, 'seguimientoPublico'])->name('seguimiento.publico');

//--RUTA ADMIN PASSWORD VERIFICATION
Route::post('/admin/password/verify', [AdminPasswordController::class, 'verify'])->name('admin.password.verify');


//rutas de incidencias

Route::middleware(['auth'])->group(function () {
    // Rutas para la gestión de Incidencias
    // Puedes proteger estas rutas con middleware 'can' o con lógica dentro del controlador
    Route::get('/incidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');
    Route::get('/incidencias/create', [IncidenciaController::class, 'create'])->name('incidencias.create');
    Route::post('/incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
    Route::get('/incidencias/{incidencia}/edit', [IncidenciaController::class, 'edit'])->name('incidencias.edit');
    Route::put('/incidencias/{incidencia}', [IncidenciaController::class, 'update'])->name('incidencias.update');
    Route::delete('/incidencias/{incidencia}', [IncidenciaController::class, 'destroy'])->name('incidencias.destroy');
    Route::patch('/incidencias/{incidencia}/resolve', [IncidenciaController::class, 'markAsResolved'])->name('incidencias.resolve');
});

});
