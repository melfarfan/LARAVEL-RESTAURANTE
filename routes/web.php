<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\User;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Perfil de usuario
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'getProfile'])->name('detail');
        Route::post('/update', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('update');
        Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
    });

    // Roles
    Route::resource('roles', App\Http\Controllers\RolesController::class);

    // Permissions
    Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

    // Estudiantes
    Route::resource('estudiantes', App\Http\Controllers\EstudianteController::class);
    Route::get('estudiantes/{estudiante_id}/{estado}', [App\Http\Controllers\EstudianteController::class, 'actualizarEstado'])->name('estudiantes.estado');
    //clientes
    Route::resource('clientes', App\Http\Controllers\ClienteController::class);
    Route::get('clientes/{cliente_id}/{estado}', [App\Http\Controllers\ClienteController::class, 'actualizarEstado'])->name('clientes.estado');

    //CLIENTES 
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    //CATEGORIAS 
    Route::resource('categories', CategoryController::class);
     //PRODUCTOS 
     Route::resource('products', ProductController::class);
     //VENTAS 
     Route::resource('sales', SaleController::class);
    // //  Route::get('sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    // // 
    // Route::get('/sales/{id}/edit', [SaleController::class, 'edit'])->name('sales.edit');

    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');



   
   





    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
        Route::put('/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('update');
        Route::get('/show/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
        Route::delete('/delete/{user}', [App\Http\Controllers\UserController::class, 'delete'])->name('destroy');
        Route::get('/update/status/{user_id}/{status}', [App\Http\Controllers\UserController::class, 'updateStatus'])->name('status');
        Route::get('/import-users', [App\Http\Controllers\UserController::class, 'importUsers'])->name('import');
        Route::post('/upload-users', [App\Http\Controllers\UserController::class, 'uploadUsers'])->name('upload');
        Route::get('export/', [App\Http\Controllers\UserController::class, 'export'])->name('export');
    });

    // Empresas
    Route::resource('empresas', App\Http\Controllers\EmpresaController::class);

    // Ruta para medicos
    Route::resource('medicos', App\Http\Controllers\MedicoController::class);
});
